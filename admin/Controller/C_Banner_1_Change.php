<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Banner_1_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Banner_1 = array();
		$this->Banner_1_new = array();
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

		if ($this->IsPost())
		{
		//видалення фотографії
			if(isset($_POST['delete'])){
				$m_colums->deletePhoto($this->table,$_POST['field'],$_POST['id']);
				echo json_encode($_POST);
				die;
			}

			$this->Banner_1_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Banner_1 = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Banner_1_new['id'] = null;
			}

	//зберігаємо данні в БД (checkbox)
			!isset($this->Banner_1_new['checkbox']) ? $this->Banner_1_new['checkbox']=0 : "";

			if($this->Banner_1['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Banner_1_new['position'] = $m_colums->getMaxPosition($this->table)+1;

			//___if Insert
				$this->Banner_1_new['id'] = $this->Banner_1['id'] = $msql->Insert($this->table, $this->Banner_1_new);
			}

		//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

			// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Banner_1_new[$key] = $m_colums->Upload_image($key,
														  $_FILES[$key],
														  $this->Banner_1['id']);
				}
				else
				{
					$this->Banner_1_new[$key] = $this->Banner_1[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Banner_1_new, " `id`='" . $this->Banner_1['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Banner_1['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Banner_1 = $object->Row_by_id($this->table, $_GET['id']);



	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}


	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Banner_1,
											'table' => $this->table,
											'sections'=>$this->Sections,
											'url' => $this->Url,
											'settings' => $this->Settings));
		parent::OnOutput();
	}	
}
