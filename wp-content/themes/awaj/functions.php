<?php
require __DIR__.'/vendor/autoload.php';

use App\Theme\Core;

$theme = new Core();
$theme->injectAssets([
    'styles' => [
        'main-style' => '/dist/css/style.min.css@1.0',
    ],
    'js' => [
        'main-js' => '/dist/js/app.min.js@1.0',
    ],
])
->addSupports([
    'menu',
    'post-thumbnails',
    'html5',
])
->addMenuLocations([
    'primary-menu' => 'Primary menu',
])
->addCustomPostType([
    'staff' => [
        'name' => 'Staff',
        'singular_name' => 'Staff',
        'arguments' => [
            'description'   => 'All team member data',
            'public'        => true,
            'menu_position' => 5,
            'menu_icon'     => 'dashicons-groups',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies'    => array( 'category' ),
            'has_archive'   => true,
            'exclude_from_search' => false,
        ]
    ],
    'project' => [
        'name' => 'Projects',
        'singular_name' => 'Project',
        'arguments' => [
            'description'   => 'All Projects',
            'public'        => true,
            'menu_position' => 5,
            'menu_icon'     => 'dashicons-grid-view',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'   => true,
            'exclude_from_search' => false,
        ]
    ],
    'report' => [
        'name' => 'Annual Reports',
        'singular_name' => 'Annual Report',
        'arguments' => [
            'description'   => 'All Annual Reports',
            'public'        => true,
            'menu_position' => 5,
            'menu_icon'     => 'dashicons-chart-area',
            'supports'      => array( 'title', 'editor', 'thumbnail' ),
            'has_archive'   => true,
            'exclude_from_search' => false,
        ]
    ],
    'jobs' => [
        'name' => 'Jobs',
        'singular_name' => 'Job',
        'arguments' => [
            'description'   => 'All Jobs',
            'public'        => true,
            'menu_position' => 5,
            'menu_icon'     => 'dashicons-id-alt',
            'supports'      => array( 'title', 'editor' ),
            'has_archive'   => true,
            'exclude_from_search' => false,
        ]
    ]
])
->addFilters([
    'excerpt_length' => 16,
    'remove_archive_title' => true,
    'send_yoast_to_bottom' => true,
    'next_prev_button_class' => [
        'next' => 'button button__primary button--small button--rounded',
        'prev' => 'button button__primary__outline button--small button--rounded'
    ]
])
->addThemeSettings([
    'company_name'      => [ 'label' => 'Company name', 'type' => 'text' ],
    'company_address'   => [ 'label' => 'Company address', 'type' => 'textarea' ],
    'contact_number'    => [ 'label' => 'Contact number', 'type' => 'text' ],
    'facebook_name'     => [ 'label' => 'Facebook page name', 'type' => 'text' ],
    'facebook_url'      => [ 'label' => 'Facebook page URL', 'type' => 'text' ],
    'twitter_name'      => [ 'label' => 'Twitter username', 'type' => 'text' ],
    'twitter_url'       => [ 'label' => 'Twitter URL', 'type' => 'text' ],
    'youtube_url'       => [ 'label' => 'YouTube channel URL', 'type' => 'text' ],
    'google_map_api_key'=> [ 'label' => 'Google map API key', 'type' => 'text' ],
    'google_map_lat'    => [ 'label' => 'Google map lat value', 'type' => 'text' ],
    'google_map_lon'    => [ 'label' => 'Google map lon value', 'type' => 'text' ],
])
->fixCategory404()
->completelyDisableRestAPI();


function dd($array) {
    w3r_dd($array);
}