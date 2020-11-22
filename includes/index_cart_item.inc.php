<?php
session_start();
require_once 'autoload.inc.php';
/* get post data */
$item_id = $_POST['item_id'] ?? false;

$crudItem = new CrudItem();
echo json_encode($crudItem->getItemForCart($item_id), JSON_PRETTY_PRINT);






?>