<?php
session_start();
require_once 'autoload.inc.php';

$user_first_name = getPostData('user_first_name');
$user_last_name = getPostData('user_last_name');
$user_email = getPostData('user_email');
$user_contact = getPostData('user_contact');
$user_name =  getPostData('user_name');
$user_password = getPostData('user_password');
$seller_name = getPostData('seller_name');
$seller_address = getPostData('seller_address');
$seller_contact = getPostData('seller_contact');
$seller_details = getPostData('seller_details');


$filter = new FilterInput;
/* Sanitizing STRING*/
$user_first_name_sanitized = $filter->sanitizeString(html_entity_decode($user_first_name));
$user_last_name_sanitized = $filter->sanitizeString(html_entity_decode($user_last_name));
$user_contact_sanitized = $filter->sanitizeString(html_entity_decode($user_contact));
$user_name_sanitized = $filter->sanitizeString(html_entity_decode($user_name));
$seller_name_sanitized = $filter->sanitizeString(html_entity_decode($seller_name));
$seller_address_sanitized = $filter->sanitizeString(html_entity_decode($seller_address));
$seller_contact_sanitized = $filter->sanitizeString(html_entity_decode($seller_contact));
$seller_details_sanitized = $filter->sanitizeString(html_entity_decode($seller_details));
$password_sanitized = password_hash($user_password, PASSWORD_DEFAULT);
$user_id = generateId();

/* Validation
String validation through string count
-each string should not exceed to 250 char exept for Store details
Email Validation :
-FILTER_SANITIZE_EMAIL
-FILTER_VALIDATE_EMAIL
if Error back to registe.php
*/

if(!$filter->isEmailValid($user_email)){
  errReport('Invalid Email Address');
}
if(!$filter->isStringCountValid($user_first_name_sanitized) || !$filter->isStringCountValid($user_last_name_sanitized)){
  errReport('\"Name\",Character should not exceed morethan 250');
}
if(!$filter->isStringCountValid($user_contact_sanitized)){
  errReport('Contact, string should not exceed more than 250 Character');
}
if(!$filter->isStringCountValid($user_name_sanitized)){
  errReport('User Name, string should not exceed more than 250 Character');
}
if(!$filter->isStringCountValid($seller_name_sanitized)){
  errReport('Seller name, string should not exceed more than 250 Character');
}
if(!$filter->isStringCountValid($seller_address_sanitized)){
  errReport('Seller Address, string should not exceed more than 250 Character');
}
if(!$filter->isStringCountValid($seller_contact_sanitized)){
  errReport('Seller Contact, string should not exceed more than 250 Character');
}
if(!$filter->isStringCountValid($seller_details_sanitized)){
  errReport('Seller Details, string should not exceed more than 250 Character');
}



/* IMAGE FILE */
$file = $_FILES['user_image'];
$image_name = $file['name'];
$image_tmp = $file['tmp_name'];
$image_size = $file['size'];
$newImageName = 'dp.jpg';
$destination = '../multimedia/image/users/';

if($image_name !== '' || strlen($image_name) !== 0){

  $img = new FilterImage;
  $newImageName = $img->imageNewName($image_name,$user_id);
  
  if(!$img->imageSizeValid($image_size)){
    errReport('Invalid Image size');
  }
  if(!$img->isImageFileValid($image_name)){
    errReport('Invalid Image file');
  }
}




/* Prepare Assoc Array for DB insert 
*  dataInfo and dataAccount is named after its table
*/
$dataInfo = [
  'user_id' => $user_id,
  'user_first_name' => $user_first_name_sanitized,
  'user_last_name' => $user_last_name_sanitized,
  'user_email' => $user_email,
  'user_contact' => $user_contact_sanitized,
  'user_name' => $user_name_sanitized,
  'user_image' => $newImageName,
  'seller_name' => $seller_name_sanitized,
  'seller_address' => $seller_address_sanitized,
  'seller_contact' => $seller_contact_sanitized,
  'seller_details' => $seller_details_sanitized
];
$dataAccount = [
  'user_id' => $user_id,
  'user_name' => $user_name_sanitized,
  'user_email' => $user_email,
  'user_password' => $password_sanitized
];


/* UPLOADING TO DATABASE~! */
$crud = new CrudRegister;
if($crud->insertIntoAccount($dataAccount)){
  $crud->insertIntoInfo($dataInfo);
  move_uploaded_file($image_tmp, $destination.$newImageName);
  echo 'Registered!';
}else{
  // errReport('Something wen\'t wrong in server');
  echo 'Registration Failed!';
}


/* echo '<pre>';
var_dump();
echo '</pre>';
 */















/* getting POST Data */
function getPostData($str){
  $data = $_POST[$str] ?? '';
  return htmlentities($data);
}

/* Err report */
function errReport($str){
  $_SESSION['err'] = $str;
  echo '<script>window.history.back();</script>';
}

/* User ID Generator
  *date(Ym) + rand(1000, 9999) + rand(100, 999) + date(dms);
*/
function generateId(){
  $a = date('Ymd');
  $b = rand(1000, 9999);
  $c = rand(100, 999);
  $d = $a.$b.$c;
  if(strlen($d) !== 15){
    return str_pad($d, 15, '0', STR_PAD_RIGHT);
  }
  return $d;
}
?>