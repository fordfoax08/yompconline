<?php
session_start();
if(!isset($_SESSION['u_id']) && !isset($_SESSION['logged_in'])){
  header('Location: ../index.php');
}


echo $_SESSION['u_id'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/checkout_main.css">
  <title>Checkout</title>
</head>
<body>
  

  <script src="../js/checkout_main.js"></script>
</body>
</html>