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
      /* cartBtn before modal */
      
    }else{
      localData.push(cartItem);
      localStorage.setItem('cart', JSON.stringify(localData));  
      e.lastElementChild.src = 'multimedia/image/others/addtocart_done.png';
      cartItemCount(); //update cart number indicator
    }
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


/* cart number indicator */
function cartItemCount(){
  let cartIndicator = document.querySelector('.cart-item-indicator');
  let localStorageData = JSON.parse(localStorage.getItem('cart'));
  if(localStorageData.length == 0){
    cartIndicator.classList.remove('show');
  }else{
    cartIndicator.classList.add('show');
    cartIndicator.innerHTML = localStorageData.length;
  }
}


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
const addQuantityBtn = document.querySelectorAll('.add-btns > button');
addQuantityBtn.forEach(btn => {
  btn.addEventListener('click', addQuantity);
});
function addQuantity(e){
  let inputQuantity = e.target.parentNode.parentNode.firstElementChild;
  if(e.target.classList.contains('plus')){
    inputQuantity.value ++;
  }

  if(e.target.classList.contains('minus')){
    inputQuantity.value --;
    /* chec if inputQuantity is 0 remove item from the list */
    if(inputQuantity.value < 1){
      if(confirm('Remove this item from add to cart?')){
        /* parent Element / container of item */
        e.target.parentNode.parentNode.parentNode.parentNode.remove();
      }
    }
  }
  // console.log(inputQuantity);
}


