<?php
////// пажинация ///
function purl($url,$razd,$n){
if ($n!=1)$url.=$razd.'page='.$n;
return $url;
}

function crr_url() {
 global $router;
 $get=$_GET;
 unset($get['page']);
 $url='';
 $razd='?';
 foreach ($router as $v) {if($v)$url.=$v.'/';}
 if (count($get)>0)
 {$url.='?';
 foreach ($get as $k=>$v) {$url.=$v.'='.$v.'&';} 
 $url=trim ($url,'&');
 $razd='&';
 } 
$r['url']=$url;
$r['razd']=$razd;
return $r;
 }

 //// функцыя пажинации $all - всего записей,$pstr - записей на странице ,$lim - количесво стрниц в пажинации

function paging ($all,$pstr,$lim){
    $last=ceil($all/$pstr);
    if (isset($_GET['page']))$cur=(int)$_GET['page'];
    else $cur=1;
    if ($cur<1 || $cur>$last)$cur=1;
    $sme=ceil($lim/2);
    $start=$cur-$sme;if ($start<1)$start=1;if ($start+$lim-1>=$last)$start=$last-$lim+1;
 //собираем урл
 $r=crr_url(); $url =$r['url']; $razd =$r['razd'];
 
 
 //////// шаблон пажинации /////////////
 $ret='<ul class="pagination">';
 // стрелка <
 if ($cur>1)$ret.='<li><a href="'.purl($url,$razd,$cur-1).'"><span class="left-triangle"></span></a></li>';
 // первая страница
 if ($start>1)$ret.='<li><a href="'.purl($url,$razd,1).'">1</a></li>';
  // .. <
 if ($start-1 > 1)$ret.='<li><a href="'.purl($url,$razd,$start-1).'">...</a></li>';
 
for ($index = 1; $index <= $lim; $index++) {if ($start<=$last)if ($start==$cur)
    // активная страница
    $ret.='<li><strong>'.$start.'</strong></li>';
else
    // страница   
    $ret.='<li><a href="'.purl($url,$razd,$start).'">'.$start.'</a></li>';
$start++;
}
 // .. >
 if ($start<$last)$ret.='<li><a href="'.purl($url,$razd,$start).'">...</a></li>';
 // последняя страница
 if ($start<$last)$ret.='<li><a href="'.purl($url,$razd,$last).'">'.$last.'</a></li>';
 // стрелка > 
if ($cur<$last)$ret.='<li><a href="'.purl($url,$razd,$cur+1).'"><span class="right-triangle"></span></a></li>';

$ret.='</ul>';  
 

 $limit=($cur-1)*$pstr.','.$pstr;$end[0]=$ret;$end[1]=$limit;
 return $end;
}




// вывод шаблона
function showtempl($t){
ob_start();
include $t;
$ret=ob_get_contents();
ob_end_clean();
return $ret;
}

//////////// кеширование ///////////////////////

// читаем кешь есле есть возврашаем запись есле нет false
// параметры $k - ключь

function cash_read($k){
$ret=false;

//файл
if (CASH==1){
$file_cash=SITE_PATH.'/cash/'.$k.'.cash';
$time_sec=time(); 
$time_file=filemtime($file_cash); 
if ($time_file){  
            if ($time_file<$time_sec){
            $rHandle = fopen($file_cash,'r');                     
            $ret = fread($rHandle, filesize($file_cash));
            fclose($rHandle);
            }
            else unlink ($file_cash);
            }

} 
if (CASH==2){
$ret = $memcache->get($k);
} 
 
return false;   
}

// пишем кешь 
// параметры $k - ключь, $t - время в секундах харанения $d - данные
function cash_add($k,$t,$d){
if (CASH==1){
$file_cash=SITE_PATH.'/cash/'.$k.'.cash';
$time_sec=time()+$t;
$rHandle = fopen($file_cash,'w'); 
fwrite($rHandle, $d);
fclose($rHandle);
touch ($file_cash,$time_sec);
}
if (CASH==2){
$memcache->set($k, $d, TRUE, $t);
}
}


