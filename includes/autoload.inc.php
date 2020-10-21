<?php
spl_autoload_register('myAutoLoader');
function myAutoLoader($className){
  $path = '../class/';
  $ext = '.class.php';
  $fullPath = $path.$className.$ext;
  include_once $fullPath;
}
?>