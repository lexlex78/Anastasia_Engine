<?php
//ключь для кеша
$cash_mod='news_'.$id_news;
$cash=cash_read ($cash_mod);
if (!$cash){

    
$sql =$db->select('SELECT * FROM '.DB_PREFIX.'news WHERE en=1 AND id ='.$id_news);
if (!$sql)$_GET['error']=404;

$it='<strong>'.$sql[0][zag].'</strong>
                        <p>'.date('d.m.Y', strtotime($sql[0]['data'])).'</p>
                            <img class="thumb" src="img/news/'.$sql[0]['img'].'" alt="">
                        <p>'.$sql[0][text].'
                        </p>';


$center_area=$it;


cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';