<?php
session_start();
require_once 'autoload.inc.php';
// echo 'THIS IS SECRET FILES 0918205102';
$u_id = $_SESSION['u_id'];
$data1 = $_POST['item_name'] ?? false;
$data = json_decode($data1, true);

$crudItem = new CrudItem;
$data = json_encode($crudItem->deleteSellerItems($u_id,$data), JSON_PRETTY_PRINT);
echo $data;

?>