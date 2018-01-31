<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Article_Cats_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Article_cats = array();
		$this->Article_cats_new = array();
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

			$this->Article_cats_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Article_cats = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Article_cats_new['id'] = null;
			}

	//зберігаємо данні в БД (checkbox)
			!isset($this->Article_cats_new['checkbox']) ? $this->Article_cats_new['checkbox']=0 : "";

			if($this->Article_cats['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Article_cats_new['position'] = $m_colums->getMaxPosition($this->table)+1;

			//___if Insert
				$this->Article_cats_new['id'] = $this->Article_cats['id'] = $msql->Insert($this->table, $this->Article_cats_new);
			}

		//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

			// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Article_cats_new[$key] = $m_colums->Upload_image($key,
														  $_FILES[$key],
														  $this->Article_cats['id']);
				}
				else
				{
					$this->Article_cats_new[$key] = $this->Article_cats[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Article_cats_new, " `id`='" . $this->Article_cats['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Article_cats['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Article_cats = $object->Row_by_id($this->table, $_GET['id']);
		$this->Categories = $object->Array_where($this->table, "WHERE `has_child`='1'");

	//формуємо за допомогою шаблону юрла
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1  => $this->Article_cats['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Article_cats['url']);
		}
	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Article_cats,
											'categories'=>$this->Categories,
											'table' => $this->table,
											'sections'=>$this->Sections,
											'url' => $this->Url,
											'settings' => $this->Settings
										));
		parent::OnOutput();
	}	
}
