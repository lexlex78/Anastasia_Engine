<?php
////////////////////////////////////////////////////////////////////////////
// вывод таблицы
//$t - таблица
//$d - масив с типами полей
//$title - заголовок


function tab_admin($t,$title,$d,$d1){
 //  инициализация переменных 
 global $ta_title,$ta_colModel,$ta_searchitems,$ta_sortname,$ta_tabl,$ta_dat,$ta_sortorder,$ta_where,$ta_dat1,$t_dop_but,$t_dop_but_sc;
$ta_where=$d1['where'];
$ta_title=$title;$ta_colModel='';$ta_searchitems='';
$ta_sortname='id';$ta_tabl=$t;$ta_sortorder='asc';
$ta_dat= serialize($d);
$ta_dat1=$d1;



//дополнительные кнопки
$t_dop_but='';$t_dop_but_sc="";
$ta_i=1;
if ($d1['button'])
foreach ($d1['button'] as $k=>$v){
$t_dop_but.="{name: '".$k."', bclass: '', onpress : dop_but".$ta_tabl."_".$ta_i."},";
$t_dop_but_sc.=" function dop_but".$ta_tabl."_".$ta_i." (com, grid) {
     
	col=$('.trSelected', grid).length;
        m_mult='".$v['multi']."';
        m_url='".$v['url']."';
        raz=1;
        if (col<1){raz=0;alert ('Выбирете  запись!!!!')}
        if (m_mult!=1)if (col>1){raz=0;alert ('Выбирете одну запись!!!!')}  
        
        if (raz==1){
        obj= $('.trSelected', grid);
        id='';
	$.each( obj ,function(){id=id+$(this).attr('id').substring(3)+',';});
        id=id.slice(0, -1);
        window.open(m_url+'?id='+id,'_new','width=700,toolbar=0,location=0,scrollbars=1,resizable=1');
        }}";


$ta_i++;
}
// включаем сортировку
$t_sortabb='false';
if($d1['sort']=='1'){$t_sortabb='true';}
// разбираем все поля
foreach ($d as $k=>$v) {
 // поле id обязательно для вывода  
//if ($k=='id')$v['r']=1;

///обработка типов


$width=70;
if ($v['tip']=='img')$width=150;
if ($v['tip']=='id')$width=30;
if ($v['tip']=='url')$width=120;
if ($v['tip']=='text')$width=180;
if ($v['tip']=='sort')$width=30;
if ($v['tip']=='tel')$width=120;
if ($v['tip']=='email')$width=120;
if ($v['tip']=='ftext')$width=200;
if ($v['tip']=='sel_tab')$width=120;
if ($v['tip']=='datatime')$width=100;

 
if ($v['r']==1){
    if (empty($v[name]))$v[name]=$k;
$ta_colModel.="{display: '$v[name]', name : '$k', sortable : $t_sortabb, width : $width, align: 'center'},";
if ($v['tip']=='img' ||  $v['tip']=='sort'){}
else $ta_searchitems.="{display: '$v[name]', name : '$k'},";

}
if ($v['tip']=='sort'){
 $ta_sortname=$k;$ta_sortorder=$v['sort'];   
    
 $ta_colModel.="{display: '&nbsp;', name : 'up_down', sortable : false, width : 35, align: 'center'},";
}


}
$ta_colModel=trim($ta_colModel, ",");$ta_searchitems=trim($ta_searchitems, ",");
if (empty($ta_searchitems))$ta_searchitems=$ta_colModel;

$tabl.=showtempl(dirname(__FILE__).'/templ/c_tabl.php');



 
$ret=$tabl;
  
return $ret;    
   
}

require SITE_PATH.'core/upload.php';

/// обрезает строку $a по пробел с $b символа

function str_smol($a,$b){
    
$search = array ("'<script[^>]*?>.*?</script>'si",  // Вырезается javascript
                 "'<[\/\!]*?[^<>]*?>'si",           // Вырезаются html-тэги
                 "'([\r\n])[\s]+'",                 // Вырезается пустое пространство
                 "'&(quot|#34);'i",                 // Замещаются html-элементы
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // вычисляется как php

$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");

$text = preg_replace ($search, $replace, $a);

//$aa=mb_strpos($text, " ", $b, "utf8");
//if ($aa<$b)$aa=$b;
$text=mb_substr($text, 0, $b, "utf8");   
 
return $text;
}

///////////рекурсивная функцти для вывода дерева для меню админки/////////////////////////////////////
function vievtree_top ($a){
$ret='';
global $dantree;
$fol='';if ($a==0)$fol='id="suckerfishnav"';

$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
$dost_in=  explode(',',$dantree[$v]['access']);   
 if  (in_array($_SESSION['admintype'], $dost_in))  
 if ($dantree[$v]['cild'])
 {
     if( $_SERVER['REQUEST_URI']==$dantree[$v]['url']) {$active='class="current"';} else {$active='';}
     
     $ret.='<li '.$active.'><span><a>'.$dantree[$v]['name'].'</a></span>'.vievtree_top ($dantree[$v]['id'],$name,$tabl,$num).'</li>';}
 else $ret.='<li '.$active.'><span><a href="'.$dantree[$v]['url'].'">'.$dantree[$v]['name'].'</a></span></li>';
 
 
 
}
$ret.='</ul>';
return $ret;
}

