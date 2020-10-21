<?php
session_start();
require_once('../class/input_filter.class.php');


/* echo '<pre>';
var_dump($_POST);
echo '</pre>'; */
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
echo '<pre>';
var_dump($_FILES['user_image']);
echo '</pre>';

















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

?>