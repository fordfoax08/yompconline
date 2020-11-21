<?php
session_start();
require_once 'autoload.inc.php';

$data = $_POST['item_category'];


$crudItem = new CrudItem();
echo $crudItem->getPageCount($data);



/* echo '<pre>';
var_dump();
echo '</pre>';
 */
/* if(is_int(intval($data))){
    echo 'Number';
}else{
    echo 'NaN';
} */



?>