<?
session_start();

require '../core/conf.php';
require '../core/db.php';
//чистка GET и POST
$_pattern = array('&', "'", '"', '<', '>', '\\');
$_replacement = array('&amp;', '&#039;', '&quot;', '&lt;', '&gt;', '\\\\');
$_GET = str_replace($_pattern, $_replacement, $_GET);
$_POST = str_replace($_pattern, $_replacement, $_POST);

if($_GET[logout]==1)
{
session_destroy();
}

if($_POST[login]||$_POST[password])
{
 $sel=$db->select("SELECT * FROM ".DB_PREFIX."admin_user WHERE log='$_POST[login]' AND pas ='$_POST[password]'");
 if (count($sel)>0)    
 {
 $_SESSION['admin']= 'admin';
 $_SESSION['adminuser']=$sel[0]['log'];
 $_SESSION['admintype']=$sel[0]['tip'];
 header('Location: index.php');
 exit();
 }
        
 if(!$_SESSION[admin])
 $error='Введите правильные логин и пароль.';
 
 
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Админ Панель - Вход</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf=8">

</head>
<body >
		<br><br><br><br>
                <table  border=0 cellpadding=0 cellspacing=0 align="center"><tr><td valign="top" align="left">
<!--img --></td><td>

		<table border=0 cellpadding=0 cellspacing=0 align="center">
		<form method=post action="?">
		<tr>
		<td colspan="2"><font color="#ff0000"><?echo$error;?></font>
		</tr>
		<tr style="font-size: 12px;">
		<td align=right>логин:&nbsp;&nbsp;</td>
		<td><input type="text" name=login style="width:120px"></td>
		</tr>
		<tr style="font-size: 12px;">
		<td align=right>пароль:&nbsp;&nbsp;</td>
		<td><input type="password" name=password style="width:120px"></td>
		</tr>
		<tr>
		<td colspan=2 valign=top align=center><input type="submit" value="Войти"></td>
		</tr>
		</form>
</table>
		
		
		</td>
		</tr></table>
</body>
</html>