<?php
require_once 'autoload.inc.php';

$item_id = $_POST['item_id'];

/* DB */
$crudItem = new CrudItem();
echo json_encode($crudItem->getItemForModal($item_id), JSON_PRETTY_PRINT);

?>