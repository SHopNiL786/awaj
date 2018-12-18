<?php
use App\Theme\Helper as _;
?>
<div class="columns large-2">
    <div class="nav__footer" data-sal="fade">
        <h6 class="nav__footer__hl">About us</h6>
        <?php _::showMenu('primary-menu', ['submenu' => 'About us']); ?>
    </div>
</div>
<div class="columns large-2">
    <div class="nav__footer" data-sal="fade" data-sal-delay="100">
        <h6 class="nav__footer__hl">Our work</h6>
        <?php _::showMenu('primary-menu', ['submenu' => 'Our work']); ?>
    </div>
</div>
<div class="columns large-2">
    <div class="nav__footer" data-sal="fade" data-sal-delay="200">
        <h6 class="nav__footer__hl">Our impact</h6>
        <?php _::showMenu('primary-menu', ['submenu' => 'Our impact']); ?>
    </div>
</div>
<div class="columns large-2">
    <div class="nav__footer" data-sal="fade" data-sal-delay="300">
        <h6 class="nav__footer__hl">Get involved</h6>
        <?php _::showMenu('primary-menu', ['submenu' => 'Get involved']); ?>
    </div>
</div>
<div class="columns large-2">
    <div class="nav__footer" data-sal="fade" data-sal-delay="400">
        <a href="#" class="footer__back-to-top">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M256 464c114.9 0 208-93.1 208-208S370.9 48 256 48 48 141.1 48 256s93.1 208 208 208zm0-244.5l-81.1 81.9c-7.5 7.5-19.8 7.5-27.3 0s-7.5-19.8 0-27.3l95.7-95.4c7.3-7.3 19.1-7.5 26.6-.6l94.3 94c3.8 3.8 5.7 8.7 5.7 13.7 0 4.9-1.9 9.9-5.6 13.6-7.5 7.5-19.7 7.6-27.3 0l-81-79.9z"/></svg>
        </a>

        <h6 class="nav__footer__hl">Contact us</h6>
        <p><small><?= _::themeSettingsValue('company_address'); ?></small></p>
        <p><small><a href="tel:<?= _::themeSettingsValue('contact_number'); ?>"><?= _::themeSettingsValue('contact_number'); ?></a></small></p>
    </div>
</div>