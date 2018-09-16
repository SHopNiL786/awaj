export class Footer {
    constructor() {
        this.init();
    }

    init() {
        $('.footer__back-to-top').click(function(event) {
            event.preventDefault();

            $('html, body').animate({scrollTop: 0}, 800);
        });
    }
}
