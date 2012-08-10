<?php

///////////рекурсивная функцти для вывода дерева /////////////////////////////////////
function shop_vievtree_mmenu ($a){
$ret='';
global $dantree;
$fol='class="slide"';if ($a==0)$fol='';

$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
 
 if ($dantree[$v]['cild'])
 {
    // if( $_SERVER['REQUEST_URI']==$dantree[$v]['url']) {$active='class="current"';} else {$active='';}
     
     $ret.='<li '.$active.'><a class="opener"><span>'.$dantree[$v]['name'].'</span></a>'.vievtree_mmenu($dantree[$v]['id']).'</li>';}
 else $ret.='<li '.$active.'><a href="'.$dantree[$v]['url'].'">'.$dantree[$v]['name'].'</a></li>';
 
 
 
}
$ret.='</ul>';
return $ret;
}



// вывод меню каталога товаров
unset($dantree);
$dantree=$db->select_id("SELECT * FROM ".DB_PREFIX."shop_cat WHERE en=1 ORDER BY sort ASC");
//1 я итерация указываем каждому родителю ребенка
foreach ($dantree as $k=>$v) {$dantree[$v['pid']]['cild'][]=$v[id];$dantree[$v['pid']]['tree_num']=0;}
$shop_cat=shop_vievtree_mmenu (0);


////////////////////////////////////////////

