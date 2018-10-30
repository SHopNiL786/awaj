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

function yoasttobottom() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoasttobottom');
