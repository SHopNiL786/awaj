export class Accordion {
    constructor() {
        this.init();
        this.preventClickOnBody();
    }

    init() {
        $('html').on('click', '.accordion__item', function(event) {
            event.preventDefault();

            $(this).toggleClass('active');
        });
    }

    preventClickOnBody() {
        $('html').on('click', '.accordion__item__body', function(event) {
            event.stopPropagation();
        });
    }
}
