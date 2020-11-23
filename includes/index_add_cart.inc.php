<?php /* Adding cart item */
session_start();
require_once 'autoload.inc.php';

/* getting Stringged JSON */
$data = $_POST['cart_data'];
$u_id = $_SESSION['u_id'];

// echo $data;
/* adding to DB */
$crudItem = new CrudItem();
$crudItem->addToCart($data,$u_id);




?>