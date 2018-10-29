<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

add_action( 'admin_enqueue_scripts', 'wp_modul3r_load_cssjs' );
function wp_modul3r_load_cssjs() {
    wp_enqueue_media();

    wp_enqueue_style( 'wp-modul3r-css', WPMODUL3R_URL . 'css-js/wp-modul3r.css');
    wp_enqueue_script( 'wp-modul3r-js', WPMODUL3R_URL . 'css-js/wp-modul3r.js', [], '1.0.0', true );
}
