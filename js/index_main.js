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
let currPage = 1;
let maxPage = 0;
const section2 = document.querySelector('.section2'); //Item Container


/* Load All Items */
async function loadItems(data){
  const res = await fetch('includes/index_display_item.inc.php',{method: 'POST', body: data})
              .then(res => res.text())
              .catch(err => console.log('loadItems: '+err));
  return res;
}

/* get page count */
async function getPageCount(category){
  const res = await fetch('includes/index_get_page_number.inc.php', {method: 'POST', body: category})
              .then(res => res.text())
              .catch(err => console.log('Error Getting Page count: ' + err));
  return res;              
}

/* Once DOM is loaded call getItemData which process displayItem */
/* display all items currPage shoud be 1, and itemCategory should be 0 ind. all */
document.addEventListener('DOMContentLoaded', function(){
  getItemData();
  getPageNumber();
});

function getItemData(){
  let formData = new FormData();
  formData.append('item_category', itemCategory);
  formData.append('page', currPage);
  loadItems(formData)
  .then(data => {
    let items = JSON.parse(data);
    section2.innerHTML = '';
    displayItem(items);
    // console.log(data);
  })
  .catch(err => console.log(err));
}

function displayItem(item){
  if(item.length > 0){
    /* get localStorage list to check for cart item if include adjust cart png */
    let localStorageItem = JSON.parse(localStorage.getItem('cart'));
    item.forEach(data => {
      let itemContainer = document.createElement('DIV');
      itemContainer.class = 'item-container';
      itemContainer.innerHTML = `
      <div class="item-container">
  
        <div class="i-c-a">
          <a href="javascript:void(0)" onclick="itemModalExt(this);">
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
              <p>P <span class="i-price">${parseFloat(data.item_price.length) <= 0 ? 'Free' : parseInt(data.item_price) <= 0 ? parseFloat(data.item_price) :parseFloat(data.item_price).toFixed(2)}</span></p>
            </div>
            <div class="a-c-c-2">
              <a href="javascript:void(0)" onclick="addToCart(this)">
                <input type="hidden" value="${data.item_id}">
                <!--<img src="multimedia/image/others/addtocart.png" alt="">-->
                <img src="multimedia/image/others/${isItemExisted(localStorageItem, data) ? 'addtocart_done.png' : 'addtocart.png'}" alt="">
              </a>
            </div>
          </div>
        </div>
      </div>
    `;
    /* append Template */
    section2.appendChild(itemContainer);
    // console.log(isItemExisted(localStorageItem, data));
    })
  }else{
    section2.innerHTML = 'NO ITEMS FOUND';
  }
  
}



function getPageNumber(){
  let formData = new FormData();
  formData.append('item_category', itemCategory);
  getPageCount(formData)
  .then(data => {
    maxPage = parseInt(Math.ceil(data));
    loadPages();
  })
  .catch(err => console.log(err));
}






/* SELECT Navig  */
const navBtns = document.querySelectorAll('.nav div');
navBtns.forEach(btn => {
  btn.addEventListener('click', function(e){
    if(e.target.classList.contains('nav-all-items')){
      return;
    }

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
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-2':
        itemCategory = 5;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-3':
        itemCategory = 4;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-4':
        itemCategory = 1;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-5':
        itemCategory = 2;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-6':
        itemCategory = 3;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      case 'nav-item-7':
        itemCategory = 7;
        currPage = 1;
        getItemData();
        getPageNumber();
        break;
      default:
        itemCategory = 0;
    }
  })
})

const allCategory = document.querySelector('.nav-all-items');
allCategory.addEventListener('click', function(){
  navBtns.forEach(btnReset => {
    btnReset.style.backgroundColor = 'gray';
    btnReset.firstElementChild.style.color = '#eaeaea';
    btnReset.lastElementChild.style.color = 'rgb(202, 202, 202)';
  });
  
  itemCategory = 0;
  currPage = 1;
  getItemData();
  getPageNumber();
});




/* SEARCH ITEM ajax*/
const searchBtn = document.querySelector('.input-group-append');
const searchText = document.querySelector('#search_que');
const searchBy = document.querySelector('#search_by_id');
const searchCategory = document.querySelector('#search_by_category');
searchBtn.addEventListener('click', searchItem);
function searchItem(e){
  const text = searchText.value.trim().toLowerCase();
  if(text.length <= 0){
    itemCategory = 0;
    currPage = 1;
    getItemData();
    getPageNumber();
    return;
  }

  let formData = new FormData();
  formData.append('search_que', text);
  formData.append('search_by', searchBy.value);
  formData.append('search_category', searchCategory.value);
  fetch('includes/index_search_item.inc.php', {method: 'POST', body: formData})
  .then(res => res.text())
  .then(data => {
    let items = JSON.parse(data);
    section2.innerHTML = '';
    displayItem(items);
  })
  .catch(err => console.log(err));
 
}


