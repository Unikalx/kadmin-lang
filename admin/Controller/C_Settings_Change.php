<?php
include_once('Model/M_Columns.php');
include_once('Model/Model.php');
include_once('Controller/C_Base.php');

class C_Settings_Change extends C_Base
{
    public $table;
    public $Columns;
    public $view = 'v_settings';
    public $ID;

    // конструктор
    function __construct()
    {
        $this->table = trim($_GET['f']);
        $this->ID = ((int)$_GET['id']) ? (int)$_GET['id'] : -1;
    }

    protected function OnInput()
    {
        parent::OnInput();

        //берем экземпляр класа M_Users
        $m_columns = M_Columns::Instance();
        $object = Model::Instance();

        if ($_SESSION['authorize']['status'] != 1) {
            header('Location: /admin');
        }

        if ($this->table == '') {
            header('Location: /admin/?t=settings&c=select');
        }


        if ($this->IsPost()) {


            //ввімкнення/вимкнення поля в таблиці settings
            if (isset($_POST['on_off']) && isset($_POST['table']) && isset($_POST['id'])) {

                $id = (int)$_POST['id'];
                $table = trim(mysql_real_escape_string($_POST['table']));
                $name = trim(mysql_real_escape_string($_POST['name']));
                $on_off = (int)$_POST['on_off'];

                $data = $m_columns->OnOffField($on_off, $table, $name, $id);

                echo json_encode($data);
                die();
            }

            //зміна title поля
            if (isset($_POST['changeTitle']) && isset($_POST['table']) && isset($_POST['id'])) {
                $id = (int)$_POST['id'];
                $table = trim(mysql_real_escape_string($_POST['table']));
                $name = trim(mysql_real_escape_string($_POST['name']));
                $newTitle = trim(mysql_real_escape_string($_POST['changeTitle']));
                $data = $m_columns->changeTitle($table, $name, $id, $newTitle);

                echo json_encode($data);
                die();
            }

            //зміна style поля
            if (isset($_POST['changeStyle']) && isset($_POST['table']) && isset($_POST['id'])) {
                $id = (int)$_POST['id'];
                $table = trim(mysql_real_escape_string($_POST['table']));
                $name = trim(mysql_real_escape_string($_POST['name']));
                $newStyle = trim(mysql_real_escape_string($_POST['changeStyle']));
                $data = $m_columns->changeStyle($table, $name, $id, $newStyle);

                echo json_encode($data);
                die();
            }

            //зміна назви таблиці
            if (isset($_POST['newTableName'])) {
                $name = htmlspecialchars(trim($_POST['newTableName']));
                $table = htmlspecialchars(trim($_POST['table']));
                $m_columns->newTableName($name, $table);

                die();
            }

            if (isset($_POST['on_off_table'])) {
                $on_off = htmlspecialchars(trim($_POST['on_off_table']));
                $table = htmlspecialchars(trim($_POST['table']));
                $m_columns->newTableName($on_off, $table);

                die();
            }
        }

        switch ($this->table) {
            case 'sections':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table' AND `field_id`='" . $this->ID . "' OR `table`= 'sectionsTranslate' AND `field_id`='" . $this->ID . "' ORDER by `table`");
                break;

            case 'products':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table'  OR `table`= 'productsTranslate'  ORDER by `table`");
                break;

            case 'product_cats':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table'  OR `table`= 'product_catsTranslate'  ORDER by `table`");
                break;
            case 'news':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table'  OR `table`= 'newsTranslate'  ORDER by `table`");
                break;
            case 'subsections':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table' AND `field_id`='" . $this->ID . "' OR `table`= 'subsectionsTranslate' AND `field_id`='" . $this->ID . "'  ORDER by `table`");
                break;
            case 'slider_1':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table' OR `table`= 'slider_1Translate'  ORDER by `table`");
                break;
            case 'faq':
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table' OR `table`= 'faqTranslate'  ORDER by `table`");
                break;

            default:
                $this->Columns = $object->Array_where('settings', " WHERE `table`='$this->table'");
                break;
        }
    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {
        $this->content = $this->View('View/v_settings_change.php',
            array(
                'table' => $this->table,
                'columns' => $this->Columns,
                'id' => $this->ID
            )
        );

        parent::OnOutput();
    }
}