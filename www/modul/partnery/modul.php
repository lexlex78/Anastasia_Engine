<?php
$act='';
if ($modul=='partnery')$act='action';

$sql=$db->select_id("SELECT * FROM ".DB_PREFIX."partnery WHERE en=1 ORDER BY sort ASC");
$it='';
foreach ($sql as $v) {
$it.='<li><a href="/partnery/'.$v['url'].'">'.$v['name'].'</a></li>';   
}
  
$partneryy='
<li>
                              <a class="opener-main '.$act.'" href="#">Партнеры</a>
                              <ul>
                                        '.$it.'
                              </ul>
                    </li>';
