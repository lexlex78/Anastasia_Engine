<?php
$cash_mod='stat';
$cash=cash_read ($cash_mod);
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'stat WHERE en=1  ORDER BY sort LIMIT 0,2');

$it='';
foreach ($sql as $k=>$v)
{ 
$it.='<div class="news-holder">
                        <strong>'.$v[zag].'</strong>
                        <p>
                            '.$v[text].'
                        </p>
                        <div class="news-holder-bottom">
                            <strong>'.$v[data].'</strong>
                            <a href="/news/'.$v[id].'">Читать полностью &gt;&gt;</a>
                        </div>
                    </div>';

}

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');


cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';