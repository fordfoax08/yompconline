class OpenClose{
  
  
  classContains(_target,_className){ //This code is not used
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


class InputCheck{
  isInputLengthValid(str,limit=100){
    if(str.trim().length > limit){
      return false;
    }
    return true;
  }

  isInputWithoutScript(str){
    let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
    if(regex.test(str)){
      return false;
    }
    return true;
  }

}

/* Variable Global */

const mainContainer = document.querySelector('.main-container');
const userId = document.querySelector('#user_id');
const tableParent = document.querySelector('.table1 tbody');
const sortSelect = document.querySelector('#sort_item');
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
  /* Update Item count for pagination purpose */
  updatePage();

  const user_id = userId.value;
  let formData = new FormData();
  formData.append('user_id', user_id);
  formData.append('limit_a', limit);
  formData.append('limit_b', limitOffset);
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
          <input type="hidden" value="${item.item_id}">
          <svg class="edit-item" onclick="openCloseEdit(this);" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
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
const searchOpt = document.querySelector('.search_filter');
const pageContainer = document.querySelector('.page-container');
let searchLimit = 10; //Continue Tommorrow
searchBtn.addEventListener('click', getSearch);
function getSearch(e){
  let data1 = searchInpt.value.toLowerCase().trim();
  if(data1 === ''){
    pageContainer.style.display = 'flex';
    tableParent.innerHTML = '';
    loadSellerItems();
    return;
  }else{
    pageContainer.style.display = 'none';
    let formData = new FormData();
    formData.append('user_id', userId.value);
    formData.append('search_data',data1);
    formData.append('search_option', searchOpt.value);
  
    getItems('includes/admin_search_item.inc.php',formData)
    .then(res => {
      tableParent.innerHTML = '';
      displaySellerItems(res)
    });
  }

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
  selectAll.checked = false;
  let formData = new FormData();
  formData.append('item_name',JSON.stringify(itemData));
  formData.append('sort_by', sortSelect.value);
  formData.append('limit_a', limit);

  getItems('includes/remove_item.inc.php', formData)
  .then(data => {
    tableParent.innerHTML = '';
    // displaySellerItems(data);
    loadSellerItems();
  })
  .catch(err => console.log(err))

  /* Update Item count for pagination purpose */
  updatePage();
}


/* SORT ITEM BY DATE */
/* Sort item list */
sortSelect.addEventListener('change', sortItem);
function sortItem(e){
  let opt = sortSelect.value;
  const user_id = userId.value;
  let formData = new FormData();
  formData.append('user_id', user_id);
  formData.append('sort_by', opt);

  /* Call getItem function */
  getItems('includes/admin_display_item.inc.php', formData)
  .then(res => {
    tableParent.innerHTML = '';
    displaySellerItems(res)
  });

}


/* EDIT ITEM */
const editClose = document.querySelector('.edit-container-close');
const editModal = document.querySelector('.modal-container');

/* DRAW EDIT Close */
editModal.addEventListener('click', closeModalEdit);
function closeModalEdit(e){
  if(e.target.classList.contains('modal-container') || e.target.classList.contains('edit-container-close')){
    openCloseEdit();
    //console.log(e.target);
  }
}

/* toggle EditModal
*Display Item Information for EditModal */
const specificUl = document.querySelector('.specific-ul2');
const includedUl = document.querySelector('.included-ul2');
function openCloseEdit(e){
  if(editModal.classList.contains('open')){
    specificUl.innerHTML = '<!-- Specification Items here -->';
    includedUl.innerHTML = '<!-- <li>EXAMPLE<span class="item-list-close">&times;</span></li> -->';
    editModal.classList.remove('open');
  }else{
    let itemId = e.previousElementSibling.value;
    
    let formData = new FormData();
    formData.append('user_id', userId.value);
    formData.append('item_id', itemId);

    fetch('includes/admin_get_item.inc.php', {method: 'POST', body: formData})
    .then(res => res.text())
    .then(data => {
      const dataJson = JSON.parse(data);
      document.querySelector('#edit_image').src = `multimedia/image/${dataJson.item_path}/${dataJson.item_image}`;
      document.querySelector('#item_id2').value = dataJson.item_id;
      document.querySelector('#item_name2').value = dataJson.item_name;
      document.querySelector('#item_sub_name2').value = dataJson.item_sub_name;
      document.querySelector('#item_available2').value = dataJson.item_available;
      document.querySelector('#item_short_desc2').value = dataJson.item_short_desc;
      document.querySelector('#item_overview2').value = dataJson.item_overview;
      document.querySelector('#item_information2').value = dataJson.item_information;
      document.querySelector('#item_specification2').value = dataJson.item_specification;
      document.querySelector('#item_price2').value = (dataJson.item_price.length > 0) ? parseFloat(dataJson.item_price).toFixed(2) : 0;
      document.querySelector('#item_discount2').value = (dataJson.item_discount > 0) ? parseFloat(dataJson.item_price) : 0 ;
      document.querySelectorAll('#item-category2 option').forEach(opt => {
        if(opt.value < 1){
          opt.selected = false;
        }
        if(opt.value == Number(dataJson.item_category)){
          opt.selected = true; 
        }
      });

      let specs = (dataJson.item_specs.length > 0) ? JSON.parse(dataJson.item_specs) : [];
      if(specs.length > 0){
        specs.forEach(item => {
          let newLi = document.createElement('LI');
          newLi.innerHTML = `${item}<span class="spec-close">&times;</span>`;
          let specInpt = document.createElement('INPUT');
          specInpt.setAttribute('type','hidden');
          specInpt.setAttribute('name','item_specs[]')
          specInpt.value = item;
          specificUl.appendChild(newLi);
          specificUl.appendChild(specInpt);
        });
        /* update list to be able to remove specs item */
        updateEditSpecsInclude();
      }


      let includes = (dataJson.item_included.length > 0) ? JSON.parse(dataJson.item_included) : [];
      if(includes.length > 0){
        includes.forEach(item => {
          let newLi = document.createElement('LI');
          newLi.innerHTML = `${item}<span class="item-list-close">&times;</span>`;
          let newHidden = document.createElement('INPUT');
          newHidden.setAttribute('type','hidden');
          newHidden.setAttribute('name','item_included[]');
          newHidden.value = item;
          includedUl.appendChild(newLi);
          includedUl.appendChild(newHidden);
          // console.log(item);
        });
        /* update list to be able to remove includes item */
        updateEditSpecsInclude();
      }

    })
    .catch(err => console.log(err));
    editModal.classList.add('open');
  }
}

/* Remove Edit Item Specs and Included */
let editSpecs = undefined;
function removeEditSpecs(e){
  const li = e.target.parentNode;
  const inpt = e.target.parentNode.nextElementSibling;
  if(confirm('Are you sure you wan\'t to delete this?')){
    li.remove();
    inpt.remove();
  }
}

let editIncluded = undefined;
function removeEditIncluded(e){
  const li = e.target.parentNode;
  const inpt = e.target.parentNode.nextElementSibling;
  if(confirm('Are you sure you wan\'t to remove this in included items?')){
    li.remove();
    inpt.remove();
  }
}

/* Add item for Edit ***************/
const editAddSpecsBtn = document.querySelector('.spec-add-btn2');
const editSpecsText = document.querySelector('.spec-input-txt2');
editAddSpecsBtn.addEventListener('click', editAddSpecs);
function editAddSpecs(e){
  const inputTest = new InputCheck();
  const countItem = document.querySelectorAll('.specific-ul2 li');
  if(!inputTest.isInputLengthValid(editSpecsText.value.trim(), 50)){
    return;
  }
  if(countItem.length > 4){
    return;
  }
  let newLi = document.createElement('LI');
  newLi.innerHTML = `${editSpecsText.value.trim()}<span class="spec-close">&times;</span>`;
  let newHidden = document.createElement('INPUT');
  newHidden.setAttribute('type','hidden');
  newHidden.setAttribute('name','item_specs[]');
  newHidden.value = editSpecsText.value.trim();
  /* Append to parent created elements */
  specificUl.appendChild(newLi);
  specificUl.appendChild(newHidden);
  /* Update Specs Item */
  updateEditSpecsInclude();
}

const editAddIncludedBtn = document.querySelector('.item-included-btn2');
const editIncludedText = document.querySelector('.item-included-input2');
editAddIncludedBtn.addEventListener('click', editAddIncluded);
function editAddIncluded(e){
  const inputTest = new InputCheck();
  const countItem = document.querySelectorAll('.included-ul2 li');
  if(countItem.length > 7){
    return;
  }
  if(!inputTest.isInputLengthValid(editIncludedText.value.trim(), 50)){
    return;
  }
  
  let newLi = document.createElement('LI');
  newLi.innerHTML = `${editIncludedText.value.trim()}<span class="item-list-close">&times;</span>`;
  let newHidden = document.createElement('INPUT');
  newHidden.setAttribute('type','hidden');
  newHidden.setAttribute('name','item_included[]');
  newHidden.value = editIncludedText.value.trim();
  includedUl.appendChild(newLi);
  includedUl.appendChild(newHidden);
  /* Update Include */
  updateEditSpecsInclude();
}

/* call this to update ListNodes of Specs and Include items */
function updateEditSpecsInclude(){
  editSpecs = document.querySelectorAll('.specific-ul2 li .spec-close');
  editSpecs.forEach(btn => btn.addEventListener('click', removeEditSpecs));
  editIncluded = document.querySelectorAll('.included-ul2 li .item-list-close');
  editIncluded.forEach(btn => btn.addEventListener('click', removeEditIncluded));
}


/* UPDATE Item Info ************/
const updateBtn = document.querySelector('.btn-update');
updateBtn.addEventListener('click', updateItemInfo);
function updateItemInfo(e){
  if(!confirm('Are you sure you wan\'t to update?')){
    return;
  }
  const itemId = document.querySelector('#item_id2');
  const itemName = document.querySelector('#item_name2');
  const itemSubName = document.querySelector('#item_sub_name2');
  const itemCategory = document.querySelector('#item-category2');
  const itemAvailable = document.querySelector('#item_available2');
  const itemShortDesc = document.querySelector('#item_short_desc2');
  const itemOverview = document.querySelector('#item_overview2');
  const itemInformation = document.querySelector('#item_information2');
  const itemSpecification = document.querySelector('#item_specification2');
  const itemPrice = document.querySelector('#item_price2');
  const itemDiscount = document.querySelector('#item_discount2');
  const itemSpecs = document.querySelectorAll('.specific-ul2 input[name="item_specs[]"]');
  const itemIncluded = document.querySelectorAll('.included-ul2 input[name="item_included[]"]');
  /* Prepare Array container */
  let arrSpecs = [];
  let arrIncluded = [];
  let formData = new FormData();
  /* Prepare Array Specs and Included Specs */
  (itemSpecs.length > 0) ? itemSpecs.forEach(item => arrSpecs.push(item.value)) : [];
  (itemIncluded.length > 0) ? itemIncluded.forEach(item => arrIncluded.push(item.value)) : [];

  let dataObj = {
    item_id : itemId.value,
    item_name : itemName.value.trim(),
    item_sub_name : itemSubName.value.trim(),
    item_category : (itemCategory.value > 7 || itemCategory.value < 1) ? 7 : itemCategory.value,
    item_available : itemAvailable.value,
    item_short_desc : itemShortDesc.value.trim(),
    item_overview : itemOverview.value.trim(),
    item_information : itemInformation.value.trim(),
    item_specification : itemSpecification.value.trim(),
    item_price : String(itemPrice.value),
    item_discount: String(itemDiscount.value),
    item_specs : (arrSpecs.length > 0) ? arrSpecs : '',
    item_included : (arrIncluded.length > 0) ? arrIncluded : []
  };

  formData.append('data',JSON.stringify(dataObj));

  fetch('includes/admin_update_item.inc.php', {method: 'POST', body: formData})
  .then(res => res.text())
  .then(data => {
    console.log(data)
    if(data == 1){
      itemAlert('Updated!');
    }else{
      itemAlert('Update Failed!');
      console.log(data);
    }
    // openCloseEdit();
  })
  .catch(err => console.log(err));
  // console.log(dataObj);
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
let newObj = new OpenClose;
newObj.eventClick('.menu1',showMenu1);
newObj.eventClick('.menu2', showMenu2);
/* classRemove and classAdd
  .classRemove(#targetElement#,#class-name-to-remove#)
*/
function showMenu1(e){
  tableParent.innerHTML = '';
    // displaySellerItems(data);
    loadSellerItems();
  newObj.classRemove('.main-container','sec2');
}
function showMenu2(e){
  newObj.classAdd('.main-container','sec2');
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


/* Pagination *************** */
const pageText = document.querySelector('#page_text');
let itemCount = 0;
let totalPage = 1;
let currPage = 1; //Curr page
let limit = 0;
let limitOffset = 10;
const prevMax = document.querySelector('.page_prev_max');
const prevMin = document.querySelector('.page_prev');
const nextMin = document.querySelector('.page_next');
const nextMax = document.querySelector('.page_next_max');

/* add function to page buttons */
nextMin.addEventListener('click', currPageAdd);
function currPageAdd(){
  if(currPage !== totalPage){
    currPage++;
    limit = limit + 10;
    pageText.innerHTML = currPage;
    paginationUpdate();
    // console.log(limitOffset);
  }
}
prevMin.addEventListener('click', currPageMinus);
function currPageMinus(){
  if(currPage > 1){
    currPage--;
    limit = limit - 10;
    pageText.innerHTML = currPage;
    paginationUpdate();
    // console.log(limitOffset);
  }
}
prevMax.addEventListener('click', currPagePrevMax);
function currPagePrevMax(){
  if(currPage === 1){return}
  currPage = 1;
  limit = 0;
  pageText.innerHTML = currPage;
  paginationUpdate();
  // console.log(limitOffset);
}
nextMax.addEventListener('click', currPageNextMax);
function currPageNextMax(){
  if(currPage === totalPage){return}
  currPage = totalPage;
  limit = (currPage * 10) - 10;
  pageText.innerHTML = currPage;
  paginationUpdate();
  // console.log(limitOffset);
}

/* Get all item number / count all seller's item */
async function getAllItemsCount($user_id){
  let count = await fetch('includes/item_count.inc.php')
    .then(res => res.text())
    .then(data => JSON.parse(data)) //parse Json
    .catch(err => console.log(err));
  return count;
}

/* Pagination */
function updatePage(){
  /* Update Item count for pagination purpose */
  getAllItemsCount().then(res => {
    itemCount = res;
    totalPage = Math.ceil(res / 10);
    document.querySelector('#page_total').innerHTML = (Math.ceil(res / 10) === 0)? '': totalPage;
  });
}

/* Pagination display */
function paginationUpdate(){
  tableParent.innerHTML = '';

  const user_id = userId.value;
  let opt = sortSelect.value;
  let formData = new FormData();
  formData.append('user_id', user_id);
  formData.append('sort_by', opt);
  formData.append('limit_a', limit);
  getItems('includes/admin_display_item.inc.php',formData)
  .then(res => {
    displaySellerItems(res);
  });
  /* console.log(limit);
  // console.log(limitOffset); */
}









/* SEC2 Area */


/* For Function itemAlert */
function itemAlert(msg){
  const a = document.querySelector('.item-alert');
  const b = document.querySelector('.item-alert-container'); 
  const c = document.querySelector('.item-alert-text'); 
  c.innerHTML = msg;
  a.classList.add('open');
  setTimeout(() => {
    b.classList.add('open');
    setTimeout(()=>{
      b.classList.remove('open');
      setTimeout(()=>{a.classList.remove('open')}, 500)
    },2000)
  }, 100)
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
  if(document.querySelector('#item_image').files[0] !== undefined){
    formData.append('item_image', document.querySelector('#item_image').files[0]);
  }
  
  /* Check for required fields */
  if(document.querySelector('input[name="item_name"]').value === ''){
    isReady = false;
    document.querySelector('input[name="item_name"]').style.backgroundColor = '#f0a8a8';
  }
  if(document.querySelector('input[name="item_price"]').value === ''){
    isReady = false;
    document.querySelector('input[name="item_price"]').style.backgroundColor = '#f0a8a8';
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
      console.log(data);
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






