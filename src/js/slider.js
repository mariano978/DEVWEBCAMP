import Swiper, { Navigation, Pagination } from "swiper";

import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/pagination";

addEventListener("DOMContentLoaded", function () {
  if (document.querySelector(".slider")) {
    const swiper = new Swiper(".slider", {
      modules: [Navigation, Pagination],
      observer: true,
      observeParents: true,
      loop: true,
      slidesPerView: 1,
      spaceBetween: 0,
      freeMode: true,
      breakpoints: {
        768: {
          slidesPerView: 2,
        },
        1024: {
          slidesPerView: 3,
        },
        1200: {
          slidesPerView: 4,
        },
      },

      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  }
});
