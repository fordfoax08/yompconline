'use strict';
let isUserLoggedIn = false;

async function getStatus(){
  const fetched = await fetch('includes/login_status.inc.php');
  const res = await fetched.text();
  const data = await JSON.parse(res);
  return data; 
}

(function(){
  loadCartData();
})();


/* CART VIEW********** */
const cartShow = document.querySelector('.cart-modal-container');
cartShow.addEventListener('click', showCart);
function showCart(e){
  const targetThis = e.target;
  if(targetThis.classList.contains('modal-close') || targetThis.classList.contains('cart-modal-container')){
    cartToggle();
  }
  return false;
}
function cartToggle(){
  if(cartShow.classList.contains('open')){
      cartShow.firstElementChild.classList.remove('open');
      cartShow.firstElementChild.style.overflow = 'hidden';
    setTimeout(()=>{
      cartShow.classList.remove('open');
    },700)
  }else{
    cartShow.classList.add('open');
    setTimeout(()=>{
      cartShow.firstElementChild.classList.add('open');
      setTimeout(()=>{
        cartShow.firstElementChild.style.overflow = 'visible';
      }, 700);
    },100);
  }
}


  /* USER LOGIn */
  const userLoginModal = document.querySelector('.user-login-container');
  userLoginModal.addEventListener('click', toggleLogin);

  function toggleLogin(e){
    if(e.target.classList.contains('user-login-container') || e.target.classList.contains('user-login-a-close')){
      if(!userLoginModal.classList.contains('close')){
        userLoginModal.firstElementChild.classList.add('close');
        setTimeout(() =>{
          userLoginModal.classList.add('close');
        }, 400);
      }
    }
  }
  function toggleLoginOpen(){
    userLoginModal.classList.remove('close');
      setTimeout(() =>{
        userLoginModal.firstElementChild.classList.remove('close');
      }, 100);
  }


  /* Back Btn */
  const btnBackShop = document.querySelector('.back-to-shop');
  btnBackShop.addEventListener('click',() => {
    window.close();
  });




  /* CART************************** */

  /* LOAD CART */
/* load Cart item */
function loadCartData(){
  if(localStorage.getItem('cart') === null){
    localStorage.setItem('cart',JSON.stringify([]));
  }else{
    /* display item count indicator */
    cartItemCount();
  }
  /* update Cart Display */
  updateCartDisplay();
}

/* CART DISPLAY */
function updateCartDisplay(){
  let totalPriceDisplay = document.querySelector('.total-price');
  let cartContainer = document.querySelector('.cart-item-container');
  const cartData = JSON.parse(localStorage.getItem('cart'));
  if(cartData.length > 0){
    cartContainer.innerHTML = '';
    cartData.forEach(item => {
      const {item_id,item_discount,item_price,item_path,item_image,item_name,pcs_item} = item;
      let newDiv = document.createElement('DIV');
      newDiv.setAttribute('class','cart-item')
      newDiv.innerHTML = `
        <div class="c-i qtyy"></div>
        <div class="c-i">
          <img src="multimedia/image/${item_path}/${item_image}" width="40px" alt="item">
        </div>
        <div class="c-i">
          <a href="details.php?v=${item_id}" class="view-item">
            ${item_name}
          </a>
        </div>
        <div class="c-i">
          <span class="item-price">${item_price}</span>
          <span class="item-sub-price">${((item_price - ((item_discount / 100) * item_price)) * pcs_item).toFixed(2)}</span>
          <input type="hidden" value="${item_discount/100}">
        </div>
        <div class="c-i">
          <div class="add-item">
            <input type="number" name="qty" class="item-qty" value="${pcs_item}" disabled>
            <div class="add-btns">
              <button class="plus">&plus;</button>
              <button class="minus">&minus;</button>
            </div>
            <input type="hidden" value="${item_id}">
          </div>
        </div>
      `;
      cartContainer.appendChild(newDiv);
      // console.log(item.item_name);
    })
    /* for total Price */
    let totalPrice = cartData.reduce((acc,item) => {
      return ((item.item_price - ((item.item_discount / 100) * item.item_price)) * item.pcs_item) + acc;
    },0);
    /* update Total */
    totalPriceDisplay.innerHTML = totalPrice.toFixed(2);
    /* update buttons */
    updateCartDisplayBtns();
  }else{
    cartContainer.innerHTML = '';
    let newDiv = document.createElement('DIV');
    newDiv.setAttribute('class','cart-empty');
    newDiv.innerHTML = 'Empty Cart Shop now.';
    cartContainer.appendChild(newDiv); 
  }
  /* update cart number Indicator */
  cartItemCount();
}







/* cartDisplay button function */

