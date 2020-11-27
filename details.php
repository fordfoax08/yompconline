<?php
  session_start();
  require_once 'class/display_items.class.php';
  if(isset($_GET['v'])){
    $conn = new DisplayItems;
    $itemInfo = $conn->getItemInformation($_GET['v']);

  }

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/details_main.css">
  <title>Yom's Shop Home</title>
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
    <div class="h-cart">
      <div class="h-cart-container" onclick="cartToggle()">
      <span class="cart-item-indicator"></span>
        <a href="javascript:void(0)">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
        </svg>
        </a>
      </div>
      <div class="h-user-container">
        <a href="javascript:void(0)" onclick="toggleLoginOpen();">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
        </a>
      </div>

    </div>
    <div class="back-to-shop">&nbsp;Back</div>
  </header>
<!-- HEADER ENDS HERE -->


  <div class="main-container">
    <div class="title-container">
      <h2><?php echo isset($itemInfo) ? $itemInfo["item_name"] : "Product Title" ;?></h2>
    </div>

    <section class="section1">
      <div class="sec1-a">
        <img src="multimedia/image/<?php echo isset($itemInfo) ? $itemInfo["item_path"] : "mobo" ;?>/<?php echo isset($itemInfo) ? $itemInfo["item_image"] : "01-2345.png" ;?>" alt="item Image">
      </div>
      <div class="sec1-b">
        <h4>Specification</h4>
        <p><?php echo isset($itemInfo) && strlen($itemInfo["item_specification"]) > 0  ? $itemInfo["item_specification"] : "Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam officia esse illum illo nam vero iure similique. Provident laborum, eos itaque dolores fugit facere dolorum, dignissimos neque illo, accusamus repudiandae?" ;?></p>
        <ul>
          <?php 
          if(isset($itemInfo["item_specs"]) && strlen($itemInfo["item_specs"]) > 0){
          foreach(json_decode($itemInfo["item_specs"]) as $key){?>
            <?php echo "<li>$key</li>";?>
          <?php }};?>
            <!-- <li>Auto Transform</li>
            <li>Led lights</li>
            <li>Wireless Pc</li> -->
        </ul>
      </div>
    </section>
    
    <section class="section2">
      <div class="sec2-a">
      <img src="multimedia/image/<?php echo isset($itemInfo) ? $itemInfo["item_path"] : "mobo" ;?>/<?php echo isset($itemInfo) ? $itemInfo["item_image"] : "01-2345.png" ;?>" alt="item Image">
      </div>
      <div class="sec2-b">
        <h4>Overview</h4>
      
        <p><?php echo isset($itemInfo) && strlen($itemInfo["item_overview"]) > 0  ? $itemInfo["item_overview"] : "A amet consectetur adipisicing elit. Quibusdam officia esse illum illo nam vero iure similique. Provident laborum, eos itaque dolores fugit facere dolorum, dignissimos neque illo, accusamus repudiandae?" ;?></p>
      </div>
    </section>

    <!-- Item more details -->
    <section class="section3">
      <h2>Item Included</h2>
      <ul>
        <?php 
        if(isset($itemInfo["item_included"]) && strlen($itemInfo["item_included"]) > 0){
          foreach(json_decode($itemInfo["item_included"]) as $key){
            echo "<li>$key</li>";
          }
        }else{
          echo "<li>". $itemInfo["item_name"] ."</li>";
        }
        ?>
      </ul>
    </section>

    <!-- Price and add to cart option -->
    <section class="section4">

    </section>

  </div>


  <footer>
    <div class="f-1"></div>
    <div class="f-2"></div>
  </footer>



  <!-- CART MODAL -->
  <div class="cart-modal-container">
    <div class="cart-modal">
      <div class="modal-close">&times;</div>
      <h3>My Cart</h3>
      
      <div class="cart-item-container">


        <!-- <div class="cart-item">
          <div class="c-i qtyy"></div>
          <div class="c-i">
            <img src="/multimedia/image/mobo/01-2345.png" width="60px" alt="item">
          </div>
          <div class="c-i">Aspire 1000 Mother board</div>
          <div class="c-i">
            <span class="item-price">2000</span>
            <span class="item-sub-price">2000</span>
          </div>
          <div class="c-i">
            <div class="add-item">
              <input type="number" name="qty" class="item-qty">
              <div class="add-btns">
                <button>&plus;</button>
                <button>&minus;</button>
              </div>
            </div>
          </div>
        </div> -->
        

        




        <!-- End of Cart Container -->
      </div>
      
      <div class="cart-total">
        <p><b>Sub Total: </b> P &nbsp;<span class="total-price">2000</span></p>
      </div>

      <div class="cart-checkout">
        <button id="checkout">Check out!</button>
      </div>

    </div>
  </div>


  <!-- LOGIN MODAL -->
  <div class="user-login-container close">
    <div class="user-login close">
      <div class="user-login-a-close">&times;</div>

      <div class="user-login-a <?php echo isset($_SESSION['logged_in']) && isset($_SESSION['u_id']) ?'':'d-none';?>">
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


  <!-- confirm pop up modal -->
  <div class="confirm-container">
    <div class="confirm">
     <!--  <p>Are you sure about that?</p>
      <div class="btn-confirm-container">
        <button class="yesConfirm">Yes</button>
        <button class="noConfirm">No</button>
      </div> -->
    </div>
  </div>







<!-- <p style="padding-bottom: 500px"></p> -->
  <script src="js/details_main.js"></script>
  <script>

    //   /* CART VIEW********** */
    // const cartShow = document.querySelector('.cart-modal-container');
    // cartShow.addEventListener('click', showCart);
    // function showCart(e){
    //   const targetThis = e.target;
    //   if(targetThis.classList.contains('modal-close') || targetThis.classList.contains('cart-modal-container')){
    //     cartToggle();
    //   }
    //   return false;
    // }
    // function cartToggle(){
    //   if(cartShow.classList.contains('open')){
    //       cartShow.firstElementChild.classList.remove('open');
    //       cartShow.firstElementChild.style.overflow = 'hidden';
    //     setTimeout(()=>{
    //       cartShow.classList.remove('open');
    //     },700)
    //   }else{
    //     cartShow.classList.add('open');
    //     setTimeout(()=>{
    //       cartShow.firstElementChild.classList.add('open');
    //       setTimeout(()=>{
    //         cartShow.firstElementChild.style.overflow = 'visible';
    //       }, 700);
    //     },100);
    //   }
    // }


    //   /* USER LOGIn */
    //   const userLoginModal = document.querySelector('.user-login-container');
    //   userLoginModal.addEventListener('click', toggleLogin);

    //   function toggleLogin(e){
    //     if(e.target.classList.contains('user-login-container') || e.target.classList.contains('user-login-a-close')){
    //       if(!userLoginModal.classList.contains('close')){
    //         userLoginModal.firstElementChild.classList.add('close');
    //         setTimeout(() =>{
    //           userLoginModal.classList.add('close');
    //         }, 400);
    //       }
    //     }
    //   }
    //   function toggleLoginOpen(){
    //     userLoginModal.classList.remove('close');
    //       setTimeout(() =>{
    //         userLoginModal.firstElementChild.classList.remove('close');
    //       }, 100);
    //   }


    //   /* Back Btn */
    //   const btnBackShop = document.querySelector('.back-to-shop');
    //   btnBackShop.addEventListener('click',() => {
    //     window.close();
    //   });

  </script>
</body>
</html>