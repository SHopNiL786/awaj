<?php
/* Template Name: Collaborate with us template */
use App\Theme\Helper as _;

get_header();

$post = get_post();

$featuredImage = _::getFeaturedImageUrl('full', $post->ID);

if ($featuredImage) {
    $data = [
        'post' => $post,
        'featuredImage' => $featuredImage,
    ];

    _::view('partial/inner', 'header', $data);
} else {
    $data = [
        'post' => $post,
    ];

    _::view('partial/inner', 'header-plain', $data);
}

$modules = w3r_get_modules($post->ID);

if (count($modules) > 0) {
    foreach($modules as $moduleName => $moduleData) {
        if (isset($modules[$moduleName])) {
            _::view('modules/module', $moduleName, $moduleData);
        }
    }
}

get_footer('dark');