// рекурсивная функцти для вывода дерева

function vievtree ($a,$name,$tabl,$num){
$ret='';
global $dantree;
$fol='';if ($a==0)$fol='id="'.$tabl.'_'.$num.'"';
$ret.='<ul '.$fol.'>';
foreach ($dantree[$a]['cild'] as $v) {
 if ($dantree[$v]['cild'])
 {$fol='class="closed"';if ($dantree[$v]['tree_num']==1)$fol='';
     $ret.='<li '.$fol.'><span class="folder">'.$dantree[$v][$name].'</span>'.vievtree ($dantree[$v]['id'],$name,$tabl,$num).'</li>';}
 else $ret.='<li><a href="/admin/?r='.$_GET['r'].'&tree_'.$num.'='.$dantree[$v]['id'].'">'.$dantree[$v][$name].'</a></li>';
 
}
$ret.='</ul>';
return $ret;
}

//функцти  вывода дерева
// $tabl таблица
// $d данные
function tree_db($tabl,$d,$num)
{ global $dantree,$db;
  $dantree="";
  $dantree=$db->select_id("SELECT * FROM ".DB_PREFIX.$tabl." ORDER BY ".$d['sort']." ASC");
     //1 я итерация указываем каждому родителю ребенка
    foreach ($dantree as $k=>$v) {$dantree[$v[$d['pid']]]['cild'][]=$v[id];$dantree[$v[$d['pid']]]['tree_num']=0;}
    
    // определяем открытые папки
    $tree_id=$_GET['tree_'.$num];
    if ($tree_id){       
       do  {$dantree[$tree_id]['tree_num']=1;$tree_id=$dantree[$tree_id][$d['pid']];
        }
        while  ($dantree[$tree_id][$d['pid']]!=0); 
       $dantree[$tree_id]['tree_num']=1;        
        }
    
    $tree=vievtree (0,$d['name'],$tabl,$num);
    return $tree;
    
  
}

////////////////////////////////////////////////////////////////////////////
// вывод дерево
//$t - таблица
//$d - масив с типами полей
//$title - заголовок


function tree_admin($t,$title,$d,$num,$z_where){
global $tree_title,$tree_dan,$tree_tab,$tree_num;

$tree_title=$title;
$tree_tab=$t;
$tree_dan=tree_db ($t,$d,$num);
$tree_num=$num;
    
$tree=showtempl(dirname(__FILE__).'/templ/c_tree.php');
return $tree;

}

//////////////////////////////////tree edit ////////////////////////////

