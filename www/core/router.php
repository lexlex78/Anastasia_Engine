<?
$router=trim($_SERVER['REQUEST_URI'], '/');

//----------------- разбиваем полученный урл ----------------- 
$router=explode('?', $router); //отделяем динамику
$router=$router[0];
$router=explode('/', $router); //разбиваем по слешам

$last_route=count($router)-1;

if(  stripos($router[$last_route], '.')  ) { // если в конце пути указан файл
    $last_route       = array_pop($router);
    $route_file       = explode( '.', $last_route );
    $route_file_ext   = $route_file[1]; //расширение файла
    $route_file       = $route_file[0]; //имя файла
}

$router_str = implode('/',$router); //строка пути
//----------------- конец ----------------- 


//------------- язык сайта
// прописываем потдержываемые языки
$site_language=$yaz[0];
$yaz=array_slice($yaz,1);

if(in_array($router[0],$yaz))
{
 $site_language=$router[0];
 $router=  array_slice($router,1);
}
// $site_language - язык сайта
// подключаем файл перевода    
include_once SITE_PATH.'/modul/translation/translation_'.$site_language.'.php';



////////////////ниже правила для сайта ////////////////////////////////////////////////////////////////

// для статических страниц 
if  ($route_file_ext=='html'){
    $modul = 'page';$file = 'page';} 
    
// для стартовой страниц
if ($_SERVER['REQUEST_URI']=='/' || $_SERVER['REQUEST_URI']=='')
    {$modul = 'index';$file = 'index';}
  
  //для молудя вакансии
 if  ($route_file=='vacansii' && $route_file_ext=='html')
  { 
     $modul = 'vac';$file = 'vac';} 
    
    
 

 //для молудя команда
// if  ($route_file=='team' && $route_file_ext=='html')
//     { $modul = 'comand';$file = 'comand';}   
 
 //для молудя вопрос ответ
// if  ($route_file=='qa' && $route_file_ext=='html'){
//     $modul = 'qa';$file = 'qa';} 
     
 //для молудя вопрос
// if  ($route_file=='question' && $route_file_ext=='html'){
//     $modul = 'question';$file = 'question';} 
     
     

     
//для молудя техподдержка
if ($router[0]=='tex'){
  $modul = 'tex';$file = 'tex';  
}
//для молудя партнеры
if ($router[0]=='partnery'){
  $modul = 'partnery';$file = 'partnery';  
}
     
// для новостей
if ($router[0]=='news'){
  $modul = 'news';  
  if ($router[1]){
  $file = 'news_str';
  $id_news=$router[1];
  } 
}

// для статей
//if ($router[0]=='article'){
//  $modul = 'stat';  
//  if ($router[1]){
//  $file = 'stat_str';
//  $id_stat=$router[1];
//  } 
//}




///// цвет страницы

$body_cvet='';
 if  ($modul == 'news') {
  $body_cvet='class="green"';   
 } 
 if  ($route_file=='contacts' && $route_file_ext=='html')
 {
 $body_cvet='class="green2"';    
 }
 
  if  ($route_file=='opt' && $route_file_ext=='html')
 {
 $body_cvet='class="purple"';    
 }