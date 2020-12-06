/* Remove redirect action */
(() => {
  localStorage.removeItem('action');
})();



/* get cart item  */
async function getCartItem(){
  const res = await fetch('checkout_get_cart.inc.php')
        .then(res => res.text())
        .catch(err => console.log('Error: '+err));
  return res;
}

function displayItem(){
  getCartItem()
  .then(data => {
    console.log(data)
  })
  .catch(err => console.log(err));
}


