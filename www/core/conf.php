<?php
//mysql connection params
define('DB_SERVER', 'localhost');
define('DB_USER', 'test8');
define('DB_PASS', 'B3AsMSHq');
define('DB_NAME', 'test8');
define('DB_PREFIX', 'site_');


$site_url='http://'.$_SERVER['HTTP_HOST'];

$arr = pathinfo(__FILE__);
$arr = pathinfo($arr['dirname']);
define('SITE_PATH', $arr['dirname'].'/');


// языки используемые на сайте 1 й по умолчанию
$yaz=array('ru','en');

//параметры кеширование
// тип кеширования 0 - нет, 1 - файл , 2 - мемкеш
define('CASH', 0);