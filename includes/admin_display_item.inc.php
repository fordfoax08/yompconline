<?php
require_once 'autoload.inc.php';
$user_id = $_POST['user_id'];
$sort_by = $_POST['sort_by'] ?? '1';
/* Instance */
$crudItem = new CrudItem;
echo json_encode($crudItem->getAllUserItem($user_id,$sort_by),JSON_PRETTY_PRINT);

?>