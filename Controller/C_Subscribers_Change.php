<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Subscribers_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Subscribers = array();
		$this->Subscribers_new = array();
		$this->Sections = array();
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

			$this->Subscribers_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Subscribers = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Subscribers_new['id'] = null;
			}


			if($this->Subscribers['id'] == null) {

				//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Subscribers_new['position'] = $m_colums->getMaxPosition($this->table)+1;

				//___if Insert
				$this->Subscribers_new['id'] = $this->Subscribers['id'] = $msql->Insert($this->table, $this->Subscribers_new);
			}

		//___if Update
			$msql->Update($this->table, $this->Subscribers_new, " `id`='" . $this->Subscribers['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Subscribers['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Subscribers = $object->Row_by_id($this->table, $_GET['id']);



	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Subscribers,
											'table' => $this->table,
											'sections'=>$this->Sections));
		parent::OnOutput();
	}	
}
