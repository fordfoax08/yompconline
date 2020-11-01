<?php
require_once 'autoload.inc.php';
$user_id = $_POST['user_id'];
/* Instance */
$crudItem = new CrudItem;
echo json_encode($crudItem->getAllUserItem($user_id),JSON_PRETTY_PRINT);

?>