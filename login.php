<?php
session_start();
if(isset($_SESSION['err'])){
  echo '<script>alert("'.$_SESSION['err'].'");</script>';
  unset($_SESSION['err']);
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/login_main.css">
  <title>Login to Yom Shop</title>
</head>
<body>
  <header>
    <div class="h-logo f-jl">
      <div class="logo-container">
        <a href="home.php">
          <img src="multimedia/image/logo/yomshoplogo.png" alt="logo">
        </a>
      </div>
    </div>
    
  </header>

  <div class="main-content">
    <section class="section1">
      <div class="msg">
        <p>You must register to continue</p>
      </div>
      <form action="includes/login_proc.inc.php" method="post">
        <h3>Login:</h3>
        <div class="field-container">
          <input type="text" name="username" placeholder="Username / Email" id="input_username">
          <input type="password" name="passwd" placeholder="Password" id="input_password">
        </div>
        <div class="create-container">
          <pre><a href="">forgot password</a></pre>
          <pre><a href="register.php">Sign Up</a></pre>
        </div>
        <button type="button" id="btn-login">Login</button>
      </form>
      <div class="loading close">
        <div class="progress">
          <div class="progress-color"></div>
        </div>
      </div>
    </section>




  </div>



  <script src="js/login_main.js"></script>
</body>
</html>