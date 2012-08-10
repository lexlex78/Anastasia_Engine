<?php
$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>0),
    'name'=>array('tip'=>'text','name'=>'Название','r'=>1,'w'=>1,'ob'=>1),
    'url'=>array('tip'=>'text','name'=>'URL','r'=>1,'w'=>1,'ob'=>1),
    'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
    'text'=>array('tip'=>'ftext','name'=>'Контент','r'=>0,'w'=>1),
    'descr'=>array('tip'=>'btext','name'=>'meta_descr','r'=>0,'w'=>1),
    'keyw'=>array('tip'=>'btext','name'=>'meta_keyw','r'=>0,'w'=>1),
    'title'=>array('tip'=>'btext','name'=>'meta_title','r'=>0,'w'=>1),
    
    
    
    );
$z_where='';//where к запросу

//  tab_admin админ таблица (название таблицы в БД,название визуальное, масив данных  , where)
//$admin_center_area=tab_admin('test','Тест Админки',$dan,$z_where);


$admin_center_area.=tab_admin('page','Статические страницы',$dan,$z_where);
?>
