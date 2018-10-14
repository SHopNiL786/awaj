export class Url {
    constructor() {
        this.currentUrl = null;

        this.getCurrentUrl();
        this.init();
    }

    init() {
        if (!this.currentUrl) {
            return false;
        }

        const elementId = `#${this.currentUrl}`;

        if ($(elementId).length === 0) {
            return false;
        }

        this.scrollToElement(elementId);
    }

    getCurrentUrl() {
        if (location.hash) {
            this.currentUrl = location.hash.substring(2);
        }
    }

    scrollToElement(selector) {
        $('html, body').animate({
            scrollTop: $(selector).offset().top - 76
        }, 1000);
    }
}
