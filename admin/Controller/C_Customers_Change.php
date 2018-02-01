<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Customers_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Customer = array();
		$this->Customer_new = array();
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


		if ($this->IsPost())
		{
		//видалення фотографії
			if(isset($_POST['delete'])){
				$m_colums->deletePhoto($this->table,$_POST['field'],$_POST['id']);
				echo json_encode($_POST);
				die;
			}

			$this->Customer_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Customer = $object->Row_by_id($this->table, $_GET['id']);
			}


			if($this->Customer['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Customer_new['position'] = $m_colums->getMaxPosition($this->table)+1;
					$this->Customer_new['password'] = md5($this->Users_new['password']);
			//___if Insert
				$this->Customer_new['id'] = $this->Customer['id'] = $msql->Insert($this->table, $this->Customer_new);
			}
			//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

				// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Customer_new[$key] = $m_colums->Upload_image($key,
						$_FILES[$key],
						$this->Customer['id']);

				}
				else
				{
					$this->Customer_new[$key] = $this->Customer[$key];
				}
			}
	//___if Update

			if($this->Customer_new['password']=='')
				unset($this->Customer_new['password']);
			else
				$this->Customer_new['password'] = md5($this->Customer_new['password']);

			$msql->Update($this->table, $this->Customer_new, " `id`='" . $this->Customer['id'] . "'");
			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Customer['id']);
			}
		}

	// используем метод класса Model для вывода секции по id
		$this->Customer = $object->Row_by_id($this->table, $_GET['id']);
	//формуємо за допомогою шаблону юрл
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Customer['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Customer['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Customer,
				'table' => $this->table,
				'url' => $this->Url,
				'settings' => $this->Settings));
		parent::OnOutput();
	}
}
