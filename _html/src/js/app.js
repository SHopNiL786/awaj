import { Header } from './modules/Header';
import { Footer } from './modules/Footer';
import { News } from './modules/News';
import { Slider } from './modules/Slider';
import { Url } from './modules/Url';
import { Accordion } from './modules/Accordion';

jQuery(document).ready(function($) {
    new Header();
    new Footer();
    new News();
    new Slider();
    new Url();
    new Accordion();
});
