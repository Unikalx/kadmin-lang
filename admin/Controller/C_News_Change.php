<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_News_Change extends C_Base
{

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
        $this->News = array();
        $this->News_new = array();
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

            $this->News_new = $arrayMain;

            if ($_GET['id'] != '') {
                // используем метод класса Model для вывода секции по id
                $this->News = $object->Row_by_id($this->table, $_GET['id']);
            } else {
                $this->News_new['id'] = null;
            }

            //зберігаємо данні в БД (checkbox)
            !isset($this->News_new['checkbox']) ? $this->News_new['checkbox'] = 0 : "";

            if ($this->News['id'] == null) {

                //визначаємо останю позицію
                if ($m_colums->ifIssetPosition($this->table))
                    $this->News_new['position'] = $m_colums->getMaxPosition($this->table) + 1;

                //___if Insert
                $this->News_new['id'] = $this->News['id'] = $msql->Insert($this->table, $this->News_new);

                $arrayUA['id_news'] = $this->News_new['id'];
                $arrayRU['id_news'] = $this->News_new['id'];
                $arrayEN['id_news'] = $this->News_new['id'];

                $msql->Insert('newsTranslate', $arrayUA);
                $msql->Insert('newsTranslate', $arrayRU);
                $msql->Insert('newsTranslate', $arrayEN);
            }

            //зберігаємо усі зображення, що прийшли з форми
            foreach ($_FILES as $key => $value) {

                // обновление фонової картинки
                if ($_FILES[$key]['tmp_name'] != "") {
                    $this->News_new[$key] = $m_colums->Upload_image($key,
                        $_FILES[$key],
                        $this->News['id']);
                } else {
                    $this->News_new[$key] = $this->News[$key];
                }
            }
            //___if Update
            $msql->Update($this->table, $this->News_new, " `id`='" . $this->News['id'] . "'");

            $msql->Update('newsTranslate', $arrayUA, " `id_news`='" . $this->News_new['id'] . "' AND lang = 'ua'");
            $msql->Update('newsTranslate', $arrayRU, " `id_news`='" . $this->News_new['id'] . "' AND lang = 'ru'");
            $msql->Update('newsTranslate', $arrayEN, " `id_news`='" . $this->News_new['id'] . "' AND lang = 'en'");

            if ($_GET['id'] != '' || isset($_POST['save_close'])) {
                header("Location: /admin/?t=" . $this->table . "&c=select&page=1");
            } else {
                header("Location: /admin/?t=" . $this->table . "&c=change&id=" . $this->News['id']);
            }
        }

        // используем метод класса Model для вывода секции по id
        $this->News = $object->Row_by_id($this->table, $_GET['id']);

        if (isset($_GET['id'])) {
            $this->NewsUA = $object->Row_where("newsTranslate", "WHERE id_news = $_GET[id] AND lang = 'ua'");
            $this->NewsRU = $object->Row_where("newsTranslate", "WHERE id_news = $_GET[id] AND lang = 'ru'");
            $this->NewsEN = $object->Row_where("newsTranslate", "WHERE id_news = $_GET[id] AND lang = 'en'");
        }

        //формуємо за допомогою шаблону юрла
        $this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->News['url']));
        if ($_GET['id'] == '') {
            $this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
            $this->Url['url'] = str_replace('{*}', '', $this->Url['url']);
        } else {
            $this->Url['first-entrance'] = stripos($this->Url['url'], $this->News['url']);
        }

        //витягуємо всі налаштування до цієї таблиці
        $this->Settings = $object->IndexBy($object->Array_where('settings', " WHERE `table`='" . $this->table . "'"), "field_name");
        $this->SettingsTranslate = $object->IndexBy($object->Array_where('settings', " WHERE `table`= 'newsTranslate'"), "field_name");

    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_' . $this->table . '_change.php',
            array(
                'columns' => $this->News,
                'columnsUA' => $this->NewsUA,
                'columnsRU' => $this->NewsRU,
                'columnsEN' => $this->NewsEN,
                'table' => $this->table,
                'sections' => $this->Sections,
                'url' => $this->Url,
                'settingsTranslate' => $this->SettingsTranslate,
                'settings' => $this->Settings));
        parent::OnOutput();
    }
}
