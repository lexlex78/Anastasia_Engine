<?php
$sql =$db->select('SELECT * FROM '.DB_PREFIX.'recl  ORDER BY sort');
$li='';$sh=0;
foreach ($sql as $k=>$v)
{ 
//$kk=$k+1;if (strlen($kk)==1) $kk='0'.$kk;
//$aktiv='';
//if ($kk==1) $aktiv='class="active"';
if ($sh==0)$li.='<div class="banner-left"><img src="/img/recl/'.$v[img].'" alt=""/></div>';
if ($sh==1)$li.='<div class="banner-right"><img src="/img/recl/'.$v[img].'" alt=""/></div>';
$sh++;
}
$recl=$li;



