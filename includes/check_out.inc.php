<?php
require_once '../class/cruditem.class.php';
session_start();
if(!isset($_SESSION['u_id']) && !isset($_SESSION['logged_in'])){
  header('Location: ../index.php');
}


//GET ALL ITEM in db
if(isset($_SESSION['u_id'])){
  $crudItem = new CrudItem;
  $dataJson = json_decode($crudItem->getUserCart($_SESSION['u_id'])['user_cart']);
}

// displayData($dataJson);


function displayData($arr){
  echo '<pre>';
  var_dump($arr);
  echo '</pre>';
}

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
  
  <div class="container">
    <section class="header">
      <h4>Checkout</h4>
    </section>


    <!-- Section 1 includes item view, total -->
    <section class="section1">
      <div class="sec1-a">
        <table class="table1">
          <tbody class="tbody1">
            <?php
              if(isset($dataJson)){
                foreach($dataJson as $key){
                  // displayData(json_encode($key,JSON_PRETTY_PRINT));
                  $data = (array) $key;
                  echo '
                  <tr class="tr1">
                    <td><img src="../multimedia/image/'.$data["item_path"].'/'.$data["item_image"].'" width="70" alt="item"></td>
                    <td>
                      <h5>'.$data["item_name"].'</h5>
                      <p>Quantity: <span class="item-qty">'. $data["pcs_item"] .'</span></p>
                      <a href="javascript:void(0);" class="remove-item">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                        </svg>
                      </a>
                      <input type="hidden" value="'. $data["item_id"] .'">
                      <h3>Php: <span class="item-price">'. intval($data["item_price"]) * intval($data["pcs_item"]) .'</span></h3>
                    </td>
                  </tr>
                  ';
                  
                }
              }
            ?>

           <!--  <tr class="tr1">
              <td><img src="https://picsum.photos/70/70" width="70" alt="item"></td>
              <td>
                <h5>Black i9 Casing dragon lollipop</h5>
                <p>Quantity: <span>23</span></p>
                <a href="javascript:void(0);">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
                <h3>Php: <span class="item-price">2000.50</span></h3>
              </td>
            </tr>

            <tr class="tr1">
              <td><img src="https://picsum.photos/70/70" width="70" alt="item"></td>
              <td>
                <h5>Black i9 Casing dragon lollipop</h5>
                <p>Quantity: <span>23</span></p>
                <a href="javascript:void(0);">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
                <h3>Php: <span class="item-price">2000.50</span></h3>
              </td>
            </tr>

            <tr class="tr1">
              <td><img src="https://picsum.photos/70/70" width="70" alt="item"></td>
              <td>
                <h5>Black i9 Casing dragon lollipop</h5>
                <p>Quantity: <span>23</span></p>
                <a href="javascript:void(0);">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
                <h3>Php: <span class="item-price">2000.50</span></h3>
              </td>
            </tr>

            <tr class="tr1">
              <td><img src="https://picsum.photos/70/70" width="70" alt="item"></td>
              <td>
                <h5>Black i9 Casing dragon lollipop</h5>
                <p>Quantity: <span>23</span></p>
                <a href="javascript:void(0);">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
                <h3>Php: <span class="item-price">2000.50</span></h3>
              </td>
            </tr>

            <tr class="tr1">
              <td><img src="https://picsum.photos/70/70" width="70" alt="item"></td>
              <td>
                <h5>Black i9 Casing dragon lollipop</h5>
                <p>Quantity: <span>23</span></p>
                <a href="javascript:void(0);">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z"/>
                  </svg>
                </a>
                <h3>Php: <span class="item-price">2000.50</span></h3>
              </td>
            </tr> -->








            <!-- End of TBODY -->
          </tbody>
        </table>
      </div>
      
      <div class="sec1-a sec-total">
        <!-- <div class="item-compute-container">
          <div class="total-a">
            <p>Total: </p>
            <p>P <span class="total-int">2000</span></p>
          </div>
          <div class="total-a">
            <p>Discount: </p>
            <p><span class="total-disc">-P 120.50</span></p>
          </div>
          <div class="total-a">
            <p>Estimated Tax: </p>
            <p>+P <span class="total-int"> 50.50</span></p>
          </div>
          <div class="line-divide"></div>
          <div class="total-a total-order">
            <p>Order Total: </p>
            <p>P <span class="total-int"> 1893.50</span></p>
          </div>
        </div> -->
      </div>
      <!-- End of Section1 -->
    </section>

    <!-- Section2 payment method -->
    <section class="section2">
      <h4>Select Payment Option</h4>
      <div class="payment-method-container">
        <div class="payment-a">
          <h5>Payment Method</h5>
          <ul class="payment-method">
            <li>Credit / Debit Card</li>
            <li class="active">ATM Card</li>
            <li>G-Cash</li>
            <li>Net Banking</li>
          </ul>
        </div>
        <!-- Payment card Details -->
        <div class="payment-b">
          <div class="p-b">
            <h5>Payment Details</h5>
            <label for="card-name">Card holder Name</label>
            <input type="text" name="card_name" id="card-name" placeholder="Name">
            <label for="card-no">Card Number</label>
            <input type="number" name="card_number" id="card-number" placeholder="X-XXX-XXX-X">
            <div class="card-type">
              <input type="radio" name="visa" id="visa">
              <img src="../multimedia/image/banner/visa.png" width="35" alt="visa img">
              <input type="radio" name="master" id="master">
              <img src="../multimedia/image/banner/master.png" width="35" alt="visa img">
            </div>
            <div class="card-valid">
              <label for="cart-validity">Valid through</label>
              <input type="date" name="valie_to" id="valid-through"><br/>
              <label for="cart-validity">CCV</label>
              <input type="text" name="card_ccv" id="card-ccv">
            </div>
          </div>
          <!-- for Visa Image -->
          <div class="p-b">
            <img src="../multimedia/image/banner/mastervisa.png" width="100" alt="visa and master image">
            <button class="btn-submit">PAY NOW</button>
          </div>
        </div>
      </div>
    </section>




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

  <script src="../js/checkout_main.js"></script>
</body>
</html>