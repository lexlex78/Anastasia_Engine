<?php

///////////рекурсивная функцти для вывода дерева /////////////////////////////////////
function vievtree_mmenu ($a){
$ret='';
global $dantree;
$fol='';if ($a==0)$fol='class="nav"';

$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
 
 if ($dantree[$v]['cild'])
 {
    // if( $_SERVER['REQUEST_URI']==$dantree[$v]['url']) {$active='class="current"';} else {$active='';}
     
     $ret.='<li '.$active.'><a>'.$dantree[$v]['name'].'</a><div class="drop-box">'.vievtree_mmenu($dantree[$v]['id']).'</div></li>';}
 else $ret.='<li '.$active.'><a href="'.$dantree[$v]['url'].'">'.$dantree[$v]['name'].'</a></li>';
 
 
 
}
$ret.='</ul>';
return $ret;
}


function vievtree_mmenu1 ($a){
$ret='';
global $dantree;
$fol='';if ($a==0)$fol='class="foot-nav"';

$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
 
 if ($dantree[$v]['cild'])
 {
    // if( $_SERVER['REQUEST_URI']==$dantree[$v]['url']) {$active='class="current"';} else {$active='';}
     
     $ret.='<li '.$active.'><a>'.$dantree[$v]['name'].'</a><div class="drop-box">'.vievtree_mmenu($dantree[$v]['id']).'</div></li>';}
 else $ret.='<li '.$active.'><a href="'.$dantree[$v]['url'].'">'.$dantree[$v]['name'].'</a></li>';
 
 
 
}
$ret.='</ul>';
return $ret;
}


// вывод меню
unset($dantree);
$dantree=$db->select_id("SELECT * FROM ".DB_PREFIX."mmenu WHERE en=1 ORDER BY sort ASC");
//1 я итерация указываем каждому родителю ребенка
foreach ($dantree as $k=>$v) {$dantree[$v['pid']]['cild'][]=$v[id];$dantree[$v['pid']]['tree_num']=0;}
$topmenu=vievtree_mmenu (0);
$topmenu1=vievtree_mmenu1 (0);

////////////////////////////////////////////

