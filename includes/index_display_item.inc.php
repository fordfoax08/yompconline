<?php
session_start();
require_once 'autoload.inc.php';
$item_category = $_POST['item_category'] ?? 0;


$crudItem = new CrudItem;
echo json_encode($crudItem->getAllItems($item_category),JSON_PRETTY_PRINT);
/* if($item_category === 0){

} */



?>