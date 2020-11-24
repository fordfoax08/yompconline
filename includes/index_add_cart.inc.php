<?php /* Adding cart item */
session_start();
require_once 'autoload.inc.php';

/* getting Stringged JSON */
$data = $_POST['cart_data'];
$u_id = $_SESSION['u_id'];


/* adding to DB */
$crudItem = new CrudItem();
echo $crudItem->addToCart($data,$u_id);



?>