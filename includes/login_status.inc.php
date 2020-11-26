<?php
session_start();

if(isset($_SESSION['u_id']) && isset($_SESSION['logged_in'])){
  echo '{"online": true}';
}else{
  echo '{"online": false}';
}




?>