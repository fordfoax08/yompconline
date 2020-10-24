

/* Seller field Expand */
const checkSellExpand = document.querySelector('.chck1');
function sellExpand(){
  if(checkSellExpand.checked){
    document.querySelector('.seller-info-container').innerHTML=`
    <!-- Shop / Seller name -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-shop-window" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h12V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zm2 .5a.5.5 0 0 1 .5.5V13h8V9.5a.5.5 0 0 1 1 0V13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5a.5.5 0 0 1 .5-.5z"/>
          </svg>
          &nbsp;Shop&nbsp;Name
        </span>
      </div>
      <input type="text" name="seller_name" placeholder="Shop / Seller Name" class="required-field">
    </div>

    <!-- Shops Address -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-geo-alt" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M12.166 8.94C12.696 7.867 13 6.862 13 6A5 5 0 0 0 3 6c0 .862.305 1.867.834 2.94.524 1.062 1.234 2.12 1.96 3.07A31.481 31.481 0 0 0 8 14.58l.208-.22a31.493 31.493 0 0 0 1.998-2.35c.726-.95 1.436-2.008 1.96-3.07zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
            <path fill-rule="evenodd" d="M8 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
          </svg>
          Shop&nbsp;Address
        </span>
      </div>
      <input type="text" name="seller_address" placeholder="Address">
    </div>

    <!-- Shop / Seller's contact details -->
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">
          <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-telephone-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M2.267.98a1.636 1.636 0 0 1 2.448.152l1.681 2.162c.309.396.418.913.296 1.4l-.513 2.053a.636.636 0 0 0 .167.604L8.65 9.654a.636.636 0 0 0 .604.167l2.052-.513a1.636 1.636 0 0 1 1.401.296l2.162 1.681c.777.604.849 1.753.153 2.448l-.97.97c-.693.693-1.73.998-2.697.658a17.47 17.47 0 0 1-6.571-4.144A17.47 17.47 0 0 1 .639 4.646c-.34-.967-.035-2.004.658-2.698l.97-.969z"/>
          </svg>
          &nbsp;Seller&nbsp;No.
        </span>
      </div>
      <input type="text" name="seller_contact" placeholder="Seller / Shop Contact"  class="required-field">
    </div>

    <!-- Shop / Seller Details -->
    <textarea name="seller_details" cols="30" rows="5" placeholder="About Store / More information"></textarea>
    `;
  }else{
    document.querySelector('.seller-info-container').innerHTML = '';
  }
}



/* Submit Btn Cheking */
const btnSubmit = document.querySelector('.btn-submit');
btnSubmit.addEventListener('click', submitDocument);
function submitDocument(e){
  let errCount = 0;
  /* Reqs this function hightlights required field if empty */
  const reqs = document.querySelectorAll('.required-field');
  reqs.forEach(inputs => {
    if(inputs.value === '' || inputs.value === undefined || inputs.value === null){
      inputs.classList.add('input-req');
      errCount++;
    }else{
      inputs.classList.remove('input-req');
    }
  })

  /* All input check for lenght max 250 */
  const allInput = document.querySelectorAll('input');
  allInput.forEach(item => {
    if(!isStringLenghtValid(item.value)){
      errCount++;
      alert('Invalid input string should not exceed 250');
      item.classList.add('input-req');
      setTimeout(()=>{
        item.classList.remove('input-req');
      }, 3000)
    }
  })

  /* allInput query for inputs to be tested for js script */
  allInput.forEach(item => {
    if(!isStringValid(item.value)){
      errCount++;
      alert('HAHA NICE TRY WEABO! remove <script> tag lols');
    }
  })
  
  /* Check for special Character in name */
  const personNameInput = document.querySelectorAll('.p-name');
  personNameInput.forEach(item => {
    if(!isStringWithoutSpecialChar(item.value, 3)){
      item.classList.add('input-req');
      errCount++;
    }
  })

  /* Check for Email address */
  const personEmail = document.querySelector('.p-email');
  if(!isEmailValid(personEmail.value)){
    personEmail.classList.add('input-req');
    errCount++;
  }  


  /* Check for username */
  const inputUsername = document.querySelector('#input_username');
  if(!isStringWithoutSpecialChar(inputUsername.value,1)){
    inputUsername.classList.add('input-req');
    errCount++;
  }

  /* Check for Password */
  if(!isPasswordMatched()){
    chckPass.forEach(item => {
      item.classList.add('input-req');
    })
    errCount++;
  }else{
    chckPass.forEach(item => {
      if(item.value === '' || item.value === undefined || item.value === null){
        item.classList.add('input-req');
      }else{
        item.classList.remove('input-req');
      }
    })
  }

  /* Textarea check */
  const textArea = document.querySelector('textarea');
  if(textArea !== null){
    if(textArea.value !== '' || textArea.value !== null || textArea.value !== undefined){
      if(!isStringValid(textArea.value)){
        alert('HAHA NICE TRY WEABO! remove <script> tag lols');
        textArea.classList.add('input-req');
        errCount++;
      }
    }
  }

  /* Checking for errCount and password match */
  if(errCount >= 1){
    return;
  }else{
    btnSubmit.previousElementSibling.submit();
  }
}


