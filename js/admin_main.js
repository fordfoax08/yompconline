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


/*Remove Specs item  *****/
let specCLoseBtn;
function specClose(e){
  e.target.parentNode.nextElementSibling.remove();
  e.target.parentNode.remove();
}



/* ITEMS INCLUDED add items */
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
  /* console.log(e.target.parentNode.nextElementSibling); */
}