<?php
require_once 'autoload.inc.php';
$user_id = $_POST['user_id'];
$sort_by = $_POST['sort_by'] ?? '1';
$limit = $_POST['limit_a'] ?? 0;

/* Instance */
$crudItem = new CrudItem;
echo json_encode($crudItem->getAllUserItem($user_id,$sort_by,$limit),JSON_PRETTY_PRINT);

?>