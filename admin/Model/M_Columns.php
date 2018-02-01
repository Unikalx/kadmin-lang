<?php
include_once('Model/Model.php');

Class M_Columns extends MSQL
{
    // ññûëêà íà ýêçåìïëÿð êëàññà
    private static $instance;
    private $privatFields = array(1 => 'id', 2 => 'landing', 3 => 'has_subsect', 4 => 'position', 5 => 'id_section');

    // ïîëó÷åíèå ýêçåìïëÿðà êëàññà
    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new M_Columns();
        }

        return self::$instance;
    }

// êîíñòðóêòîð
    public function __construct()
    {
        $this->model = Model::Instance();
        $this->msql = MSQL::Instance();
    }

    // генирация случайной строки
    public function GenerateStr($length = 10)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
        $code = '';
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }

// çàãðóãêà êàðòèíêè
    public function Upload_image($prefix, $file, $id)
    {

        $table = trim(mysql_real_escape_string($_GET['t']));
        $path_info = pathinfo($file['name']);
        $mime = mb_strtolower($path_info['extension'], 'utf-8');
        $rand = $this->GenerateStr();
        if ($mime == 'jpg' && $prefix !='pdf' || $mime == 'jpeg' && $prefix !='pdf' || $mime == 'gif' && $prefix !='pdf' || $mime == 'png' && $prefix !='pdf' /*|| $mime == 'pdf'*/) {
            $image_name = '';
            $filename = $table . '_' . $prefix . '_' . $rand . '.' . $mime;
            @mkdir("../pictures/" . $table);
            if (copy($file['tmp_name'], '../pictures/' . $table . '/' . $filename)) {
                $image_name = $filename;
            }
        }
        if ($mime == 'pdf') {
            $image_name = '';
            $filename = $table . '_' . $prefix . '_' . $rand . '.' . $mime;
            @mkdir("../pdf/" . $table);
            if (copy($file['tmp_name'], '../pdf/' . $table . '/' . $filename)) {
                $image_name = $filename;
            }
        }
        return $image_name;
    }

// âèäàëåííÿ photo
    public function deletePhoto($table, $field, $id)
    {
        $fileName = $this->msql->Select("SELECT $field FROM $table WHERE id = $id");

        $fileName = $fileName[0][$field];

        if (file_exists(__DIR__ . '/../../pictures/' . $table . '/' . $fileName)) {
            unlink(__DIR__ . '/../../pictures/' . $table . '/' . $fileName);
        } elseif (file_exists(__DIR__ . '/../../pdf/' . $table . '/' . $fileName)) {
            unlink(__DIR__ . '/../../pdf/' . $table . '/' . $fileName);
        }

        $this->msql->Update($table, array($field => ''), sprintf("id=%s", $id));
    }

//ôîðìóºìî çà äîïîìîãîþ øàáëîíó þðë
    public static function getFormatUrl($table, $vall)
    {

        if ($table != 'teams') {
            $url = constant("SET_URL_TEMPLATE_" . strtoupper($table));

            for ($i = 1; $i <= count($vall); $i++) {
                //ïîì³÷àºìî íåçàïîâíåíå ïîëå â url
                $vall[$i] = $vall[$i] != '' ? $vall[$i] : '';
                $url = str_replace('{' . $i . '}', $vall[$i], $url);
            }
            return $url;
        }
    }

//âèäàëåííÿ âñ³õ çíà÷åíü ç òàáëèö³ ..._in_cats ïî id
    public function delInCats($table, $id)
    {
        $val = '';
        if ($table == "featured")
            $val = "id_featured";
        if ($table == "product_in_cats")
            $val = "id_product";
        if ($table == "article_in_cats")
            $val = "id_article";
        return $this->msql->Delete($table, " $val='$id'");
    }

//äîäàºìî çíà÷åíü â òàáëèöó ..._in_cats ïî id
    public function addInCats($table, $categories, $id)
    {
        $val = '';
        if ($table == "featured")
            $val = "id_featured";
        if ($table == "product_in_cats")
            $val = "id_product";
        if ($table == "article_in_cats")
            $val = "id_article";
        foreach ($categories as $category) {
            $this->msql->Insert($table, array($val => $id, 'id_category' => $category));
        }
    }

