<?php

include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Articles_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Article = array();
		$this->Article_new = array();
		$this->Article_cats = array();
		$this->Article_in_cats = array();
		$this->Tags = array();
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
		//автокомпліт для тегів
			if(isset($_POST['tagautocomplete']) && !empty($_POST['tagautocomplete'])){
				$tags = $m_colums->getTagsByQuery($_POST['tagautocomplete']);
				echo json_encode($tags);
				die;
			}


		//видалення фотографії
			if(isset($_POST['delete'])){
				$m_colums->deletePhoto($this->table,$_POST['field'],$_POST['id']);
				echo json_encode($_POST);
				die;
			}

		// звантаження фото в галерею
			if (isset($_POST['gallery']) && isset($_POST['upload'])) {
				$m_colums->saveGalleryImage($_FILES['file'], $_GET['id'],$this->table,'Article_images');
			}

		// видалення фото з галереї
			if (isset($_POST['deletePhotoGallery'])) {
				$m_colums->deleteGalleryPhoto($_POST['imageId'],$this->table,'Article_images');
				echo json_encode(array('status' => 'success'));
				die;
			}
		//змінюємо позицію картинок
			if(isset($_POST['changePositionImage'])){
				$responce['result'] = $m_colums->changeFieldsPosition('Article_images', $_POST['fields_id'], $_POST['first_position']);
				echo json_encode($responce);
				die;
			}

			$this->Article_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода по id
				$this->Article = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Article_new['id'] = null;
			}

			//зберігаємо данні в БД (checkbox)
			!isset($this->Article_new['checkbox']) ? $this->Article_new['checkbox']=0 : "";

			if($this->Article['id'] == null) {

			//визначаємо останю позицію
				if($m_colums->ifIssetPosition($this->table))
					$this->Article_new['position'] = $m_colums->getMaxPosition($this->table,$_POST['a_cat'][0])+1;

			//___if Insert
				$this->Article_new['id'] = $this->Article['id'] = $msql->Insert($this->table);
			}

			//зберігаємо усі зображення, що прийшли з форми
			foreach ($_FILES as $key=>$value) {

				// обновление фонової картинки
				if ($_FILES[$key]['tmp_name'] != "")
				{
					$this->Article_new[$key] = $m_colums->Upload_image($key,
						$_FILES[$key],
						$this->Article['id']);
				}
				else
				{
					$this->Article_new[$key] = $this->Article[$key];
				}
			}
		//___if Update
			$msql->Update($this->table, $this->Article_new, " `id`='" . $this->Article['id'] . "'");
		//зберігаємо категорії для продукту
			if (isset($_POST['a_cat']) && !empty($_POST['a_cat'])) {

				$cat = array();
				$cats = $_POST['a_cat'];
				for($i=0;$i<count($cats);$i++){
					$cat[] = $cats[$i];
				}


			// очищаємо всі старі данні з таблиці "Article_in_cats"
				$m_colums->delInCats('article_in_cats',$this->Article['id']);
			// додоаємо нові данні в таблицю "Article_in_cats"
				$m_colums->addInCats('article_in_cats',$cat, $this->Article['id']);
			}
		//зберігаємо теги для продукту
			if (isset($_POST['a_tag']) && !empty($_POST['a_tag'])) {

				if (ARTICLE_TAGS != 0) {

					$tags = $_POST['a_tag'];

					if (!empty($_POST['in_tag'])) {
						$tags [] = $_POST['in_tag'];
					}
					$ids_tags = $m_colums->addTags($tags);
				}
			}

			if($_GET['id']!='' || isset($_POST['save_close'])){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Article['id']);
			}
		}

	// используем метод класса Model для вывода данных
		$this->Article = $object->Row_by_id($this->table, (int)$_GET['id']);
		$this->Article_cats = $object->IndexBy($object->All_rows('article_cats'),'id');
		$this->Article_in_cats = $object->Array_where('article_in_cats',"WHERE `id_article`='".$this->Article['id']."'");
		$this->Tags = $object->Array_where('article_tags',"WHERE `article_id`= '".(int)$_GET['id']."'GROUP BY `name`");


	//формуємо за допомогою шаблону url
		$this->Url['url'] = M_Columns::getFormatUrl($this->table, $vall = array(1 => "{category}",2 => $this->Article['url']));
		if($_GET['id']==''){
			$this->Url['first-entrance'] = stripos($this->Url['url'], '{*}');
			$this->Url['url'] = str_replace('{*}','',$this->Url['url']);
		}else{
			$this->Url['first-entrance'] = stripos($this->Url['url'], $this->Article['url']);
		}

	//витягуємо всі налаштування до цієї таблиці
		$this->Settings = $object->IndexBy($object->Array_where('settings'," WHERE `table`='".$this->table."'"),"field_name");
	}

	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
			array(
				'columns' => $this->Article,
				'table' => $this->table,
				'categories'=>$this->Article_cats,
				'article_in_cats'=>$this->Article_in_cats,
				'tags'=>$this->Tags,
				'url' => $this->Url,
				'settings' => $this->Settings));
		parent::OnOutput();
	}
}
?>