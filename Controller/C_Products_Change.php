<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Products_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Product = array();
        $this->Product_new = array();
        $this->Product_cats = array();
        $this->Product_in_cats = array();
        $this->Images = array();
        $this->Category = array();
        $this->Url = array();
    }

    // виртуальный обработчик запроса
    protected function OnInput()
    {
        parent::OnInput();
        $object = Model::Instance();
        $m_colums = M_Columns::Instance();
        $msql = MSQL::Instance();

        $this->title = $this->title;

        if ($this->IsPost()) {

            $arrayMain = [];
            $arrayUA = ['lang' => 'ua'];
            $arrayRU = ['lang' => 'ru'];
            $arrayEN = ['lang' => 'en'];


            foreach ($_POST[$this->table] as $key => $item) {
                if (preg_match('/^ua/', $key)) {
                    $arrayUA[substr($key, 2)] = $item;

                } elseif (preg_match('/^ru/', $key)) {
                    $arrayRU[substr($key, 2)] = $item;

                } elseif (preg_match('/^en/', $key)) {
                    $arrayEN[substr($key, 2)] = $item;

                } else {
                    $arrayMain[$key] = $item;
                }
            }

            //видалення фотографії
            if (isset($_POST['delete'])) {
                $m_colums->deletePhoto($this->table, $_POST['field'], $_POST['id']);
                echo json_encode($_POST);
                die;
            }
            // звантаження фото в галерею
            if (isset($_POST['gallery']) && isset($_POST['upload'])) {
                $m_colums->saveGalleryImage($_FILES['file'], $_GET['id'], $this->table, 'product_images');
            }

            // видалення фото з галереї
            if (isset($_POST['deletePhotoGallery'])) {
                $m_colums->deleteGalleryPhoto($_POST['imageId'], $this->table, 'product_images');
                echo json_encode(array('status' => 'success'));
                die;
            }
            //змінюємо позицію картинок
            if (isset($_POST['changePositionImage'])) {
                $responce['result'] = $m_colums->changeFieldsPosition('product_images', $_POST['fields_id'], $_POST['first_position']);
                echo json_encode($responce);
                die;
            }
            //змінюємо name картинок з галереї
            if (isset($_POST['new_name']) && $_POST['new_name'] != '') {
                $name = trim(mysql_real_escape_string($_POST['new_name']));
                $id = (int)$_POST['id'];
                $responce = $m_colums->changeGalleryImageName($this->table, $name, $id);
                die;
            }

            $this->Product_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода по id
                $this->Product = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Product_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->Product_new['checkbox']) ? $this->Product_new['checkbox'] = 0 : "";

            if ($this->Product['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Product_new['position'] = $m_colums->getMaxPosition($this->table, $_POST['a_cat'][0]) + 1;

                //___if Insert
                $this->Product_new['id'] = $this->Product['id'] = $msql->Insert($this->table, $this->Product_new);

                $arrayUA['id_product'] = $this->Product['id'];
                $arrayRU['id_product'] = $this->Product['id'];
                $arrayEN['id_product'] = $this->Product['id'];


                $msql->Insert('productsTranslate', $arrayUA);
                $msql->Insert('productsTranslate', $arrayRU);
                $msql->Insert('productsTranslate', $arrayEN);
            }

            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Product_new[$key] = $m_colums->Upload_image($key, $_FILES[$key], $this->Product['id']);
                } else {
                    $this->Product_new[$key] = $this->Product[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->Product_new, " `id`='" . $this->Product['id'] . "'");

            $msql->Update('productsTranslate', $arrayUA, " `id_product`='" . $this->Product['id'] . "' AND lang = 'ua'");
            $msql->Update('productsTranslate', $arrayRU, " `id_product`='" . $this->Product['id'] . "' AND lang = 'ru'");
            $msql->Update('productsTranslate', $arrayEN, " `id_product`='" . $this->Product['id'] . "' AND lang = 'en'");

            //зберігаємо категорії для продукту
            if (isset($_POST['a_cat']) && !empty($_POST['a_cat'])) {
                $cat = array();
                $cats = $_POST['a_cat'];
                for ($i = 0; $i < count($cats); $i++) {
                    $cat[] = $cats[$i];
                }
                // очищаємо всі старі данні з таблиці "product_in_cats"
                $m_colums->delInCats('product_in_cats', $this->Product['id']);
                // додоаємо нові данні в таблицю "product_in_cats"
                $m_colums->addInCats('product_in_cats', $cat, $this->Product['id']);
            }

            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /kadmin/?t=" . $this->table . "&c=select&page=1");
            } else {
                header("Location: /kadmin/?t=" . $this->table . "&c=change&id=" . $this->Product['id']);
            }
        }

        // используем метод класса Model для вывода данных
        $this->Product = $object->Row_by_id($this->table, $_GET['id']);
        if (isset($_GET['id'])) {
            $this->ProductUA = $object->Row_where("productsTranslate", "WHERE id_product = $_GET[id] AND lang = 'ua'");
            $this->ProductRU = $object->Row_where("productsTranslate", "WHERE id_product = $_GET[id] AND lang = 'ru'");
            $this->ProductEN = $object->Row_where("productsTranslate", "WHERE id_product = $_GET[id] AND lang = 'en'");
        }
        $this->Product_cats = $object->Array_clean("SELECT pc.id, pcT.name AS nameT FROM product_cats AS pc JOIN product_catsTranslate AS pcT ON (pcT.id_product_cats = pc.id) WHERE `lang`='".ADMIN_LANG."'");
        $this->Product_in_cats = $object->Array_where('product_in_cats', "WHERE `id_product`='" . $this->Product['id'] . "'");
        $this->Images = $object->Array_where('product_images', "WHERE `id_product`='" . $this->Product['id'] . "' ORDER BY `position`");
        $this->Category = $object->Row_by_id('product_cats', $this->Product['category']);


        //формуємо за допомогою шаблону url
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Category['url'], 2 => $this->Product['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->Product['url']);
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "'"), "field_name");
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'productsTranslate'"), "field_name");


    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Product,
                'columnsUA' => $this->ProductUA,
                'columnsRU' => $this->ProductRU,
                'columnsEN' => $this->ProductEN,
                'table' => $this->table,
                'categories' => $this->Product_cats,
                'product_in_cats' => $this->Product_in_cats,
                'url' => $this->Url,
                'images' => $this->Images,
                'settingsTranslate' => $this->SettingsTranslate,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