// редирект
function JSRedirect($url='')
{
  if (headers_sent()) print "<script>location='$url';</script>";
  else header('location: '.$url);
}


           function generate_password($number)
            {
                $arr = array('a','b','c','d','e','f',
                            'g','h','i','j','k','l',
                            'm','n','o','p','r','s',
                            't','u','v','x','y','z',
                            'A','B','C','D','E','F',
                            'G','H','I','J','K','L',
                            'M','N','O','P','R','S',
                            'T','U','V','X','Y','Z',
                            '1','2','3','4','5','6',
                            '7','8','9','0',
                            '!','?','&','$',
                            '+','-');
                $pass = "";
                for($i = 0; $i < $number; $i++)
                {
                $index = rand(0, count($arr) - 1);
                $pass .= $arr[$index];
                }
                return $pass;
            }
            
            
            
//изменяет размер картинки 
// src  - путь к файлу к-рый меняем
// dest - путь где будет новый файл       
            
function img_resize($src, $dest, $width, $height, $rgb = 0xFFFFFF, $quality = 100) {  
    if (!file_exists($src)) {  
        return false;  
    }  

    $size = getimagesize($src);  

    if ($size === false) {  
        return false;  
    }  

    $format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));  
    $icfunc = 'imagecreatefrom'.$format;  

    if (!function_exists($icfunc)) {  
        return false;  
    }  

    $x_ratio = $width  / $size[0];  
    $y_ratio = $height / $size[1];  

    if ($height == 0) {  

        $y_ratio = $x_ratio;  
        $height  = $y_ratio * $size[1];  

    } elseif ($width == 0) {  

        $x_ratio = $y_ratio;  
        $width   = $x_ratio * $size[0];  

    }  

    $ratio       = min($x_ratio, $y_ratio);  
    $use_x_ratio = ($x_ratio == $ratio);  

    $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);  
    $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);  
    $new_left    = $use_x_ratio  ? 0 : floor(($width - $new_width)   / 2);  
    $new_top     = !$use_x_ratio ? 0 : floor(($height - $new_height) / 2);  

    $isrc  = $icfunc($src);  
    $idest = imagecreatetruecolor($width, $height);  

    imagefill($idest, 0, 0, $rgb);  
    imagecopyresampled($idest, $isrc, $new_left, $new_top, 0, 0, $new_width, $new_height, $size[0], $size[1]);  

    imagejpeg($idest, $dest, $quality);  

    imagedestroy($isrc);  
    imagedestroy($idest);  

    return true;  

}        


// удаление всех файлов из указанной директории
function clearDir($path){ 
    if (substr($path, strlen($path)-1, 1) != '/') $path .= '/'; 
    if ($handle = @opendir($path)){ 
        while ($obj = readdir($handle)){ 
            if ( ($obj=='.') or ($obj=='..') ) continue; 
            if ( is_file($path.$obj) )  unlink($path.$obj); 
        }   
         closedir($handle); 
     } 
}

// обрезает строку по пробелу посл еуказаного символа и вырезает теги 
function str_smoll($a,$b){
    
$search = array ("'<script[^>]*?>.*?</script>'si",  // Вырезается javascript
                 "'<[\/\!]*?[^<>]*?>'si",           // Вырезаются html-тэги
                 "'([\r\n])[\s]+'",                 // Вырезается пустое пространство
                 "'&(quot|#34);'i",                 // Замещаются html-элементы
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // вычисляется как php

$replace = array ("",
                  "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");

$text = preg_replace ($search, $replace, $a);

$aa=mb_strpos($text, " ", $b, "utf8");
if ($aa<$b)$aa=$b;
$text=mb_substr($text, 0, $aa, "utf8").' ...';   
 
return $text;
}