export class Utils {
    static screenWidth() {
        return $(window).width();
    }

    static isSmallScreen() {
        return Utils.screenWidth() < 640;
    }

    static isMediumScreen() {
        return Utils.screenWidth() >= 640 && Utils.screenWidth() <= 1024;
    }

    static isLargeScreen() {
        return Utils.screenWidth() > 1024;
    }
}
