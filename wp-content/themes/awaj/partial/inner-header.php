<!-- inner header -->
<section class="inner__header inner__header--has__image<?= isset($headerModuleData['theme']) ? ' '.$headerModuleData['theme'] : '' ?>">
    <figure class="inner__header__img" style="background-image: url('<?= $headerModuleData['featuredImage'] ?>')"></figure>

    <div class="container">
        <div class="column">

            <div class="inner__header__content">
                <span class="inner__header__content__box"></span>
                <div class="inner__header__content__area">
                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('<div class="breadcrumb inner__header__breadcrumb">', '</div>');
                        }
                    ?>

                    <h2 class="inner__header__hl"><?= $headerModuleData['post']->post_title ?></h2>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- inner header -->