// äëÿ çáåð³ãàííÿ çîáðàæåíü â ãàëåðå¿
    public function saveGalleryImage($file, $productId, $table, $in_to)
    {
        $val = '';
        $uploaddir = __DIR__ . '/../../pictures/' . $table . '/';
        if ($table == 'products')
            $val = 'id_product';
        if ($table == 'galleries')
            $val = 'id_gallery';

        if (!is_dir($uploaddir)) mkdir($uploaddir);

        $fileName = sha1(uniqid(mt_rand(), true)) . substr($file['name'], strripos($file['name'], '.'));
        $uploadfile = $uploaddir . $fileName;

        if (move_uploaded_file($file['tmp_name'], $uploadfile)) {

            $name = substr($file['name'], 0, strripos($file['name'], '.'));

            $id = $this->msql->Insert($in_to, array(
                $val => $productId,
                'name' => $name,
                'image' => $fileName));

            echo json_encode(array(
                'id' => $id,
                'name' => $name,
                'image' => '/pictures/' . $table . '/' . $fileName,
            ));

        } else {
            echo json_encode(array('status' => 'error', 'message' => 'File wasn\'t upload'));
        }

        die;
    }

//âèäàëåííÿ êàðòèíêè ç ãàëåðå¿
    public function deleteGalleryPhoto($id, $table, $in_to)
    {
        $q = "SELECT image FROM `$in_to` WHERE id = %s";
        $q = sprintf($q, $id);
        $image = $this->msql->Select($q);

        $path = __DIR__ . ' /../../pictures/' . $table . '/' . $image[0]['image'];

        if (file_exists($path)) {
            unlink($path);
        }

        $this->msql->Delete($in_to, 'id=' . $id);
    }

// Çì³íèòè ïîçèö³¿ ïîë³â
    public function changeFieldsPosition($table_name, $fields_id, $first_position)
    {
        $values = "";
        for ($i = 0; $i < count($fields_id); $i++) {
            $values .= "(" . $fields_id[$i] . ", " . ($first_position + $i) . ")";
            if ($i != (count($fields_id) - 1)) {
                $values .= ", ";
            }
        }
        $query = "INSERT INTO %s (`id`, `position`) VALUES %s ON DUPLICATE KEY UPDATE `position` = VALUES(`position`)";
        $query = sprintf($query, $table_name, $values);
        $result = mysql_query($query);
        if (!$result) {
            die(mysql_error());
        } else {
            return true;
        }
    }

// äîäàòè íîâ³ òåãè â áä
    public function addTags($names)
    {

        $id = (int)$_GET['id'];

        $tmp = '\'' . implode('\', \'', $names) . '\'';
        $q = "SELECT `name` FROM `article_tags` WHERE `article_id`='$id'";

        $res = $this->msql->Select($q);

        foreach ($res as &$r) {
            foreach ($names as &$n) {
                if ($r['name'] == $n) {
                    $n = null;
                    $r = null;
                }
            }
        }

        $q = "INSERT INTO `article_tags` (name,article_id) VALUES ('%s','$id')";

        foreach ($names as $name) {
            if ($name !== null) {
                $this->msql->Select(sprintf($q, $name));
            }
        }

        //âèäàëåííÿ íåïîòð³áíèõ òåã³â
        $tmp = '';
        foreach ($res as $del) {
            if ($del['name'] != '')
                $tmp .= "'" . $del['name'] . "', ";
        }

        if (!empty($tmp)) {
            $this->msql->Delete("article_tags", "`article_id`='$id' AND `name` IN (" . substr($tmp, 0, -2) . ")");
        }
        return true;
    }

//îòðèìàííÿ òåã³â äëÿ àâòîêîìïë³òà
    public function getTagsByQuery($val)
    {
        $res = array();
        $val = trim(mysql_real_escape_string($val));
        $tags = $this->msql->Select("SELECT `name` FROM `article_tags` WHERE `name` LIKE '%$val%' GROUP BY `name`");
        foreach ($tags as $tag) {
            $res[] = $tag['name'];
        }
        return $res;
    }

