<?php
use App\Theme\Helper as _;
?>
<!-- content highlight -->
<section class="content__highlight">
    <div class="container">
        <div class="row">
            <div class="columns <?= _::notNull($contentHighlightModuleData->button) ? 'large-8' : 'large-12' ?>">
                <h4 class="content__highlight__hl"><?= $contentHighlightModuleData->header ?></h4>
                <p class="content__highlight__text"><?= $contentHighlightModuleData->text ?></p>
            </div>
            <?php if(_::notNull($contentHighlightModuleData->button)) : ?>
            <div class="columns large-4">
                <a href="<?= $contentHighlightModuleData->buttonlink ?>" class="content__highlight__button button button--rounded button__primary">
                    <?= $contentHighlightModuleData->button ?>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- content highlight -->