<?php use App\Theme\Helper as _; ?>

<li class="search__result__item">
    <a href="<?= _::link() ?>" class="search__result__item__link"><h5><?= _::title() ?></h5></a>
    <?php
        $limitedContent = _::limitedContent();
        if (_::notNull($limitedContent)) {
            echo '<p class="search__result__item__text">';
            echo $limitedContent;
            echo '</p>';
        } else {
            $yoastMeta = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);

            if ($yoastMeta) {
                echo '<p class="search__result__item__text">';
                echo $yoastMeta;
                echo '</p>';
            }
        }
    ?>
</li>