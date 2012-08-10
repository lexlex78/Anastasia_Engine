<?php

if ($_POST['send']=='ok'){
    
$to=$set[email];

$subject = "Вопрос с сайта!!!"; 

$message = "
   <html> 
    <head> 
        <title></title> 
    </head> 
    <body>
    $_POST[name]<br>
    $_POST[cont]  
    <hr>
Категория вопроса:$_POST[kat]
<hr>
$_POST[vopr]<br> 
    </body> 
</html>"; 

$headers  = "Content-type: text/html; charset=utf8 \r\n"; 
//$headers .= "@example.com>\r\n"; 
//echo $message;
mail($to, $subject, $message, $headers);

$mess='<script type="text/javascript">
    alert ("Выш вопрос принят!!!")
    </script>
    ';
    
    
    
}



$sel=$db->select("SELECT * FROM ".DB_PREFIX."temy WHERE en=1 ORDER BY sort");
$ttemy='';
foreach ($sel as $v)
{    
$ttemy.='<option>'.$v['text'].'</option>';   
}



//$meta_title='';
//$meta_keyw='';
//$meta_descr='';







// вывод маленькой рекламы
$sql =$db->select('SELECT * FROM '.DB_PREFIX.'recl  ORDER BY sort');
$li='';$sh=0;
foreach ($sql as $k=>$v)
{ 
if ($sh==0)$li.='<div class="banner-left-s"><img src="/img/recl/'.$v[img].'" alt="" width="317" /></div>';
if ($sh==1)$li.='<div class="banner-right-s"><img src="/img/recl/'.$v[img].'" alt="" width="317" /></div>';
$sh++;
}
$recl_sm=$li;

$recl='';

$center_area=showtempl(dirname(__FILE__).'/templ/tpl.php');