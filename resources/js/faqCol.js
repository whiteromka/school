// FAQ Swiper - настройка слайдера

import Swiper from 'swiper';
import { Autoplay, Pagination } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {

    const container = document.querySelector('.mySwiper');
    if (!container) return;

    new Swiper(container, {

        modules: [Autoplay, Pagination],

        slidesPerView: 2,
        spaceBetween: 20,
        grabCursor: true,
        loop: true,
        speed: 800,

        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
        },

        breakpoints: {
            320: { 
                slidesPerView: 1, 
                spaceBetween: 15 
            },
            576: { 
                slidesPerView: 2, 
                spaceBetween: 20 
            },
            992: { 
                slidesPerView: 3, 
                spaceBetween: 25 
            },
            1400: { 
                slidesPerView: 4, 
                spaceBetween: 30 
            }
        }
    });
});
