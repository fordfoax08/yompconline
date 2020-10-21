<?php

class FilterImage{
  /* function return bool, if size >= 4mb return false. */
  public function imageSizeValid($size){
    if($size >= 4000000){
      return false;
    }
    return true;
  }

  /* Function return bool, if File is image file */
  public function isImageFileValid($image_name){
    $ext = ['jpg','jpeg','png','gif','bmp'];
    $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
    return in_array($image_ext, $ext);
  }

  
  /* function Rename Image to user's id 2 param original name and new name*/
  public function imageNewName($image_name,$new_name){
    // $ext = explode('.', $image_name);
    $ext = pathinfo($image_name, PATHINFO_EXTENSION);
    $fullName = $new_name.'.'.$ext;
    return $fullName;
  }

  

}

?>