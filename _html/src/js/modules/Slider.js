import Swiper from 'swiper';
import { Utils } from './Utils';

export class Slider {
    constructor() {
        this.init();
    }

    init() {
        this.primarySlider();
        this.secondarySlider();
    }

    primarySlider() {
        if ($('.slider .swiper-container').length === 0) {
            return false;
        }

        new Swiper('.slider .swiper-container', {
            direction: 'horizontal',
            loop: false,

            pagination: {
                el: '.slider .swiper-pagination',
            },

            navigation: {
                nextEl: '.slider .swiper-button-next',
                prevEl: '.slider .swiper-button-prev',
            }
        });
    }

    secondarySlider() {
        if ($('.slider__carousel .swiper-container').length === 0) {
            return false;
        }

        let slidesPerView = this.getSecondarySliderPerView();

        new Swiper('.slider__carousel .swiper-container', {
            direction: 'horizontal',
            loop: false,

            slidesPerView: slidesPerView,

            pagination: {
                el: '.slider__carousel .swiper-pagination',
                clickable: true,
            },
        });
    }

    getSecondarySliderPerView() {
        let slidesPerView = 7;

        if (Utils.isSmallScreen()) {
            slidesPerView = 3;
        } else if (Utils.isMediumScreen()) {
            slidesPerView = 5;
        }

        return slidesPerView;
    }
}
