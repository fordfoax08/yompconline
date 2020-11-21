<?php
session_start();
// require_once 'includes/autoload.inc.php';
include_once 'class/display_user_details.class.php';
include_once 'class/display_items.class.php';
if(isset($_SESSION['err'])){
  echo '<script>alert("'.$_SESSION['err'].'");</script>';
  unset($_SESSION['err']);
}

/* Feedback after successfull adding Item */
if(isset($_SESSION['done'])){
  echo '<script>alert("'.$_SESSION['done'].'");</script>';
  unset($_SESSION['done']);
  echo '<script>location.reload();</script>';
}

/* User information */
$user_details = [];
if(isset($_SESSION['logged_in']) && isset($_SESSION['u_id'])){
  $userDetails = new UserDetails;
  $user_details = $userDetails->getUserInformation($_SESSION['u_id']);
}else{
  header('Location: login.php');
}

// $crudItem = new CrudItem;
$displayItems = new DisplayItems;
$userItems = $displayItems->getSellersItems($_SESSION['u_id']);






/* DEBUGGING DUMP */
// echo '<pre>';
// var_dump($user_details);
// echo '</pre>';




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/admin_main.css">
  <title>Admin Dashboard</title>
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
  
  

  <!-- REMOVE / ADD sec2 to view section 1 -->
  <div class="main-container">
    <!-- Shrinked  -->
    <section class="section1">
      <div class="sec1-a">
        <!-- hidden default for design purpose -->
        <div class="sec1a">
          <img class="dp-img" src="multimedia/image/users/<?php echo $user_details['user_image'];?>" alt="">
          <div class="user-details">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $user_details['user_id'];?>">
            <h3><a href="index.php">
              <?php 
                $name = $user_details['seller_name'];
                echo strlen($name) >= 30 ? substr($name,0,28) : $name;
              ?>
            </a></h3>
            <p>
              <?php 
                $Uemail = $user_details['user_email'];
                echo strlen($Uemail) >= 30 ? substr($Uemail,0,28) : $Uemail;
              ?>
            </p>
            <p>
              <?php 
                $Scontact = $user_details['seller_contact'];
                echo strlen($Scontact) >= 30 ? substr($Scontact,0,28) : $Scontact;
              ?>
            </p>
          </div>
        </div>
        <div class="sec1a"></div>

        <div class="sec1a">
          <!-- for search area -->
          <div class="search-item">
            <!-- <form action=""> -->
              <select name="search_filter" class="search_filter">
                <option value="1" selected disabled>Search by</option>
                <option value="1">Name</option>
                <option value="2">Item No.</option>
              </select>
              <input type="text" name="search_item" id="search_item">
              <button id="searchBtn">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
              </button>
            <!-- </form> -->
          </div>
          <!-- Enf of Search -->
          

        </div>
      </div>

      <div class="sec1-b">
        <div class="item-list">
          <div class="header">
              <div class="item-delete">
                <form action="">
                  <label for="sort_item">Sort Date:</label>
                  <select name="sort_item" id="sort_item">
                    <option value="1">Descending</option>
                    <option value="2">Ascending</option>
                  </select>
                </form>
                <a href="javascript:void(0)" id="delete-item">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
              </div>
          </div>
        </div>
      </div>

      <!-- Section1 C main container of items -->
      <div class="select-all-container">
        <input type="checkbox" id="select_all">
        <p>Select all</p>
        <div class="page-container">
          <div class="page page_prev_max"><a href="javascript:void(0);">&lt;&lt;</a></div>
          <div class="page page_prev"><a href="javascript:void(0);">&lt;</a></div>
          <div class="page page_next"><a href="javascript:void(0);">&gt;</a></div>
          <div class="page page_next_max"><a href="javascript:void(0);">&gt;&gt;</a></div>
          <input type="hidden" name="page_no" id="page_no" value="1">
          Page &nbsp; <span id="page_text">1</span> &nbsp; of &nbsp;<span id="page_total">1</span>
        </div>
      </div>
      <div class="sec1-c">
        <!-- item list of item here -->
        <div class="sec1-c-a">
          <div class="items">
            <table class="table1">
              <tbody>
                <!-- Populate items -->
             
                
                <!-- DUMPED 
                <tr>
                  <td>
                    <input type="checkbox" name="productName">
                  </td>
                  <td><img src="multimedia/image/mobo/01-2387.png" alt=""></td>
                  <td>
                    <p>Mobo best evooooo okay?</p>
                    <p>Lorem ipsum dolor sit amet coasdfasdfasdfasdfsadf Lorem ipsum dolor sit amet. asjdkf nsectetur adipisicing elit. Vero, aliquam!</p>
                  </td>
                  <td>
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                    </svg>
                  </td>
                </tr>
                
                 -->
               
              </tbody>
            </table>
          </div>


        </div>
        
        <div class="sec1-c-b">
          <!-- dkasjdflkj -->
        </div>


      </div>
      <!-- End of sec1-c -->
    </section>



    <section class="section2">
      
      
      <div class="container sec2-main-container">
        <div class="sec2-header">
          <h1>Sell Item</h1>
          <p>Please fill up all important information.</p>
        </div>
        <form class="inpts" action="includes/add_item.inc.php" method="post" enctype="multipart/form-data">
          <input type="file" id="item_image">
          <select name="item_category" id="item-category">
            <option value="0" selected disabled>Category</option>
            <option value="1">Board / CPU</option>
            <option value="2">Chassis / Rig</option>
            <option value="3">Graphics Card</option>
            <option value="4">Monitor</option>
            <option value="5">Keyboard</option>
            <option value="6">Mouse</option>
            <option value="7">Others</option>
          </select>
          <span class="req-field">*</span>
          <input type="number" name="item_available" id="item_available" placeholder="Number of Items Available">
          <span class="req-field">*</span>
          <input type="text" name="item_name" id="item_name" placeholder="Item name">
          <input type="text" name="item_sub_name" id="item_sub_name" placeholder="Sub name">
          <span class="req-field">*</span>
          <textarea name="item_short_desc" id="item_short_desc" cols="30" rows="3" placeholder="Short Item description"></textarea>
          <label for="item_overview">Overview</label>
          <textarea name="item_overview" id="item_overview" cols="30" rows="6" placeholder="Item Overview"></textarea>
          <label for="item_information">Information</label>
          <textarea name="item_information" id="item_information" cols="30" rows="6" placeholder="Item Overview"></textarea>
          <label for="item_specification">Specification</label>
          <textarea name="item_specification" id="item_specification" cols="30" rows="3" placeholder="Specification Overview"></textarea>
          <div class="specific-container">
            <ul class="specific-ul">
              <!-- Specification Items here -->
            </ul>
            <input type="text" class="spec-input-txt" style="padding: 4px;" placeholder="Add Specification">
            <button type="button" class="spec-add-btn">&plus;</button>
          </div>
          <p class="items-included-title">Items included</p>
          <div class="item-included-container">
            <ul class="included-ul">
              <!-- <li>EXAMPLE<span class="item-list-close">&times;</span></li> -->
            </ul>
            <input type="text" style="padding: 4px;" class="item-included-input" placeholder="Item included">
            <button type="button" class="item-included-btn">&plus;</button>
          </div>

          <button type="button" class="btn-new-item">Add new Item</button>
          
        </form>
      </div>




      <!-- <div class="container border sec2-body">
        <div class="sec2-body-a pos-center">
          <h6>Item image</h6>
          <form action="" class="sec2-form1">
            <input type="file" name="item_image" enctype="multipart/form-data">
          </form>
        </div>
        <div class="sec2-body-b pos-center">
        </div>
        <div class="sec2-body-c pos-center">c</div>
      </div> -->

    </section>
  </div>

  <footer>

  </footer>


  <!-- Pop up indicating if item is added or error occured itemAlert(msg)-->
  <div class="item-alert">
      <div class="item-alert-container">
        <span class="item-alert-text">Item Added!</span>
      </div>
  </div>

  
  

  <!-- MENU LEFT NAV -->
  <div class="menu-drawer-container">
    <div class="menu-drawer"></div>
  </div>
  <div class="menu-container close">
    <div class="menu-content close">
      <div class="menu-header">
        <img src="multimedia/image/logo/yomshoplogo2.png" width="50" alt="">
      </div>
      <div class="menu1 mn">Home</div>
      <div class="menu2 mn">New Item</div>
      <div class="menu3 mn"><a href="includes/logout_proc.php">Logout</a></div>
    </div>
  </div>






  <!-- MODAl FOR UPDATING ITEM INFORMATION open-->
  <div class="modal-container">
    <div class="edit-container">
      <!-- Div for closing modal -->
      <div class="edit-container-close">&times;</div>
      <!-- Edit A for Image, B for Item Info-->
      <div class="edit-a">
        <img id="edit_image" src="multimedia/image/banner/banner1.png" alt="image">
      </div>
      <!-- B ************** -->
      <div class="edit-b">
        <h3>Update Item Info</h3>
        
        <div class="modal-input-container">
          <input type="hidden" name="item_id" id="item_id2">
          <span class="req-field">*</span>
          <input type="text" name="item_name" id="item_name2" placeholder="Item name">
          <input type="text" name="item_sub_name" id="item_sub_name2" placeholder="Sub name">
          <select name="item_category" id="item-category2">
            <option value="0" selected disabled>Category</option>
            <option value="1">Board / CPU</option>
            <option value="2">Chassis / Rig</option>
            <option value="3">Graphics Card</option>
            <option value="4">Monitor</option>
            <option value="5">Keyboard</option>
            <option value="6">Mouse</option>
            <option value="7">Others</option>
          </select>
          <span class="req-field">*</span>
          <label for="item_available2">Available Units</label>
          <input type="number" name="item_available" id="item_available2" placeholder="Number of Items Available">
          <span class="req-field">*</span>
          <label for="item_short_desc2">Short Description</label>
          <textarea name="item_short_desc" id="item_short_desc2" cols="30" rows="3" placeholder="Short Item description"></textarea>
          <label for="item_overview">Overview</label>
          <textarea name="item_overview" id="item_overview2" cols="30" rows="6" placeholder="Item Overview"></textarea>
          <label for="item_information">Information</label>
          <textarea name="item_information" id="item_information2" cols="30" rows="6" placeholder="Item Overview"></textarea>
          <label for="item_specification">Specification</label>
          <textarea name="item_specification" id="item_specification2" cols="30" rows="3" placeholder="Specification Overview"></textarea>
          <div class="specific-container2">
            <ul class="specific-ul2">
              <!-- Specification Items here -->
            </ul>
            <input type="text" class="spec-input-txt2" style="padding: 4px;" placeholder="Add Specification">
            <button type="button" class="spec-add-btn2">&plus;</button>
          </div>
          <p class="items-included-title2">Items included</p>
          <div class="item-included-container2">
            <ul class="included-ul2">
              <!-- <li>EXAMPLE<span class="item-list-close">&times;</span></li> -->
            </ul>
            <input type="text" style="padding: 4px;" class="item-included-input2" placeholder="Item included">
            <button type="button" class="item-included-btn2">&plus;</button>
          
          </div>
          <div class="price-container2">
            <span class="price-current2">Price:</span>
            <input type="number" name="item_price" id="item_price2" placeholder="Price">
            <br />
            <label for="item_discount">Discount</label>
            <input type="number" name="item_discount" id="item_discount2" placeholder="Discount %">
          </div>
          <button class="btn-update">UPDATE ITEM</button>
      </div>


    </div>
  </div>

  <!-- <p style="margin-bottom: 1000px;">.</p> -->
  <script src="js/admin_main.js"></script>
  
</body>
</html>