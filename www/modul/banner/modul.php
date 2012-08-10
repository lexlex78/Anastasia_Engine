<?php
$sql =$db->select('SELECT * FROM '.DB_PREFIX.'banner WHERE en=1 ORDER BY sort');
$li='';
foreach ($sql as $k=>$v)
{ 
//$kk=$k+1;if (strlen($kk)==1) $kk='0'.$kk;
//$aktiv='';
//if ($kk==1) $aktiv='class="active"';
$li.='<div class="slider-li">
                    <img src="/img/banner/'.$v[img].'" alt="'.$v[zag].'"/>
                    <div class="slider-title">
                        <strong>'.$v[zag].'</strong>
                        <p>'.$v[text].'</p>
                        <a href="'.$v[url].'">Читать полностью</a>
                    </div>
                </div>';

}
$banner=$li;



