<?php

// редактор каталога товаров

$dan=array(
    'id'=>'id',
    'pid'=>'pid',
    'name'=>'name',
    'sort'=>'sort',
    'db'=>array(
                'id'=>array('tip'=>'id','name'=>'id'),
                'name'=>array('tip'=>'text','name'=>'Название','r'=>0,'w'=>1,'ob'=>1),
                'url'=>array('tip'=>'text','name'=>'ЧПУ (часть урла)','r'=>0,'w'=>1,'ob'=>1),
                'descr'=>array('tip'=>'btext','name'=>'meta_descr','r'=>0,'w'=>1),
                'keyw'=>array('tip'=>'btext','name'=>'meta_keyw','r'=>0,'w'=>1),
                'title'=>array('tip'=>'btext','name'=>'meta_title','r'=>0,'w'=>1),        
                'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
                ),
          );


$z_where='';
$admin_center_area.=tree_admin_red('shop_cat','Редактор каталога товаров',$dan,2,$z_where);

?>
