<?php
session_start();
require_once 'autoload.inc.php';
$item_category = $_POST['item_category'] ?? 0;
$page = $_POST['page'] ?? 1;

$crudItem = new CrudItem;
echo json_encode($crudItem->getAllItems($page,$item_category),JSON_PRETTY_PRINT);



?>