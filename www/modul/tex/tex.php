<?php

$sel=$db->select("SELECT * FROM ".DB_PREFIX."tex WHERE en=1 and url='".$route_file.".".$route_file_ext."'");
if ($sel){$center_area='<div class="devider-header"></div>'.$sel[0]['text'];
$meta_title=$sel[0]['title'];
$meta_keyw=$sel[0]['keyw'];
$meta_descr=$sel[0]['descr'];
}
else $_GET['error']=404;
