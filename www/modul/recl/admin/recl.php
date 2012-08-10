<?php
$dan=array(
    'id'=>array('tip'=>'id'),
    'img'=>array('tip'=>'img','name'=>'Картинка','r'=>1,'w'=>1,'path'=>'/img/recl/','imgw'=>477,'imgh'=>131),
    'url'=>array('tip'=>'text','name'=>'URL','r'=>1,'w'=>1),
    'sort'=>array('tip'=>'sort','sort'=>'desc','r'=>0),
   // 'en'=>array('tip'=>'bool','r'=>1,'w'=>1),
    );
$dan1=array(
    'where'=>'',//where к запросу
    //'button'=>array('Ответить'=>array('url'=>'/modul/help/ajax/sendemail.php','multi'=>0)),// дополнительные кнопки в интерфейсе
    'add'=>0, //включение выключение кнопки добавить
    'edit'=>1,//включение выключение кнопки редактировать
    'del'=>0,//включение выключение кнопки удалить
    'sel_all'=>0,//включение выключение кнопки выбрать все
    'an_sel_all'=>0,//включение выключение кнопки отменить выбор
    'in_sel_all'=>0,//включение выключение кнопки инвертировать выбор
    'sort'=>1, // включть сортировку   
);


$admin_center_area=tab_admin('recl','Банер на главной',$dan,$dan1);
?>
