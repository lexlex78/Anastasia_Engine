<?php 
session_start();
if(!$_SESSION[admin])header('Location: login.php');

require '../core/conf.php';
require '../core/db.php';
require '../core/core.php';
require '../core/admin/core.php';


// тип пользователя
$dan=$db->select("SELECT * FROM ".DB_PREFIX."tip_admin WHERE id='$_SESSION[admintype]'");
$admin_tip=$dan[0]['name'];

    // вывод верхнего меню
    $dantree="";
    $dantree=$db->select_id("SELECT * FROM ".DB_PREFIX."amodules WHERE en=1 ORDER BY sort ASC");
     //1 я итерация указываем каждому родителю ребенка
    foreach ($dantree as $k=>$v) {$dantree[$v['pid']]['cild'][]=$v[id];$dantree[$v['pid']]['tree_num']=0;}
    $admin_topmenu=vievtree_top (0);
    ////////////////////////////////////////////
  
  // проверка доступа  
    function dostup ($a){
        $dos=false;
        global $dantree;
        foreach ($dantree as $v) {
            
        if ($v['url']=='/admin/?r='.$a){
       $dost_in=  explode(',',$v['access']);   
        if  (in_array($_SESSION['admintype'], $dost_in))$dos=true;    
           
        }    
        
    }
    return $dos;
    }
 //////////////////////////////////////////
    
    
//// подключение модулей админки    
if($_GET['r'])
{
    if (dostup($_GET['r']))
    $explode_module=explode('/', $_GET['r']);
    $_GET['modul']=$explode_module[0];
    $_GET['file'] =$explode_module[1];
    if(!$_GET[file])$_GET[file]=$_GET[modul];
    if(is_file(SITE_PATH.'modul/'.$_GET[modul].'/admin/'.$_GET[file].'.php'))include SITE_PATH.'modul/'.$_GET[modul].'/admin/'.$_GET[file].'.php';
}

$all_admin=showtempl('./templ/admin.php');
echo $all_admin;
