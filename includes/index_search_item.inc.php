<?php
session_start();
require_once 'autoload.inc.php';

$search_que = $_POST['search_que'] ?? 'i3';
$search_by = $_POST['search_by'] ?? 1; //1 = item
$search_category = $_POST['search_category'] ?? 0;

$dataArray = array(
    "search_que" => $search_que,
    "search_by" => $search_by,
    "search_category" => $search_category
);

/* DB */
$crudItem = new CrudItem();
echo json_encode($crudItem->searchItem($dataArray),JSON_PRETTY_PRINT);



/* echo '<pre>';
var_dump($dataArray);
echo '</pre>'; */




?>