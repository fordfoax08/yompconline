<?php
session_start();
require_once 'autoload.inc.php';
$user_id = getPostData('user_id');
$item_id = getPostData('item_id');


/* Get Item from Db */
$crudItem = new CrudItem;
echo json_encode($crudItem->getSellerItemById($user_id,$item_id),JSON_PRETTY_PRINT);




function getPostData($str){
    $data = $_POST[$str];
    return htmlentities($data);
}

?>