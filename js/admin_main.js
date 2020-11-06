class OpenClose{
  
  
  classContains(_target,_className){
    return _target.classList.contains(_className);
  }

  classAdd(_target,_className,_child=null){
    const targ = document.querySelector(_target);
    if(_child === 1){
      return targ.firstElementChild.classList.add(_className);
    }
    return targ.classList.add(_className);
  }
  classRemove(_target,_className){
    const targ = document.querySelector(_target);
    return targ.classList.remove(_className);
  }

  eventClick(_target,_callback){
    const targ = document.querySelector(_target);
    return targ.addEventListener('click', _callback);
  }

}


/* Variable Global */
let newObj = new OpenClose;
const mainContainer = document.querySelector('.main-container');
const userId = document.querySelector('#user_id');
const tableParent = document.querySelector('.table1 tbody');
let itemData = [];


/* Ajax template 
* @display Data when Doc is loaded
* @for delete / Search
*/
async function getItems(url,data){
  const res = await fetch(url, {method:'POST', body: data})
    .then(res => res.text())
    .then(data => JSON.parse(data))
    .catch(err => console.log(err))
  return res;
}



/* Load Items AJAX */
document.addEventListener('DOMContentLoaded', loadSellerItems);
function loadSellerItems(){
  const user_id = userId.value;
  let formData = new FormData();
  formData.append('user_id', user_id);
  getItems('includes/admin_display_item.inc.php',formData)
  .then(res => displaySellerItems(res));

  //OR code below, original, before using async await
  // fetch('includes/admin_display_item.inc.php', {method: 'POST',body: formData})
  // .then(res => res.text())
  // /* pass array data to display Function */
  // .then(data => displaySellerItems(JSON.parse(data)))
  // .catch(err => console.log(err))
  
}
function displaySellerItems(itemArray){
  itemArray.forEach(item => {
    /* Create element tr */
    let newTr = document.createElement('TR');
    newTr.innerHTML = `
      <tr>
        <td>
          <input type="checkbox" name="productName" class="input-chk">
          <input type="hidden" name="item_id" value="${item.item_id}">
        </td>
        <td><img src="multimedia/image/${item.item_path}/${item.item_image}" alt=""></td>
        <td>
          <p>${item.item_name}</p>
          <p>${item.item_short_desc}</p>
        </td>
        <td>
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
          </svg>
        </td>
      </tr>
    `;
    tableParent.appendChild(newTr);
  })

  /* queryAll Checkboxes */
  allCheckBox = document.querySelectorAll('.input-chk');
  allCheckBox.forEach(item => {
    item.addEventListener('change', function(){
      if(this.checked){
        if(!itemData.indexOf(this.nextElementSibling.value) > -1){
          itemData.push(this.nextElementSibling.value);
        }
      }else{
        // itemData.pop(this.nextElementSibling.value);
        const index = itemData.indexOf(this.nextElementSibling.value);
        if(index > -1){
          itemData.splice(index, 1);
          selectAll.checked = false;
        }
      }
    })
  })
}

/* SEARCH AJAX */
const searchBtn = document.querySelector('#searchBtn');
const searchInpt = document.querySelector('#search_item');
let searchLimit = 10; //Continue Tommorrow
searchBtn.addEventListener('click', getSearch);
function getSearch(e){
  let data1 = searchInpt.value.toLowerCase().trim();
  let formData = new FormData();
  formData.append('user_id', userId.value);
  formData.append('search_data',data1);

  getItems('includes/admin_search_item.inc.php',formData)
  .then(res => {
    tableParent.innerHTML = '';
    displaySellerItems(res)
  });

  // fetch('includes/admin_search_item.inc.php',{
  //   method: 'POST',
  //   // headers: {'Content-Type':'multipart/form-data'},
  //   body: formData
  // })
  // .then(res => res.text())
  // .then(data => {
  //   tableParent.innerHTML = '';
  //   displaySellerItems(JSON.parse(data));
  // })
  // .catch(err => console.log(err));

}


/* AJAX delete Item and refresh list */
const deleteBtn = document.querySelector('#delete-item');
deleteBtn.addEventListener('click', deleteItem);
function deleteItem(e){
  if(itemData.length === 0){
    return;
  }
  if(!confirm('Are you sure you wan\'t to remove item/s?')){
    return;
  }

  let formData = new FormData();
  formData.append('item_name',JSON.stringify(itemData));
  
  /* fetch('includes/remove_item.inc.php', {method: 'POST', body: formData})
  .then(res => res.text())
  .then(data => {
    console.log(data)
  })
  .catch(err => console.log(err)) */

  getItems('includes/remove_item.inc.php', formData)
  .then(data => {
    tableParent.innerHTML = '';
    displaySellerItems(data);
  })
  .catch(err => console.log(err))

  // console.log(formData);
}








