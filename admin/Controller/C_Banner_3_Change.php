<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Banner_3_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Banner_3 = array();
		$this->Banner_3_new = array();
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

			$this->Banner_3_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Banner_3 = $object->Row_by_id($this->table, $_GET['id']);
			}

	//зберігаємо данні в БД (checkbox)
			!isset($this->Banner_3_new['checkbox']) ? $this->Banner_3_new['checkbox']=0 : "";

			if($this->Banner_3['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Banner_3_new['position'] = $m_colums->getMaxPosition($this->table)+1;

			//___if Insert
				$this->Banner_3_new['id'] = $this->Banner_3['id'] = $msql->Insert($this->table, $this->Banner_3_new);
			}

		//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

			// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Banner_3_new[$key] = $m_colums->Upload_image($key,
														  $_FILES[$key],
														  $this->Banner_3['id']);
				}
				else
				{
					$this->Banner_3_new[$key] = $this->Banner_3[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Banner_3_new, " `id`='" . $this->Banner_3['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Banner_3['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Banner_3 = $object->Row_by_id($this->table, $_GET['id']);

	//формуємо за допомогою шаблону юрла
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1  => $this->Banner_3['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Banner_3['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Banner_3,
											'table' => $this->table,
											'sections'=>$this->Sections,
											'url' => $this->Url,
											'settings' => $this->Settings));
		parent::OnOutput();
	}	
}
