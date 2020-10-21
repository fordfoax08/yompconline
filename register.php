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
  <link rel="stylesheet" href="css/register_main.css">
  <title>Register</title>
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

  <div class="container">
   <form action="includes/register_proc.inc.php" method="post" enctype="multipart/form-data">
    <section class="container-a sec1">
      <h4>Register</h4>
      <div class="input-container" style="padding: 0 16px;">
        <!--Upload Image-->
        <div class="img-container">
          <div class="img">
            <img src="multimedia/image/users/dp.jpg" alt="" id="img_file">
          </div>
          <input type="file" accept="image/*" name="user_image" class="custom-file-input" id="img_input">
        </div>
        <!-- user fullname -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                <path fill-rule="evenodd" d="M2 15v-1c0-1 1-4 6-4s6 3 6 4v1H2zm6-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
              Person
            </span>
          </div>
          <!-- All input except inputFile has js-sc class for js purpose -->
          <input type="text" name="user_first_name" placeholder="First Name" class="required-field js-scr p-name">
          <input type="text" name="user_last_name" placeholder="Last Name" class="required-field  js-scr  p-name">
        </div>
        <!-- Email -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-envelope-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
              </svg>
              &nbsp;&nbsp;Email
            </span>
          </div>
          <input type="email" name="user_email" placeholder="Email Address" class="required-field p-email">
        </div>
        <!-- Contact number -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
              </svg>
              &nbsp;&nbsp;No.
            </span>
          </div>
          <input type="text" name="user_contact" placeholder="Contact Number" class="required-field">
        </div>

        <!-- <input type="text" name="" id="" placeholder="Enter Text">
        <input type="password" name="" id="" placeholder="Enter Password">
        <input type="email" name="" id="" placeholder="Enter Email"> -->
      </div>


    </section>

    <!-- Section 2 for login details -->
    <section class="container-1 sec2">
      <h4>Login Details</h4>
      <div style="padding: 0 24px;">
        <!-- Username Text -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
              </svg>
              Username
            </span>
          </div>
          <input type="text" name="user_name" placeholder="Username" id="input_username" class="required-field">
        </div>
        
        <!-- PAssword txt -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
              </svg>
              Password
            </span>
          </div>
          <input type="password" name="user_password" placeholder="New Password" class="required-field">
        </div>

        <!-- RePassword -->
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
              </svg>
              Password
            </span>
          </div>
          <input type="password" name="user_repassword" placeholder="Re-Password" class="required-field" >
        </div>
      </div>

    </section>


    <!-- SECTION 3 Buyer or Seller -->
    <section class="container-a sec3" style="padding: 0 16px;">

    <div class="checkbox-container">
      <input type="checkbox" name="" id="ch1" class="chck1" onclick="sellExpand()">
      <label for="ch1">Check if you are a Seller.</label>
    </div>
    <!-- Seller information -->
    <div class="seller-info-container">
      <!-- SELLER INFO EXPAND AREA -->
    </div>

    </section>

    
   </form>
    <button class="btn-submit">
      REGISTER
    </button>
  </div>



  <footer style="height: 300px; background-color: rgba(0,0,0,.4);"></footer>
  
  <script src="js/register_main.js"></script>
</body>
</html>