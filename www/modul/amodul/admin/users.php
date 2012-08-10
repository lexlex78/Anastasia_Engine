<?php

$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>0),
    'log'=>array('tip'=>'text','name'=>'Логин','r'=>1,'w'=>1,'ob'=>1),
    'pas'=>array('tip'=>'text','name'=>'Пароль','r'=>0,'w'=>1,'ob'=>1),
    'tip'=>array('tip'=>'sel_tab','name'=>'Доступ','r'=>1,'w'=>1,'tabl'=>'tip_admin','td'=>'name'),
     
    );
$z_where='';//where к запросу

//  tab_admin админ таблица (название таблицы в БД,название визуальное, масив данных  , where)
//$admin_center_area=tab_admin('test','Тест Админки',$dan,$z_where);


$admin_center_area.=tab_admin('admin_user','Пользователи',$dan,$z_where);
?>
