<?php
session_start();

/* if(isset($_SESSION['logged_in'])){
  echo 'Logged In!';
} */

!isset($_SESSION['visited_count']) ? $_SESSION['visited_count'] = 1 : $_SESSION['visited_count']++;





?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="css/home_set.css"> -->
  <link rel="stylesheet" href="css/index_main.css">
  <title>Browse Shop</title>
</head>
<body>
  <header>
    <div class="h-logo f-jl">
      <div class="logo-container">
        <a href="home.php">
          <input type="hidden" id="logged-in" value="<?php echo isset($_SESSION['logged_in']) ? 1 : 0 ;?>">
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
        <a href="javascript:void(0)"  onclick="toggleLoginOpen();">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
          </svg>
        </a>
      </div>
    </div>

    <div class="nav">
      <div class="nav-item-1">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-mouse" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8 3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 3zm4 8V5a4 4 0 0 0-8 0v6a4 4 0 0 0 8 0zM8 0a5 5 0 0 0-5 5v6a5 5 0 0 0 10 0V5a5 5 0 0 0-5-5z"/>
        </svg>
        <span class="svg-label">MOUSE</span>
      </div>

      <div class="nav-item-2">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-keyboard" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M14 5H2a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1zM2 4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2H2z"/>
          <path d="M13 10.25a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm0-2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm-5 0A.25.25 0 0 1 8.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 8 8.75v-.5zm2 0a.25.25 0 0 1 .25-.25h1.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-1.5a.25.25 0 0 1-.25-.25v-.5zm1 2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm-5-2A.25.25 0 0 1 6.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 6 8.75v-.5zm-2 0A.25.25 0 0 1 4.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 4 8.75v-.5zm-2 0A.25.25 0 0 1 2.25 8h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 2 8.75v-.5zm11-2a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm-2 0a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm-2 0A.25.25 0 0 1 9.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 9 6.75v-.5zm-2 0A.25.25 0 0 1 7.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 7 6.75v-.5zm-2 0A.25.25 0 0 1 5.25 6h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5A.25.25 0 0 1 5 6.75v-.5zm-3 0A.25.25 0 0 1 2.25 6h1.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-1.5A.25.25 0 0 1 2 6.75v-.5zm0 4a.25.25 0 0 1 .25-.25h.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-.5a.25.25 0 0 1-.25-.25v-.5zm2 0a.25.25 0 0 1 .25-.25h5.5a.25.25 0 0 1 .25.25v.5a.25.25 0 0 1-.25.25h-5.5a.25.25 0 0 1-.25-.25v-.5z"/>
        </svg>
        <span class="svg-label">KEYS</span>
      </div>

      <div class="nav-item-3">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-display" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path d="M5.75 13.5c.167-.333.25-.833.25-1.5h4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75z"/>
          <path fill-rule="evenodd" d="M13.991 3H2c-.325 0-.502.078-.602.145a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/>
        </svg>
        <span class="svg-label">MONITOR</span>
      </div>
      
      <div class="nav-item-4">
        <span class="nav-all-items">...</span>
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-cpu" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M5 0a.5.5 0 0 1 .5.5V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2h1V.5a.5.5 0 0 1 1 0V2A2.5 2.5 0 0 1 14 4.5h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14v1h1.5a.5.5 0 0 1 0 1H14a2.5 2.5 0 0 1-2.5 2.5v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14h-1v1.5a.5.5 0 0 1-1 0V14A2.5 2.5 0 0 1 2 11.5H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2v-1H.5a.5.5 0 0 1 0-1H2A2.5 2.5 0 0 1 4.5 2V.5A.5.5 0 0 1 5 0zm-.5 3A1.5 1.5 0 0 0 3 4.5v7A1.5 1.5 0 0 0 4.5 13h7a1.5 1.5 0 0 0 1.5-1.5v-7A1.5 1.5 0 0 0 11.5 3h-7zM5 6.5A1.5 1.5 0 0 1 6.5 5h3A1.5 1.5 0 0 1 11 6.5v3A1.5 1.5 0 0 1 9.5 11h-3A1.5 1.5 0 0 1 5 9.5v-3zM6.5 6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3z"/>
        </svg>
        <span class="svg-label">CPU</span>
      </div>
            
      <div class="nav-item-5">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-phone" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11 1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
          <path fill-rule="evenodd" d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
        </svg>
        <span class="svg-label">CASING</span>
      </div>

      <div class="nav-item-6">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-controller" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M11.119 2.693c.904.19 1.75.495 2.235.98.407.408.779 1.05 1.094 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.815-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773a11.307 11.307 0 0 1-.739-.809c-.126-.147-.25-.291-.368-.422-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.422-.243.283-.494.576-.739.81-.398.378-.877.705-1.513.772a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772.486-.485 1.331-.79 2.235-.98.932-.196 2.03-.292 3.119-.292 1.089 0 2.187.096 3.119.292zm-6.032.979c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.505C4.861 9.97 5.978 9.026 8 9.026s3.139.943 3.965 1.855c.164.182.307.35.44.505.214.25.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
          <path d="M11.5 6.026a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm2 0a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1 1a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-7-2.5h1v3h-1v-3z"/>
          <path d="M3.5 6.526h3v1h-3v-1zM3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .258.966l-1.932.518a.5.5 0 0 1-.612-.354zm9.976 0a.5.5 0 0 0-.353-.613l-1.932-.518a.5.5 0 1 0-.259.966l1.932.518a.5.5 0 0 0 .612-.354z"/>
        </svg>
        <span class="svg-label">GPU</span>
      </div>

      <div class="nav-item-7">
        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-box" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5 8 5.961 14.154 3.5 8.186 1.113zM15 4.239l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
        </svg>
        <span class="svg-label">OTHERS</span>
      </div>


    </div>
  </header>
