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

if (!$_POST['id_kuda'])$_POST['id_kuda']=0;
$db->execute("INSERT ".DB_PREFIX.$_POST['tabl']." SET ".$_POST['pid']."='".$_POST['id_kuda']."'");
$_POST['id']=mysql_insert_id();
$db->execute("UPDATE ".DB_PREFIX.$_POST['tabl']." SET ".$_POST['sort']."='".$_POST['id']."' WHERE id =".$_POST['id']);

require_once './edit.php';