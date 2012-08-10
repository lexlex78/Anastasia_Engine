<?php

$dan=array(
    'id'=>'id',
    'pid'=>'parentid',
    'name'=>'name',
    'sort'=>'sort',
    );
$z_where='';
$admin_center_area.=tree_admin('shop_cat','Каталог',$dan,'1',$z_where);


$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>1),
    'img'=>array('tip'=>'img','name'=>'Картинка','r'=>1,'w'=>1,'path'=>'/img/baner/','imgw'=>400/*,'imgh'=>300*/),
    'text'=>array('tip'=>'text','name'=>'Текст','r'=>1,'w'=>1,'ob'=>1),
    'btext'=>array('tip'=>'btext','name'=>'большой текст','r'=>1,'w'=>1),
    'url'=>array('tip'=>'url','name'=>'URL','r'=>1,'w'=>1),
    'num'=>array('tip'=>'int','name'=>'Число (int)','r'=>1,'w'=>1),
    'dec'=>array('tip'=>'dec','name'=>'Цена','r'=>1,'w'=>1),
    'tel'=>array('tip'=>'tel','name'=>'Тел','r'=>1,'w'=>1),
    'email'=>array('tip'=>'email','r'=>1,'w'=>1),
    'f_text'=>array('tip'=>'ftext','name'=>'Описание','r'=>1,'w'=>1),
    'sel_tab'=>array('tip'=>'sel_tab','name'=>'Города','r'=>1,'w'=>1,'tabl'=>'testm','td'=>'name'),
    'sel_td'=>array('tip'=>'sel_tabm','name'=>'Мнго<br>городов','r'=>1,'w'=>1,'tabl'=>'testm','td'=>'name'),
    'da'=>array('tip'=>'data','name'=>'Дата','r'=>1,'w'=>1),
    'ta'=>array('tip'=>'time','name'=>'Время','r'=>1,'w'=>1),
    'data'=>array('tip'=>'datatime','name'=>'Датавремя','r'=>1,'w'=>1),
    'en'=>array('tip'=>'bool','name'=>'Выводить','r'=>1,'w'=>1),
    'sort'=>array('tip'=>'sort','sort'=>'desc','r'=>0),
    );

$dan1=array(
    'where'=>'',//where к запросу
    'button'=>array('Ответить'=>array('url'=>'/modul/help/ajax/sendemail.php','multi'=>0)),// дополнительные кнопки в интерфейсе
    'add'=>1, //включение выключение кнопки добавить
    'edit'=>1,//включение выключение кнопки редактировать
    'del'=>1,//включение выключение кнопки удалить
    'sel_all'=>1,//включение выключение кнопки выбрать все
    'an_sel_all'=>1,//включение выключение кнопки отменить выбор
    'in_sel_all'=>1,//включение выключение кнопки инвертировать выбор
    'sort'=>1, // включть сортировку   
);

//  tab_admin админ таблица (название таблицы в БД,название визуальное, масив данных  , еще масив данных)
//$admin_center_area=tab_admin('test','Тест Админки',$dan,$dan1);


//$admin_center_area.=tab_admin('test','Тест Админки',$dan,$dan1);
?>
