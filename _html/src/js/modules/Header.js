export class Header {
    constructor() {
        this.stickyMenu();
        this.mobileMenu();
        this.dropdownMenu();
    }

    stickyMenu() {
        let debounce = null;

        if (debounce) {
            clearTimeout(debounce);
        }

        $(window).on('scroll', function() {
            debounce = setTimeout(() => {
                const fromTop = $(document).scrollTop();

                if (fromTop > 500) {
                    $('.header--compact').removeClass('header--hide');
                } else {
                    $('.header--compact').addClass('header--hide');
                }
            }, 250);
        });
    }

    mobileMenu() {
        $('html').on('click', '.header__hamburger', function(event) {
            event.preventDefault();

            $(this).toggleClass('is-active');

            if ($(this).hasClass('is-active') === true) {
                $(this).closest('.header').find('.header__nav').addClass('is--active');
            } else {
                $(this).closest('.header').find('.header__nav').removeClass('is--active');
            }
        });
    }

    dropdownMenu() {
        $('html').on('mouseenter', '.header__nav > ul > li', function(event) {
            event.preventDefault();

            $('.header__nav > ul > li').removeClass('on-hover');
            $(this).addClass('on-hover');
        });

        $('html').on('mouseleave', '.header', function(event) {
            event.preventDefault();

            $('.header__nav > ul > li').removeClass('on-hover');
        });

        $(document).click(function(event) {
            $('.header__nav > ul > li').removeClass('on-hover');
        });
    }
}
