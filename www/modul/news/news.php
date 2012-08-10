<?php


$cash_mod='news'.$_GET[page];
$cash=cash_read ($cash_mod);
if (!$cash){
  
// пажинация    
$sql =$db->select('SELECT COUNT(id) FROM '.DB_PREFIX.'news WHERE en=1'); 
$all=$sql[0]['COUNT(id)'];
$pagin=paging($all,3,6);


$sql =$db->select('SELECT * FROM '.DB_PREFIX.'news WHERE en=1  ORDER BY `data` LIMIT '.$pagin[1]);

$it='';
foreach ($sql as $k=>$v)
{ 
$it.='
  <div class="post cf">
                                                  <div class="post-text">
                                                            <div class="cf">
                                                                      <h3>'.$v['zag'].'</h3>  <span class="date">'.date('d.m.Y', strtotime($v['data'])).'</span>
                                                            </div>
                                                            <p>'.str_smoll($v[text],300).'<br><a href="/news/'.$v['id'].'">Подробнее...</a>
                                                            </p>
                                                  </div>
                                                  <img class="thumb" src="img/news/'.$v['img'].'" alt="">
                                        </div>  
';

}

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');




cash_add ($cash_mod,120,$center_area);
}
else $center_area=$cash;

$recl='';