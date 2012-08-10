<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require '../conf.php';
require '../db.php';
//require '../core.php';
//require './core.php';
$d=$_POST['data']['dan'];

//вывод поста
//echo "<pre>";
//print_r ($_POST);
//echo "</pre>";

$dantree=$db->select_id("SELECT * FROM ".DB_PREFIX.$_POST['data']['table']);
// проверяем не зацыклица ли перемешение
$tree_id=$_POST['id_kuda'];
$tr=0;
  while  ($dantree[$tree_id][$d['pid']]!=0)
     {
     if ($tree_id==$_POST['id_kto'])$tr=1;
     $tree_id=$dantree[$tree_id][$d['pid']];
     if ($tree_id==$_POST['id_kto'])$tr=1;
     }
 
// перемешаем есле нет зацыкливания
if ($tr==0)$db->execute("UPDATE ".DB_PREFIX.$_POST['data']['table']." SET ".$d['pid']."='".$_POST['id_kuda']."' WHERE id=".$_POST['id_kto']);

// сортируем
$dantree=$db->select("SELECT * FROM ".DB_PREFIX.$_POST['data']['table']." WHERE ".$d['pid']."='".$_POST['id_kuda']."' ORDER BY ".$d['sort'] );


//min значение и массив
$key=0;
foreach ($dantree as $k=>$v) {
if ($dantree[$key][$d['sort']]>$v[$d['sort']])$key=$k;
}
foreach ($dantree as $k=>$v) {
if ($k!=$key )$mas[]=$v[$d['sort']];
}
$max=$dantree[$key][$d['sort']];

$sh=0;
foreach ($dantree as $k=>$v) {
if ($v['id']==$_POST['id_kto']){$dantree[$k][$d['sort']]=$max;echo $v['id']." ".$max;}
else {$dantree[$k][$d['sort']]=$mas[$sh];$sh++;}
   
}



$sql="INSERT ".DB_PREFIX.$_POST['data']['table']."(id, ".$d['sort'].") VALUES ";
foreach ($dantree as $k=>$v) {
$sqll.="(".$v['id'].", ".$v[$d['sort']]."),";
}
$sqll=trim ($sqll,",");
$sql.=$sqll." ON DUPLICATE KEY UPDATE ".DB_PREFIX.$_POST['data']['table'].".".$d['sort']." = VALUES(".$d['sort'].");";

$db->execute($sql);
//INSERT INTO tbl_country
//(code, price)
//VALUES
//(1, 123),
//(2, 456),
//…
//ON DUPLICATE KEY UPDATE tbl_country.price = VALUES(price);


////вывод таблицы
//$_GET['tree_'.$_POST['data']['num']]=$_POST['id_kto'];
//$input=tree_admin_red_ajax($_POST['data']['table'],$_POST['data']['title'],$_POST['data']['dan'],$_POST['data']['num'],$_POST['data']['where']);


echo $input;?>
