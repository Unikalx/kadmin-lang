<?php
include_once('Model/Model.php');
include_once('Model/M_Table.php');
include_once('Controller/C_Base.php');

// конттроллер сторінки всіх Faq
class C_Faq_Select extends C_Base
{
    public $Faq;

    private $limit;
    private $where;

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];

        $this->order = 'ORDER BY `position`';
        $this->limit = '';
        $this->where = '';

    }

    // виртуальный обработчик запроса
    protected function OnInput()
    {
        parent::OnInput();
        // берем один экземпляр класса Model i M_Table
        $object = Model::Instance();
        $m_table = M_Table::Instance();

        $this->title = $this->title;

        //визначаємо кількість елементів на строрінці
        if(!isset($_COOKIE['items_count'])) {
            setcookie('items_count', 20, time() + 3600*24*7);
        }

        if ($this->IsPost()) {
            //зміна кількості елементів на сторінці (20,40,60...)
            if($_POST['items_count']){
                $items_count =  (int)$_POST['items_count'];
                if($items_count) {
                    setcookie('items_count', $items_count, time() + 3600 * 24 * 7);
                    die;
                }
                die;
            }

            //зміна позиції полів
            if(isset($_POST['first_position'])){
                $responce['result'] = $m_table->changeFieldsPosition($_POST['table_name'], $_POST['fields_id'], $_POST['first_position']);
                echo json_encode($responce);
                exit;
            }
            //видалення полів
            if(isset($_POST['table_name']) && isset($_POST['deleted_id'])){

                foreach ($_POST['deleted_id'] as $fields_id ) {
                    if($m_table->deleteFields($_POST['table_name'], $fields_id)) {
                        $responce['status'] = "ok";
                    } else {
                        $responce['status'] = "error";
                    }
                }

                echo json_encode($responce);
                die;
            }


        }

        //якщо є сортування
        if($_GET['sort']!=''){
            $sort = trim(mysql_real_escape_string($_GET['sort']));
            if($sort{0} == '-') {
                $order_type = 'DESC';
                $sort{0} = ' ';
            }else {
                $order_type = 'ASC';
            }

            $this->order = 'ORDER BY '.$sort.' '.$order_type;
        }

        // виводимо секції
        $this->pagination = $m_table->getPaginationValues($this->table, $this->where);

        if($this->pagination['count_pages'] > 1){
            $this->limit = "LIMIT ".$this->pagination['offset'].",".$this->pagination['limit'];
        }
        $this->Faq = $object->Array_clean("Select f.id,fT.name FROM faq as f JOIN faqTranslate as fT on fT.id_faq = f.id WHERE lang='".ADMIN_LANG."' $this->and $this->where GROUP by f.id $this->order $this->limit");

    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {
        $this->content = $this->View('View/v_'.$this->table.'_select.php',
            array(
                'faq' => $this->Faq,
                'pagination' => $this->pagination,
                'table'=>$this->table
            ));
        parent::OnOutput();
    }
}
