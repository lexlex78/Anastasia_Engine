<?php

$dan=array(
    'id'=>'id',
    'pid'=>'pid',
    'name'=>'name',
    'sort'=>'sort',
    'db'=>array(
                'id'=>array('tip'=>'id','name'=>'id'),
                'name'=>array('tip'=>'text','name'=>'Название','r'=>0,'w'=>1,'ob'=>1),
                'url'=>array('tip'=>'text','name'=>'URL','r'=>0,'w'=>1,'ob'=>1),
                'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
                ),
          );

$z_where='';
$admin_center_area.=tree_admin_red('muslugi','Услуги',$dan,2,$z_where);


?>
