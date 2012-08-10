<?php

///////////рекурсивная функцти для вывода дерева /////////////////////////////////////
function vievtree_musl ($a){
$ret='';
global $dantree;
$fol='';if ($a==0)$fol='class="left-menu"';

$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
 
 if ($dantree[$v]['cild'])
 {
    // if( $_SERVER['REQUEST_URI']==$dantree[$v]['url']) {$active='class="current"';} else {$active='';}
     
     $ret.='<li '.$active.'><a>'.$dantree[$v]['name'].'</a>'.vievtree_musl($dantree[$v]['id']).'</li>';}
 else $ret.='<li '.$active.'><a href="'.$dantree[$v]['url'].'">'.$dantree[$v]['name'].'</a></li>';
 
 
 
}
$ret.='</ul>';
return $ret;
}


// вывод меню
unset($dantree);
$dantree=$db->select_id("SELECT * FROM ".DB_PREFIX."muslugi WHERE en=1 ORDER BY sort ASC");
//1 я итерация указываем каждому родителю ребенка
foreach ($dantree as $k=>$v) {$dantree[$v['pid']]['cild'][]=$v[id];$dantree[$v['pid']]['tree_num']=0;}
$left_menu=vievtree_musl (0);

////////////////////////////////////////////
    
