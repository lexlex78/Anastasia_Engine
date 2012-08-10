<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require  '../conf.php';
require '../db.php';

//echo "<pre>";
//print_r ($_POST);
//echo "</pre>";



$tabl=$_POST['tabl'];
$id=  explode(",", $_POST['ids']);


 $dantree=$db->select_id("SELECT * FROM ".DB_PREFIX.$tabl);
foreach ($id as $v){
 $dantree   [$v]['id_del']=1;
}
 foreach ($dantree as $vv){
  foreach ($dantree as $k=>$v){
  if  (!$v['id_del'] || $v['id_del']==0)if ($dantree[$v['pid']]['id_del']==1)$dantree[$k]['id_del']=1;
  }    
 } 
 $_POST['ids']="";
 foreach ($dantree as $k=>$v){
 if($v['id_del']==1) $_POST['ids'].=$v['id'].",";  
 }  
 $_POST['ids']=trim($_POST['ids'],",");
//echo $_POST['ids'];
require_once './del_bd.php';