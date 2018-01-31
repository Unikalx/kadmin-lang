<?php
// драйвер базы данных
// ===================

class MSQL
{
	// ссылка на экземпляр класса :
	private static $instance;
	
	// получение экземпляра класса :
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new MSQL();
		
		return self::$instance;
	}
	
	// выборка данных :
	// $query    - полный текст SQL запроса
	// результат - массив выбранных объектов
	public function Select($query)
	{
//	    print_r($query);
//	    die();
        $res = @mysql_query($query);

        if (!$res)
        {
            die(mysql_error());
        }
        // запись данных в массив :
        while ($row = mysql_fetch_assoc($res))
        {
            $result[] = $row;
        }
        return $result;
	}
	
	// количество строк в базе :
	// $query    - полный текст SQL запроса
	// результат - количество строк
	public function Select_num($query)
	{
		$res = @mysql_query($query);
			
		if (!$res)
		{
            die(mysql_error());
            //die("Error");
		}
		// количество строк :
		$result = @mysql_num_rows($res);
		
		return $result;
	}	

	// выборка одной строки :
	// $query    - полный текст SQL запроса
	// результат - массив выбранных объектов
	public function Select_string($query)
	{
        $res = @mysql_query($query);

        if (!$res)
        {
            die(mysql_error());
            //die("Error");
        }
        while ($row = mysql_fetch_assoc($res))
        {
            $result = $row;
        }

        return $result;
	}
	

	// вставка строки :
	// $table  - имя таблицы
	// $object - массив с парами вида "имя столбца - значение"
	public function Insert($table, $object)
	{			
		$columns = array(); // Создаем массив в который поместим название столбца таблицы БД
		$values = array(); // Создаем массив в который поместим значение для столбца таблицы БД
	
		foreach ($object as $key => $value) // проходим по массиву $object и даем значение $key - название столбца, а $value его значение
		{
			$key = mysql_real_escape_string($key . ''); // прогоняем значение через через функцию для защиты от инъекций
			$columns[] = $key; // передаем значение $key массиву $columns[]
			
			if ($value === null)
			{
				$values[] = 'NULL';
			}
			else
			{
				$value = mysql_real_escape_string($value . ''); // делаем то же что и с $key в верху			
				$values[] = "'$value'"; // делаем то же что и с $key в верху
			}
		}
		
		$columns_s = implode(',', $columns); // делаем из масива $columns строковое значение
		$values_s = implode(',', $values); // делаем из масива $values строковое значение
			
		$query = "INSERT INTO $table ($columns_s) VALUES ($values_s)";
		$result = @mysql_query($query);
								
		if (!$result){
            die(mysql_error());
            //die("Error");
		}
			
		return mysql_insert_id();			
	}
	
	// редактирование данных :
	// $table 		- имя таблицы
	// $object 		- ассоциативный массив с парами вида "имя столбца - значение"
	// $where		- условие (часть SQL запроса)
	// результат	- число измененных строк
	public function Update($table, $object, $where)
	{
		$sets = array();
	
		foreach ($object as $key => $value)
		{
			$key = mysql_real_escape_string($key . '');
			
			if ($value === null)
			{
				$sets[] = "$key=NULL";			
			}
			else
			{
				$value = mysql_real_escape_string($value . '');					
				$sets[] = "$key='$value'";			
			}			
		}
		
		$sets_s = implode(',', $sets);			
		$query = "UPDATE $table SET $sets_s WHERE $where";
		$result = @mysql_query($query);
		
		if (!$result)
		{
            die(mysql_error());
            //die("Error");
		}

		return mysql_affected_rows();	
	}
	
	// удаление данных :
	// $table 		- имя таблицы
	// $where		- условие (часть SQL запроса)	
	// результат	- число удаленных строк		
	public function Delete($table, $where)
	{
		$query = "DELETE FROM $table WHERE $where";		
		$result = @mysql_query($query);
						
		if (!$result){
            die(mysql_error());
            //die("Error");
		}

		return mysql_affected_rows();	
	}
}