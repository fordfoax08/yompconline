/* GLOBAL */


/* USER LOGIn */
const userLoginModal = document.querySelector('.user-login-container');
userLoginModal.addEventListener('click', toggleLogin);

function toggleLogin(e){
  if(e.target.classList.contains('user-login-container') || e.target.classList.contains('user-login-a-close')){
    if(!userLoginModal.classList.contains('close')){
      userLoginModal.firstElementChild.classList.add('close');
      setTimeout(() =>{
        userLoginModal.classList.add('close');
      }, 300);
    }
  }
}
function toggleLoginOpen(){
  userLoginModal.classList.remove('close');
    setTimeout(() =>{
      userLoginModal.firstElementChild.classList.remove('close');
    }, 50);
}



  (function(){
    //lear action redirect
    if(JSON.parse(localStorage.getItem('action')) !== null){
      localStorage.removeItem('action');
    }
  })();


  /* 
  # add new css link
  */
window.addEventListener('DOMContentLoaded', (e) => {
  let deviceWidth = window.innerWidth;
  if(deviceWidth >= 1000){
    const headTag = document.querySelector("head");
    /* let newCss = document.head.children.item(2);
    newCss.href = 'css/home_main2.css'; */
    let newCss2 = document.createElement("LINK");
    newCss2.rel = "stylesheet";
    newCss2.href = "css/home_main2.css";
    headTag.appendChild(newCss2);
  }
  
})

/* Animation when Scroll, activate if screenWidth >= 1000 */

window.addEventListener('scroll', () => {
  const sec1 = document.querySelector(".section1");
  const sec2 = document.querySelector('.section2');
  const sec3 = document.querySelector(".section3");
  const sec4 = document.querySelector(".section4");
  if(sec1.getBoundingClientRect().top <= -(sec1.clientHeight / 1.5)){
    sec2.classList.add('anim');
  }

  if(sec2.getBoundingClientRect().top <= -(sec2.clientHeight / 1.5)){
    sec3.classList.add('anim');
  }

  if(sec3.getBoundingClientRect().top <= -(sec3.clientHeight / 2)){
    sec4.classList.add('anim');
  }
  
  // console.log(sec2.getBoundingClientRect().top);
  // console.log(sec1.clientHeight);
})