/* Menu Drawer */
const menuBtn = document.querySelector('.menu-drawer-container');
const menuDock = document.querySelector('.menu-container');
menuBtn.addEventListener('click', drawMenu);
menuDock.addEventListener('click', menuDockOpen);
function drawMenu(e){
  const eT = e.target;
  if(eT.classList.contains('menu-drawer-container') || eT.classList.contains('menu-drawer')){
    draw();
  }
  /* console.log(e.target); */
}
function menuDockOpen(e){
  if(e.target.classList.contains('menu-container')){
    draw();
  }
}
function draw(){
  if(menuBtn.classList.contains('open')){
    menuBtn.classList.remove('open');
    draw2();
  }else{
    menuBtn.classList.add('open');
    draw2();
  }
}
function draw2(){
  if(menuDock.classList.contains('close')){
    menuDock.classList.remove('close');
    setTimeout(()=>{
      menuDock.firstElementChild.classList.remove('close');
    }, 100)
  }else{
    menuDock.firstElementChild.classList.add('close');
    setTimeout(()=>{
      menuDock.classList.add('close');
    }, 200)
  }
}


/* Menu 2 open */
/* .menu1 element class name
  showMenu1 is a callback function
*/
newObj.eventClick('.menu1',showMenu1);
newObj.eventClick('.menu2', showMenu2);
/* classRemove and classAdd
  .classRemove(#targetElement#,#class-name-to-remove#)
*/
function showMenu1(e){
  newObj.classRemove('.main-container','sec2');
}
function showMenu2(e){
  newObj.classAdd('.main-container','sec2');
}




/* Add specification item ************/
const specText = document.querySelector('.spec-input-txt');
const specBtn = document.querySelector('.spec-add-btn');
specBtn.addEventListener('click', addNewSpec);
function addNewSpec(e){
  const ulParent = e.target.parentNode.firstElementChild;
  if(specText.value.trim() === '' || specText.value.trim() === undefined || specText.value.trim().length === 0){
    return
  }

  if(document.querySelectorAll('.specific-container ul li').length >= 5){
    return;
  }

  if(isSpecDuplicate(specText.value)){
    return;
  }else{
    let newLi = document.createElement('LI');
    newLi.innerHTML = `${specText.value}<span class="spec-close">&times;</span>`;
    let specInpt = document.createElement('INPUT');
    specInpt.setAttribute('type','hidden');
    specInpt.setAttribute('name','item_specs['+specNodeCount()+']')
    specInpt.value = specText.value;
    ulParent.appendChild(newLi);
    ulParent.appendChild(specInpt);
    /* Every list created declare btns */
    specCLoseBtn = document.querySelectorAll('.spec-close');
    specCLoseBtn.forEach(btns => btns.addEventListener('click', specClose));
  }
  specText.value = '';
  specText.focus();
  /* console.log(ulList); */
}
function isSpecDuplicate(e){
  const ulList = document.querySelectorAll('.specific-container ul li');
  let boolSample = false;
  ulList.forEach(item =>{
    if(item.firstChild.textContent.toLowerCase() === e.trim().toLowerCase()){
      boolSample = true;
    }
  })
  return boolSample;
}
function specNodeCount(){
  const inputNodes = document.querySelectorAll('.specific-container ul input');
  return inputNodes.length; 
}


/*Remove Specs item  *****/
let specCLoseBtn;
function specClose(e){
  e.target.parentNode.nextElementSibling.remove();
  e.target.parentNode.remove();
}



