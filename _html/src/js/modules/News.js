export class News {
    constructor() {
        this.limitTitle();
    }

    limitTitle() {
        $('.content__card__item__hl').each(function(index, el) {
            const text = $(el).text();
            const maxTextLength = 70;
            const maxTextLengthLarge = 125;

            if ( $(el).closest('.content__card__item ').hasClass('content__card__item--large') ) {
                if (text.length > maxTextLengthLarge) {
                    $(el).html(text.substring(0, maxTextLengthLarge) + ' &nbsp; &rarr;');
                }
            } else {
                if (text.length > maxTextLength) {
                    $(el).html(text.substring(0, maxTextLength) + ' &nbsp; &rarr;');
                }
            }
        });
    }
}
