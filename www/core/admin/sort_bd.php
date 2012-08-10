<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require_once '../conf.php';
require_once '../db.php';

//разбираем данные
$dat=str_replace("\\", "",  $_POST['dat']);
$dat1=$dat;
$dat=unserialize($dat);

$tabl=$_POST['tabl'];
$id=$_POST['id'];
$name=$_POST['name'];
$sortname=$_POST['sortname'];
$sortorder=$_POST['sortorder'];
$where=$_POST['where'];
if (!empty($where))$where=' AND '.$where;

//if ($sortname=='')$sortname='id';
if ($sortorder=='')$sortorder='asc';

if ($name=='down')$znak='<';
else $znak='>';

if ($sortorder=="asc"){
 if ($znak=='>')$znak='<';
else $znak='>';   
}

$aa='asc';if ($znak=='<')$aa='desc';

$result=$db->select("SELECT * FROM ".DB_PREFIX."$tabl WHERE $sortname $znak $id $where order by $sortname $aa limit 1");

if ($result)
{
 
 $da=$db->select("SELECT * FROM ".DB_PREFIX."$tabl WHERE $sortname = $id limit 1");
 
//TODO: Удалить
 file_put_contents('./mass.txt',"UPDATE  ".DB_PREFIX."$tabl SET $sortname=".$da[0][$sortname]."  WHERE id = ".$result[0][id]."UPDATE  ".DB_PREFIX."$tabl SET $sortname=".$result[0][$sortname]."  WHERE id = ".$da[0][id]);
 
 
 $db->select("UPDATE  ".DB_PREFIX."$tabl SET $sortname=".$da[0][$sortname]."  WHERE id = ".$result[0]['id']);
 $db->select("UPDATE  ".DB_PREFIX."$tabl SET $sortname=".$result[0][$sortname]."  WHERE id = ".$da[0]['id']);

}

echo "ok";