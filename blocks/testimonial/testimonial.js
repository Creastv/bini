
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
      768: {

      },
      1024: {
        slidesPerView: 1,

      },
      1200: {
        pagination: false,
      }
 
    },
  });
  