function vievtree_edit ($a,$name,$tabl,$num,$d){
$ret='';
global $dantree,$db;
$fol='';if ($a==0)$fol='id="'.$tabl.'_'.$num.'"';
$ret.='<ul '.$fol.'>';
if ($dantree[$a]['cild']) foreach ($dantree[$a]['cild'] as $v) {
    
  ////// выводим сопутствующие поля к дереву  
   $sop='<strong  style="float: right;margin-right: 50px;">';
   
   //проверяем естьли связанные таблицы и выбираем их
$dat=$d['db'];

foreach ($dat as $k => $vv) {
if ($vv['tip']=='sel_tab' || $vv['tip']=='sel_tabm' )$d[$k]=$db->select_id("SELECT * FROM ".DB_PREFIX.$vv['tabl']);
}
$ddd=$dantree[$v];
foreach  ($ddd as $k=>$v1){
    if ($dat[$k]['r']==1){
    $alt=' title="'.$dat[$k]['name'].'"';
    $nn=' '.$dat[$k]['name'].': ';
    $ss=$v1;
    if ($dat[$k]['tip']=='img'){if ($v1!='')$ss='<img src="'.$dat[$k]['path'].$v1.'" width="25px"/>';}

if ($dat[$k]['tip']=='sel_tab'){
    $ss=$d[$k][$v1][$dat[$k]['td']];
    }

    
if ($dat[$k]['tip']=='sel_tabm'){
    $pars=  explode(",", $v1);
    $ss='';
    foreach ($pars as $pv) {$ss.=$d[$k][$pv][$dat[$k]['td']].'<br>';}
    $ss='<div style="display: inline-block;" '.$alt.' style="margin: 3px;">'.$ss.'</div>';
    
    }

   if ($dat[$k]['tip']=='ftext')$ss=str_smol($v[$k],100);

   if ($dat[$k]['tip']=='btext')$ss=str_smol($v[$k],100);

if ($dat[$k]['tip']=='bool'){if ($v1==1)$ss='<input '.$alt.' type="checkbox" name="" value="1" checked="checked" disabled="disabled" />';
else $ss='<input '.$alt.' type="checkbox" name="" value="1"  disabled="disabled" />'; 
}

$sop.=$nn.$ss;
    }
}

   
 
   $sop.='</strong>'; 
  //////////////////////////////////////////////////////////////////////////////////////////////  
    
 if ($dantree[$v]['cild'])
 {$fol='class="closed"';if ($dantree[$v]['tree_num']==1)$fol='';
     $ret.='<li '.$fol.'><input class="cece" type="checkbox" name="sel_'.$num.'[]" value="'.$dantree[$v]['id'].'" /><span class="folder" num="'.$dantree[$v]['id'].'">'.$dantree[$v][$name].'</span>'.$sop.vievtree_edit ($dantree[$v]['id'],$name,$tabl,$num,$d).'</li>';}
 else $ret.='<li><input class="cece" type="checkbox" name="sel_'.$num.'[]" value="'.$dantree[$v]['id'].'" /><span num="'.$dantree[$v]['id'].'">'.$dantree[$v][$name].'</span>'.$sop.'</li>';
 
}

$ret.='</ul>';
return $ret;
}

//функцти  вывода дерева
// $tabl таблица
// $d данные
function tree_db_edit($tabl,$d,$num)
{ global $dantree,$db;
  $dantree="";
  $dantree=$db->select_id("SELECT * FROM ".DB_PREFIX.$tabl." ORDER BY ".$d['sort']." ASC");
  
  
  //1 я итерация указываем каждому родителю ребенка
    foreach ($dantree as $k=>$v) {$dantree[$v[$d['pid']]]['cild'][]=$v[id];$dantree[$v[$d['pid']]]['tree_num']=0;}
    
    // определяем открытые папки
    $tree_id=$_GET['tree_'.$num];
    if ($tree_id){       
       do  {$dantree[$tree_id]['tree_num']=1;$tree_id=$dantree[$tree_id][$d['pid']];
        }
        while  ($dantree[$tree_id][$d['pid']]!=0); 
       $dantree[$tree_id]['tree_num']=1;        
        }
    
    $tree=vievtree_edit (0,$d['name'],$tabl,$num,$d);
    return $tree;
    
  
}


function tree_admin_red($t,$title,$d,$num,$z_where){
global $tree_title,$tree_dan,$tree_tab,$tree_num,$js_dan,$ta_dat,$ta_tabl,$tree_pid,$tree_body,$tree_sort;
$ta_tabl=$t;
$ta_dat= serialize($d['db']);
$tt=array(
        'table'=>$t,
        'title'=>$title,
        'dan'=>$d,
        'num'=>$num,
        'where'=>$z_where,
         );
$js_dan=json_encode($tt);
$tree_title=$title;
$tree_tab=$t;
$tree_dan=tree_db_edit ($t,$d,$num);
$tree_num=$num;
$tree_pid=$d[pid];
$tree_sort=$d['sort'];
$tree_body=showtempl(dirname(__FILE__).'/templ/c_tree_edit.php');
$tree=showtempl(dirname(__FILE__).'/templ/c_tree_edit_sc.php');
return $tree;

}

function tree_admin_red_ajax($t,$title,$d,$num,$z_where){
global $tree_title,$tree_dan,$tree_tab,$tree_num,$js_dan,$ta_dat,$ta_tabl,$tree_pid,$tree_body,$tree_sort;
$ta_tabl=$t;
$ta_dat= serialize($d['db']);
$tt=array(
        'table'=>$t,
        'title'=>$title,
        'dan'=>$d,
        'num'=>$num,
        'where'=>$z_where,
         );
$js_dan=json_encode($tt);
$tree_title=$title;
$tree_tab=$t;
$tree_dan=tree_db_edit ($t,$d,$num);
$tree_num=$num;
$tree_pid=$d['pid'];
$tree_sort=$d['sort'];
$tree=showtempl(dirname(__FILE__).'/templ/c_tree_edit.php');
return $tree;

}
//////////////////////////////////////////////////
