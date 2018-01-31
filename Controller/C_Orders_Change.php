<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Orders_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Order = array();
		$this->Order_new = array();
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

		if($_GET['id']!='') {
			$id = (int)$_GET['id'];
			// используем метод класса Model для вывода order по id
			$this->Order = $msql->Select("SELECT `customers`.`name` as `name`,`customers`.`email`,`customers`.`phone`,`orders`.*,`products`.`name` as `product_name`
											  FROM `orders`
											  JOIN `customers` ON `orders`.`id_customer`=`customers`.`id`
											  JOIN `products` ON `orders`.`id_product`=`products`.`id`
										   	WHERE `orders`.`id_order`='$id'");
		}else{
			header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
		}
	//визначення загальної суми ордера
		$total  = 0;
		foreach ($this->Order as $order) {
			$total += $order['count']*$order['price'];
		}
		$this->Order[0]['total'] = $total;

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Order,
				'table' => $this->table,
				'settings' => $this->Settings));
		parent::OnOutput();
	}
}
