<?php use App\Theme\Helper as _; ?>
    <!-- content icon -->
    <section class="content__icon<?= _::notNull($contentIconModuleData->theme) ? ' '.$contentIconModuleData->theme : '' ?>">
        <?php if(_::notNull($contentIconModuleData->header)) : ?>
        <div class="content__icon__header">
            <div class="container">
                <div class="column">
                    <h3 class="content__icon__header__hl"><?= $contentIconModuleData->header ?></h3>
                    <div class="content__icon__header__text"><?= $contentIconModuleData->subheader ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="content__icon__body">
            <div class="container">
                <div class="row">
                    
                    <?php for($i = 1; $i <= 3; $i++) : ?>
                        <div class="columns large-4" data-sal="slide-left" data-sal-delay="<?= $i * 100 ?>">

                            <div class="content__icon__body__item">
                                <i class="icon content__icon__body__item__icon">
                                    <?= stripslashes($contentIconModuleData->{'col_'.$i.'_icon'}) ?>
                                </i>
                                <h5 class="content__icon__body__item__hl"><?= $contentIconModuleData->{'col_'.$i.'_header'} ?></h5>
                                <p class="content__icon__body__item__text">
                                    <?= $contentIconModuleData->{'col_'.$i.'_text'} ?>
                                </p>
                            </div>

                        </div>
                    <?php endfor; ?>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- content icon -->
