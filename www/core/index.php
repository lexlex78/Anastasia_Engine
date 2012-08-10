<?
session_start();

// клас замера времени работы скрипта
require 'timer.php';
$timer = new timer();
$timer->start_timer();

require 'conf.php';
require 'router.php';
require 'db.php';
require 'core.php';


//чистка GET и POST
$_pattern = array('&', "'", '"', '<', '>', '\\');
$_replacement = array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;', '\\\\');
$_GET = str_replace($_pattern, $_replacement, $_GET);
$_POST = str_replace($_pattern, $_replacement, $_POST);

//разбор роутера (r=модуль/файл)
//$file="";$modul="";
if (!empty($_GET['r'])){$temp= explode ('/', $_GET['r']);
$modul=$temp[0];
if (isset($temp[1])) $file=$temp[1];
else $file=$temp[0];
}

//подключения модуля для главной
//if ($_SERVER['REQUEST_URI']=='/'){
//$d_modul=array('gl_banner','gl_count');
//foreach ($d_modul as $v) if (file_exists("./modul/$v/modul.php"))include "./modul/$v/modul.php";
//}

//подключения модуля поумолчанию
$d_modul=array('mmenu','muslugi','set','banner','recl','stat','tex','partnery','shop');
foreach ($d_modul as $v) if (file_exists("./modul/$v/modul.php"))include "./modul/$v/modul.php";





//подключение модуля по запросу
if (!$file && $modul)$file=$modul;
if( !empty ($modul) && !empty ($file)){
if (file_exists("./modul/$modul/$file.php"))include "./modul/$modul/$file.php";else $_GET['error']=404;
}else $_GET['error']=404;

//обработка 404
if ($_GET['error']==404){
  $title = "Ошибка 404 - Такой страницы не существует!";  
  $templ = './templ/404_tpl.php';
  $all = showtempl($templ); 
  echo $all;
  exit;
}

//разруливаем шаблоны
$templ='./templ/main_tpl.php';
//if($modul=='albums' || $modul=='myroom') $templ='./templ/main_tpl.php'; 

    

/// есле нет мето тегов добовляем
if (!$meta_title)$meta_title='';
if (!$meta_descr)$meta_descr='';
if (!$meta_keyw)$meta_keyw='';

///вывод всего сайта
$all=showtempl($templ);
echo $all;
echo  $timer->end_timer();
echo  '<br>';