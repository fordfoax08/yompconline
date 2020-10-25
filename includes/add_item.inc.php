<?php
session_start();
require_once('autoload.inc.php');



/* declaring Variable getPostData('form-name', option)*/
$user_id = $_SESSION['u_id'];
$item_id = generateItemId();
$item_available = getPostData('item_available',3);
$item_name = getPostData('item_name');
$item_sub_name = getPostData('item_sub_name');
$item_short_desc = getPostData('item_short_desc');
$item_overview = getPostData('item_overview');
$item_information = getPostData('item_information',2);
$item_specification = getPostData('item_specification');
$item_specs = getPostData('item_specs');
$item_included = getPostData('item_included');


/* ITEM IMAGE */



echo '<pre>';
// var_dump($_POST);
var_dump($item_available);
echo '</pre>';
















/* Generate Item Id based on date and random number */
function generateItemId(){
  $a = date('Ymd');
  $b = rand(100,999);
  $c = rand(10,99);
  $item_id = $a.$b.$c;
  return $item_id;
}



/* Get post data */
function getPostData($str,$opt = 1){
  $filterInput = new FilterInput;
  $data = $_POST[$str] ?? '';

  if(is_array($data)){
    $filteredData = array_filter($data, function($item) use ($filterInput){
      if($filterInput->isStringCountValid($item)){
        return $item;
      }
    });
    $filteredData2 = array_map(function($item) use ($filterInput){
        return $filterInput->sanitizeString($item);
    },$filteredData);
    
    return array_values($filteredData2);
  }else{
    $data1 = htmlentities($data);
    switch($opt){
      case 1:
        $data2 = $filterInput->isStringCountValid($data1) ? $data1 : substr($data1,0,200); 
        break;
      case 2:
        $data2 = (strlen($data1) > 999) ? substr($data1,0,900) : $data1; 
        break;
      case 3:
        $data2 = $data1 === '' ?? '1';
      }
      $data3 = $filterInput->sanitizeString($data2);
      return $data3;
  }








}



?>