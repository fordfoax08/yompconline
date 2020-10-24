/* Login button Submit */
const btnLogin = document.querySelector('#btn-login');
btnLogin.addEventListener('click', submitForm);
function submitForm(e){
  const inputUsername = document.querySelector('#input_username');
  const inputPassword = document.querySelector('#input_password');
  
  if(inputUsername.value.trim() === '' || inputPassword.value.trim() === ''){
    return false;
  }

  if(!isStringValid(inputUsername.value.trim()) || !isStringValid(inputPassword.value.trim())){
    return false;
  }
  
  if(!isStringLenghtValid(inputUsername.value.trim())){
    return false;
  }

  loadingScreen();
  setTimeout(()=>{
    e.target.parentNode.submit();
  }, 5000);
  
}

function loadingScreen(){
  const loading = document.querySelector('.loading');
  const progressColor = document.querySelector('.progress-color');
  loading.classList.remove('close');
  progressColor.classList.add('load');
  //console.log(progressColor.clientWidth);
}












/* input filter */
function isStringValid(str){
  let regex = /<script[\s\S]*?>[\s\S]*?<\/script>/gi;
  if(regex.test(str)){
    return false;
  }
   return true;
}

function isStringLenghtValid(str){
  if(str.length >= 200 || str.length <= 2){
    return false;
  }
  return true;
}

function isEmailValid(email){
  let regex = /^[a-zA-Z0-9_\.-]{5,100}(@[a-zA-Z-_]{2,50})(\.[a-zA-Z]{2,50})$/;
  if(regex.test(email)){
    return true;
  }
  return false;
}