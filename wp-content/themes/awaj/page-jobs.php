<?php
/* Template Name: Jobs template */
use App\Theme\Helper as _;
use App\Model\Post;

get_header();

$post = get_post();
$featuredImage = _::getFeaturedImageUrl('full', $post->ID);

if ($featuredImage) {
    $data = [
        'post' => $post,
        'featuredImage' => $featuredImage,
        'theme' => 'inner__header--dark'
    ];

    _::view('partial/inner', 'header', $data);
} else {
    $data = [
        'post' => $post,
    ];

    _::view('partial/inner', 'header-plain', $data);
}
?>

<?php if (_::notNull($post->post_content)) : ?>
    <!-- article -->
    <div class="container">
        <div class="row">
            <div class="columns large-12">

                <article class="article">
                    <?= apply_filters('the_content', $post->post_content) ?>
                </article>

            </div>
        </div>
    </div>
    <!-- article -->
<?php endif; ?>

<?php
$jobs = Post::where(['post_type' => 'jobs', 'posts_per_page' => -1])->get();
?>

    <?php if ($jobs->hasPost()) : ?>
    <section class="job">
        <div class="container">
            <div class="column" data-sal="fade">

                <h4 class="job__hl">Current openings</h4>
                <ul class="accordion">
                    <?php $jobs->each(function($job){ ?>
                    <li class="accordion__item">
                        <div class="accordion__item__header">
                            <h6 class="accordion__item__hl"><?= $job->post_title ?></h6>
                            <span class="accordion__item__text">Number of vacancy: <?= _::acfField('number_of_vacancy', $job->ID) ?></span>
                        </div>

                        <article class="accordion__item__body">
                            <?= apply_filters('the_content', $job->post_content) ?>
                        </article>
                    </li>
                    <?php }); ?>
                </ul>

                <?= apply_filters('the_content', $post->post_content) ?>

            </div>
        </div>
    </section>
    <?php endif; ?>

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
