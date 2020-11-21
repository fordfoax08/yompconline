<?php
session_start();
require_once 'autoload.inc.php';

/* getPost Data convert to AssocArray */
$data_raw = $_POST['data'];
$data = json_decode($data_raw, true);

/* Db update */
$crudItem = new CrudItem();
echo $crudItem->updateItem($data)

/* echo '<pre>';
var_dump($crudItem->updateItem($data));
echo '</pre>'; */

?>