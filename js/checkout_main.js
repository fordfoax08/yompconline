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
    let jsonData = JSON.parse(data);
    const sec1 = document.querySelector(".sec-total")
    let totalWithoutDiscount = jsonData.reduce((acc,item) => acc + (item.pcs_item * item.item_price),0);
    let totalDiscount = jsonData.reduce((acc,item) => acc + ((item.item_price  * (item.item_discount / 100)) * item.pcs_item),0);
    let tax = 20;
    let itemTotal = jsonData.reduce((acc,item) => acc + ((parseFloat(item.item_price) - ((item.item_discount / 100) * item.item_price)) * item.pcs_item), 0);
    let newDiv = document.createElement("DIV");
    newDiv.setAttribute("class","item-compute-container");
    newDiv.innerHTML = `
      <div class="total-a">
        <p>Total: </p>
        <p>P <span class="total-int">${totalWithoutDiscount.toFixed(2)}</span></p>
      </div>
      <div class="total-a">
        <p>Discount: </p>
        <p><span class="total-disc">-P ${totalDiscount.toFixed(2)}</span></p>
      </div>
      <div class="total-a">
        <p>Estimated Tax: </p>
        <p>+P <span class="total-int"> ${tax.toFixed(2)}</span></p>
      </div>
      <!-- <div class="total-a">
        <p>Option: </p>
        <p> <span class="total-int">Pickup</span></p>
      </div> -->
      <div class="line-divide"></div>
      <div class="total-a total-order">
        <p>Order Total: </p>
        <p>P <span class="total-int"> ${(totalWithoutDiscount - totalDiscount - tax).toFixed(2)}</span></p>
      </div>
    `;

    sec1.appendChild(newDiv);

    // console.log(itemTotal);
  })
  .catch(err => console.log(err));
}


window.addEventListener('DOMContentLoaded',  displayItem);



/* Remove Item from cart */
const btnRemove = document.querySelectorAll(".remove-item");
btnRemove.forEach(btn => {
  btn.addEventListener("click", (e)=>{
    let itemId = 0;
    if(!e.target.classList.contains("remove-item")){
      itemId = e.target.closest(".remove-item").nextElementSibling;
      // console.log(e.target.closest(".remove-item"));
      // return;
    }else{
      itemId = e.target.nextElementSibling;
    }
    console.log(itemId);
  });
});


