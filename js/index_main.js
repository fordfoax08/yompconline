/* SELECT  */
const navBtns = document.querySelectorAll('.nav div');
navBtns.forEach(btn => {
  btn.addEventListener('click', function(){
    this.style
  })
})






/* drawer */
const drawBtn = document.querySelector('.sec1-drawer');
drawBtn.addEventListener('click', drawOption);
function drawOption(e){
  const draw = e.target.previousElementSibling;
  if(draw.classList.contains('open')){
    draw.classList.remove('open');
  }else{
    draw.classList.add('open');
  }
}



/* ITEM MODAL */
/* Show Item Modal */
const itemModalShow = document.querySelector('.item-modal-container');
itemModalShow.addEventListener('click', showItemModal);
function showItemModal(e){
  const thisEvent = e.target;
  if(thisEvent.classList.contains('item-modal-container') || thisEvent.classList.contains('item-modal-close')){
    itemModalExt();
    window.history.back();
  }
  /* console.log(thisEvent); */
}
function itemModalExt(){
  if(itemModalShow.classList.contains('open')){
    itemModalShow.firstElementChild.classList.remove('open');
    setTimeout(() => {
      itemModalShow.classList.remove('open');
    }, 300)
  }else{
    itemModalShow.classList.add('open');
    setTimeout(() => {
      itemModalShow.firstElementChild.classList.add('open');
    }, 100)
  }
}



/* Item Modal Accordion */
const accBtn = document.querySelectorAll('.item-acc');
accBtn.forEach(btn => {
  btn.addEventListener('click', showAcc);
})
function showAcc(e){
  const thisAcc = e.target;
  const thisPlus = thisAcc.firstElementChild;
  let ht = thisAcc.nextElementSibling.scrollHeight;
  if(thisAcc.nextElementSibling.classList.contains('open')){
    thisPlus.innerHTML = '&plus;';
    thisAcc.nextElementSibling.style.height =  0;
    thisAcc.nextElementSibling.classList.remove('open')
  }else{
    /* Cloase all accordion that are not selected */
    document.querySelectorAll('.acc').forEach(acc => {
      acc.style.height = 0;
      acc.classList.remove('open');
      acc.previousElementSibling.firstElementChild.innerHTML = '&plus;';
    })
    thisPlus.innerHTML = '&minus;';
    thisAcc.nextElementSibling.style.height =  ht+'px';
    thisAcc.nextElementSibling.classList.add('open')
  }
  
  /* console.log(thisPlus); */
}


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
    setTimeout(()=>{
      cartShow.classList.remove('open');
    },400)
  }else{
    cartShow.classList.add('open');
    setTimeout(()=>{
      cartShow.firstElementChild.classList.add('open');
    },100)
  }
}

/* USER LOGIn *******/
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
