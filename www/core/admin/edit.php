<?php
// защита от запростов с дургих сайтов
if (strpos($_SERVER['HTTP_REFERER'],'http://'.$_SERVER['HTTP_HOST'])===false)exit();
// проверка на сесию админа
session_start();
if ($_SESSION['admin']!='admin')exit();

//подключение БД
require_once '../conf.php';
require_once '../db.php';

$dat=str_replace("\\", "",  $_POST['dat']);
$dat1=$dat;
$dat=unserialize($dat);
$id= $_POST['id'];
$tabl=$_POST['tabl'];

$sel=$db->select("SELECT * FROM ".DB_PREFIX."$tabl WHERE id=$id");
$sel=$sel[0];
//echo "<pre>";
//print_r ($dat);
//echo "</pre>";

// вывод инпутов
$input='<br><br><form id="form_'.$_POST['tabl'].'" name="form_'.$_POST['tabl'].'" action="/core/admin/edit_bd.php" method="POST" enctype="multipart/form-data" onSubmit="return false">
<table cellspacing="0" cellpadding="0" id="table_'.$_POST['tabl'].'">
<input type=\'hidden\' name=\'p_dat\' value=\''.$dat1.'\' />
<input type="hidden" name=\'p_tabl\' value=\''.$_POST['tabl'].'\' />
<input type="hidden" name=\'p_id\' value=\''.$_POST['id'].'\' />
';
foreach ($dat as $k => $v) {
$name=$v[name];
if (!$name)$name=$k;
$val='';
 //перебор типов 
if ($v['w']==1){
$rec='';if ($v['ob']==1)$rec='required,';
if ($v['tip']=='text'){
    $valid='class="validate['.$rec.']"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='url'){
  
    $valid='class="validate['.$rec.',custom[url]]"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='data'){
    $valid='class="validate['.$rec.',custom[date]] daty"';    
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='time'){
    $valid='class="validate['.$rec.',custom[time]] timy"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='datatime'){
    $valid='class="validate['.$rec.',custom[datatime]] datytimy"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}


if ($v['tip']=='int'){
    $valid='class="validate['.$rec.',custom[integer]"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='dec'){
    $valid='class="validate['.$rec.',custom[number]"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='tel'){
    $valid='class="validate['.$rec.',custom[phone]"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';}

if ($v['tip']=='email'){ 
    $valid='class="validate['.$rec.',custom[email]]"';
    $val='<input '.$valid.' type="text" name="'.$k.'" value="'.$sel[$k].'" />';    
    }
    
if ($v['tip']=='ftext'){
    $valid='class="validate['.$rec.'] tiny"';
    $val='<textarea '.$valid.' name="'.$k.'" >'.$sel[$k].'</textarea>';}
    
if ($v['tip']=='btext'){
    $valid='';
    $val='<textarea style="margin: 2px; height: 116px; width: 686px; " '.$valid.' name="'.$k.'" >'.$sel[$k].'</textarea>';}
    
if ($v['tip']=='bool'){
   // $valid='class="validate['.$rec.'] tiny"';
    if ($sel[$k]==1)$val='<input type="checkbox" name="'.$k.'" value="1" checked="checked" />';
    else $val='<input type="checkbox" name="'.$k.'" value="1" />';   
}

if ($v['tip']=='sel_tab'){
$pv=$db->select_id("SELECT * FROM ".DB_PREFIX.$v['tabl']);
 $val='<select name="'.$k.'">';
foreach ($pv as $vv) {
    $sele='';if ($vv['id']==$sel[$k])$sele='selected';
 $val.='<option '.$sele.' value="'.$vv['id'].'">'.$vv[$v[td]].'</option>';   
}
$val.='</select>';
}

if ($v['tip']=='sel_tabm'){
$pv=$db->select_id("SELECT * FROM ".DB_PREFIX.$v['tabl']);
$val='<div><fieldset><table id="tab_'.$k.$v[tabl].$v[td].'">';
$ttt=  explode(',', $sel[$k]);
foreach ($ttt as $kt=>$vt) {
if (!empty($vt))$val.="<tr id='tr_".$k.$v[tabl].$v[td].$kt."' num=".$vt."><td>".$pv[$vt][$v['td']]."</td><td onclick=\"del_tab(".$kt.",'".$k.$v[tabl].$v[td]."')\"><a href='javascript:void(0);'> удалить <a/></td></tr>";    
}

$val.='</table></fieldset></div><br>    
<select id="nam_'.$k.$v[tabl].$v[td].'">';

foreach ($pv as $vv) {
$val.='<option value="'.$vv['id'].'">'.$vv[$v[td]].'</option>'; 
}
$val.='</select>';
$val.='<input id="'.$k.$v[tabl].$v[td].'" type="hidden" name="'.$k.'" value="'.$sel[$k].'" />
<button onclick="add_tab(\''.$k.$v[tabl].$v[td].'\')">добавить</button>';
}

    
if ($v['tip']=='img'){$val='<input type="file" name="'.$k.'" />';
if ($sel[$k]!="")$name.='<br><img src="'.$dat[$k]['path'].$sel[$k].'" width="150px"/><br> ';
if ($v[imgw])$name.=' W='.$v[imgw].' ';
if ($v[imgh])$name.=' H='.$v[imgh].' ';
}


$aa='';if ($v[ob]==1)$aa='<span style="color:red"> * <span>';
if ($val!='')$input.='<tr><td>'.$name.$aa.'<td><td>'.$val.'</td></tr>';
}
    
}
$input.='</table></form></div>';


echo $input;?>
