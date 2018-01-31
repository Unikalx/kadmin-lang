<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Users_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Users = array();
		$this->Users_new = array();
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

			$this->Users_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Users = $object->Row_where($this->table, " WHERE `id_user`='".(int)$_GET['id']."'");
			} else {
				$this->Users_new['id'] = null;
			}


			if($this->Users['id_user'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Users_new['position'] = $m_colums->getMaxPosition($this->table)+1;

				$this->Users_new['password'] = $this->Users_new['password'];
			//___if Insert
				$this->Users_new['id_user'] = $this->Users['id_user'] = $msql->Insert($this->table, $this->Users_new);
			}

	//___if Update

			if($this->Users_new['password']=='')
				unset($this->Users_new['password']);
			else
				$this->Users_new['password'] = md5($this->Users_new['password']);

			//___if Insert
			$msql->Update($this->table, $this->Users_new, " `id_user`='" . $this->Users['id_user'] . "'");

			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Users['id_user']);
			}
		}

	// используем метод класса Model для вывода секции по id
		$this->Users = $object->Row_where($this->table, " WHERE `id_user`='".$_GET['id']."'");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Users,
				'table' => $this->table,
				'url' => $this->Url));
		parent::OnOutput();
	}
}
