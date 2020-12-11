<?php /* Adding cart item */
session_start();
require_once '../class/cruditem.class.php';

/* getting Stringged JSON */
$data = $_POST['cart_data'];
$u_id = $_SESSION['u_id'];

/* adding to DB */
if(isset($data)){
  $crudItem = new CrudItem();
  echo $crudItem->addToCart($data,$u_id);
}


?>

