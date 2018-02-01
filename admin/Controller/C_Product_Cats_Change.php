<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Product_Cats_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Product_cats = array();
        $this->Product_cats_new = array();
        $this->Sections = array();
        $this->Url = array();
        $this->Gallery = array();
    }

    // виртуальный обработчик запроса
    protected function OnInput()
    {
        parent::OnInput();

        // берем один экземпляр класса Model:
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

            $this->Product_cats_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->Product_cats = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Product_cats_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->Product_cats_new['checkbox']) ? $this->Product_cats_new['checkbox'] = 0 : "";

            if ($this->Product_cats['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Product_cats_new['position'] = $m_colums->getMaxPosition($this->table) + 1;

                //___if Insert

                $this->Product_cats_new['id'] = $this->Product_cats['id'] = $msql->Insert($this->table, $this->Product_cats_new);

                $arrayUA['id_product_cats'] = $this->Product_cats['id'];
                $arrayRU['id_product_cats'] = $this->Product_cats['id'];
                $arrayEN['id_product_cats'] = $this->Product_cats['id'];

                $msql->Insert('product_catsTranslate', $arrayUA);
                $msql->Insert('product_catsTranslate', $arrayRU);
                $msql->Insert('product_catsTranslate', $arrayEN);
            }

            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Product_cats_new[$key] = $m_colums->Upload_image($key,
                        $_FILES[$key],
                        $this->Product_cats['id']);
                } else {
                    $this->Product_cats_new[$key] = $this->Product_cats[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->Product_cats_new, " `id`='" . $this->Product_cats['id'] . "'");

            $msql->Update('product_catsTranslate', $arrayUA, " `id_product_cats`='" . $this->Product_cats['id'] . "' AND lang = 'ua'");
            $msql->Update('product_catsTranslate', $arrayRU, " `id_product_cats`='" . $this->Product_cats['id'] . "' AND lang = 'ru'");
            $msql->Update('product_catsTranslate', $arrayEN, " `id_product_cats`='" . $this->Product_cats['id'] . "' AND lang = 'en'");


            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /admin/?t=" . $this->table . "&c=select&page=1");
            } else {
                header("Location: /admin/?t=" . $this->table . "&c=change&id=" . $this->Product_cats['id']);
            }
        }


        // используем метод класса Model для вывода секции по id
        $this->Product_cats = $object->Row_by_id($this->table, $_GET['id']);
        if (isset($_GET['id'])) {
            $this->Product_catsUA = $object->Row_where("product_catsTranslate", "WHERE id_product_cats = $_GET[id] AND lang = 'ua'");
            $this->Product_catsRU = $object->Row_where("product_catsTranslate", "WHERE id_product_cats = $_GET[id] AND lang = 'ru'");
            $this->Product_catsEN = $object->Row_where("product_catsTranslate", "WHERE id_product_cats = $_GET[id] AND lang = 'en'");
        }
        $this->Categories = $object->Array_where($this->table, "WHERE `has_child`='1'");

        //формуємо за допомогою шаблону юрла
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Product_cats['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->Product_cats['url']);
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "'"), "field_name");
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'product_catsTranslate'"), "field_name");

//        print_r($this->SettingsTranslate);

        $this->Gallery = $object->Array_where('galleries', 'ORDER by name');
    }


    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Product_cats,
                'columnsUA' => $this->Product_catsUA,
                'columnsRU' => $this->Product_catsRU,
                'columnsEN' => $this->Product_catsEN,
                'categories' => $this->Categories,
                'table' => $this->table,
                'sections' => $this->Sections,
                'settingsTranslate' => $this->SettingsTranslate,
                'url' => $this->Url,
                'galleries' => $this->Gallery,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
