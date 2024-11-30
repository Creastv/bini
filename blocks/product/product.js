
var swiper = new Swiper(".products-carousel", {
    slidesPerView: 2,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 5500,
      disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
     
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 3,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: false,
        navigation: {
            nextEl: '.slider-nav__prod__next',
            prevEl: '.slider-nav__prod__prev',
        },
      },
    
      1200: {
        slidesPerView: 4,
        spaceBetween: 30,
        pagination: false,
        navigation: {
          nextEl: '.slider-nav__prod__next',
          prevEl: '.slider-nav__prod__prev',
        }
      },
     
    },
  });
