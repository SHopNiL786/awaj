<?php
/*
Plugin Name: wp-modul3r
Plugin URI: http://habibhadi.com
description: Module based website creation for theme development
Version: 1.0.0
Author: Habib Hadi
Author URI: http://habibhadi.com
License: GPL2
*/

/**
 * Prevent direct access
 */
defined('ABSPATH') or die('Direct access not allowed!');

/**
 * Plugin prevent direct access rule
 */
define('WPMODUL3R', true);

/**
 * Version
 */
define('WPMODUL3R_VERSION', '1.0.0');

/**
 * Plugin base directory
 */
define('WPMODUL3R_DIR', __DIR__);

/**
 * Plugin base url
 */
define('WPMODUL3R_URL', plugin_dir_url( __FILE__ ));

/**
 * Plugin base slug
 */
define('WPMODUL3R_SLUG', 'wp-modul3r');

/**
 * Install
 */
 function w3r_install() {
    global $wpdb;

   	$table_modul3r = $wpdb->prefix . 'modul3r';
    $table_modul3r_data = $wpdb->prefix . 'modul3r_data';
    $table_modul3r_structure = $wpdb->prefix . 'modul3r_structure';

 	if($wpdb->get_var("show tables like '$table_modul3r'") != $table_modul3r)
 	{
        $sql = [];

        $sql[] = "CREATE TABLE `".$table_modul3r."` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `page_id` int(11) NOT NULL,
        `theme_key` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
        `module_order` int(11) NOT NULL,
        `state` int(1) NOT NULL,
        `structure_id` int(11) NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";

        $sql[] = "CREATE TABLE `".$table_modul3r_data."` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `module_id` int(11) NOT NULL,
        `field_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
        `field_value` longtext COLLATE utf8_unicode_ci NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

        $sql[] = "CREATE TABLE `".$table_modul3r_structure."` (
        `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
        `name` varchar(299) COLLATE utf8_unicode_ci NOT NULL,
        `structure` text COLLATE utf8_unicode_ci NOT NULL,
        `state` int(1) NOT NULL DEFAULT '1',
        `created_at` datetime NOT NULL,
        `updated_at` datetime NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";

 		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
 		dbDelta($sql);
 	}

}

register_activation_hook(__FILE__, 'w3r_install');


/**
 * Bootstrap
 */
include WPMODUL3R_DIR . '/files/wp-modul3r-bootstrap.php';
