<?php
session_start();
require_once '../class/cruditem.class.php';
//GET ALL ITEM in db
if(isset($_SESSION['u_id'])){
  $crudItem = new CrudItem;
  $dataJson = $crudItem->getUserCart($_SESSION['u_id'])['user_cart'];
  echo $dataJson;
}



?>