/* Add ITEMS INCLUDED */
const itemIncText = document.querySelector('.item-included-input');
const itemIncBtn = document.querySelector('.item-included-btn');
itemIncBtn.addEventListener('click', addNewIncludedItem);
function addNewIncludedItem(e){
  const ulParent = document.querySelector('.item-included-container ul');
  if(itemIncText.value.trim() === undefined || itemIncText.value.trim() === "" || itemIncText.value.trim() === null){
    return;
  }/* Check if input is empty return false */
  if(document.querySelectorAll('.item-included-container ul li').length >= 8){
    itemIncText.value = "";
    return;
  }/* Check if number li exceeds 8 return false */
  if(isItemDuplicate(itemIncText.value)){
    return;
  }else{
    let newLi = document.createElement('LI');
    newLi.innerHTML = `${itemIncText.value}<span class="item-list-close">&times;</span>`;
    let newHidden = document.createElement('INPUT');
    newHidden.setAttribute('type','hidden');
    newHidden.setAttribute('name','item_included[]');
    newHidden.value = itemIncText.value;
    ulParent.appendChild(newLi);
    ulParent.appendChild(newHidden);
    itemIncClose = document.querySelectorAll('.item-list-close');
    itemIncClose.forEach(item => item.addEventListener('click', removeItemInclude));
  }
  itemIncText.value = "";
  itemIncText.focus();
}
function isItemDuplicate(str){
  const ulLi = document.querySelectorAll('.item-included-container ul li');
  let boolSample = false;
  ulLi.forEach(list => {
    if(list.firstChild.textContent.toLowerCase() === str.trim().toLowerCase()){
      boolSample = true;
    }
  })
  return boolSample;
}

/* REMOVE item included****** */
let itemIncClose;
function removeItemInclude(e){
  e.target.parentNode.nextElementSibling.remove();
  e.target.parentNode.remove();
}


/* Button Submit new Item */
const btnSubmitNewItem = document.querySelector('.btn-new-item');
const formInpt = document.querySelector('.inpts');
btnSubmitNewItem.addEventListener('click', submitNewItem);
function submitNewItem(e){
  /* e.target.parentNode.submit(); */
  let isReady = true;
  let formData = new FormData();
  formData.append('item_image', document.querySelector('#item_image').files[0]);
  
  /* Check for required fields */
  if(document.querySelector('input[name="item_name"]').value === ''){
    isReady = false;
    document.querySelector('input[name="item_name"]').style.backgroundColor = '#f0a8a8';
  }
  if(document.querySelector('#item_short_desc').value === ''){
    isReady = false;
    document.querySelector('#item_short_desc').style.backgroundColor = '#f0a8a8';
  }
  if(document.querySelector('#item-category').value == '0'){
    isReady = false;
    document.querySelector('#item-category').style.backgroundColor = '#f0a8a8';
  }
  if(document.querySelector('#item_available').value === ''){
    isReady = false;
    document.querySelector('#item_available').style.backgroundColor = '#f0a8a8';
  }


  
  formInpt.childNodes.forEach(child =>  {
    if(child.name){
      /* If input has value continue */
      if(child.value){
        child.style.backgroundColor = '#ffffff';
        formData.append(child.name, child.value);
      }
    }
    else{
      if(child.tagName === 'DIV'){
        let childNode = child.firstElementChild.childNodes;
        childNode.forEach(children => {
          if(children.name){
            // console.log(children);
            formData.append(children.name,children.value);
          }
        })
      }
      
    }
  })

  /* if isReady is TRUE, then save to DB */
  if(isReady){
    fetch('includes/admin_add_item.inc.php',{method: 'POST', body: formData})
    .then(res => res.text())
    .then(data => {
      if(parseInt(data) > 0){
        /* Empty all input fields */
        formInpt.reset();
        document.querySelector('.specific-ul').innerHTML = '';
        document.querySelector('.included-ul').innerHTML = '';
      }
    })
    .catch(err => console.log(err));
    itemAlert('Item Added!');
  }else{
    // alert('Fill required Fields');
    itemAlert('Complete All Required Field!');
  }
}







/* Select All Items */
const selectAll = document.querySelector('#select_all');
//ready allcheckbox var
let allCheckBox = undefined;
selectAll.addEventListener('change', selectAllCheck);
function selectAllCheck(e){
  if(allCheckBox.length === 0 || allCheckBox === undefined){
    return;
  }
  if(selectAll.checked){
    itemData = [];
    allCheckBox.forEach(item => {
      item.checked = true;
      /* populate itemData item_id from hidden input */
      itemData.push(item.nextElementSibling.value);
    });
  }else{
    allCheckBox.forEach(item => {
      item.checked = false;
      itemData = [];
      // itemData.pop(item.nextElementSibling.value);
    });
    ;
  }
}


/* For Function itemAlert */
function itemAlert(msg){
  const a = document.querySelector('.item-alert');
  const b = document.querySelector('.item-alert-container'); 
  b.firstChild.innerHTML = msg;
  a.classList.add('open');
  setTimeout(() => {
    b.classList.add('open');
    setTimeout(()=>{
      b.classList.remove('open');
      setTimeout(()=>{a.classList.remove('open')}, 500)
    },2000)
  }, 100)
}


