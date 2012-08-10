<?php
$cash_mod='action';
$cash=cash_read ($cash_mod);
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'action WHERE en=1  ORDER BY `sort`');

$it='';
foreach ($sql as $k=>$v)
{ 
$it.='<div class="akcia">
    
                    <a href="/action/'.$v['id'].'"><img src="img/action/'.$v['img'].'" alt="'.$v[zag].'"/></a>
                    <div class="akcia-holder">
                        <strong>АКЦИЯ</strong>
                        <a href="/action/'.$v['id'].'"><span>'.$v[zag].'</span></a>
                        <a href="/action/'.$v['id'].'"><p>'.$v[text].'
                        </p></a>
                    </div>
                    </div>';

}

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');


cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';