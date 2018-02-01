<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Galleries_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Gallery = array();
		$this->Gallery_new = array();
		$this->Gallery_cats = array();
		$this->Images = array();
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
				$m_colums->saveGalleryImage($_FILES['file'], $_GET['id'],$this->table,'gallery_images');
			}

		// видалення фото з галереї
			if (isset($_POST['deletePhotoGallery'])) {
				$m_colums->deleteGalleryPhoto($_POST['imageId'],$this->table,'gallery_images');
				echo json_encode(array('status' => 'success'));
				die;
			}
		//змінюємо позицію картинок
			if(isset($_POST['changePositionImage'])){
				$responce['result'] = $m_colums->changeFieldsPosition('gallery_images', $_POST['fields_id'], $_POST['first_position']);
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
			$this->Gallery_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода по id
				$this->Gallery = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Gallery_new['id'] = null;
			}

			//зберігаємо данні в БД (checkbox)
			!isset($this->Gallery_new['checkbox']) ? $this->Gallery_new['checkbox']=0 : "";

			if($this->Gallery['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Gallery_new['position'] = $m_colums->getMaxPosition($this->table,(int)$this->Gallery_new['id_category'])+1;

				//___if Insert
				$this->Gallery_new['id'] = $this->Gallery['id'] = $msql->Insert($this->table, $this->Gallery_new);
			}

			//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

				// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Gallery_new[$key] = $m_colums->Upload_image($key,
						$_FILES[$key],
						$this->Gallery['id']);
				}
				else
				{
					$this->Gallery_new[$key] = $this->Gallery[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Gallery_new, " `id`='" . $this->Gallery['id'] . "'");

			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /admin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /admin/?t=".$this->table."&c=change&id=".$this->Gallery['id']);
			}
		}

	// используем метод класса Model для вывода данных
		$this->Gallery = $object->Row_by_id($this->table, $_GET['id']);
		$getGalleryCats = $object->All_rows('gallery_cats');
		if ($getGalleryCats){
			$this->Gallery_cats = $object->IndexBy($getGalleryCats,'id');
		}
		$this->Images = $object->Array_where('gallery_images',"WHERE `id_gallery`='".$this->Gallery['id']."' ORDER BY `position`");

	//формуємо за допомогою шаблону url
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => $this->Gallery_cats[$this->Gallery['id_category']]['url'],2 => $this->Gallery['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Gallery['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Gallery,
				'table' => $this->table,
				'categories'=>$this->Gallery_cats,
				'url' => $this->Url,
				'images' => $this->Images,
				'settings' => $this->Settings));
		parent::OnOutput();
	}
}
