<!-- content multi -->
<section class="content__multi__col">

    <div class="content__multi__col__header">
        <div class="container">
            <div class="column">
                <h6 class="content__multi__col__header__hl"><?= $contentMultiModuleData->header ?></h6>
                <p class="content__multi__col__header__text"><?= $contentMultiModuleData->subtext ?></p>
            </div>
        </div>
    </div>

    <div class="content__multi__col__body">
        <div class="container">

            <div class="row">
                <div class="columns small-12 medium-6 large-4">

                    <div class="content__card__item">
                        <figure class="content__card__item__fig" style="background-image: url('<?= $contentMultiModuleData->column1_image['url'] ?>')"></figure>
                        <div class="content__card__item__body">
                            <h5 class="content__card__item__hl"><?= $contentMultiModuleData->column1_title ?></h5>
                        </div>
                    </div>
                    <div class="content__multi__col__body__detail">
                        <p class="content__multi__col__body__detail__text"><?= $contentMultiModuleData->column1_body ?></p>

                        <a href="<?= $contentMultiModuleData->column1_buttonlink ?>" class="button__link"><?= $contentMultiModuleData->column1_button ?></a>
                    </div>

                </div>
                <div class="columns small-12 medium-6 large-4">

                    <div class="content__card__item">
                        <figure class="content__card__item__fig" style="background-image: url('<?= $contentMultiModuleData->column2_image['url'] ?>')"></figure>
                        <div class="content__card__item__body">
                            <h5 class="content__card__item__hl"><?= $contentMultiModuleData->column2_title ?></h5>
                        </div>
                    </div>
                    <div class="content__multi__col__body__detail">
                        <p class="content__multi__col__body__detail__text"><?= $contentMultiModuleData->column2_body ?></p>

                        <a href="<?= $contentMultiModuleData->column2_buttonlink ?>" class="button__link"><?= $contentMultiModuleData->column2_button ?></a>
                    </div>

                </div>
                <div class="columns small-12 medium-6 large-4">

                    <div class="content__card__item">
                        <figure class="content__card__item__fig" style="background-image: url('<?= $contentMultiModuleData->column3_image['url'] ?>')"></figure>
                        <div class="content__card__item__body">
                            <h5 class="content__card__item__hl"><?= $contentMultiModuleData->column3_title ?></h5>
                        </div>
                    </div>
                    <div class="content__multi__col__body__detail">
                        <p class="content__multi__col__body__detail__text"><?= $contentMultiModuleData->column3_body ?></p>

                        <a href="<?= $contentMultiModuleData->column3_buttonlink ?>" class="button__link"><?= $contentMultiModuleData->column3_button ?></a>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
<!-- content multi -->