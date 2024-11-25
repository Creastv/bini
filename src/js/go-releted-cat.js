var swiper = new Swiper(".releted", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 3500,
      disableOnInteraction: false
    },
    pagination: {
      el: ".swiper-pagination--col",
      clickable: true,
    },
    navigation: {
      nextEl: ".slider-nav__next",
      prevEl: ".slider-nav__prev",
    },
    breakpoints: {
      640: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      768: {
        slidesPerView: 2,
        spaceBetween: 30,
      },
      1024: {
        slidesPerView: 2,
        spaceBetween: 30,
        pagination: false,
      },
      1200: {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: false,
      }
    }
  });