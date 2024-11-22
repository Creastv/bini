
var swiper = new Swiper(".slider-carousel", {
    slidesPerView: 1,
    // spaceBetween: 30,
    loop: true,
    effect: "fade",
    autoplay: {
      delay: 4500,
      disableOnInteraction: false
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true
      },
  });
  