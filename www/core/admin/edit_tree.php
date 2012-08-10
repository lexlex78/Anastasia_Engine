<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require_once  '../conf.php';
require_once '../db.php';

//echo "<pre>";
//print_r ($_POST);
//echo "</pre>";

$_POST['id']=$_POST['id_kuda'];
require_once './edit.php';