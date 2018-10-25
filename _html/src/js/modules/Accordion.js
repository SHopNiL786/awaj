export class Accordion {
    constructor() {
        this.init();
    }

    init() {
        $('html').on('click', '.accordion__item', function(event) {
            event.preventDefault();

            $(this).toggleClass('active');
        });
    }
}
