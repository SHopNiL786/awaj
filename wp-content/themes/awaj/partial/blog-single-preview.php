<?php use App\Theme\Helper as _; ?>
<!-- Blog -->
<section class="blog" data-sal="slide-up">
    <div class="blog__header">
        <time class="blog__header__date" datetime="<?= get_the_date('c') ?>"><?= get_the_date() ?></time>
        <h5 class="blog__header__hl"><a href="<?= _::link() ?>"><?= _::title() ?></a></h5>
<!--        <div class="blog__header__meta">by <bdi>--><?//= get_the_author() ?><!--</bdi></div>-->
    </div>
    <div class="blog__content">
        <?php $featuredImageUrl = _::getFeaturedImageUrl('medium'); if ($featuredImageUrl) : ?>
        <figure class="blog__content__fig">
            <img src="<?= _::getFeaturedImageUrl('medium') ?>" alt="<?= _::title() ?>">
        </figure>
        <?php endif; ?>
        <summary class="blog__content__text">
            <?= wp_trim_words( _::content(), 40, NULL ) ?>
        </summary>

        <a href="<?= _::link() ?>" class="blog__content__link">Read more</a>
    </div>
</section>
<!-- Blog -->