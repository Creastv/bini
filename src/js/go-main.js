
// HEader fixed

const togglerNav = document.querySelector(".js-navbar__toggler");
const nav = document.querySelector("#header");
const closeNav =document.querySelector('.close-nav');
let navFlag = false;

togglerNav.addEventListener("click", () => {
  if (navFlag == false) {
    nav.classList.add("active");
    togglerNav.classList.add("active");
    // document.querySelector("body").style.overflow = "hidden";
    navFlag = true;
  } else {
    nav.classList.remove("active");
    togglerNav.classList.remove("active");
    // document.querySelector("body").style.overflow = "inherit";
    navFlag = false;
  }
});
closeNav.addEventListener('click', () => {
  nav.classList.remove("active");
  togglerNav.classList.remove("active");
  // document.querySelector("body").style.overflow = "inherit";
  navFlag = false;
});




window.addEventListener('scroll', function() {
  const header = document.querySelector('.js-header');
  const stickyinfo = document.querySelector('.info-stripe');
  const body = document.querySelector('body');

   if (window.pageYOffset >= stickyinfo.offsetHeight) {
    header.classList.add('sticky'); // Przypinamy do góry
   body.style.paddingTop = header.offsetHeight + "px";
  } else {
    header.classList.remove('sticky'); // Odklejamy
    body.style.paddingTop = "0px";
  }
});

// Search slider


// Go to Top
  const goToTop = document.querySelector("#go-to-top");
  goToTop.addEventListener("click", () => {
    document.documentElement.scrollTop = 0;
  });
  document.addEventListener("scroll", () => {
    if (window.pageYOffset >= 200) {
      goToTop.classList.add("active");
    } else {
      goToTop.classList.remove("active");
    }
  });
// Set Alt
setTimeout(
 function() {
    let images = document.querySelectorAll("img"); 
    for (let i = 0; i < images.length; i++) {
        if (!images[i].alt) {
            images[i].alt = 'test';
		 images[i].setAttribute('alt', 'Bini');
        }
    }
}, 1000);


const serchSliderIcon = document.querySelector('.search-slider__icon');
const serchSliderWrap= document.querySelector('.search-slider__form');
const searchSliderBg= document.querySelector('.search-slider__bg');
const container= document.querySelector('.js-navbar');

serchSliderIcon.addEventListener("click", () => {
  serchSliderWrap.classList.add('active');
  serchSliderWrap.style.width = `${container.offsetWidth}px`;
  searchSliderBg.classList.add('active');
});

window.onclick = function(event) {
  if (event.target == searchSliderBg) {
    serchSliderWrap.classList.remove('active');
    serchSliderWrap.style.width = `0px`;
    searchSliderBg.classList.remove('active');
  }
}


document.addEventListener("DOMContentLoaded", function() {
  var menuItems = document.querySelectorAll(".navbar-left li");
  var border = document.querySelector(".border");
  for (var i = 0; i < menuItems.length; i++) {
    menuItems[i].addEventListener("mouseover", function() {
      var itemRect = this.getBoundingClientRect();
      var menuRect = this.parentNode.getBoundingClientRect();
      var leftPos = itemRect.left - menuRect.left;
      var width = itemRect.width;

      border.style.transform = "translateX(" + leftPos + "px)";
      border.style.width = width + "px";
    });
    menuItems[i].addEventListener("mouseout", function() {
      border.style.width = '0px';
    });
  }
});





// Marque
// const marquees = [...document.querySelectorAll('.marquee')];
// marquees.forEach((marquee) => {
//     marquee.innerHTML = marquee.innerHTML + '&nbsp; &nbsp;'.repeat(5);
//     marquee.i = 0;
//     marquee.step = 0.5;
//     marquee.width = marquee.clientWidth + 1;
//     marquee.style.position = '';
//     marquee.innerHTML = `${marquee.innerHTML}&nbsp; &nbsp;`.repeat(10);
//     marquee.addEventListener('mouseenter', () => (marquee.step = 0), false);
//     marquee.addEventListener('mouseleave', () => (marquee.step = 0.5), false);
// });

// requestAnimationFrame(move);

// function move() {
//     marquees.forEach((marquee) => {
//         marquee.style.marginLeft = `-${marquee.i}px`;
//         marquee.i = marquee.i < marquee.width ? marquee.i + marquee.step : 1;
//     });

//     requestAnimationFrame(move);
// }



function setupEvents() {

const isMobile = window.innerWidth >= 1300;

if(isMobile){

  const menuItems = document.querySelectorAll(" .menu-item  ");

for (let i = 0; i < menuItems.length; i++) {
  menuItems[i].addEventListener("mouseover", function () {
    const isHasChild = menuItems[i].classList.contains("has-child");

    for (let e = 0; e < menuItems.length; e++) {
      const dropdown = menuItems[e].querySelector(".mega-submenu");

      if (dropdown) {
        if (menuItems[e] === menuItems[i] && isHasChild) {
          // Aktywuj dropdown, jeśli element ma klasę has-child
          dropdown.classList.add("active");
          menuItems[e].classList.add("active");
        } else {
          // Usuń klasę active z pozostałych
          dropdown.classList.remove("active");
          menuItems[e].classList.remove("active");
        }
      }
    }
  });

  // Ukryj dropdown po wyjechaniu poza element z klasą has-child
  const dropdown = menuItems[i].querySelector(".mega-submenu");
  if (dropdown) {
    dropdown.addEventListener("mouseleave", function () {
      dropdown.classList.remove("active");
      menuItems[i].classList.remove("active");
    });
  }
}

}else{
    
  const menuItems = document.querySelectorAll(".menu-item .arrow-plus");
  // console.log(menuItems);
  for (let i = 0; i < menuItems.length; i++) {
    console.log(menuItems[i]);
    menuItems[i].addEventListener("click", function (event) {
      // event.preventDefault(); // Zapobiega domyślnemu działaniu
      console.log('test')
      const parentItem = menuItems[i].parentElement; // Pobierz rodzica elementu arrow-plus
      const isHasChild = parentItem.classList.contains("has-child");
  
      for (let e = 0; e < menuItems.length; e++) {
        const dropdown = menuItems[e].parentElement.querySelector(".mega-submenu");
  
        if (dropdown) {
          if (menuItems[e] === menuItems[i] && isHasChild) {
            // Aktywuj dropdown, jeśli element ma klasę has-child
            console.log('test')
            dropdown.classList.toggle("active");
            menuItems[e].parentElement.classList.toggle("active");
          } else {
            console.log('test')
            // Usuń klasę active z pozostałych
            dropdown.classList.remove("active");
            menuItems[e].parentElement.classList.remove("active");
          }
        }
      }
    });
  }
  }
  

  
};
setupEvents();

window.addEventListener("resize", setupEvents);