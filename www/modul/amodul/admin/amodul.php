<?php
// админ меню + доступы

$dan=array(
    'id'=>'id',
    'pid'=>'pid',
    'name'=>'name',
    'sort'=>'sort',
    'db'=>array(
                'id'=>array('tip'=>'id','name'=>'id'),
                'name'=>array('tip'=>'text','name'=>'Название','r'=>0,'w'=>1,'ob'=>1),
                'url'=>array('tip'=>'text','name'=>'URL','w'=>1),
                'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
                'access'=>array('tip'=>'sel_tabm','name'=>'Доступ','r'=>1,'w'=>1,'tabl'=>'tip_admin','td'=>'name'),                
                ),
          );
$z_where='';
$admin_center_area.=tree_admin_red('amodules','Доступы',$dan,1,$z_where);



?>
