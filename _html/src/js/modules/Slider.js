import Swiper from 'swiper';

export class Slider {
    constructor() {
        this.init();
    }

    init() {
        if ($('.swiper-container').length === 0) {
            return false;
        }

        new Swiper('.swiper-container', {
            direction: 'horizontal',
            loop: false,

            pagination: {
                el: '.swiper-pagination',
            },

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            }
        });
    }
}
