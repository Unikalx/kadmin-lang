<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Media_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Media = array();
		$this->Media_new = array();
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
		$m_colums = M_Columns::Instance();
		/*$m_colums->addNewTableInToSettings($this->table);*/
		if ($this->IsPost())
		{
		//видалення фотографії
			if(isset($_POST['delete'])){
				$m_colums->deletePhoto($this->table,$_POST['field'],$_POST['id']);
				echo json_encode($_POST);
				die;
			}

			$this->Media_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Media = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Media_new['id'] = null;
			}

			if($this->Media['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Media_new['position'] = $m_colums->getMaxPosition($this->table)+1;

			//___if Insert
				$this->Media_new['id'] = $this->Media['id'] = $msql->Insert($this->table, $this->Media_new);
			}

		//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

			// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Media_new[$key] = $m_colums->Upload_image($key,
														  $_FILES[$key],
														  $this->Media['id']);
				}
				else
				{
					$this->Media_new[$key] = $this->Media[$key];
				}
			}

			if($this->Media_new['type']!=1)
				$this->Media_new['video']=null;

		//___if Update
			$msql->Update($this->table, $this->Media_new, " `id`='" . $this->Media['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Media['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Media = $object->Row_by_id($this->table, $_GET['id']);

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Media,
											'table' => $this->table,
											'settings' => $this->Settings));
		parent::OnOutput();
	}	
}
