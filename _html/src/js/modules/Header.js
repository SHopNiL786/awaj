export class Header {
    constructor() {
        this.stickyMenu();
        this.mobileMenu();
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
                $('.header__nav').addClass('is--active');
            } else {
                $('.header__nav').removeClass('is--active');
            }
        });
    }
}
