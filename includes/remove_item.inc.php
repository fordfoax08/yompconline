<?php
session_start();
require_once 'autoload.inc.php';
// echo 'THIS IS SECRET FILES 0918205102';
$u_id = $_SESSION['u_id'];
$data1 = $_POST['item_name'] ?? false;
$sort_by = $_POST['sort_by'] ?? 1;
$limit = $_POST['limit_a'] ?? 0;
$data = json_decode($data1, true);

$crudItem = new CrudItem;
echo json_encode($crudItem->deleteSellerItems($u_id,$data,$sort_by,$limit), JSON_PRETTY_PRINT);
// echo $data;

?>