<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Faq_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->Faq = array();
        $this->Faq_new = array();
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
            $arrayEN = ['lang' => 'en'];

            foreach ($_POST[$this->table] as $key => $item) {
                if (preg_match('/^ua/', $key)) {
                    $arrayUA[substr($key, 2)] = $item;


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

            $this->Faq_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->Faq = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->Faq_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->Faq_new['checkbox']) ? $this->Faq_new['checkbox'] = 0 : "";

            if ($this->Faq['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->Faq_new['position'] = $m_colums->getMaxPosition($this->table) + 1;

                //___if Insert
                $this->Faq_new['id'] = $this->Faq['id'] = $msql->Insert($this->table, $this->Faq_new);

                $arrayUA['id_faq'] = $this->Faq['id'];
                $arrayEN['id_faq'] = $this->Faq['id'];

                $msql->Insert('faqTranslate', $arrayUA);
                $msql->Insert('faqTranslate', $arrayEN);
            }

            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->Faq_new[$key] = $m_colums->Upload_image($key, $_FILES[$key], $this->Faq['id']);
                } else {
                    $this->Faq_new[$key] = $this->Faq[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->Faq_new, " `id`='" . $this->Faq['id'] . "'");

            $msql->Update('faqTranslate', $arrayUA, " `id_faq`='" . $this->Faq['id'] . "' AND lang = 'ua'");
            $msql->Update('faqTranslate', $arrayEN, " `id_faq`='" . $this->Faq['id'] . "' AND lang = 'en'");


            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /admin/?t=" . $this->table . "&c=select&page=1");
            } else {
                header("Location: /admin/?t=" . $this->table . "&c=change&id=" . $this->Faq['id']);
            }
        }

        // используем метод класса Model для вывода секции по id
        $this->Faq = $object->Row_by_id($this->table, $_GET['id']);
        if (isset($_GET['id'])) {
            $this->FaqUA = $object->Row_where("faqTranslate", "WHERE id_faq = $_GET[id] AND lang = 'ua'");
            $this->FaqEN = $object->Row_where("faqTranslate", "WHERE id_faq = $_GET[id] AND lang = 'en'");
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "'"), "field_name");
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'faqTranslate'"), "field_name");

    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->Faq,
                'columnsUA' => $this->FaqUA,
                'columnsEN' => $this->FaqEN,
                'table' => $this->table,
                'sections' => $this->Sections,
                'url' => $this->Url,
                'settingsTranslate' => $this->SettingsTranslate,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
