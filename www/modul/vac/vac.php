<?php
$cash_mod='vac';
$cash=cash_read ($cash_mod);
if (!$cash){

$stat=$db->select('SELECT * FROM '.DB_PREFIX.'vac_op');
$stat=$stat[0];   
    
$sql =$db->select('SELECT * FROM '.DB_PREFIX.'vac WHERE en=1  ORDER BY sort DESC');

$it='';
foreach ($sql as $k=>$v)
{ 
$it.='
    <li>
    <a href="#">'.$v[zag].'</a>
        <div>
        '.$v[text].'         
        </div>
    </li>
      ';

}

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');




cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

