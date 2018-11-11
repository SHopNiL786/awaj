<?php
use App\Theme\Helper as _;

get_header();

$post = get_post();
$featuredImage = _::getFeaturedImageUrl('full', $post->ID);

if ($featuredImage) {
    $data = [
        'post' => $post,
        'featuredImage' => $featuredImage,
        'theme' => 'inner__header--white'
    ];

    _::view('partial/inner', 'header', $data);
} else {
    $data = [
        'post' => $post,
    ];

    _::view('partial/inner', 'header-plain', $data);
}
?>

    <!-- article -->
    <div class="container">
        <div class="row">
            <div class="columns large-12">

                <article class="article" data-sal="fade">
                    <?= apply_filters('the_content', $post->post_content) ?>
                </article>

            </div>
        </div>
    </div>
    <!-- article -->

<?php
$modules = w3r_get_modules($post->ID);

if (count($modules) > 0) {
    foreach($modules as $moduleName => $moduleData) {
        if (isset($modules[$moduleName])) {
            _::view('modules/module', $moduleName, $moduleData);
        }
    }
}

get_footer('dark');
