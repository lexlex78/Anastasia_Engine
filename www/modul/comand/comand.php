<?php
$cash=cash_read ('comanda');
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'comand  ORDER BY sort limit 0,1');
$about_name=$sql[0]['name'];
$about_text=$sql[0]['text'];

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'comand_com WHERE en=1 ORDER BY sort ');
$about_it='';$s=0;$tt='';
foreach ($sql as $k=>$v)
{ 
$tt.=showtempl(dirname(__FILE__).'/templ/tpl_com.php');
if ($s>1){$about_it.='<div class="our-team-wrapper">'.$tt.'</div>';$s=-1;$tt='';}
$s++;
}
if ($s>0)$about_it.='<div class="our-team-wrapper">'.$tt.'</div>';
else $about_it.=$tt;

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');


cash_add ('comanda',120,$center_area);
}
else $center_area=$cash;

$recl='';