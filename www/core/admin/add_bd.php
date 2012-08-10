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
foreach ($_POST as $v=>$k){$_POST[$k]=mysql_real_escape_string($v);}

//разбираем посты
$dop_wh=($_POST['dop_wh']&&$_POST['p_tabl']?','.$_POST['dop_wh']:(!$_POST['p_tabl']&&$_POST['dop_wh']?$_POST['dop_wh']:''));
$tabl=$_POST['p_tabl'];
$dat=str_replace("\\", "",$_POST['p_dat']);
$dat=unserialize($dat);

$sort='';
$sql='';
// типы даннх с '';
$tipy=array('text','img','img_all','data','tel','time','datatime','datatime','email','ftext','btext','sel_tabm','url','url_s','int');

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
// если несколько картинок привязанных к таблице
  if ($v['tip']=='img_all'){           
$path ="../..".$v['path']."/".$v['table_id'];

$table_img=$v['table'];
$table_id=$v['table_id'];
if (!is_dir($path))mkdir($path,'0756');
if (substr(sprintf('%o', fileperms($path)), -4)!=='0756')  chmod($path, '0756');
chmod($path, '1777');

$iw=$v[imgw];$ih=$v[imgh];
$iw1=$v[imgw_1];$ih1=$v[imgh_1];
$iw2=$v[imgw_2];$ih2=$v[imgh_2];

if (empty($iw)){
$size = getimagesize ($_FILES[$k][tmp_name]); 
$iw=$size[0];$ih=$size[1];
}
if (empty($iw1)){
$size1 = getimagesize ($_FILES[$k][tmp_name]);
$iw1=$size1[0];$ih1=$size1[1];
}
if (empty($iw2)){
$size2 = getimagesize ($_FILES[$k][tmp_name]);
$iw2=$size2[0];$ih2=$size2[1];
}

$tabl_1=$v['tabl_1'];
$tabl_2=$v['tabl_2'];

$val=uploadimage($iw,$ih,$path,$k);
$val1=uploadimage($iw1,$ih1,$path,$k);
$val2=uploadimage($iw2,$ih2,$path,$k);
}
// 
/////////////////////////////////////////////////////////
if ($v['tip']=='bool'){
 if (!isset($val))$val=0; 
 }
}
// флаг ели есть сортировка
if (($v['tip']=='sort')){$sort=$k;}

//добовляем кавычки где нужно
if ($val!=''){ 
if (in_array($v['tip'],$tipy)){$val="'".$val."'";}
$sql.=' `'.$k.'`='.$val.',';
}

 }
$sql=trim($sql,",");
  if($val1||$val2){
     $sql.=",`".$tabl_1."`='".$val1."',`".$tabl_2."`='".$val2."'";
 }
 $sql=trim($sql,",");
 
//TODO: Удалить
file_put_contents('./mass.txt', "INSERT  ".DB_PREFIX."$tabl SET $sql");

$db->execute("INSERT ".DB_PREFIX."$tabl SET $sql $dop_wh");
$ins_id=mysql_insert_id();
if ($sort!='')$db->select("UPDATE ".DB_PREFIX."$tabl SET $sort=".$ins_id." WHERE id=".$ins_id."");
if($table_img){
    
    $sell=$db->select("SELECT * FROM ".DB_PREFIX.$table_img." WHERE id='".$table_id."'");
    $sell=$sell[0];
    
	if($sell['img']){
	$sel_img=$sell['img'].','.$ins_id;
	;
	    }else{
	$sel_img=$ins_id;
	    }
	$sel_img=trim($sel_img,',');
	$db->select("UPDATE ".DB_PREFIX."$tabl SET pid=".$sell['id']." WHERE id=".$ins_id."");
    $db->select("UPDATE ".DB_PREFIX."$table_img SET img='".$sel_img."' WHERE id=".$table_id."");
}
echo "ok";
