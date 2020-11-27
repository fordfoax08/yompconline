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
          <a href="details.php?v=${item_id}" class="view-item" target="_blank">
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


/* ADD TO CART */

function addToCart(e){
  const itemId = e.firstElementChild.value;
  let formData = new FormData();
  formData.append('item_id', itemId);

  fetch('includes/index_cart_item.inc.php', {method : 'POST', body : formData})
  .then(res => res.text())
  .then(data => {
    addToCartLocal(data,e);
  })
  .catch(err => console.log(err));
  

  // console.log(itemId);
}

/* accepts string JSON  from DB, and set data to local storage */
function addToCartLocal(dataObj,e){
  const data = JSON.parse(dataObj);
  let cartItem = {
    item_id : data.item_id,
    item_name : data.item_name,
    item_path : data.item_path,
    item_image : data.item_image,
    item_price : data.item_price,
    item_discount : data.item_discount,
    item_available : data.item_available,
    pcs_item : 1
  };

  if(localStorage.getItem('cart') == null){
    localStorage.setItem('cart', JSON.stringify([cartItem]));  
  }else{
    let localData = JSON.parse(localStorage.getItem('cart'));
    if(isItemExisted(localData, cartItem)){
      /* remove item from the list */
      let newData = localData.filter(item => item.item_id !== cartItem.item_id);
      localStorage.setItem('cart', JSON.stringify(newData));
      e.lastElementChild.src = 'multimedia/image/others/addtocart.png';
      cartItemCount(); //update cart number indicator
      /* update DB */
      addToCartDatabase();
      /* update Cart Display */
       updateCartDisplay();
      /* cartBtn before modal */
      
    }else{
      localData.push(cartItem);
      localStorage.setItem('cart', JSON.stringify(localData));  
      e.lastElementChild.src = 'multimedia/image/others/addtocart_done.png';
      cartItemCount(); //update cart number indicator
      /* UPDATE DB */
      addToCartDatabase();
      /* update Cart Display */
      updateCartDisplay();
      // console.log(JSON.parse(localStorage.getItem('cart')));

      /* animation test */
      /* let newDiv = document.createElement('DIV');
      newDiv.setAttribute('class','cart-added-anim');
      newDiv.innerHTML = 'SAMPLE';
      e.insertBefore(newDiv, e.lastElementChild); */
      // console.log(e)
    }
  }



}


/* ADD CART to DB
*if user is logged in upload 
*/
function addToCartDatabase(){
  const userId = document.querySelector('#user_id');
  const data = JSON.parse(localStorage.getItem('cart'));
  /* if theres an item in cart */
  if(data.length > 0){
    /* if user is logged in */
    if(userId.value.length > 0){
      let formData = new FormData();
      formData.append('cart_data', JSON.stringify(data));
      /* Update DB php AJAX */
      fetch('includes/index_add_cart.inc.php', {method : 'POST', body : formData})
      .then(res => res.text())
      .then(data => {
        // console.log(data)
      })
      .catch(err => console.log(err));
      // console.log(userId.value.length);
    }
  }else{
    /* if cart is empty while user is logged In */
    if(userId.value.length > 0){
      let formData = new FormData();
      formData.append('cart_data', JSON.stringify(data));
      /* update DB php Ajax empty db */
      fetch('includes/index_add_cart.inc.php', {method : 'POST', body : formData})
      .then(res => res.text())
      .then(data => {

        // console.log(data);
      })
      .catch(err => console.log(err));
    }
  }
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
      addToCartDatabase();
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
        addToCartDatabase();
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
    addToCartDatabase();
  }else{
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    /* Run Script if No */
    inputQuantity.value = 1;
    /* update Item Quantity in localStorage */
    updateItemQuantity(itemId,inputQuantity);
    /* Update DB user cart item */
    addToCartDatabase();
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
    localStorage.setItem('action',JSON.stringify({redirect: 'check_out.inc.php'}));
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
    window.location.href = 'register.php';
  }else{
    confirmCustom.classList.remove('active');
    confirmCustom.firstElementChild.innerHTML = '';
  }
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




