<?php
session_start();
if(!isset($_SESSION['u_id']) && !isset($_SESSION['logged_in'])){
  header('Location: ../index.php');
}


// echo $_SESSION['u_id'];



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








            <!-- End of TBODY -->
          </tbody>
        </table>
      </div>
      
      <div class="sec1-a">
        <div class="item-compute-container">
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
          <!-- <div class="total-a">
            <p>Option: </p>
            <p> <span class="total-int">Pickup</span></p>
          </div> -->
          <div class="line-divide"></div>
          <div class="total-a total-order">
            <p>Order Total: </p>
            <p>P <span class="total-int"> 1893.50</span></p>
          </div>
        </div>
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
        <div class="payment-b"></div>
      </div>
    </section>




  </div>


  <script src="../js/checkout_main.js"></script>
</body>
</html>