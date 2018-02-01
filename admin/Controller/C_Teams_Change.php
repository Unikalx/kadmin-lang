<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Teams_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Team = array();
		$this->Team_new = array();
		$this->Team_cats = array();
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
				$m_colums->saveGalleryImage($_FILES['file'], $_GET['id'],$this->table,'product_images');
			}

		// видалення фото з галереї
			if (isset($_POST['deletePhotoGallery'])) {
				$m_colums->deleteGalleryPhoto($_POST['imageId'],$this->table,'product_images');
				echo json_encode(array('status' => 'success'));
				die;
			}
		//змінюємо позицію картинок
			if(isset($_POST['changePositionImage'])){
				$responce['result'] = $m_colums->changeFieldsPosition('product_images', $_POST['fields_id'], $_POST['first_position']);
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

			$this->Team_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода по id
				$this->Team = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Team_new['id'] = null;
			}

			//зберігаємо данні в БД (checkbox)
			!isset($this->Team_new['checkbox']) ? $this->Team_new['checkbox']=0 : "";

			if($this->Team['id'] == null) {


			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Team_new['position'] = $m_colums->getMaxPosition($this->table,$_POST['a_cat'][0])+1;

			//___if Insert
				$this->Team_new['id'] = $this->Team['id'] = $msql->Insert($this->table, $this->Team_new);
			}

			//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

				// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Team_new[$key] = $m_colums->Upload_image($key,
						$_FILES[$key],
						$this->Team['id']);
				}
				else
				{
					$this->Team_new[$key] = $this->Team[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Team_new, " `id`='" . $this->Team['id'] . "'");


			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Team['id']);
			}
		}

	// используем метод класса Model для вывода данных
		$this->Team = $object->Row_by_id($this->table, $_GET['id']);
		$this->Team_cats = $object->IndexBy($object->All_rows('product_cats'),'id');

	//формуємо за допомогою шаблону url
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => "{category}",2 => $this->Team['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Team['url']);
		}

		
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Team,
				'table' => $this->table,
				'categories'=>$this->Team_cats,
				'url' => $this->Url));
		parent::OnOutput();
	}
}
