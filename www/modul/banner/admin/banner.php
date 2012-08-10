<?php
$dan=array(
    'id'=>array('tip'=>'id'),
    'img'=>array('tip'=>'img','name'=>'Картинка','r'=>1,'w'=>1,'path'=>'/img/banner/','imgw'=>327,'imgh'=>217),
    'zag'=>array('tip'=>'text','name'=>'Заголовок','r'=>1,'w'=>1),
    'text'=>array('tip'=>'text','name'=>'Текст','r'=>1,'w'=>1),
    'url'=>array('tip'=>'text','name'=>'URL','r'=>1,'w'=>1),
    'sort'=>array('tip'=>'sort','sort'=>'desc','r'=>0),
    'en'=>array('tip'=>'bool','r'=>1,'w'=>1),
    );


$admin_center_area=tab_admin('banner','Банер на главной',$dan);
?>
