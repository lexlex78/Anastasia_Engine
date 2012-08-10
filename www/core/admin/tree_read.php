<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require '../conf.php';
require '../db.php';
require '../core.php';
require './core.php';
$d=$_POST['data']['dan'];

//echo "<pre>";
//print_r ($_POST);
//echo "</pre>";

//вывод таблицы
$_GET['tree_'.$_POST['data']['num']]=$_POST['id_reload'];
//$_GET['tree_'.$_POST['data']['num']]=$_POST['id_kto'];

$input=tree_admin_red_ajax($_POST['data']['table'],$_POST['data']['title'],$_POST['data']['dan'],$_POST['data']['num'],$_POST['data']['where']);


echo $input;?>
