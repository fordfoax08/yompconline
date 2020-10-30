<?php
session_start();
/* Comment Added for git practice */
!isset($_SESSION['visited_count']) ? $_SESSION['visited_count'] = 1 : $_SESSION['visited_count']++;





?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/home_main.css">
  <title>Yom's Shop Home</title>
</head>
<body>
  <header>
    <div class="h-logo f-jl">
      <div class="logo-container">
        <a href="javascript:void(0)">
          <img src="multimedia/image/logo/yomshoplogo.png" alt="logo">
        </a>
      </div>
    </div>
    <div class="h-cart">
      <div class="h-user-container">
        <a href="javascript:void(0)" class="user-link" onclick="toggleLoginOpen();">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
        </a>
      </div>
    </div>
    
  </header>

  <div class="main-content">
    <section class="section1">
      <div class="sec1-a">
        <img src="multimedia/image/banner/banner1.png" alt="banner1">
      </div>
      <div class="sec1-b">
        <h4>GAMING EXPERIENCE</h4>
        <p>Lorem ipsum dolor sit, amet  Cumqtur culpa nesciunt numquam maiores temporibus doloribus repudiandae, necessitatibus corporis quae </p>
      </div>
    </section>
    
    <section class="section2">
      <div class="sec2-a">
        <h4>Slick Design</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, totam.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, sit voluptates.</p>
        <p> Placeat cumque enim recusandae? Quibusdam possimus reprehenderit molestiae, ut quod vitae veritatis at nihil, in impedit, itaque accusamus perferendis. Dicta, assumenda. Velit earum quaerat tempora iure eius officiis veniam tempore sequi aperiam, nulla ut reprehenderit voluptatum. Dignissimos, impedit!</p>
      </div>
      <div class="sec2-b">
        <img src="multimedia/image/banner/banner2.png" alt="bn2">
      </div>
    </section>
    
    <section class="section3">
      <div class="sec3-a">
        <img src="multimedia/image/banner/banner3.png" alt="bn2">
      </div>
      <div class="sec3-b">
        <h4>Cougar technology</h4>
        <ul>
          <li>Led lights</li>
          <li>Light Ledss 2</li>
          <li>Key Logger</li>
          <li>Customizable rig</li>
        </ul>
        <p>with wide variety of led colours...</p>
      </div>
    </section>
    
    <section class="section4">
      <div class="sec4-a">
        <div class="sec4-a-1">
          <img src="multimedia/image/banner/bnmouse.png" alt="">
        </div>
        <div class="sec4-a-2">
          <h4>Mouse</h4>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo libero temporibam.</p>
          <h4> Keyboards</h4>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente natus earum, consectetur, sequi placeat esse v unde nemo ea totam voluptas?</p>
        </div>
        <div class="sec4-a-3">
          <img src="multimedia/image/banner/bnkey.png" alt="">
        </div>
      </div>
    </section>

    <section class="section5">
      <img src="multimedia/image/banner/banner4.jpg" alt="">
      <div class="sec5-a">
        <h4>Rig Led Cluster</h4>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nam sed ab quibusdam, enim nesciunt nulla culpa veritatis libero consequatur id.</p>
      </div>
    </section>

    <a href="index.php" id="toshop">
    <section class="section6">
      <div class="sec6-a">
        <img src="multimedia/image/banner/stamp.png" alt="">
        <h3>SHOP NOW</h3>
      </div>
      <div class="sec6-b">
        &raquo;
      </div>
    </section>
    </a>

    <section class="about-us">
      <div class="about-container">
        <h2>About-Us</h2>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, iste distinctio consequuntur numquam culpa natus non eaque, earum maiores fugiat aperiam, alias perspiciatis.</p>
      </div>
    </section>

    <section class="service">
      <div class="service-1">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clock-history" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
          <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
          <path fill-rule="evenodd" d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
        </svg>
        <h4>Forever Waranty</h4>
        <p>Lorem, ipsum dolorpisicing elit. Hic, laboriosam.</p>
      </div>

      <div class="service-2">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-truck" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
        <h4>Free Delivery</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
      </div>

      <div class="service-3">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z"/>
        </svg>
        <h4>Caller Pin</h4>
        <p>Lorem ipsum dolor sit amet consectetur.</p>
      </div>
    </section>

    <section class="service-banner">
      <img src="multimedia/image/banner/banner5.jpg" alt="bn5">
    </section>


  </div>

  <footer>
    <div class="f-1"></div>
    <div class="f-2"></div>
  </footer>




  <!-- MODAL USER DETAILS -->
  <div class="user-login-container close">
    <div class="user-login close">
      <div class="user-login-a-close">&times;</div>

      <div class="user-login-a  <?php echo isset($_SESSION['logged_in']) && isset($_SESSION['u_id']) ?'':'d-none';?>">
        <h5>WELCOME!</h5>
        <div class="user-grid-container">
          <div class="grid-1">
            <img src="multimedia/image/logo/yomshoplogo.jpg" alt="">
            <h4>Yom De Guapo</h4>
          </div>
          <div class="grid-2">
            <a href="admin.php">Admin Home</a>
            <a href="index.php">My Shop</a>
            <a href="includes/logout_proc.php">Logout</a>
          </div>
        </div>
        
      </div>
      <div class="user-login-b <?php echo isset($_SESSION['logged_in']) && isset($_SESSION['u_id']) ?'d-none':'';?>">
        <h3>You are not Logged In.</h3>
        <p style="margin-bottom: 20px;"> Please Sign In to continue....</p>
        <p><a href="login.php">Sign In</a></p>
      </div>

    </div>
  </div>

  <!-- <p style="padding-bottom: 500px"></p> -->
  <script src="js/home_main.js"></script>
</body>
</html>