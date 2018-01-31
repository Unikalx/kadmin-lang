<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Slider_2_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Slider_2 = array();
		$this->Slider_2_new = array();
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

			$this->Slider_2_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Slider_2 = $object->Row_by_id($this->table, $_GET['id']);
			}

	//зберігаємо данні в БД (checkbox)
			!isset($this->Slider_2_new['checkbox']) ? $this->Slider_2_new['checkbox']=0 : "";

			if($this->Slider_2['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Slider_2_new['position'] = $m_colums->getMaxPosition($this->table)+1;

				//___if Insert
				$this->Slider_2_new['id'] = $this->Slider_2['id'] = $msql->Insert($this->table, $this->Slider_2_new);
			}

		//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

			// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Slider_2_new[$key] = $m_colums->Upload_image($key,
														  $_FILES[$key],
														  $this->Slider_2['id']);
				}
				else
				{
					$this->Slider_2_new[$key] = $this->Slider_2[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Slider_2_new, " `id`='" . $this->Slider_2['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Slider_2['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Slider_2 = $object->Row_by_id($this->table, $_GET['id']);

	//формуємо за допомогою шаблону юрла
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1  => $this->Slider_2['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Slider_2['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Slider_2,
											'table' => $this->table,
											'sections'=>$this->Sections,
											'url' => $this->Url,
											'settings' => $this->Settings));
		parent::OnOutput();
	}	
}
