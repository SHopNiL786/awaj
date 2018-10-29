<!-- inner header -->
<section class="inner__header">
    <div class="container">
        <div class="column">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<div class="breadcrumb inner__header__breadcrumb">', '</div>');
                }
            ?>

            <h2 class="inner__header__hl"><?= $headerPlainModuleData['post']->post_title ?></h2>
        </div>
    </div>
</section>
<!-- inner header -->