/* drawer */
const drawBtn = document.querySelector('.sec1-drawer');
drawBtn.addEventListener('click', drawOption);
function drawOption(e){
  const draw = drawBtn.previousElementSibling;
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
    //window.history.back();
  }
  /* console.log(thisEvent); */
}
function itemModalExt(e){
 
  if(itemModalShow.classList.contains('open')){
    itemModalShow.firstElementChild.classList.remove('open');
    setTimeout(() => {
      itemModalShow.classList.remove('open');
      itemModalShow.innerHTML = '';
    }, 300)
    /* localStorage.removeItem('cartBtn'); */
  }else{
    const itemId = e.nextElementSibling.value;
    let formData = new FormData();
    formData.append('item_id', itemId);

    fetch('includes/index_modal_item.inc.php', {method: 'POST', body: formData})
    .then(res => res.text())
    .then(data => {
      let dataObject = JSON.parse(data);
      if(objectLenght(dataObject) > 0){
        // console.log(dataArray);
        itemModalShow.innerHTML = itemModalTemplate(dataObject);
      }else{
        itemModalShow.innerHTML = itemModalTemplate({});
      }
      itemModalShow.classList.add('open');
      setTimeout(() => {
        itemModalShow.firstElementChild.classList.add('open');
      }, 100)
      // console.log(itemId.value);
      accBtn = document.querySelectorAll('.item-acc');
      accBtn.forEach(btn => {
        btn.addEventListener('click', showAcc);
      });
    })
    .catch(err => console.log(err));
    
    /* localStorage.setItem('cartBtn', e.outerHTML); */
  }
  
}

function itemModalTemplate(dataObject){
  // let localStorageItem = JSON.parse(localStorage.getItem('cart'));
  let addCartLogo = isItemExisted(JSON.parse(localStorage.getItem('cart')), dataObject) ? 'addtocart_done.png' : 'addtocart.png';
  if(objectLenght(dataObject) === 0){
    return `
        <div class="item-modal ">
        <div class="item-modal-close">&times;</div>
        <div class="item-modal-image">
          <div class="m-i">
          <img src="multimedia/image/mobo/01-3462.png" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/mobo/01-3462.png" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/mobo/01-3462.png" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/mobo/01-3462.png" alt="img">
          </div>
        </div>

        <div class="item-modal-info">
          <h4 class="item-acc">Overview<span class="acc-plus">&plus;</span></h4>
          <div class="item-overview acc">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum sapiente, delectus impedit at omnis neque et! Quo, perspiciatis exercitationem. Voluptates deserunt blanditiis molestiae labore cupiditate, incidunt ipsam ullam, est adipisci ipsa qui rerum eum dicta. Consequatur sit assumenda numquam non.</p>
          </div>
          <h4 class="item-acc">Information<span class="acc-plus">&plus;</span></h4>
          <div class="item-details acc">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum sapiente, delectus impedit at omnis neque et! Quo, perspiciatis exercitationem. Voluptates deserunt blanditiis molestiae labore cupiditate, incidunt ipsam ullam, est adipisci ipsa qui rerum eum dicta. Consequatur sit assumenda numquam non.</p>
          </div>
          <h4 class="item-acc">Specification <span class="acc-plus">&plus;</span></h4>
          <div class="item-specification acc">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eum sapiente, delectus impedit at omnis neque et! Quo, perspiciatis exercitationem. Voluptates deserunt blanditiis molestiae labore cupiditate, incidunt ipsam ullam, est adipisci ipsa qui rerum eum dicta. Consequatur sit assumenda numquam non.</p>
          </div>

          <!-- <div class="item-redirect">
            s
          </div> -->
        </div>

        <div class="item-redirect2">
          <div class="redirect-item">
            <a href="javascript:void(0)">
              <img src="multimedia/image/others/addtocart.png" alt="">
            </a>
          </div>
          <div class="redirect-item">
            <a href="details.php">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
              </svg>
            </a>
            <p>More Details</p>
          </div>
        </div>

      </div>
    `;
  }else{
    return `
        <div class="item-modal ">
        <div class="item-modal-close">&times;</div>
        <div class="item-modal-image">
          <div class="m-i">
            <img src="multimedia/image/${dataObject.item_path}/${dataObject.item_image}" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/${dataObject.item_path}/${dataObject.item_image}" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/${dataObject.item_path}/${dataObject.item_image}" alt="img">
          </div>
          <div class="m-i">
            <img src="multimedia/image/${dataObject.item_path}/${dataObject.item_image}" alt="img">
          </div>
        </div>

        <div class="item-modal-info">
          <h4 class="modal-item-name">${dataObject.item_name}</h4>
          <h6 class="modal-item-sub-name">${dataObject.item_sub_name}</h6>
          <h5 class="modal-item-price">P 20,000 srp <span class="modal-item-discount">-51% sale!</span></h5>
          <h4 class="item-acc">Overview<span class="acc-plus">&plus;</span></h4>
          <div class="item-overview acc">
            <p>${dataObject.item_overview.length > 0 ? dataObject.item_overview : 'Not Available'}</p>
          </div>
          <h4 class="item-acc">Information<span class="acc-plus">&plus;</span></h4>
          <div class="item-details acc">
            <p>${dataObject.item_information.length > 0 ? dataObject.item_information : 'Not Available'}</p>
          </div>
          <h4 class="item-acc">Specification <span class="acc-plus">&plus;</span></h4>
          <div class="item-specification acc">
            <p>${dataObject.item_specification.length > 0 ? dataObject.item_specification : 'Not Available'}</p>
          </div>

          <!-- <div class="item-redirect">
            s
          </div> -->
        </div>

        <div class="item-redirect2">
          <div class="redirect-item">
            <a href="javascript:void(0)" onclick="addToCart(this)">
              <input type="hidden" value="${dataObject.item_id}">
              <img src="multimedia/image/others/${addCartLogo}" alt="">
            </a>
          </div>
          <div class="redirect-item">
            <a href="details.php">
              <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-info-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
              </svg>
            </a>
            <p>More Details</p>
          </div>
        </div>

      </div>
    `;
  }

}

//object lenght via key int
function objectLenght(obj){
  let key = Object.keys(obj);
  return key.length;
}

/* Item Modal Accordion */
let accBtn = document.querySelectorAll('.item-acc');

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
