<?php use App\Theme\Helper as _; ?>

<!-- content image -->
<section class="content__img<?= _::notNull($contentImgModuleData->extraclass) ? ' '.$contentImgModuleData->extraclass : '' ?>" id="<?= $contentImgModuleData->sectionid ?>">
    <div class="container">
        <div class="column">
            <aside class="content__img__main fancy__img fancy__img--secondary">
                <figure class="fancy__img__item" style="background-image: url('<?= $contentImgModuleData->figure['url'] ?>')"></figure>

                <?php
                    if (_::notNull($contentImgModuleData->boxs)) {
                        $boxArray = explode(':', $contentImgModuleData->boxs);
                        $color = _::notNull($contentImgModuleData->color) ? $contentImgModuleData->color : 'primary';

                        foreach($boxArray as $box) {
                            echo '<span class="fancy__img__box '.$box.' bg-color-'.$color.'"></span>';
                        }
                    }
                ?>
            </aside>
            <h3 class="content__img__hl"><?= $contentImgModuleData->title ?></h3>
            <div class="content__img__text">
                <?= apply_filters('the_content', $contentImgModuleData->description) ?>
            </div>
        </div>
    </div>
</section>
<!-- content image -->