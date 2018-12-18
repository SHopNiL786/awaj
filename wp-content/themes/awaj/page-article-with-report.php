<?php
/* Template Name: Article with report template */
use App\Theme\Helper as _;
use App\Model\Post;

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

        <div class="spacer-50"></div>
    <?php endif; ?>

<?php
    $reports = Post::where([
        'post_type' => 'report',
        'posts_per_page' => 4,
        'meta_key' => 'year',
        'orderby' => 'meta_value',
        'order' => 'DESC'
    ])->get();

if ($reports->hasPost()) :
?>

    <!-- Items -->
    <div class="container">
        <div class="column">
            <h4 class="item__hl">Monitoring and evaluation reports</h4>
        </div>

        <div class="row">

            <?php $reports->each(function($post){ ?>
            <div class="columns large-6">
                <!-- item -->
                <section class="item item--small">
                    <figure class="item__fig" style="background-image: url('<?= _::getFeaturedImageUrl('full', $post->ID) ?>')"></figure>

                    <div class="item__content">
                        <h6 class="item__content__hl"><a href="<?= _::acfField('pdf', $post->ID) ?>" target="_blank"><?= $post->post_title ?></a></h6>
                        <p class="item__content__text"><?= wp_trim_words($post->post_content, 22, NULL) ?></p>
                    </div>
                </section>
                <!-- item -->
            </div>
            <?php }); ?>

        </div>
    </div>
    <!-- Items -->

    <div class="spacer-100"></div>

<?php
endif;
get_footer('dark');
