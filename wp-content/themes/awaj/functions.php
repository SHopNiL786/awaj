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
// ->addCustomPostType([
//     'product' => [
//         'name' => 'Products',
//         'singular_name' => 'Product',
//         'arguments' => [
//             'description'   => 'Holds our products and product specific data',
//             'public'        => true,
//             'menu_position' => 5,
//             'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
//             'has_archive'   => true,
//         ]
//     ]
// ])
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
