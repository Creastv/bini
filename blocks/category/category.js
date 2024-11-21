var swiper = new Swiper(".releted", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
        pagination: {
          el: ".swiper-pagination",
          clickable: true,
        },
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
        navigation: {
          nextEl: ".slider-nav__next",
          prevEl: ".slider-nav__prev",
        },
      },
      1024: {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
          nextEl: ".slider-nav__next",
          prevEl: ".slider-nav__prev",
        },
      }
    }
  });