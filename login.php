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
      <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <h3>Login:</h3>
        <div class="field-container">
          <input type="text" name="username" placeholder="Username / Email">
          <input type="password" name="passwd" placeholder="Password">
        </div>
        <div class="create-container">
          <pre><a href="">forgot password</a></pre>
          <pre><a href="register.php">Sign Up</a></pre>
        </div>
        <button>Login</button>
      </form>
    </section>




  </div>



  <!-- <script></script> -->
</body>
</html>