function updateCartDisplayBtns(){
  
  /* item quantity input */
  let itemQtyBtn = document.querySelectorAll('.item-qty');
  itemQtyBtn.forEach(btn => {
    btn.addEventListener('change', itemQty);
  });
  function itemQty(e){
    if(e.target.value < 1){
      e.target.value = 1;
    }
    // console.log(e.target);
  }
  
  /* Add item quantity Button */
  const addRemoveQuantityBtn = document.querySelectorAll('.add-btns > button');
  addRemoveQuantityBtn.forEach(btn => {
    btn.addEventListener('click', addRemoveQuantity);
  });
  function addRemoveQuantity(e){
    let inputQuantity = e.target.parentNode.parentNode.firstElementChild;
     /* get item id to be used to filter out from exiting data */
     const itemId = e.target.parentNode.nextElementSibling.value;
    if(e.target.classList.contains('plus')){
      inputQuantity.value ++;
      /* update Quantity */
      updateItemQuantity(itemId,inputQuantity);
      /* Update DB user cart item */
      // addToCartDatabase();
    }
  
    if(e.target.classList.contains('minus')){
      inputQuantity.value --;
      /* chec if inputQuantity is 0 remove item from the list */
      if(inputQuantity.value < 1){
        customConfirmRemove(e,itemId,inputQuantity);
        // if(confirm('Remove this item from add to cart?')){
        //   /* get items in cartdata */
        //   const cartItem = JSON.parse(localStorage.getItem('cart'));
        //   /* filtered cartItem */
        //   let newCartData = cartItem.filter(data => data.item_id !== itemId);
        //   /* Jsonify and set to localStorage the updated data */
        //   localStorage.setItem('cart',JSON.stringify(newCartData));
        //   /* parent Element / container of item */
        //   e.target.parentNode.parentNode.parentNode.parentNode.remove();
        //   /* update cart display */
        //   updateCartDisplay();
        //   // console.log(newCartData);
        //   /* Update DB user cart item */
        //    addToCartDatabase();
        // }else{
        //   inputQuantity.value = 1;
        //   /* update Item Quantity in localStorage */
        //   updateItemQuantity(itemId,inputQuantity);
        //   /* Update DB user cart item */
        //   addToCartDatabase();
        // }
      }else{
        /* update Item Quantity in localStorage */
        updateItemQuantity(itemId,inputQuantity);
        /* Update DB user cart item */
        // addToCartDatabase();
      }

    }
    // console.log(inputQuantity);

  }
}


/* custom confirm box for removing item from Cart */
const customConfirmRemove = async (e,itemId,inputQuantity) => {
  const resolve = await ui.confirm('Are you sure you wants to remove this Item?');
  if(resolve){
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    /* Run Script if yes*/
    /* get items in cartdata */
    const cartItem = JSON.parse(localStorage.getItem('cart'));
    /* filtered cartItem */
    let newCartData = cartItem.filter(data => data.item_id !== itemId);
    /* Jsonify and set to localStorage the updated data */
    localStorage.setItem('cart',JSON.stringify(newCartData));
    /* parent Element / container of item */
    e.target.parentNode.parentNode.parentNode.parentNode.remove();
    /* update cart display */
    updateCartDisplay();
    // console.log(newCartData);
    /* Update DB user cart item */
    // addToCartDatabase();
  }else{
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    /* Run Script if No */
    inputQuantity.value = 1;
    /* update Item Quantity in localStorage */
    updateItemQuantity(itemId,inputQuantity);
    /* Update DB user cart item */
    // addToCartDatabase();
  }
}




/* update quantity 2 params itemId qty val */
function updateItemQuantity(itemId, itemQty){
  /* get items of cart in localStorage */
  let cartItem = JSON.parse(localStorage.getItem('cart'));
  /* update psc_item using Map */
  let newCartData = cartItem.map(item => {
    if(item.item_id == itemId){
      if(parseInt(item.item_available) < itemQty.value){
        item.pcs_item = parseInt(item.item_available);
      }else{
        item.pcs_item = parseInt(itemQty.value);
      }
      return item;
    }else{
      return item;
    }
  });

  /* convert newCartData to JSON string to be set in localStorage */
  localStorage.setItem('cart',JSON.stringify(newCartData));
  /* update cart Display */
  updateCartDisplay();
}




/* Check out */
const checkoutBtn = document.querySelector('#checkout');
checkoutBtn.addEventListener('click', checkoutCart);
function checkoutCart(e){
  const cartData = JSON.parse(localStorage.getItem('cart'));
  if(cartData.length <= 0) return;
  if(!isUserLoggedIn){
    confirmContinueCheckBox();
  }
}
/* custom confirm for checkout */
const confirmContinueCheckBox = async () =>{
  const reslove = await ui.confirm('Login before continue');
  if(reslove){
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    window.location.href = 'register.php';
  }else{
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
  }
}

/* Function pop up */
let confirmCustom = document.querySelector('.confirm-container');

const ui = {
  confirm : async (msg) => createConfirm(msg)
};

const createConfirm = (msg) => {
  let template = `
    <p>${msg}</p>
    <div class="btn-confirm-container">
      <button class="yesConfirm">Yes</button>
      <button class="noConfirm">No</button>
    </div>
  `;
  confirmCustom.classList.add('active');
  confirmCustom.firstElementChild.innerHTML = template;

  return new Promise((resolve,reject) => {
    document.querySelector('.yesConfirm').addEventListener('click',function(){
      resolve(true);
    });
    document.querySelector('.noConfirm').addEventListener('click',function(){
      resolve(false);
    });
  });
}

const areYouSure = async () =>{
  const resolve = await ui.confirm('Are you sure?');
  if(resolve){
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    // console.log('Yes');
    return true;
  }else{
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    // console.log('No');
    return false;
  }

  // return false;
}


/* ********************************************* */
/* Function for cart number indicator */
function cartItemCount(){
  let cartIndicator = document.querySelector('.cart-item-indicator');
  let localStorageData = JSON.parse(localStorage.getItem('cart'));
  if(localStorageData.length == 0){
    cartIndicator.classList.remove('show');
  }else{
    cartIndicator.classList.add('show');
    setTimeout(() => {
      cartIndicator.classList.add('anim');
      setTimeout(() => cartIndicator.classList.remove('anim'),800);
    },200);
    cartIndicator.innerHTML = localStorageData.length;
  }
}

/* Function to check existing cart item */
function isItemExisted(arrayData,item){
  let res = false;
  for(let i = 0; i < arrayData.length;i++){
    if(arrayData[i].item_id == item.item_id){
      res = true;
    }
  }
  return res;
}




