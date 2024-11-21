
var swiper = new Swiper(".testimonial-carousel", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 4500,
      disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next.OfferSwiperRight',
        prevEl: '.swiper-button-prev.OfferSwiperLeft',
    },
    breakpoints: {
      640: {
        pagination: true,

      },
      1300: {
        slidesPerView: 1,
        pagination: false,
      },
    },
  });
  