<?php
defined('WPMODUL3R') or die('Direct access not allowed!');

/**
 * Menu configuration
 */
add_action('admin_menu', 'wp_modul3r_menu');
function wp_modul3r_menu(){
    add_menu_page( 'WP modul3r', 'Page modules', 'manage_options', WPMODUL3R_SLUG, 'wp_modul3r_init', 'dashicons-editor-table', 21 );
    add_submenu_page( WPMODUL3R_SLUG, 'Add New Module', 'Add New Module', 'manage_options', WPMODUL3R_SLUG.'-module-add', 'wp_modul3r_module_add');

    add_submenu_page( WPMODUL3R_SLUG, 'All Structures', 'All Structures', 'manage_options', WPMODUL3R_SLUG.'-structure', 'wp_modul3r_structure');
    add_submenu_page( WPMODUL3R_SLUG, 'Add New Structure', 'Add New Structure', 'manage_options', WPMODUL3R_SLUG.'-structure-add', 'wp_modul3r_structure_add');
}

/**
 * Dashboard and Module edit
 */
function wp_modul3r_init(){
    $edit = isset($_GET['edit']) ? wpModul3rSanitizeGet($_GET['edit']) : null;

    if($edit) {
        include WPMODUL3R_DIR . '/modules/wp-modul3r-module-edit.php';
    }
    else {
        include WPMODUL3R_DIR . '/modules/wp-modul3r-home.php';
    }
}

/**
 * Add new module
 */
function wp_modul3r_module_add() {
    include WPMODUL3R_DIR . '/modules/wp-modul3r-module-add.php';
}

/**
 * Module structure and edit
 */
function wp_modul3r_structure() {
    $edit = isset($_GET['edit']) ? wpModul3rSanitizeGet($_GET['edit']) : null;

    if(!$edit) {
        include WPMODUL3R_DIR . '/modules/wp-modul3r-structure.php';
    }
    else {
        include WPMODUL3R_DIR . '/modules/wp-modul3r-structure-edit.php';
    }
}

/**
 * Add new module structure
 */
function wp_modul3r_structure_add() {
    include WPMODUL3R_DIR . '/modules/wp-modul3r-structure-add.php';
}

/**
 * Ajax request for image preview
 */
add_action( 'wp_ajax_wp_modul3r_get_image', 'wp_modul3r_get_image');
function wp_modul3r_get_image() {
    if(isset($_GET['id']) ){
        $data = [];
        $idArray = explode(",", $_GET['id']);
        foreach ($idArray as $id) {
            $data[] = wp_get_attachment_image($id) ? wp_get_attachment_image($id) : wp_get_attachment_link($id);
        }
        wp_send_json_success($data);
    } else {
        wp_send_json_error();
    }
}
