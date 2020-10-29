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
$item_category = getPostData('item_category');
$item_path = itemPath($item_category);


/* ITEM IMAGE */
$filterImage = new FilterImage;
$file = $_FILES['item_image'];
$file_name = $file['name'];
$file_temp = $file['tmp_name'];
$file_size = $file['size'];
$file_valid = true;

/* Change Image name according to item id */
$file_name = $filterImage->imageNewName($file_name, $item_id);

/* Check if Image is Valid, Size and Type */
if(!$filterImage->isImageFileValid($file_name) || !$filterImage->imageSizeValid($file_size)){
  $file_valid = false;
  $file_name = 'noimage.jpg';
}



/* PREPARE DATA FOR SAVING (array) */
$dataPrepared = array(
  'user_id' => $user_id,
  'item_id' => $item_id,
  'item_image' => $file_name,
  'item_path' => $item_path,
  'item_category' => $item_category,
  'item_name' => $item_name,
  'item_sub_name' => $item_sub_name,
  'item_short_desc' => $item_short_desc,
  'item_overview' => $item_overview,
  'item_information' => $item_information,
  'item_specification' => $item_specification,
  'item_specs' => $item_specs,
  'item_included' => $item_included,
  'item_available' => $item_available
);


/* INSERTING DATA TO DATABASE */
$cruditem = new CrudItem;
if($cruditem->insertNewItem($dataPrepared)){
  if($file_valid){
    /* move image if File is valid */
    move_uploaded_file($file_temp,'../multimedia/image/'.$item_path.'/'.$file_name);
  }
  echo 'Uploaded!';
}



/* echo '<pre>';
var_dump($cruditem->insertNewItem($dataPrepared));
// var_dump($item_available);
echo '</pre>'; */






















/* Generate Item Id based on date and random number */
function generateItemId(){
  $a = date('Ymd');
  $b = rand(100,999);
  $c = rand(10,99);
  $item_id = $a.$b.$c;
  return $item_id;
}

/* GET ITEM PATH by category*/
function itemPath($category){
  $path = '';
  switch($category){
    case 1:
      $path = 'keyboard';
      break;
    case 2:
      $path = 'mobo';
      break;
    case 3:
      $path = 'monitor';
      break;
    case 4:
      $path = 'mouse';
      break;
    case 5:
      $path = 'others';
      break;
    default:
      $path = '';
  }
  return $path;
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