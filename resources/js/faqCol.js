// resources/js/swiper-faq.js
import Swiper from 'swiper';
// Если нужно импортировать дополнительные модули
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

// Используем модули
Swiper.use([Navigation, Pagination, Autoplay]);

// Инициализация после загрузки DOM
document.addEventListener('DOMContentLoaded', function() {
    // Проверяем, есть ли на странице слайдер
    const swiperContainer = document.querySelector('.mySwiper');
    if (!swiperContainer) return;

    // Инициализация Swiper
    const swiper = new Swiper('.mySwiper', {
        // Основные настройки
        slidesPerView: 'auto',
        spaceBetween: 30,
        centeredSlides: true,
        grabCursor: true,
        loop: true,
        speed: 800,

        // Автовоспроизведение с паузой при наведении
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },

        // Прогресс-бар
        pagination: {
            el: '.swiper-pagination',
            type: 'progressbar',
        },

        // Навигация
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },

        // Брейкпоинты для адаптивности
        breakpoints: {
            320: {
                spaceBetween: 20,
                slidesPerView: 1,
            },
            768: {
                spaceBetween: 25,
                slidesPerView: 'auto',
            },
            992: {
                spaceBetween: 30,
                slidesPerView: 'auto',
            }
        },

        // События
        // on: {
        //     init: function () {
        //         console.log('FAQ Swiper инициализирован');
        //     },
        //     slideChange: function () {
        //         console.log('FAQ слайд изменен на:', this.activeIndex);
        //     }
        // }
    });

    // Экспортируем объект Swiper для возможного использования в других местах
    window.faqSwiper = swiper;
});
