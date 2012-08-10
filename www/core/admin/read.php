<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require '../conf.php';
require '../db.php';
require './core.php';



//ob_start();
//print_r($dat);
//$ret=ob_get_contents();
//ob_end_clean();
//file_put_contents('./mass.txt', $ret);


//проверка постов
$page = isset($_POST['page']) ? $_POST['page'] : 1;
$rp = isset($_POST['rp']) ? $_POST['rp'] : 10;
$sortname = isset($_POST['sortname']) ? $_POST['sortname'] : 'id';
$sortorder = isset($_POST['sortorder']) ? $_POST['sortorder'] : 'asc';
$query = isset($_POST['query']) ? $_POST['query'] : false;
$qtype = isset($_POST['qtype']) ? $_POST['qtype'] : false;
$dat=str_replace("\\", "",  $_POST['dat']);
$dat=unserialize($dat);
if (!isset($_POST['tabl']))exit();
$tabl=$_POST['tabl'];


$sort = "ORDER BY $sortname $sortorder";
$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";
$where = "";
if ($query) $where = " WHERE $qtype LIKE '%".mysql_real_escape_string($query)."%' ";
//дабовляем запрос
if (!empty($_POST['where'])){
if ($where!="")$where.=' AND '.$_POST['where'];
else $where=' WHERE '.$_POST['where'];
}
// запрос
$result = $db->select("SELECT * FROM ".DB_PREFIX."$tabl $where $sort $limit");
// количество записей
$dan=$db->select("SELECT count(id) as co FROM ".DB_PREFIX."$tabl $where $sort");
$total=$dan[0]['co'];


//проверяем естьли связанные таблицы и выбираем их
foreach ($dat as $k => $v) {
if ($v['tip']=='sel_tab' || $v['tip']=='sel_tabm' )$d[$k]=$db->select_id("SELECT * FROM ".DB_PREFIX.$v['tabl']);
}


// компановка и передача данных
header("Content-type: application/json");
$jsonData = array('page'=>$page,'total'=>$total);


foreach($result as $v){
// обработка вывода результата
 foreach  ($v as $k=>$v1){ 
if ($dat[$k]['tip']=='img'){if ($v[$k]!='')$v[$k]='<img src="'.$dat[$k]['path'].$v[$k].'" width="150px"/>';}

if ($dat[$k]['tip']=='sel_tab'){
    $v[$k]=$d[$k][$v[$k]][$dat[$k]['td']];
    }
    
if ($dat[$k]['tip']=='sel_tabm'){
    $pars=  explode(",", $v[$k]);
    $v[$k]='';
    foreach ($pars as $pv) {$v[$k].=$d[$k][$pv][$dat[$k]['td']].'<br>';}
    }

if ($dat[$k]['tip']=='ftext')$v[$k]=str_smol($v[$k],100);

if ($dat[$k]['tip']=='btext')$v[$k]=str_smol($v[$k],100);

if ($dat[$k]['tip']=='bool'){if ($v[$k]==1)$v[$k]='<input type="checkbox" name="" value="1" checked="checked" disabled="disabled" />';
else $v[$k]='<input type="checkbox" name="" value="1"  disabled="disabled" />'; 
}

if ($dat[$k]['tip']=='sort'){$v['up_down']='<span class="up" onclick="sort'.$tabl.'(\'up\',\''.$v[sort].'\')"  ></span> <span class="down" onclick="sort'.$tabl.'(\'down\',\''.$v[sort].'\')"></span>';}    
 
 }
 
 
$result1=array('id'=>$v[id],'cell'=>$v);
$jsonData['rows'][]=$result1;
}
echo json_encode($jsonData);
