<?php
include_once('Model/M_Columns.php');
include_once('Controller/C_Base.php');

// конттроллер редактирования секций
class C_Article_Comments_Change extends C_Base
{

	// конструктор
	function __construct()
	{
		$this->table = $_GET['t'];
		$this->Article_comments = array();
		$this->Article_comments_new = array();

	}

	// виртуальный обработчик запроса
	protected function OnInput()
	{
		parent::OnInput();

		// берем один экземпляр класса Model:
		$object = Model::Instance();
		$msql = MSQL::Instance();

		$this->title = $this->title;

		if ($this->IsPost())
		{

			$this->Article_comments_new = $_POST[$this->table];

			if($_GET['id']!='') {
				// используем метод класса Model для вывода секции по id
				$this->Article_comments = $object->Row_by_id($this->table, $_GET['id']);
			} else {
				$this->Article_comments_new['id'] = null;
			}

	//зберігаємо данні в БД (checkbox)
			!isset($this->Article_comments_new['checkbox']) ? $this->Article_comments_new['checkbox']=0 : "";

			$msql->Update($this->table, $this->Article_comments_new, " `id`='" . $this->Article_comments['id'] . "'");

			if($_GET['id']!=''){
				header("Location: /kadmin/?t=".$this->table."&c=select&page=1");
			}else{
				header("Location: /kadmin/?t=".$this->table."&c=change&id=".$this->Article_comments['id']);
			}
		}
			
	// используем метод класса Model для вывода секции по id
		$this->Article_comments = $object->Row_by_id($this->table, $_GET['id']);

		$this->Articles = $object->Array_where('articles',"ORDER BY `date` DESC");

	}
	
	// виртуальный генератор HTML
	protected function OnOutput()
	{

		$this->content = $this->View('View/v_'.$this->table.'_change.php',
										array(
											'columns' => $this->Article_comments,
											'table' => $this->table,
											'articles'=>$this->Articles,
											));
		parent::OnOutput();
	}	
}
