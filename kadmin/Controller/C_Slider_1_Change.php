<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Slider_1_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Slider_1 = array();
        $this->Slider_1_new = array();
        $this->Sections = array();
        $this->Url = array();
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

            $this->Slider_1_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->Slider_1 = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Slider_1_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->Slider_1_new['checkbox']) ? $this->Slider_1_new['checkbox'] = 0 : "";

            if ($this->Slider_1['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Slider_1_new['position'] = $m_colums->getMaxPosition($this->table) + 1;

                //___if Insert
                $this->Slider_1_new['id'] = $this->Slider_1['id'] = $msql->Insert($this->table, $this->Slider_1_new);

                $arrayUA['id_slider_1'] = $this->Slider_1['id'];
                $arrayRU['id_slider_1'] = $this->Slider_1['id'];
                $arrayEN['id_slider_1'] = $this->Slider_1['id'];

                $msql->Insert('slider_1Translate', $arrayUA);
                $msql->Insert('slider_1Translate', $arrayRU);
                $msql->Insert('slider_1Translate', $arrayEN);
            }


            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Slider_1_new[$key] = $m_colums->Upload_image($key,
                        $_FILES[$key],
                        $this->Slider_1['id']);
                } else {
                    $this->Slider_1_new[$key] = $this->Slider_1[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->Slider_1_new, " `id`='" . $this->Slider_1['id'] . "'");

            $msql->Update('slider_1Translate', $arrayUA, " `id_slider_1`='" . $this->Slider_1['id'] . "' AND lang = 'ua'");
            $msql->Update('slider_1Translate', $arrayRU, " `id_slider_1`='" . $this->Slider_1['id'] . "' AND lang = 'ru'");
            $msql->Update('slider_1Translate', $arrayEN, " `id_slider_1`='" . $this->Slider_1['id'] . "' AND lang = 'en'");


            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /kadmin/?t=" . $this->table . "&c=select&page=1");
            } else {
                header("Location: /kadmin/?t=" . $this->table . "&c=change&id=" . $this->Slider_1['id']);
            }
        }

        // используем метод класса Model для вывода секции по id
        $this->Slider_1 = $object->Row_by_id($this->table, $_GET['id']);

        if (isset($_GET['id'])) {
            $this->Slider_1UA = $object->Row_where("slider_1Translate", "WHERE id_slider_1 = $_GET[id] AND lang = 'ua'");
            $this->Slider_1RU = $object->Row_where("slider_1Translate", "WHERE id_slider_1 = $_GET[id] AND lang = 'ru'");
            $this->Slider_1EN = $object->Row_where("slider_1Translate", "WHERE id_slider_1 = $_GET[id] AND lang = 'en'");
        }

        //формуємо за допомогою шаблону юрла
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Slider_1['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->Slider_1['url']);
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "'"), "field_name");
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'slider_1Translate'"), "field_name");

    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Slider_1,
                'columnsUA' => $this->Slider_1UA,
                'columnsRU' => $this->Slider_1RU,
                'columnsEN' => $this->Slider_1EN,
                'table' => $this->table,
                'sections' => $this->Sections,
                'settingsTranslate' => $this->SettingsTranslate,
                'url' => $this->Url,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
