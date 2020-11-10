/* GLOBAL var */
/* itemCategory number meaning 
*0 - all items
*1 - Mobo /CPU
*2 - Chasis / Rig
*3 - Graphics Card
*4 - Monitor
*5 - Keyboard
*6 - Mouse
* */
let itemCategory = 0;
const section2 = document.querySelector('.section2'); //Item Container


/* Load All Items */
async function loadItems(data){
  const res = await fetch('includes/index_display_item.inc.php',{method: 'POST', body: data})
              .then(res => res.text())
              .catch(err => console.log('loadItems: '+err));
  return res;
}


/* Once DOM is loaded call getItemData which process displayItem */
document.addEventListener('DOMContentLoaded', function(){
  getItemData();
});

function getItemData(){
  let formData = new FormData();
  formData.append('item_category', itemCategory);
  loadItems(formData)
  .then(data => {
    let items = JSON.parse(data);
    section2.innerHTML = '';
    displayItem(items);
  })
  .catch(err => console.log(err));
}

function displayItem(item){
  if(item.length > 0){
    item.forEach(data => {
      let itemContainer = document.createElement('DIV');
      itemContainer.class = 'item-container';
      itemContainer.innerHTML = `
      <div class="item-container">
  
        <div class="i-c-a">
          <a href="#" onclick="itemModalExt();">
            <img src="multimedia/image/${data.item_path}/${data.item_image}" alt="">
          </a>
          <input type="hidden" value="${data.item_id}">
        </div>
        <div class="i-c-b">
          <h5>${data.item_name}</h5>
          <p>${data.item_sub_name}</p>
          <!-- Add to Cart Container -->
          <div class="a-c-c">
            <div class="a-c-c-1">
              <p>P <span class="i-price">2000</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javacript:void(0)">
                <img src="multimedia/image/others/addtocart.png" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    `;
    /* append Template */
    section2.appendChild(itemContainer);
    })
  }else{
    section2.innerHTML = 'NO ITEMS FOUND';
  }
  
}



/* SELECT Navig  */
const navBtns = document.querySelectorAll('.nav div');
navBtns.forEach(btn => {
  btn.addEventListener('click', function(){
    navBtns.forEach(btnReset => {
      btnReset.style.backgroundColor = 'gray';
      btnReset.firstElementChild.style.color = '#eaeaea';
      btnReset.lastElementChild.style.color = 'rgb(202, 202, 202)';
    })
    this.style.backgroundColor = '#f5a442';
    this.firstElementChild.style.color = 'rgb(30,30,30)';
    this.lastElementChild.style.color = 'black';
    switch(this.className){
      case 'nav-item-1':
        itemCategory = 6;
        getItemData();
        break;
      case 'nav-item-2':
        itemCategory = 5;
        getItemData();
        break;
      case 'nav-item-3':
        itemCategory = 4;
        getItemData();
        break;
      case 'nav-item-4':
        itemCategory = 1;
        getItemData();
        break;
      case 'nav-item-5':
        itemCategory = 2;
        getItemData();
        break;
      case 'nav-item-6':
        itemCategory = 3;
        getItemData();
        break;
      case 'nav-item-7':
        itemCategory = 7;
        getItemData();
        break;
      default:
        itemCategory = 0;
    }
  })
})






/* drawer */
const drawBtn = document.querySelector('.sec1-drawer');
drawBtn.addEventListener('click', drawOption);
function drawOption(e){
  const draw = e.target.previousElementSibling;
  if(draw.classList.contains('open')){
    draw.classList.remove('open');
    drawBtn.classList.remove('open');
  }else{
    draw.classList.add('open');
    drawBtn.classList.add('open');
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
