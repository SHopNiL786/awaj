<!-- content card -->
<?php
use App\Model\Post;
use App\Theme\Helper as _;

$categoryId = _::getCategoryIdByName('news');
$categoryLink = _::getCategoryLink($categoryId);
$latestNews = Post::where(['post_type' => 'post', 'posts_per_page' => 4, 'cat' => $categoryId])->get();
?>
<!-- latest news -->
<section class="content__card<?= isset($newsModuleData) && isset($newsModuleData['theme']) ? ' '.$newsModuleData['theme'] : '' ?>">
    <div class="content__card__header">
        <div class="container">
            <div class="column">
                <h3 class="content__card__hl">Latest news</h3>
                <a href="<?= $categoryLink ?>" class="content__card__hl__link">See all news</a>
            </div>
        </div>
    </div>

    <!-- News card body -->
    <div class="content__card__body">

        <div class="container">
            <div class="row">
                <?php $latestNews->each(function($post){ ?>
                <div class="columns large-3">

                    <a href="<?= _::link($post->ID) ?>" class="content__card__item">
                        <figure class="content__card__item__fig" style="background-image: url('<?= _::getFeaturedImageUrl('full', $post->ID) ?>')"></figure>
                        <div class="content__card__item__body">
                            <time class="content__card__item__meta" datetime="<?= $post->post_date ?>"><?= _::formatDate($post->post_date) ?></time>
                            <h6 class="content__card__item__hl"><?= $post->post_title ?></h6>
                        </div>
                    </a>

                </div>
                <?php }); ?>
            </div>
        </div>

    </div>
    <!-- News body ends -->

</section>
<!-- lastest news -->