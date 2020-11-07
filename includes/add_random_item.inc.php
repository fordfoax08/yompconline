<?php
require_once 'autoload.inc.php';

/* FOR DEVELOPMENT PURPOSE  */

$userId = '202011062343120';

$dataPrepared = array(
    'user_id' => $userId,
    'item_id' => generateItemId(),
    'item_image' => 'noimage.jpg',
    'item_path' => 'others',
    'item_category' => randomNumberString(),
    'item_name' => randomNumberString(),
    'item_sub_name' => randomNumberString(),
    'item_short_desc' => randomNumberString(),
    'item_overview' => randomNumberString(),
    'item_information' => randomNumberString(),
    'item_specification' => randomNumberString(),
    'item_available' => '23'
);

$crudItem = new CrudItem;
if($crudItem->insertNewItem($dataPrepared)){
    echo 'Item Added!';
}else{
    echo 'Item Not Added';
}




function randomNumberString(){
    return rand(10000,99999);
}


/* Generate Item Id based on date and random number */
function generateItemId(){
    $a = date('Ymd');
    $b = rand(100,999);
    $c = rand(10,99);
    $item_id = $a.$b.$c;
    return $item_id;
}


?>