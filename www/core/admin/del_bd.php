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
$ids=$_POST['ids'];


/// удаляем картинки
foreach ($dat as $k => $v) {
if  ($v['tip']=='img')
    {
     $result=$db->select("SELECT * FROM ".DB_PREFIX."$tabl WHERE id IN ($ids)");
     foreach ($result as $vv) 
                {
                $path ="../..".$v['path'];
                unlink($path.$vv[$k]);
                }
     }       
}


$result=$db->execute("DELETE FROM ".DB_PREFIX."$tabl WHERE id IN ($ids)");

echo "ok";