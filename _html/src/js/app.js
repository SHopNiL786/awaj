import { Header } from './modules/Header';
import { Footer } from './modules/Footer';
import { News } from './modules/News';

jQuery(document).ready(function($) {
    new Header();
    new Footer();
    new News();
});