<!-- HEADER ENDS HERE*********** -->



  <div class="main-content">
    <section class="section1">
      <div class="sec1-container">

        <div class="sec1-a">
          <!-- SEARCH BAR -->
          <div class="input-group">
            <input type="text" name="search_que" id="search_que" placeholder="Search">
            <div class="input-group-append">
              <span class="input-group-text">
                <a href="javascript:void(0)">
                  <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                  </svg>
                </a>
              </span>
            </div>
          </div>
        </div>

        <div class="sec1-b">
          <label for="search_by_id">Search by:&nbsp;</label>
          <select name="search_by" id="search_by_id">
            <option value="1">Items</option>
            <!-- <option value="2">Seller</option> -->
          </select>
          <label for="search_by_category">Catergory:&nbsp;</label>
          <select name="search_category" id="search_by_category">
            <option value="0">All</option>
            <option value="1">CPU / Motherboard</option>
            <option value="2">Chassis / Rig</option>
            <option value="3">Graphics Card</option>
            <option value="4">Monitor</option>
            <option value="5">Keyboard</option>
            <option value="6">Mouse</option>
            <option value="7">Others</option>
          </select>
        </div>

      </div>
      <div class="sec1-drawer">
        <div class="arrow-1"></div>
        <div class="arrow-2"></div>
      </div>
    </section>

    <section class="section2" id="section2">



      <div class="item-container">
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/mobo/01-2345.png" alt="">
          </a>
          
        </div>
        <div class="i-c-b">
          <h5>Cougar mobo</h5>
          <p>Complete Set.</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item-container">
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/mobo/01-2345.png" alt="">
          </a>
        </div>
        <div class="i-c-b">
          <h5>Cougar mobo</h5>
          <p>Complete Set.</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item-container">
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/mobo/01-2345.png" alt="">
          </a>
        </div>
        <div class="i-c-b">
          <h5>Cougar mobo</h5>
          <p>Complete Set.</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item-container">
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/mobo/01-2345.png" alt="">
          </a>
        </div>
        <div class="i-c-b">
          <h5>Cougar mobo</h5>
          <p>Complete Set.</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
      
      <div class="item-container">
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/mobo/01-2345.png" alt="">
          </a>
        </div>
        <div class="i-c-b">
          <h5>Cougar mobo</h5>
          <p>Complete Set.</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
      
      
      
    

    </section>

    <section class="section3">
      <div class="page-container">
        <div class="page pagePrevMax"><a href="javascript:void(0)">&lt;&lt;</a></div>
        <div class="page pagePrev"><a href="javascript:void(0)">&lt;</a></div>
        <!-- <div class="page pageNo pageFirst"><a href="javascript:void(0)">1</a></div>
        <div class="page pageNo pageSecond"><a href="javascript:void(0)">2</a></div>
        <div class="page pageNo pageThird"><a href="javascript:void(0)">3</a></div>
        <div class="page pageNo pageFourth"><a href="javascript:void(0)">4</a></div> -->
        <div class="page pageJump"><a href="javascript:void(0)">...</a></div>
        <div class="page pageNext"><a href="javascript:void(0)">&gt;</a></div>
        <div class="page pageNextMax"><a href="javascript:void(0)">&gt;&gt;</a></div>
      </div>
    </section>

  </div>

  <footer>
    <div class="f-1"></div>
    <div class="f-2"></div>
  </footer>
  
  <!-- View Item Modal open -->
  <div class="item-modal-container">
    <!-- Item modal here -->
    
  </div>




  <!-- CART MODAL -->
  <div class="cart-modal-container">
    <div class="cart-modal">
      <div class="modal-close">&times;</div>
      <h3>My Cart</h3>
      
      <div class="cart-item-container">
      
        <!-- <div class="cart-empty">
          Empty Cart shop now.
        </div> -->


        <!-- <div class="cart-item">
          <div class="c-i qtyy"></div>
          <div class="c-i">
            <img src="multimedia/image/mobo/noimage.png" width="40px" alt="item">
          </div>
          <div class="c-i">Aspire 1000 Mother board</div>
          <div class="c-i">
            <span class="item-price">2000</span>
            <span class="item-sub-price">2000</span>
          </div>
          <div class="c-i">
            <div class="add-item">
              <input type="number" name="qty" class="item-qty" value="1">
              <div class="add-btns">
                <button class="plus">&plus;</button>
                <button class="minus">&minus;</button>
              </div>
            </div>
          </div>
        </div> -->



        <!-- End of cart container -->
      </div>
      
      <div class="cart-total">
        <p><b>Sub Total: </b> <span class="total-price">P &nbsp;2000</span></p>
      </div>

      <div class="cart-checkout">
        <button>Check out!</button>
      </div>

    </div>
  </div>


  <div class="user-login-container close">
    <div class="user-login close">
      <div class="user-login-a-close">&times;</div>

      <div class="user-login-a <?php echo isset($_SESSION['logged_in']) && isset($_SESSION['u_id']) ?'':'d-none';?>">
        <h5>WELCOME!</h5>
        <div class="user-grid-container">
          <div class="grid-1">
            <img src="multimedia/image/logo/yomshoplogo.jpg" alt="">
            <input type="hidden" id="user_id" value="<?php echo isset($_SESSION['u_id']) ? $_SESSION['u_id'] : '';?>">
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
        <p style="margin-bottom: 20px; margin-top: 40px;"> Please Sign In to continue....</p>
        <p><a href="login.php">Sign In</a></p>
      </div>

    </div>
  </div>


  <!-- <p style="padding-bottom: 500px"></p> -->

  <script src="js/index_main.js"></script>
  <script src="js/index_pagination.js"></script>
  <script src="js/index_cart.js"></script>
  <script>
  </script>
</body>
</html>