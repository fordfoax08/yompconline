<?php
session_start();
require_once('autoload.inc.php');




$username = $_POST['username'];
$password = $_POST['passwd'];
/* preparing array to be inserted */
$arrayCredentials = array($username,$password);
/* instantiate CrudInfo */
$con = new CrudInfo;
$isValidUser = $con->loginUser($arrayCredentials) ?? false;
/* Setting up sessions */
if($isValidUser){
  $user_id = $con->getUserId($username);
  $_SESSION['logged_in'] = true;
  $_SESSION['u_id'] = $user_id['user_id'];
  header('Location: ../admin.php');
}else{
  //session_destroy();
  errMessage('User not found');
}


function errMessage($str){
  $_SESSION['err'] = $str;
  echo '<script>window.history.back();</script>';
}

?>