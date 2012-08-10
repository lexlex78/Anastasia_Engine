<?php
$act='';
if ($modul=='tex')$act='action';

$sql=$db->select_id("SELECT * FROM ".DB_PREFIX."tex WHERE en=1 ORDER BY sort ASC");
$it='';
foreach ($sql as $v) {
$it.='<li><a href="/tex/'.$v['url'].'">'.$v['name'].'</a></li>';   
}
  
$tex_pot='
<li>
                              <a class="opener-main '.$act.'" href="#">Техподдержка</a>
                              <ul>
                                        '.$it.'
                              </ul>
                    </li>';
