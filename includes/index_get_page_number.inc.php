<?php
session_start();
require_once 'autoload.inc.php';

$data = $_POST['item_category'];


$crudItem = new CrudItem();
echo $crudItem->getPageCount($data);


?>