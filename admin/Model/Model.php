<?php

Include_once ('MSQL.php');

Class Model
{
	// ссылка на экземпляр класса
	private static $instance; 
	
	// драйвер БД
	private $msql;


	// получение экземпляра класса
	public static function Instance()
	{
		if (self::$instance == null)
			{
				self::$instance = new Model();
			}
		
		return self::$instance;
	}
	
	// конструктор
	public function __construct()
	{
		$this->msql = MSQL::Instance();
	}
	
//--ALL MODULES--///////////////////////////////////////////////////////////////
    public function dateEdit($text,$lang){ //2017-04-25
        $date = split('-',$text);
        $nowDate = intval($date[1]-1);
        switch ($lang) {
            case 'ua':
                $months =  array('січня','лютого','березня','квітня','травня','червня','липня','серпня','вересня','жовтня','листопада','грудня');
                break;
            case 'ru':
                $months =  array('января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
                break;
            case 'en':
                $months =  array('january','february','march','april','may','june','july','august','september','october','november','december');
                break;
        }
        $month = $months[$nowDate];
        return $date[2]." ".$month." ".$date[0];
    }
    /*public function dateEdit($text)
    { //2017-04-25
        $date = split('-', $text);
        $nowDate = intval($date[1]-1);
        $months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');
        $month = $months[$nowDate];
        return $date[2] . " " . $month . " " . $date[0];
    }*/
    public function Array_date($date,$table, $where)
    {
        // запрос к базе
        $t = 'SELECT '.$date.' FROM %s %s';
        $query = sprintf ($t, $table, $where);

        return $this->msql->Select($query);
    }

    // запрос строки из базы данных c параметрами
    public function Row_date($date,$table, $where)
    {
        // запрос к базе
        $t = 'SELECT '.$date.' FROM %s %s';
        $query = sprintf ($t, $table, $where);

        return $this->msql->Select_string($query);
    }
    

	// обрезка текста
    public function ShortText($text, $col)
    {
        $text =  strip_tags($text);
        $newText = mb_substr($text, 0, $col, 'utf-8');
        if (strlen($text) > $col) {
            $newText .= ' ...';
        }
        return '<p>'.$newText.'</p>';
    }
	
	// генирация случайной строки
	private function GenerateStr($length = 10) 
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789';
		$code = '';
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
			$code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}
	
	// загругка картинки
	public function Upload_image($prefix, $file)
	{
		$path_info = pathinfo($file['name']);
		$mime = mb_strtolower($path_info['extension'], 'utf-8');
		if ($mime == 'jpg' || $mime == 'jpeg' || $mime == 'gif' || $mime == 'png' || $mime == 'pdf' || $mime == 'mp3')
		{
			$rand = $this->GenerateStr(10);
			$filename = $prefix.'_'.$rand.'.'.$mime;
			if(copy($file['tmp_name'], '../pictures/'.$filename))
			{
				$image_name = $filename;
			}
			else
			{
				$image_name = '';
			}
		}
		
		return $image_name;
	}
	
	// загругка AUDIO
	public function Upload_audio($prefix, $file)
	{
		$path_info = pathinfo($file['name']);
		$mime = mb_strtolower($path_info['extension'], 'utf-8');
		if ($mime == 'mp3')
		{
			$rand = $this->GenerateStr(10);
			$filename = $prefix.'_'.$rand.'.'.$mime;
			if(copy($file['tmp_name'], '../music/'.$filename))
			{
				$audio_name = $filename;
			}
			else
			{
				$audio_name = '';
			}
		}
		
		return $audio_name;
	}
	
	// обновление AUDIO
	public function Update_audio($prefix, $file, $oldfile)
	{
		$path_info = pathinfo($file['name']);
		$mime = mb_strtolower($path_info['extension'], 'utf-8');
		if ($mime == 'mp3')
		{
			$rand = $this->GenerateStr(10);
			$filename = $prefix.'_'.$rand.'.'.$mime;
			if(copy($file['tmp_name'], '../music/'.$filename))
			{
				$audio_name = $filename;
				if ($oldfile != '' && file_exists('../music/'.$oldfile))
				{
					unlink('../music/'.$oldfile);
				}					
			}
			else
			{
				$audio_name = $oldfile;
			}
		}
		
		return $audio_name;
	}


    public function Row_by_id_date($date,$table, $id)
    {
        // запрос к базе
        $t = 'SELECT '.$date.' FROM %s WHERE id = %d';
        $query = sprintf ($t, $table, $id);
        return $this->msql->Select_string($query);
    }
	// запрос строки из базы данных
	public function Row_by_id($table, $id)
	{
		// запрос к базе
		$t = 'SELECT * FROM %s WHERE id = %d';
		$query = sprintf ($t, $table, $id);
		
		return $this->msql->Select_string($query);		
	}
	
	// запрос строки из базы данных
	public function Row_where($table, $where)
	{
		// запрос к базе
		$t = 'SELECT * FROM %s %s';
		$query = sprintf ($t, $table, $where);
		
		return $this->msql->Select_string($query);		
	}
	
	// запрос строк из базы данных
    public function All_rows_data($data,$table)
    {
        // запрос к базе
        $t = 'SELECT '. $data. ' FROM %s';
        $query = sprintf($t, $table);

        return $this->msql->Select($query);
    }
	public function All_rows($table)
	{
		// запрос к базе
		$t = 'SELECT * FROM %s';
		$query = sprintf ($t, $table);
		
		return $this->msql->Select($query);		
	}
	
	// запрос массива данных из базы
	public function Array_where($table, $where)
	{
		// запрос к базе
		$t = 'SELECT * FROM %s %s';
		$query = sprintf ($t, $table, $where);

		return $this->msql->Select($query);		
	}
	
	public function Array_clean($where)
	{
		return $this->msql->Select($where);
	}
    public function Row_clean($where)
    {
        return $this->msql->Select_string($where);
    }

    public function Num_clean($query)
    {
        return $this->msql->Select_num($query);
    }

	// запрос количества строк
	public function Num_where($table, $where)
	{
		// запрос к базе
		$t = 'SELECT * FROM %s %s';
		$query = sprintf ($t, $table, $where);
		
		return $this->msql->Select_num($query);		
	}	
	
	// добавление
	public function Add($table, $object)
	{	
		return $this->msql->Insert($table, $object);
	}
	
	// обновление
	public function Edit_by_id($table, $id, $object)
	{
		$t = 'id = "%d"';		
		$where = sprintf($t, $id);
		
		$this->msql->Update($table, $object, $where);
		
		return true;
	}
	
	// обновление
	public function Edit_where($table, $object, $where)
	{	
		$where = sprintf($where);
	
		$this->msql->Update($table, $object, $where);
		
		return true;
	}

	// удаление
	public function Delete_by_id($table, $id)
	{	
		$t = 'id = "%d"';		
		$where = sprintf($t, $id);
		
		return $this->msql->Delete($table, $where);
	}
	
	// удаление
	public function Delete_where($table, $where)
	{					
		return $this->msql->Delete($table, $where);
	}

	public function IndexBy($array,$index){
		$new_arr = array();
		foreach($array as $item){
			$new_arr[$item[$index]] = $item;
		}
	return $new_arr;
	}


	// обновление позиций
	public function Edit_positions ($table, $sortdata)
	{	
		$data = explode(',',$sortdata);
		
		$num = 0;
		$position = 1;
		foreach ($data as $k => $v)
		{
			$str[] = $v;
			
			// отправка запроса
			$object = array();
			$object['position'] = $position;		
			$t = "id = '%d'";		
			$where = sprintf($t, $str[$num]);		
			$this->msql->Update($table, $object, $where);
			
			$num = $num + 1;
			$position = $position + 1;
		}
		
		return true;
	}
    public function GetInTranslate($string)
    {
        $replace = array(
            " " => "",
            "'" => "",
            "`" => "",
            "а" => "a", "А" => "a",
            "б" => "b", "Б" => "b",
            "в" => "v", "В" => "v",
            "г" => "g", "Г" => "g",
            "д" => "d", "Д" => "d",
            "е" => "e", "Е" => "e",
            "ж" => "zh", "Ж" => "zh",
            "з" => "z", "З" => "z",
            "и" => "i", "И" => "i",
            "й" => "y", "Й" => "y",
            "к" => "k", "К" => "k",
            "л" => "l", "Л" => "l",
            "м" => "m", "М" => "m",
            "н" => "n", "Н" => "n",
            "о" => "o", "О" => "o",
            "п" => "p", "П" => "p",
            "р" => "r", "Р" => "r",
            "с" => "s", "С" => "s",
            "т" => "t", "Т" => "t",
            "у" => "u", "У" => "u",
            "ф" => "f", "Ф" => "f",
            "х" => "h", "Х" => "h",
            "ц" => "c", "Ц" => "c",
            "ч" => "ch", "Ч" => "ch",
            "ш" => "sh", "Ш" => "sh",
            "щ" => "sch", "Щ" => "sch",
            "ъ" => "", "Ъ" => "",
            "ы" => "y", "Ы" => "y",
            "ь" => "", "Ь" => "",
            "э" => "e", "Э" => "e",
            "ю" => "yu", "Ю" => "yu",
            "я" => "ya", "Я" => "ya",
            "і" => "i", "І" => "i",
            "ї" => "yi", "Ї" => "yi",
            "є" => "e", "Є" => "e");
        return $str = iconv("UTF-8", "UTF-8//IGNORE", strtr($string, $replace));
    }
}