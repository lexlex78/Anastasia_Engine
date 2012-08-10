<?php

if($_GET[update_files]=='ok')
{ 
    foreach ($yaz as $vv){
    $put=SITE_PATH.'modul/translation/translation_'.$vv.'.php';
    
        
    //формирование содержания файла
    $mas_translatoin=$db->select("SELECT * FROM ".DB_PREFIX."translation");
    foreach ($mas_translatoin as $k=>$v)
    {
        $str.='$p[\''.$v['variable'].'\']=\''.$v[$vv].'\';'."\r\n";
        
    }
    $str='<?php'."\r\n".$str.'?>';
    
    //запись в файл
    file_put_contents($put,$str); 
        //отчет 
    $error_translation.='Файлы переводов '.$vv.' успешно обвлен!!!<br>';
    }
}

$dan=array(
    'id'=>array('tip'=>'id','name'=>'id','r'=>0),
    'variable'=>array('tip'=>'text','name'=>'Переменная','r'=>1,'w'=>1,'ob'=>1),
    'ru'=>array('tip'=>'btext','name'=>'Ru','r'=>1,'w'=>1,'ob'=>1),
    'en'=>array('tip'=>'btext','name'=>'En','r'=>1,'w'=>1)
    );


$admin_center_area.=$error_translation.'<br/><a href="/admin/?r=translation&update_files=ok">Обновить файлы переводов</a>';
$admin_center_area.=tab_admin('translation','переводы',$dan);

?>
