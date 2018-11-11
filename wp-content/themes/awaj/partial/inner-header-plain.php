<?php use App\Theme\Helper as _; ?>
<!-- inner header -->
<section class="inner__header">
    <div class="container">
        <div class="column">
            <?php
            if (is_singular('post')) {
                echo '<div class="breadcrumb inner__header__breadcrumb">';
                echo '<span><a href="javascript: history.go(-1)">Go Back</a></span>';
                echo '</div>';
            } else {
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb('<div class="breadcrumb inner__header__breadcrumb" data-sal="slide-up" data-sal-delay="400">', '</div>');
                }
            }
            ?>

            <h2 class="inner__header__hl" data-sal="slide-up" data-sal-delay="500"><?= $headerPlainModuleData['post']->post_title ?></h2>

            <?php if(isset($headerPlainModuleData['post']->sub_header_text)) : ?>
            <p class="inner__header__text" data-sal="slide-up" data-sal-delay="600"><?= $headerPlainModuleData['post']->sub_header_text ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>
<!-- inner header -->
