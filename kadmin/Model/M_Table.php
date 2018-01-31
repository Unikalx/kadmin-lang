<?php
Class M_Table extends Model
{
    // ссылка на экземпляр класса
    private static $instance;

    // получение экземпляра класса
    public static function Instance()
    {
        if (self::$instance == null) {
            self::$instance = new M_Table();
        }

        return self::$instance;
    }

// конструктор
    public function __construct()
    {
        $this->model = MSQL::Instance();
    }

// Отримати значення пагінації
    public function getPaginationValues($table_name,$where='')
    {
        $pagination['limit'] = $_COOKIE['items_count'];
        $pagination['page'] = (!empty($_GET['page'])) ? $_GET['page'] : 1;
        $pagination['count_fields'] = self::getCountFields($table_name,$where);
        $pagination['count_pages'] = ceil($pagination['count_fields'] / $pagination['limit']);
        $pagination['offset'] = $pagination['limit'] * $pagination['page'] - $pagination['limit'];
        return $pagination;
    }

//отримання кількості полів (пагінація)
    public function getCountFields($table_name,$where = ''){
        if($table_name=='orders')
            $where .= " GROUP BY `id_order`";
        $t = "SELECT * FROM `$table_name` ".$where;
        $query = sprintf($t, $table_name);
        $fields_qty = $this->model->Select_num($query);
        return $fields_qty;
    }

//видалення полів
    public function deleteFields($table,$fields_id){
        $id = ' `id`';
        if($table=='orders')
            $id = ' `id_order`';
        elseif($table=='users')
            $id = ' `id_user`';

    //якщо products або articles очищаємо данні з таблиці  ..in_cats
        if($table=='products')
            $this->model->Delete("product_in_cats", "`id_product`='$fields_id'");
        elseif($table=='articles')
            $this->model->Delete("article_in_cats", "`id_article`='$fields_id'");
    //видаляємо картинки
        self::deleteImages($table,$fields_id);

        return $this->model->Delete($table, $id."='$fields_id'");

    }

//видалення кртинок
    public function deleteImages($table,$id){
        if($table=='galleries'){
            $images = $this->model->Select("SELECT * FROM `gallery_images` WHERE `id_gallery`='".$id."'");
            foreach ($images as $image)
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $image['image']);

            $this->model->Delete("gallery_images", "`id_gallery`='$id'");
        }elseif($table=='products'){
            $images = $this->model->Select("SELECT * FROM `product_images` WHERE `id_product`='".$id."'");
            foreach ($images as $image)
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $image['image']);

            $this->model->Delete("product_images", "`id_product`='$id'");
        }

        $fields = $this->model->Select("SELECT * FROM `".$table."` WHERE `id`='".$id."'");

        foreach ($fields as $field) {

            if ($field['thumbnail'])
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $field['thumbnail']);
            if ($field['background'])
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $field['background']);
            if ($field['image1'])
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $field['image1']);
            if ($field['image2'])
                unlink(__DIR__ . '/../../pictures/' . $table . "/" . $field['image2']);

        }
    }

// Змінити позиції полів
    public function changeFieldsPosition($table_name, $fields_id, $first_position)
    {
        $values = "";
        for ($i = 0; $i < count($fields_id); $i++) {
            $values .= "(" . $fields_id[$i] . ", " . ($first_position + $i) . ")";
            if ($i != (count($fields_id) - 1)) {
                $values .= ", ";
            }
        }
        $query = "INSERT INTO %s (`id`, `position`) VALUES %s ON DUPLICATE KEY UPDATE `position` = VALUES(`position`)";
        $query = sprintf($query, $table_name, $values);
        $result = mysql_query($query);
        if (!$result) {
            die(mysql_error());
        } else {
            return true;
        }
    }

//отримання інформації про Order
    public function getOrders($where){
       return $this->model->Select("SELECT `customers`.`name` as `name`,`orders`.*, SUM(`price`*`count`) as `sum`
                          FROM `orders`
                          JOIN `customers` ON `orders`.`id_customer`=`customers`.`id`
                          GROUP BY `id_order`
                           ".$where);


    }
}
?>