<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Subsections_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Subsection = array();
        $this->Subsection_new = array();
        $this->Sections = array();
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

            $this->Subsection_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->Subsection = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Subsection_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->Subsection_new['checkbox']) ? $this->Subsection_new['checkbox'] = 0 : "";

            if ($this->Subsection['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Subsection_new['position'] = $m_colums->getMaxPosition($this->table, $this->Subsection_new['id_sect']) + 1;

                //___if Insert
                $this->Subsection_new['id'] = $this->Subsection['id'] = $msql->Insert($this->table, $this->Subsection_new);

                $arrayUA['id_subsection'] = $this->Subsection['id'];
                $arrayRU['id_subsection'] = $this->Subsection['id'];
                $arrayEN['id_subsection'] = $this->Subsection['id'];

                $msql->Insert('subsectionsTranslate', $arrayUA);
                $msql->Insert('subsectionsTranslate', $arrayRU);
                $msql->Insert('subsectionsTranslate', $arrayEN);


            }

            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Subsection_new[$key] = $m_colums->Upload_image($key,
                        $_FILES[$key],
                        $this->Subsection['id']);
                } else {
                    $this->Subsection_new[$key] = $this->Subsection[$key];
                }
            }


            //___if Update
            $msql->Update($this->table, $this->Subsection_new, " `id`='" . $this->Subsection['id'] . "'");

            $msql->Update('subsectionsTranslate', $arrayUA, " `id_subsection`='" . $this->Subsection['id'] . "' AND lang = 'ua'");
            $msql->Update('subsectionsTranslate', $arrayRU, " `id_subsection`='" . $this->Subsection['id'] . "' AND lang = 'ru'");
            $msql->Update('subsectionsTranslate', $arrayEN, " `id_subsection`='" . $this->Subsection['id'] . "' AND lang = 'en'");


            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /admin/?t=" . $this->table . "&c=select&sect=" . (int)$_GET['sect'] . "&page=1");
            } else {
                header("Location: /admin/?t=" . $this->table . "&c=change&sect=" . (int)$_GET['sect'] . "&id=" . $this->Subsection['id']);
            }
        }

        // используем метод класса Model для вывода секции по id
        $this->Subsection = $object->Row_by_id($this->table, $_GET['id']);
        if (isset($_GET['id'])) {
            $this->SubsectionUA = $object->Row_where("subsectionsTranslate", "WHERE id_subsection = $_GET[id] AND lang = 'ua'");
            $this->SubsectionRU = $object->Row_where("subsectionsTranslate", "WHERE id_subsection = $_GET[id] AND lang = 'ru'");
            $this->SubsectionEN = $object->Row_where("subsectionsTranslate", "WHERE id_subsection = $_GET[id] AND lang = 'en'");
        }

        $this->Sections = $object->Array_clean("SELECT sT.name as nameT,s.id FROM sections AS s JOIN sectionsTranslate AS sT ON (sT.id_section = s.id) WHERE sT.lang = '".ADMIN_LANG."' AND s.has_subsect = 1 GROUP BY s.id");

        //формуємо за допомогою шаблону юрла
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Sections[(int)$_GET['sect']]['url'], 2 => $this->Subsection['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->Subsection['url']);
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'subsectionsTranslate' AND `field_id`='" . $_GET['sect'] . "'"), "field_name");

        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "' AND `field_id`='" . $_GET['sect'] . "'"), "field_name");
    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Subsection,
                'columnsUA' => $this->SubsectionUA,
                'columnsRU' => $this->SubsectionRU,
                'columnsEN' => $this->SubsectionEN,
                'table' => $this->table,
                'sections' => $this->Sections,
                'settingsTranslate' => $this->SettingsTranslate,
                'url' => $this->Url,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
