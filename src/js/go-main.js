
// HEader fixed

const togglerNav = document.querySelector(".js-navbar__toggler");
const nav = document.querySelector(".js-navbar__navigation");
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

// sticy nabvbar
// const navbar = document.querySelector(".js-navbar");
// document.addEventListener("scroll", () => {
//   var st = window.pageYOffset || document.documentElement.scrollTop;
//   if (window.pageYOffset) {
//     navbar.classList.add("active");
//     document.querySelector("#header").style.paddingTop = navbar.clientHeight + "px";
//   } else {
//     navbar.classList.remove("active");
//     document.querySelector("#header").style.paddingTop = "0";
//   }
// });

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

setTimeout(
 function() {
    //get the images
    let images = document.querySelectorAll("img"); 
     
    //loop through all images
    for (let i = 0; i < images.length; i++) {
        //add alt text if missing (but title is present)
        if (!images[i].alt) {
            images[i].alt = 'test';
		 images[i].setAttribute('alt', 'Aktywna Szkoła');
        }
    }
}, 1000);


// // Modal

const body = document.querySelector("body");
const header = document.querySelector("#header");
const main = document.querySelector("main");
const footer = document.querySelector("#footer");
const modal = document.querySelector("#contact-modal");
const modalClose = document.querySelector(".close-m");

const openerModal = document.querySelectorAll(".js-opener-modal");
for (let i = 0; i < openerModal.length; i++) {
  openerModal[i].addEventListener("click", openModal);
}

modalClose.addEventListener("click", function (event) {
  if (!event.target.matches(".close-m") || !event.target.matches(".box")) {
    closeModal();
  }
  false;
});

function closeModal() {
  modal.classList.remove("active");

}

function openModal(e) {
  e.preventDefault();
  modal.classList.add("active");

}


// Accessibility

const acsSlider = document.querySelector(".go-accessibility");
const togglerSlider = document.querySelector(".go-acs-toggler");
let flagSlider = false;
togglerSlider.addEventListener("click", () => {
  if (flagSlider == false) {
    acsSlider.classList.add("active");
    flagSlider = true;
  } else {
    acsSlider.classList.remove("active");
    flagSlider = false;
  }
});

const togglerTextSizeLarge = document.querySelector(".font-increase");
const togglerTextSizeSmall = document.querySelector(".font-decrease");
const togglerContrast = document.querySelector(".toggler-hight-contrast");
togglerTextSizeSmall.classList.add("inactive");
// body.classList.add("hight-contrast");

togglerTextSizeLarge.addEventListener("click", () => {
  body.classList.add("text-large");
  togglerTextSizeLarge.classList.add("inactive");
  togglerTextSizeSmall.classList.remove("inactive");
});

togglerTextSizeSmall.addEventListener("click", () => {
  body.classList.remove("text-large");
  togglerTextSizeLarge.classList.remove("inactive");
  togglerTextSizeSmall.classList.add("inactive");
});

togglerContrast.addEventListener("click", () => {
  if (body.classList.contains("hight-contrast")) {
    body.classList.remove("hight-contrast");
  } else {
    body.classList.add("hight-contrast");
  }
});

document.addEventListener("scroll", () => {
  if (window.pageYOffset >= 200) {
    acsSlider.classList.add("top");
  } else {
    acsSlider.classList.remove("top");
  }
});