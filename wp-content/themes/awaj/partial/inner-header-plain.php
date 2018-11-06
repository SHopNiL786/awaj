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
                    yoast_breadcrumb('<div class="breadcrumb inner__header__breadcrumb">', '</div>');
                }
            }
            ?>

            <h2 class="inner__header__hl"><?= $headerPlainModuleData['post']->post_title ?></h2>
        </div>
    </div>
</section>
<!-- inner header -->
