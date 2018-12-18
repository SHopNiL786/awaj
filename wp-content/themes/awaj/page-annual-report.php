<?php
/* Template Name: Annual report template */
use App\Theme\Helper as _;
use App\Model\Post;

get_header();

$post = get_post();

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);

$reports = Post::where([
    'post_type' => 'report',
    'posts_per_page' => -1,
    'meta_key' => 'year',
    'orderby' => 'meta_value',
    'order' => 'DESC'
])->get();
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

    <section class="item__container">
        <div class="container">
            <div class="column">

                <?php $reports->each(function($post){ ?>
                <!-- Item -->
                <section class="item">
                    <figure class="item__fig" style="background-image: url('<?= _::getFeaturedImageUrl('full', $post->ID) ?>')"></figure>

                    <div class="item__content">
                        <h4 class="item__content__hl"><?= $post->post_title ?></h4>
                        <p class="item__content__text"><?= $post->post_content ?></p>
                        <a href="<?= _::acfField('pdf', $post->ID) ?>" target="_blank" class="button button__secondary button--small button--rounded theme--dark">
                            <i class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 37.622 37.622"><path d="M37.306 27.558c-1.339-2.418-7.203-3.958-12.381-4.25a70.667 70.667 0 0 1-1.43-1.582c-4.45-5.088-6.252-12.482-6.925-16.399a43.99 43.99 0 0 0-.242-2.034c-.06-.409-.186-1.262-1.073-1.262-.284 0-.558.122-.753.339-.316.361-.269.749-.213 1.197.063.514.158 1.202.293 1.987.379 3.977.558 11.549-2.503 17.564a62.673 62.673 0 0 1-.953 1.803C5.398 26.587.776 29.558.099 32.022c-.245.892-.032 1.747.601 2.409.737.77 1.607 1.16 2.586 1.16 2.71 0 5.799-3.018 9.181-8.967a29.043 29.043 0 0 1 4.446-.818 48.106 48.106 0 0 0 2.034-.262c1.543-.238 3.289-.334 5.083-.275 4.152 4.316 7.547 6.504 10.091 6.504 1.366-.001 2.497-.667 3.183-1.875.422-.748.424-1.58.002-2.34zM3.285 33.591c-.424 0-.786-.172-1.141-.543-.145-.151-.177-.281-.117-.495.349-1.269 3.281-3.444 7.566-5.023-2.421 3.82-4.738 6.061-6.308 6.061zM18.64 23.57c-.532.082-1.396.194-1.93.25-.971.096-1.969.249-2.976.455l.126-.248c1.501-2.949 2.431-6.485 2.775-10.538 1.377 3.854 3.173 7.06 5.354 9.554.064.074.131.149.195.225-1.259.03-2.447.133-3.544.302zm16.92 5.346c-.332.588-.804.861-1.481.861h-.001c-1.59 0-4.035-1.505-6.962-4.265 4.53.569 7.847 1.94 8.442 3.015.086.156.086.239.002.389z"/></svg>
                            </i>
                            Download report as PDF
                        </a>
                    </div>
                </section>
                <!-- Item -->
                <?php }); ?>

            </div>
        </div>

    </section>

    <div class="spacer-150"></div>

<?php
get_footer('dark');
