
var swiper = new Swiper(".products-carousel", {
    slidesPerView: 1,
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
      navigation: {
        nextEl: '.slider-nav__prod__next',
        prevEl: '.slider-nav__prod__prev',
    },
    breakpoints: {
      640: {
        pagination: true,

      },
      1300: {
        slidesPerView: 4,
        pagination: false,
        navigation: false,
      },
    },
  });
  