//âèçíà÷åííÿ ìàêñèâàëüíî¿ ïîçèö³¿ â òàáëèö³
    public function getMaxPosition($table, $cat_id = null)
    {
        $where = '';
        //âèçíà÷àºìî ìàêñèìàëüíó ïîçèö³þ ó âêçàí³é êàòåãîð³¿
        if ($table == 'products' && $cat_id)
            $where = " WHERE `id` IN (SELECT `id_product` FROM `product_in_cats` WHERE `id_category`='" . $cat_id . "')";
        elseif ($table == 'articles' && $cat_id)
            $where = " WHERE `id` IN (SELECT `id_article` FROM `article_in_cats` WHERE `id_category`='" . $cat_id . "')";
        elseif ($table == 'galleries' && $cat_id)
            $where = " WHERE `id_category`='" . $cat_id . "'";
        elseif ($table == 'subsections' && $cat_id)
            $where = " WHERE `id_sect`='" . $cat_id . "'";

        $position = $this->msql->Select("SELECT MAX(`position`) as position FROM `$table` " . $where);

        return $position[0]['position'] ? $position[0]['position'] : 0;
    }

//âèçíà÷àºìî ùî äàíà òàáëèöÿ ìàº ïîëå 'position'
    public function ifIssetPosition($table)
    {
        return $this->msql->Select("show columns FROM `$table` where `Field` = 'position'") ? true : false;
    }

//çì³íà name êàðòèíîê ç ãàëåðå¿
    public function changeGalleryImageName($table, $name, $id)
    {
        $table_name = '';
        if ($table == 'products')
            $table_name = 'product_images';
        elseif ($table == 'galleries')
            $table_name = 'gallery_images';

        return $this->msql->Update($table_name, array('name' => $name), "`id`='$id'") > 0 ? 'true' : 'false';
    }


////////////////////SETTINGS/////////////////////

//äîäàòè íîâó òàáëèöþ â settings
//ÿêùî table_name=subsection, òî id áåðåòüñÿ áàòüê³âñüêî¿ ñåêö³¿
    public function addNewTableInToSettings($table, $id = '-1')
    {
        $query_val = '';
        $query_insert = "INSERT INTO `settings`( `table`, `field_id`, `field_name`) VALUES ";


        $query = "SHOW COLUMNS FROM " . $table;

        $res = mysql_query($query);


        while ($row = mysql_fetch_assoc($res)) {
            if (!in_array($row['Field'], $this->privatFields) && $row['Field'] !== 'lang') {
                $query_val .= "('" . $table . "','" . $id . "','" . $row['Field'] . "'),";
            }
        }
        if ($query_val != '') {
            $res = mysql_query($query_insert . substr($query_val, 0, -1));
            return true;
        } else {
            return false;
        }
    }

//ââ³ìêíåííÿ/âèìêíåííÿ ïîëÿ â òàáëèö³ settings
    public function OnOffField($on_off, $table, $name, $id)
    {
        return $this->msql->Update("settings", array('on_off' => $on_off), "`field_id`='$id' AND `table`='$table' AND `field_name`='$name'") ? $on_off : false;
    }

//çì³íà title ïîëÿ
    public function changeTitle($table, $name, $id, $newTitle)
    {
        return $this->msql->Update("settings", array('field_title' => $newTitle), "`field_id`='$id' AND `table`='$table' AND `field_name`='$name'") ? true : false;
    }

//çì³íà title ïîëÿ
    public function changeStyle($table, $name, $id, $newStyle)
    {
        return $this->msql->Update("settings", array('field_style' => $newStyle), "`field_id`='$id' AND `table`='$table' AND `field_name`='$name'") ? true : false;
    }

//ñòâîðåííÿ íîâî¿ íàçâè ³ñíóþ÷³é òàáëèö³
    public function newTableName($name, $table)
    {

        $file = 'config.php';
        // OPEN FILE TO GET DATA
        $current = file_get_contents($file);
        if ($name == 1 || $name == 0)
            $newName = $name;
        else
            $newName = "'" . $name . "'";

        $table = strtoupper($table);

        $domain = explode("'" . $table . "', ", $current);
        $newName = "'" . $table . "', " . $newName;
        $oldName = stristr($domain[1], ')', true);

        $domain[1] = substr_replace($domain[1], $newName, 0, strlen($oldName));

        $current = $domain[0] . $domain[1];

        // WRITE TO THE FILE
        file_put_contents($file, $current);
    }
}


?>