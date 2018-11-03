<!-- content card -->
<?php
use App\Model\Post;
use App\Theme\Helper as _;

$latestNews = Post::where(['post_type' => 'post', 'posts_per_page' => 5, 'category_name' => $contentCardModuleData->categoryslug])->get();

$firstNews = $latestNews->eq(0);
?>
<section class="content__card">
    <div class="content__card__header">
        <div class="container">
            <div class="column">
                <h3 class="content__card__hl"><?= $contentCardModuleData->title ?></h3>
                <a href="#" class="content__card__hl__link show-medium-up"><?= $contentCardModuleData->button ?></a>
            </div>
        </div>
    </div>

    <!-- News card body -->
    <div class="content__card__body">

        <div class="container">
            <div class="row">
                <div class="columns small-12 medium-12 large-6">
                    <a href="<?= _::link($firstNews->ID) ?>" class="content__card__item content__card__item--large">
                        <figure class="content__card__item__fig" style="background-image: url('<?= _::getFeaturedImageUrl('full', $firstNews->ID) ?>')"></figure>
                        <div class="content__card__item__body">
                            <time class="content__card__item__meta" datetime="<?= $firstNews->post_date ?>"><?= _::formatDate($firstNews->post_date) ?></time>
                            <h6 class="content__card__item__hl"><?= $firstNews->post_title ?></h6>
                        </div>
                    </a>
                </div>

                <div class="columns small-12 medium-12 large-6">

                    <div class="row">
                        <?php $latestNews->each(function($post, $index) { if ($index > 0) : ?>
                            <div class="columns small-12 medium-6 large-6">
                                <a href="<?= _::link($post->ID) ?>" class="content__card__item">
                                    <figure class="content__card__item__fig" style="background-image: url('<?= _::getFeaturedImageUrl('full', $post->ID) ?>')"></figure>
                                    <div class="content__card__item__body">
                                        <time class="content__card__item__meta" datetime="<?= $post->post_date ?>"><?= _::formatDate($post->post_date) ?></time>
                                        <h6 class="content__card__item__hl"><?= $post->post_title ?></h6>
                                    </div>
                                </a>
                            </div>
                        <?php endif; }); ?>

                        <div class="columns small-12 show-small-only">
                            <a href="#" class="content__card__hl__link">See all news</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <!-- News body ends -->

</section>
<!-- content card -->