<?php
session_start();
session_destroy();
/* remove cart item in localStorage */
echo "<script>localStorage.removeItem('cart');</script>";
echo "<script>window.location.replace('../login.php');</script>";
// header('Location: ../login.php');
?>