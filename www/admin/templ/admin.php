<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Админ Панель <?=$GLOBALS['title']?></title>
<link href="admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/admin/css/style_menu.css" />
<link type="text/css" href="/admin/css/smoothness/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<link type="text/css" href="/admin/css/validationEngine.jquery.css" rel="stylesheet" />
<link type="text/css" href="/admin/css/tree.css" rel="stylesheet" />
<script type="text/javascript" src="/admin/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/admin/js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="/admin/js/jquery.form.js"></script>
<script type="text/javascript" src="/admin/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="/admin/js/jquery.validationEngine-ru.js"></script>
<script type="text/javascript" src="/admin/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="/admin/js/jquery.treeview.js"></script>





<!-- flexigrid -->
<link type="text/css" href="/admin/css/flexigrid.css" rel="stylesheet" />
<script type="text/javascript" src="./js/flexigrid.pack.js"></script>
<!-- flexigrid -->

<!-- TinyMCE -->
<script type="text/javascript" src="/admin/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="/admin/js/tiny_mce/tiny_mce_init.js"></script>
<!-- /TinyMCE -->

<style>
form td {border-bottom: 1px activecaption solid;padding: 5px;}
form table {font-size: 11px;}
    
</style>

<script type="text/javascript">
var sh_num=0;    
function del_tab (y,x){
$("#tr_"+x+y).remove();
sel=$("#tab_"+x+" tr");
zz='';
$.each(sel, function(index, value) {zz=zz+$(this).attr('num')+',';});
zz=zz.slice(0, -1);
$("#"+x).val(zz);
}              
    
function add_tab (x){
    
val=$("#nam_"+x).val();  
name=$("#nam_"+x+" :selected").text(); 
$("#tab_"+x).append("<tr id='tr_"+x+sh_num+"' num="+val+"><td>"+name+"</td><td onclick=\"del_tab("+sh_num+",\'"+x+"\')\"><a href='javascript:void(0);'> удалить <a/></td></tr>");
sel=$("#tab_"+x+" tr");
zz='';
$.each(sel, function(index, value) {zz=zz+$(this).attr('num')+',';});
zz=zz.slice(0, -1);
$("#"+x).val(zz);
sh_num++;
}
</script>
</head>
<body style="min-width: 800px;">
    <!-- <img width="5px" style="padding:0px 5px 5px 5px;" src="/admin/css/images/up.png"/> -->
    
    <div style="float: right;font-size: 12px;padding:7px;">Пользователь: <?=$_SESSION[adminuser]?> Права <?=$GLOBALS['admin_tip']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="login.php?logout=1">Exit</a></div>
       <div ><?=$GLOBALS['admin_topmenu']?></div><br><br><br>
                            <span style="color: red; font-weight: bold;">   <?=$GLOBALS['error']?>  </span>
                            <div style="float: left" id="work_frame"><br>
                            <?=$GLOBALS['admin_center_area']?>   
                            </div>    
      
   
    </body>
</html>         