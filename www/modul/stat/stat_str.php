<?php
//ключь для кеша
$cash_mod='stat_'.$id_stat;
$cash=cash_read ($cash_mod);
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'stat WHERE en=1 AND id ='.$id_stat.'  ORDER BY sort ');
if (!$sql)$_GET['error']=404;

$it='<strong>'.$sql[0][zag].'</strong>
                        <p>'.$sql[0][data].'</p>
                        <p>'.$sql[0][text].'
                        </p>';


$center_area='<div class="breadcrumps">
                    <ul>
                        <li><a href="/article">Статьи</a></li>
                        <li class="last"><a href="/article/'.$sql[0][id].'">'.$sql[0][zag].'</a></li>
                    </ul>
                </div>
                <div class="news">
                    <div class="news-holder">'.$it.'  </div>
                </div>';


cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';