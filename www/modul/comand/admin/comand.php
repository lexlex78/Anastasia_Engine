<?php

$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>0),
    'name'=>array('tip'=>'text','name'=>'Заголовок','r'=>1,'w'=>1,'ob'=>1),
    'text'=>array('tip'=>'ftext','name'=>'Контент','r'=>1,'w'=>1,'ob'=>1),   
   // 'sort'=>array('tip'=>'sort','sort'=>'desc','r'=>0),
  //  'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
    );
$dan1=array(
    
    
    'add'=>1, //включение выключение кнопки добавить
    'del'=>0,//включение выключение кнопки удалить
    'sel_all'=>0,//включение выключение кнопки выбрать все
    'an_sel_all'=>0,//включение выключение кнопки отменить выбор
    'in_sel_all'=>0,//включение выключение кнопки инвертировать выбор
    
);


$admin_center_area.=tab_admin('comand','О проекте',$dan,$dan1).'<br>';

$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>0),
    'fio'=>array('tip'=>'text','name'=>'Ф.И.О.','r'=>1,'w'=>1,'ob'=>1),
    'descr'=>array('tip'=>'btext','name'=>'Описание','r'=>1,'w'=>1,'ob'=>1),
    'foto'=>array('tip'=>'img','name'=>'Фото','r'=>1,'w'=>1,'path'=>'/img/comand/','imgw'=>194,'imgh'=>259),
    'sort'=>array('tip'=>'sort','sort'=>'asc','r'=>0),
    'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
    );
$z_where='';//where к запросу

$admin_center_area.=tab_admin('comand_com','Команнда',$dan,$z_where);

?>
