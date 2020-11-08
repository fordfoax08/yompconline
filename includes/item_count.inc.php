<?php
session_start();
require_once 'autoload.inc.php';

$user_id = $_SESSION['u_id'];

if(isset($user_id)){
  $crudItem = new CrudItem;
  echo $crudItem->getAllItemsCount($user_id);
}else{
  echo 0;
}
?>