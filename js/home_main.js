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



  /* window.addEventListener('scroll', (e) => {
    let deviceWidth = window.innerWidth;
    console.log(deviceWidth);
    
    
    
    let scroll = this.scrollY;
    console.log(scroll);
  }); */

  /* 
  #content Load check device width,
  #and change css link with new css links
  */
window.addEventListener('DOMContentLoaded', (e) => {
  let deviceWidth = window.innerWidth;
  if(deviceWidth >= 1000){
    let newCss = document.head.children.item(2);
    newCss.href = 'css/home_main2.css';
    scrollAnim();
    console.log(newCss);
  }
  
})

/* Animation when Scroll, activate if screenWidth >= 1000 */
function scrollAnim(){
  const elementAnim = document.querySelector('.section2');
  window.addEventListener('scroll', (e) => {
    let scrollD = this.scrollY;
    if(scrollD >= 510 || scrollD <= 590){
      elementAnim.classList.add('anim');
    }
    console.log(scrollD);
  })
}