/* Image upload */
const imgInput = document.querySelector('#img_input');
const imgFile = document.querySelector('#img_file');
imgInput.addEventListener('change', imgChanged);
function imgChanged(e){
  imgFile.src=URL.createObjectURL(e.target.files[0]);
}


/* Check Password if matched */
const chckPass = document.querySelectorAll('input[type="password"]');
function isPasswordMatched(){
  if(chckPass[0].value === chckPass[1].value){
    return true;
  }else{
    return false;
  }
}


/* DUPLICATE CHECKING using AJAX fetch */
const inputUsername = document.querySelector('#input_username');
inputUsername.addEventListener('blur', userNameTest);
const inputEmail = document.querySelector('#input_email');
inputEmail.addEventListener('blur', userNameTest);
function userNameTest(e){
  fetch('includes/usernametest.inc.php')
  .then(res => res.text())
  .then(data => duplicateValue(e.target, data))
  .catch(err => console.log(err));
}

function duplicateValue(e,data){
  const inputInterface = e;
  const dataJsonParsed = JSON.parse(data);
  let duplicate = false;

  /* Loop for existing data and check for duplicate */
  if(inputInterface.id === 'input_username'){
    dataJsonParsed.forEach(item => {
      if(inputInterface.value === item.user_name){
        duplicate = true;
        alert('Email Exist');
      }
    });
  }

  if(inputInterface.id === 'input_email'){
    dataJsonParsed.forEach(item => {
      if(inputInterface.value === item.user_email){
        duplicate = true;
        alert('Username Exist');
      }
    });
  }

  duplicate ? inputInterface.classList.add('input-req') : inputInterface.classList.remove('input-req');
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
  if(str.length >= 250){
    return false;
  }
  return true;
}


/* function to test whether special chars exist or not
  case 1 regular Exp that includes space
  case 2 regular Exp that does not includes space
*/
function isStringWithoutSpecialChar(str,opt){
  let regex = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
  let regex2 = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
  let regex3 = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~0-9]/;
  switch(opt){
    case 1:
      if(regex.test(str)){
        return false;
      }else{
        return true;
      }
      break;
    case 2:
      if(regex2.test(str)){
        return false;
      }else{
        return true;
      }
      break;
    case 3:
      if(regex3.test(str)){
        return false;
      }else{
        return true;
      }
      break;
    default:
      return true;
  }
}

/* function to test whether email address is valid or not */
function isEmailValid(email){
  let regex = /^[a-zA-Z0-9_\.-]{5,100}(@[a-zA-Z-_]{2,50})(\.[a-zA-Z]{2,50})$/;
  if(regex.test(email)){
    return true;
  }
  return false;
}