<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require_once '../conf.php';
require_once '../db.php';
//подключение библиотек
require './core.php';

// чистка поста
foreach ($_POST as $k=>$v){$_POST[$k]=mysql_real_escape_string($v);}

//разбираем посты
$tabl=$_POST['p_tabl'];
$dat=str_replace("\\", "",$_POST['p_dat']);
$dat=unserialize($dat);

$sort='';
$sql='';
// типы даннх с '';
$tipy=array('text','img','data','tel','time','datatime','datatime','email','ftext','btext','sel_tabm','url');

// перебераем поля состовляем запрос
foreach ($dat as $k => $v) {
$val='';   
// проверяем есле поле для записи  добовляем
if ($v['w']==1)
{
    $val=$_POST[$k];
    // разбирвем по типам и делаем действия
    
    
 /////////////////////////////////////////////////////////   
  //есле картинка
  if ($v['tip']=='img'){           
$path ="../..".$v['path'];

//if (!is_dir($path))mkdir($path,'0756');
//if (substr(sprintf('%o', fileperms($path)), -4)!=='0756')  chmod($path, '0756');
//chmod($path, '1777');

$iw=$v[imgw];$ih=$v[imgh];


if (empty($iw)){
$size = getimagesize ($_FILES[$k][tmp_name]); 
$iw=$size[0];$ih=$size[1];
}

$val=uploadimage($iw,$ih,$path,$k);
}   
/////////////////////////////////////////////////////////
if ($v['tip']=='bool'){
 if (!isset($val))$val=0; 
 }


}
// флаг ели есть сортировка
if (($v['tip']=='sort')){$sort=$k;}

//добовляем кавычки где нужно
if ($val!=''){ 
if (in_array($v['tip'],$tipy)){$val="'$val'";}
$sql.=' `'.$k."`=$val,";
}

 }
 $sql=trim($sql,",");
 
//TODO: Удалить
file_put_contents('./mass.txt', "INSERT  ".DB_PREFIX."$tabl SET $sql");
 
$db->execute("INSERT  ".DB_PREFIX."$tabl SET $sql");
if ($sort!='')$db->select("UPDATE ".DB_PREFIX."$tabl SET $sort=".mysql_insert_id()." WHERE id=".mysql_insert_id());

echo "ok";
