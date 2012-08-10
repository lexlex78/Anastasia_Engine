<?
/////////////////////////////////////////////////////////////////////////////////////////////////////////
///upload image
require_once  SITE_PATH.'core/admin/class.upload.php'; 

function uploadimage($width,$height,$folder,$name)
{
   
 $image_name=$_FILES[$name][name];
 
 $size = getimagesize ($_FILES[$name][tmp_name]);
 if (($width==$size[0] && $height==$size[1]) || ($width=='0' && $height=='0') ){
     //копируется без искажение как есть
     $a=0;
     while (file_exists($folder.$image_name))  
     {
     $a++;  
     $image_name=$a.$image_name;
     }

      move_uploaded_file($_FILES[$name][tmp_name], $folder.$image_name);    
}
 else {
     //копируется с изменением размеров  
   
 $handle = new upload($_FILES[$name]);
 if ($handle->uploaded) {
     
    $handle->image_resize          = true;
    $handle->image_x= $width;
    if($height)
    {
    $handle->image_ratio_crop      = true;
    $handle->image_y=$height;
    }
    else
    {
    $handle->image_ratio_y         = true;
    }
     
     
     
    
     $handle->Process($folder);
     $image_name=$handle->file_dst_name;
    // $handle->clean();
 }
    
 }
return $image_name;    
}