<?php
require __DIR__.'/vendor/autoload.php';

use App\Theme\Core;

$theme = new Core();
$theme->injectAssets([
    'styles' => [
        'main-style' => '/dist/css/style.css@1.0',
    ],
    'js' => [
        'main-js' => '/dist/js/app.js@1.0',
    ],
])
->addSupports([
    'menu',
    'post-thumbnails',
    'html5',
])
->addMenuLocations([
    'primary-menu' => 'Primary menu',
    // 'secondary-menu' => 'Secondary menu',
    // 'tertiary-menu' => 'Tertiary menu',
    // 'social-menu' => 'Social menu',
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
    ]
])
->addFilters([
    'excerpt_length' => 16,
    'remove_archive_title' => true,
]);
// ->addWidgets([
//     [
//         'name'          => 'Widget',
//         'id'            => 'Widget-1',
//         'before_widget' => '<aside>',
//         'after_widget'  => '</aside>',
//         'before_title'  => '<h3 class="rounded">',
//         'after_title'   => '</h3>',
//     ]
// ]);

function dd($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

/**
 * Yoast meta box priority change
 *
 * @return string
 */
function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');


/**
 * Link class added for pagination
 */
add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_2() {
    return 'class="button button__primary__outline button--small button--rounded"';
}
function posts_link_attributes_1() {
    return 'class="button button__primary button--small button--rounded"';
}


/**
 * Category 404 fix
 *
 * @param $query
 */
function custom_pre_get_posts($query) {
    if ($query->is_main_query() && !$query->is_feed() && !is_admin() && is_category()) {
        $query->set('page_val', get_query_var('paged'));
        $query->set('paged', 0);
    }
}

add_action('pre_get_posts', 'custom_pre_get_posts');