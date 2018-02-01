<?php
include_once('Model/Model.php');
include_once('Model/M_Table.php');
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер сторінки всіх Products
class C_Products_Select extends C_Base
{
    public $Products;
    public $ProductCat;
    private $limit;
    private $where;

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];

        $this->order = 'ORDER BY p.position ';
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
        $msql = MSQL::Instance();

        $this->title = $this->title;

        //визначаємо кількість елементів на строрінці
        if (!isset($_COOKIE['items_count'])) {
            setcookie('items_count', 20, time() + 3600 * 24 * 7);
        }

        if ($this->IsPost()) {
            //зміна кількості елементів на сторінці (20,40,60...)
            if ($_POST['items_count']) {
                $items_count = (int)$_POST['items_count'];
                if ($items_count) {
                    setcookie('items_count', $items_count, time() + 3600 * 24 * 7);
                    die;
                }
                die;
            }

            //зміна позиції полів
            if (isset($_POST['first_position'])) {
                $responce['result'] = $m_table->changeFieldsPosition($_POST['table_name'], $_POST['fields_id'], $_POST['first_position']);
                echo json_encode($responce);
                exit;
            }
            //видалення полів
            if (isset($_POST['table_name']) && isset($_POST['deleted_id'])) {

                foreach ($_POST['deleted_id'] as $fields_id) {
                    if ($m_table->deleteFields($_POST['table_name'], $fields_id)) {
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
        if ($_GET['sort'] != '') {
            $sort = trim(mysql_real_escape_string($_GET['sort']));
            if ($sort{0} == '-') {
                $order_type = 'DESC';
                $sort{0} = ' ';
            } else {
                $order_type = 'ASC';
            }

            $this->order = 'ORDER BY ' . $sort . ' ' . $order_type;
        }
        //якщо є фільтрація
        if ($_GET['cat'] != '') {
            $cat = (int)$_GET['cat'];
            $this->where = "WHERE `category`='" . $cat . "'";
        }

        // виводимо секції
        $this->pagination = $m_table->getPaginationValues($this->table, $this->where);

        if ($this->pagination['count_pages'] > 1) {
            $this->limit = "LIMIT " . $this->pagination['offset'] . "," . $this->pagination['limit'];
        }

        $this->and = ($this->order !== '' && $this->limit !== '' && $this->where !== '') ? ' AND ' : '';
        $this->Products = $object->Array_clean("Select p.id,pT.name,p.url,pcT.name as catName FROM products as p JOIN productsTranslate as pT on (pT.id_product = p.id) JOIN product_cats as pc on (pc.id = p.category)  JOIN product_catsTranslate as pcT on (pcT.id_product_cats = pc.id)    WHERE pT.lang='".ADMIN_LANG."' AND pcT.lang='".ADMIN_LANG."' $this->and $this->where GROUP by pT.id_product $this->order $this->limit");
        $this->ProductCat = $object->Array_clean("SELECT pc.id, pcT.name FROM `product_cats` AS pc JOIN product_catsTranslate AS pcT ON (pcT.id_product_cats = pc.id) WHERE pcT.lang = '".ADMIN_LANG."' GROUP BY pc.id");

        //форматуємо юрл по шаблону
        foreach ($this->Products as &$productDB) {
            $productDB['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => "{category_url}", 2 => $productDB['url']));
        }
    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {
        $this->content = $this->View('View/v_' . $this->table . '_select.php',
            array(
                'products' => $this->Products,
                'pagination' => $this->pagination,
                'table' => $this->table,
                'product_cats' => $this->ProductCat
            ));
        parent::OnOutput();
    }
}
