/* Pagination ******** */
const prevMax = document.querySelector('.pagePrevMax');
const prev = document.querySelector('.pagePrev');
const nextMax = document.querySelector('.pageNextMax');
const next = document.querySelector('.pageNext');
const pageJump = document.querySelector('.pageJump');

/* Display Page upon loading */
function loadPages(){
  /* Remove pages */
  document.querySelectorAll('.pageNo').forEach(item => {
    item.remove();
  })
  if(maxPage >= 1){
    pageTemplate('pageFirst', 1);
  }
  if(maxPage >= 2){
    pageTemplate('pageSecond', 2);
  }
  if(maxPage >= 3){
    pageTemplate('pageThird', 3);
  }
  if(maxPage >= 4){
    pageTemplate('pageFourth', 4);
  }

  /* to invoke  */
  pageFunction();
}
function pageTemplate(pageName,no){
  let pageContainer = document.querySelector('.page-container');
  let newDiv = document.createElement('DIV');
  newDiv.setAttribute('class',`page pageNo ${pageName}`);
  newDiv.innerHTML = `<a href="javascript:void(0)">${no}</a>`; 
  pageContainer.insertBefore(newDiv, document.querySelector('.pageJump'));
}

/* Page Highlights */
function currentPage(e){
  let pagesWithNo = document.querySelectorAll('.pageNo');
  // e.style.backgroundColor = 'rgba(0,0,0,.1)';
  pagesWithNo.forEach(item => {
    item.setAttribute('style','');
  });
  pagesWithNo.forEach(item => {
    if(parseInt(item.innerText) === currPage){
      item.setAttribute('style','background-color: rgba(0,0,0,.2);');
    }
  });
  

}

prevMax.addEventListener('click', maxPrev);
function maxPrev(e){
  if(currPage <= 1){
    return;
  }
  currPage = 1;
  loadPages();
  scrollToSec2();
  currentPage();
  getItemData();
}

prev.addEventListener('click', pagePrev);
function pagePrev(e){
  if(currPage <= 1){
    return;
  }
  /* get page number Nodes */
  let pagesWithNo = document.querySelectorAll('.pageNo');
  /* Check if currPage is equivalent to FIRST page Node */
  if(currPage === parseInt(pagesWithNo[0].firstChild.innerText)){
    let no = currPage - 4;

    if(currPage === maxPage){
      pagesWithNo.forEach(item => {
        item.remove();
      })
      pageTemplate('pageFirst', no++);
      pageTemplate('pageSecond', no++);
      pageTemplate('pageThird', no++);
      pageTemplate('pageFourth', no++);
      // console.log('MaxPage Reached');
    }else{
        if(pagesWithNo.length === 2){
         pageTemplate('pageThird', maxPage - 3);
         pageTemplate('pageFourth', maxPage - 2);
        }
        if(pagesWithNo.length === 3){
         pageTemplate('pageFourth', maxPage - 3);
        }
      pagesWithNo.forEach(item => {
        item.firstElementChild.innerHTML = no++;
      })
    }

 
  }

  currPage --;
  scrollToSec2();
  pageFunction();
  currentPage();
  getItemData();
}


nextMax.addEventListener('click', maxNext);
function maxNext(e){
  if(currPage >= maxPage){
    return;
  }

  let pagesWithNo = document.querySelectorAll('.pageNo');

  let modulus = Math.floor(maxPage % 4);
  
  if(modulus === 0){
    let no = maxPage - 3;
    pagesWithNo.forEach(item => {
      item.firstElementChild.innerText = no++;
    });
  }else{
      pagesWithNo.forEach(item => item.remove());
      switch(modulus){
          case 1:
              pageTemplate('pageFirst', maxPage);
              break;
          case 2:
            // let no = maxPage - 1;
              pageTemplate('pageFirst', maxPage - 1);
              pageTemplate('pageSecond', maxPage);
              break;
          case 3:
              pageTemplate('pageFirst', maxPage - 2);
              pageTemplate('pageSecond', maxPage - 1);
              pageTemplate('pageThird', maxPage);
      }
  }




  currPage = maxPage;
//   console.log(modulus);
  scrollToSec2();
  pageFunction();
  currentPage();
  getItemData();
}
next.addEventListener('click', pageNext);
function pageNext(e){
  if(currPage >= maxPage){
    return;
  }
  currPage++;
  /* Get last Number of nodes */
  let no = 0;
  let pagesWithNo = document.querySelectorAll('.pageNo');
  pagesWithNo.forEach(item => no = parseInt(item.firstElementChild.innerText));
  /* update page number */
  if(pagesWithNo.length >= 4){
    if(currPage > no){
      let currPageInc = currPage;
      pagesWithNo.forEach(item => {
        if(currPageInc >= maxPage+1){
          item.remove();
        }else{
          item.firstElementChild.innerText = currPageInc;
          currPageInc++;
        }
      })
       
    }
    
  }
  
  scrollToSec2();
  pageFunction();
  currentPage();
  getItemData();
}

function pageFunction(){
  const pageFirst = document.querySelector('.pageFirst');
  const pageSecond = document.querySelector('.pageSecond');
  const pageThird = document.querySelector('.pageThird');
  const pageFourth = document.querySelector('.pageFourth');
 
  pageFirst !== null ? pageFirst.addEventListener('click', firstPageBtn) : '';
  function firstPageBtn(e){
    let num = parseInt(e.target.innerText);
    currPage = num;
    getItemData();
    currentPage();
    scrollToSec2();
  }
  pageSecond !== null ? pageSecond.addEventListener('click', secondPageBtn) : '';
  function secondPageBtn(e){
    let num = parseInt(e.target.innerText);
    currPage = num;
    getItemData();
    currentPage();
    scrollToSec2();
  }
  pageThird !== null ? pageThird.addEventListener('click', thirdPageBtn) : '';
  function thirdPageBtn(e){
    let num = parseInt(e.target.innerText);
    currPage = num;
    getItemData();
    currentPage();
    scrollToSec2();
  }
  pageFourth !== null ? pageFourth.addEventListener('click', fourthPageBtn) : '';
  function fourthPageBtn(e){
    let num = parseInt(e.target.innerText);
    currPage = num;
    getItemData();
    currentPage();
    scrollToSec2();
  }
}

pageJump.addEventListener('click', jumpPageBtn);
function jumpPageBtn(e){
  /* lastNo is the last value of .pageNo nodes */
  let lastNo = 0;
  let pagesWithNo = document.querySelectorAll('.pageNo');
  pagesWithNo.forEach(item => lastNo = parseInt(item.innerText));
  
 
  if(lastNo >= maxPage){
    return;
  }

  pagesWithNo.forEach(item => {
    if(lastNo === maxPage){
      item.remove();
      // console.log(lastNo);
      return;
    }else{
      lastNo++;
      item.firstElementChild.innerHTML = lastNo;
    }
  })
  currPage = parseInt(pagesWithNo[0].firstElementChild.innerText);
  currentPage();
  getItemData();
  scrollToSec2();
  // console.log(pagesWithNo.length);
}


/* scroll to section2 */
function scrollToSec2(){
    document.querySelector('#section2').scrollIntoView();
  }
  

