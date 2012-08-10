<?php
//ключь для кеша
$cash_mod='action_'.$id_action;
$cash=cash_read ($cash_mod);
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'action WHERE en=1 AND id ='.$id_action.'  ');
if (!$sql)$_GET['error']=404;

$it='<strong>'.$sql[0][zag].'</strong><br>
    <img src="/img/action/'.$sql[0]['img'].'"
                        <p>'.$sql[0][data].'</p>
                        <p>'.$sql[0][text].'
                        </p>';


$center_area='
                <div class="news">
                    <div class="news-holder">'.$it.'  </div>
                </div>';


cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';