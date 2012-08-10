<?php

if (!defined('__MYSQL_CLASS__')) {

    define('__MYSQL_CLASS__', 1);

Class MySQL
{
	var $CONN = "";
	var $CURDB = "";
 
	function error($text)
	{
		$no = mysql_errno();
		$msg = mysql_error();
		echo '['.$text.'] ( '.$no.' : '.$msg.' )<BR>\n';
		exit;
	}

	function connect ($server,$user,$pass,$dbase = '')
	{
		$conn = mysql_connect($server,$user,$pass);
		if(!$conn)
		{
			$this -> error('Connection attempt failed');
		}
		
		$this -> CONN = $conn;
		   if($dbase)
		   {
		   $this -> set_db($dbase);	
		   }
                 mysql_query ("SET NAMES utf8");
                return 1;
	}

	function select ($sql)	{
		$res = mysql_query($sql,$this -> CONN);
		
		if(!$res) 
		{
		$sql_query_1 = 'SELECT failed in SQL: '.$sql;
		$this->error($sql_query_1);
		}
		
	        if(empty($res)) 
			{
			return 0;	
			}
        $count = 0;
		$data = array();
		while ( $row = mysql_fetch_array($res,MYSQL_ASSOC))
		{
			$data[$count] = $row;
			$count++;
		}
		mysql_free_result($res);
		return $data;
	}
        
        function select_id ($sql)	{
		$res = mysql_query($sql,$this -> CONN);
		
		if(!$res) 
		{
		$sql_query_1 = 'SELECT failed in SQL: '.$sql;
		$this->error($sql_query_1);
		}
		
	        if(empty($res)) 
			{
			return 0;	
			}
        
		$data = array();
		while ( $row = mysql_fetch_array($res,MYSQL_ASSOC))
		{
		   $data[$row[id]] = $row;			
		}
		mysql_free_result($res);
		return $data;
	}

            function execute ($sql)
	{
		$res = mysql_query($sql,$this -> CONN);
		if(!$res) 
		{
		$this->error('EXEC failed in SQL: '.$sql);
		} 
		return $res;
	}

	function insert_id ()
	{
		$res = mysql_insert_id($this -> CONN);
		if(!$res) 
		{
		return 0;
		}
		return $res;
	}

	function one_data($sql) { 
	    $res=mysql_query($sql, $this -> CONN); 
		if(!$res)
		{
		$this->error('SELECT failed in SQL: '.$sql);
		}
   	    	if(empty($res)) 
			{
				return 0;
			}
	    list($r)=mysql_fetch_row($res); 
	    mysql_free_result($res);
	    return($r); 
	} 

	function one_array($sql) { 
	    $res=mysql_query($sql, $this -> CONN); 
		if(!$res)
		{
			$this->error('SELECT failed in SQL: '.$sql);
		}
   	     if(empty($res))
		 {
			 return 0;
		 }
	     $r = mysql_fetch_array($res); 
         mysql_free_result($res);
	     return($r); 
	} 

    function disconnect() {
		$res = mysql_close($this -> CONN);
		return $res;
	}
        function set_db($dbname){
        if(!$dbname || $this -> CURDB == $dbname)
		{
            
			return;
		}
		
			if(!mysql_select_db($dbname,$this -> CONN))
			{
				$this -> error("Dbase Select failed");
			}
		$this -> CURDB = $dbname;
	}

   
}


}

// подключение к БД
$db = new MySQL;
$db->connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
mysql_query ("SET NAMES utf8");

// подключение Memcache
if (CASH==2){
$memcache = new Memcache;
$memcache->connect('localhost',11211);
//$memcache->addServer('localhost', 11211);
print_r($memcache->getStats());

}