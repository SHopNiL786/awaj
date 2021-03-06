export class Header {
    constructor() {
        this.populateFixedMenu();
        this.stickyMenu();
        this.mobileMenu();
        this.dropdownMenu();
    }

    populateFixedMenu() {
        if ($('#top').length === 0) {
            return false;
        }

        const headerHtml = $('#top .header__nav').html();

        $('.header--fixed .header__nav').html(headerHtml);
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
                $('body').addClass('is--no-scroll');
            } else {
                $(this).closest('.header').find('.header__nav').removeClass('is--active');
                $('body').removeClass('is--no-scroll');
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
