<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Sections_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Section = array();
        $this->Section_new = array();
        $this->Url = '';
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

            $this->Section_new = $arrayMain;


            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->Section = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Section_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox

            !isset($this->Section_new['landing']) ? $this->Section_new['landing'] = 0 : "";
            !isset($this->Section_new['has_subsect']) ? $this->Section_new['has_subsect'] = 0 : "";
            !isset($this->Section_new['checkbox']) ? $this->Section_new['checkbox'] = 0 : "";

            if ($this->Section['id'] == null) {
                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Section_new['position'] = $m_colums->getMaxPosition($this->table) + 1;


                //___if Insert
                $this->Section_new['id'] = $this->Section['id'] = $msql->Insert($this->table, $this->Section_new);

                $arrayUA['id_section'] = $this->Section['id'];
                $arrayRU['id_section'] = $this->Section['id'];
                $arrayEN['id_section'] = $this->Section['id'];

                $msql->Insert('sectionsTranslate', $arrayUA);
                $msql->Insert('sectionsTranslate', $arrayRU);
                $msql->Insert('sectionsTranslate', $arrayEN);

                //додаємо секцію в сетінги
                $m_colums->addNewTableInToSettings('sectionsTranslate', $this->Section['id']);
                $m_colums->addNewTableInToSettings($this->table, $this->Section['id']);
            }

            if ($this->Section_new['has_subsect'] == 1) {
                $check_existing_fields = $object->Row_where('settings', 'WHERE `table` = "subsections" AND field_id = "' . $_GET['id'] . '"');
                if (!$check_existing_fields) {
                    //додаємо налаштування для сабсекції в сетінги
                    $m_colums->addNewTableInToSettings('subsections', $this->Section['id']);
                    $m_colums->addNewTableInToSettings('subsectionsTranslate', $this->Section['id']);

                }
            }
            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Section_new[$key] = $m_colums->Upload_image($key,
                        $_FILES[$key],
                        $this->Section['id']);

                } else {
                    $this->Section_new[$key] = $this->Section[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->Section_new, " `id`='" . $this->Section['id'] . "'");

            $msql->Update('sectionsTranslate', $arrayUA, " `id_section`='" . $this->Section['id'] . "' AND lang = 'ua'");
            $msql->Update('sectionsTranslate', $arrayRU, " `id_section`='" . $this->Section['id'] . "' AND lang = 'ru'");
            $msql->Update('sectionsTranslate', $arrayEN, " `id_section`='" . $this->Section['id'] . "' AND lang = 'en'");
            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                if ($_SESSION['authorize']['status'] == 1) {
                    header("Location: /kadmin/?t=" . $this->table . "&c=select&page=1");
                } else {
                    header("Location: /kadmin/?t=" . $this->table . "&c=change&id=" . $this->Section['id']);
                }
            } else {
                header("Location: /kadmin/?t=" . $this->table . "&c=change&id=" . $this->Section['id']);
            }
        }

        // используем метод класса Model для вывода секции по id
        $this->Section = $object->Row_by_id($this->table, $_GET['id']);
        if (isset($_GET['id'])) {
            $this->SectionUA = $object->Row_where("sectionsTranslate", "WHERE id_section = $_GET[id] AND lang = 'ua'");
            $this->SectionRU = $object->Row_where("sectionsTranslate", "WHERE id_section = $_GET[id] AND lang = 'ru'");
            $this->SectionEN = $object->Row_where("sectionsTranslate", "WHERE id_section = $_GET[id] AND lang = 'en'");
        }

        //make URL by template
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Section['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->Section['url']);
        }

        //get all settings for this table
        if ($_GET['id']) {
            $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "' AND `field_id`='" . $_GET['id'] . "'"), "field_name");
            $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'sectionsTranslate' AND `field_id`='" . $_GET['id'] . "'"), "field_name");
        } else {
            $this->Settings = array();
            $this->SettingsTranslate = array();
        }
    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Section,
                'columnsUA' => $this->SectionUA,
                'columnsRU' => $this->SectionRU,
                'columnsEN' => $this->SectionEN,
                'table' => $this->table,
                'url' => $this->Url,
                'settingsTranslate' => $this->SettingsTranslate,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
