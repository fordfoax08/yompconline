<?php
require_once 'autoload.inc.php';
$postDataUserId = $_POST['user_id'];
$postData = $_POST['search_data'] ?? '';
$postDataCleaned = strtolower(trim($postData));

/* new instance of Crud */
$crudItem = new CrudItem;
$searched_items = $crudItem->searchUserItem($postDataUserId,$postDataCleaned);

echo json_encode($searched_items, JSON_PRETTY_PRINT);


/* Debugger */
/* echo '<pre>';
var_dump($postDataUserId);
echo '</pre>'; */
?>