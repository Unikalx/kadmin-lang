<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Jobs_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Job = array();
		$this->Job_new = array();
		$this->Job_cats = array();
		$this->Job_in_cats = array();
		$this->Url = array();
	}

	// виртуальный обработчик запроса
	protected function OnInput()
	{
		parent::OnInput();
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

		// звантаження фото в галерею
			if (isset($_POST['gallery']) && isset($_POST['upload'])) {
				$m_colums->saveGalleryImage($_FILES['file'], $_GET['id'],$this->table,'job_images');
			}

		// видалення фото з галереї
			if (isset($_POST['deletePhotoGallery'])) {
				$m_colums->deleteGalleryPhoto($_POST['imageId'],$this->table,'job_images');
				echo json_encode(array('status' => 'success'));
				die;
			}
		//змінюємо позицію картинок
			if(isset($_POST['changePositionImage'])){
				$responce['result'] = $m_colums->changeFieldsPosition('job_images', $_POST['fields_id'], $_POST['first_position']);
				echo json_encode($responce);
				die;
			}
		//змінюємо name картинок з галереї
			if(isset($_POST['new_name']) && $_POST['new_name']!=''){
				$name = trim(mysql_real_escape_string($_POST['new_name']));
				$id = (int)$_POST['id'];
				$responce = $m_colums->changeGalleryImageName($this->table,$name,$id);
				die;
			}

			$this->Job_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода по id
				$this->Job = $object->Row_by_id($this->table, $_GET['id']);
			}

			//зберігаємо данні в БД (checkbox)
			!isset($this->Job_new['checkbox']) ? $this->Job_new['checkbox']=0 : "";

			if($this->Job['id'] == null) {


			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Job_new['position'] = $m_colums->getMaxPosition($this->table,$_POST['a_cat'][0])+1;

			//___if Insert
				$this->Job_new['id'] = $this->Job['id'] = $msql->Insert($this->table, $this->Job_new);
			}

			//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

				// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Job_new[$key] = $m_colums->Upload_image($key,
						$_FILES[$key],
						$this->Job['id']);
				}
				else
				{
					$this->Job_new[$key] = $this->Job[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Job_new, " `id`='" . $this->Job['id'] . "'");

		//зберігаємо категорії для продукту
			if (isset($_POST['a_cat']) && !empty($_POST['a_cat'])) {

				$cat = array();
				$cats = $_POST['a_cat'];
				for($i=0;$i<count($cats);$i++){
					$cat[] = $cats[$i];
				}
			// очищаємо всі старі данні з таблиці "job_in_cats"
				$m_colums->delInCats('job_in_cats',$this->Job['id']);
			// додоаємо нові данні в таблицю "job_in_cats"
				$m_colums->addInCats('job_in_cats',$cat, $this->Job['id']);
			}

			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Job['id']);
			}
		}

	// используем метод класса Model для вывода данных
		$this->Job = $object->Row_by_id($this->table, $_GET['id']);
		$this->Job_cats = $object->IndexBy($object->All_rows('job_cats'),'id');
		$this->Job_in_cats = $object->Array_where('job_in_cats',"WHERE `id_job`='".$this->Job['id']."'");

	//формуємо за допомогою шаблону url
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => "{category}",2 => $this->Job['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Job['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Job,
				'table' => $this->table,
				'categories'=>$this->Job_cats,
				'job_in_cats'=>$this->Job_in_cats,
				'url' => $this->Url,
				'settings' => $this->Settings));
		parent::OnOutput();
	}
}
