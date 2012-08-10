<?php
$cash_mod='m_stat';
$cash=cash_read ($cash_mod);
if (!$cash){

$sql =$db->select('SELECT * FROM '.DB_PREFIX.'stat WHERE en=1  ORDER BY sort desc LIMIT 0,2');

$it='';
foreach ($sql as $k=>$v)
{ 
$it.='<div class="stati-holder">
                        <span>'.$v[zag].'</span>
                        <p>'.$v[text_k].'</p>
                        <a href="/article/'.$v[id].'">Читать полностью &gt;&gt;</a>
                    </div>';

}

$mod_stat=$it;


cash_add ($cash_mod,120,$mod_stat);
}
else $mod_stat=$cash;
