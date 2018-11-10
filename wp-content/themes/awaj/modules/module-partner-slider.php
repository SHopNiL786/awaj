<?php
use App\Theme\Helper as _;
?>
<!-- slider -->
<div class="container">
    <div class="column">

        <!-- slider -->
        <section class="slider__carousel">
            <h3 class="slider__carousel__hl"><?= $partnerSliderModuleData->title ?></h3>

            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <?php
                    for($i = 1; $i <= 14; $i++) {
                        if (isset($partnerSliderModuleData->{'logo_'.$i}) && _::notNull($partnerSliderModuleData->{'logo_'.$i}['url'])) {
                            $link = $partnerSliderModuleData->{'logo_'.$i.'_link'};

                            echo '<div class="swiper-slide">
                                    <a href="'.$link.'" target="_blank" rel="nofollow">
                                        <figure class="slider__fig partners__list__item">
                                            <img src="'.$partnerSliderModuleData->{'logo_'.$i}['url'].'" alt="'.get_the_title($partnerSliderModuleData->{'logo_'.$i}['attachment_id']).'">
                                        </figure>
                                    </a>
                                </div>';
                        }
                    }
                    ?>
                </div>
            </div>

            <div class="swiper-pagination"></div>
        </section>
        <!-- slider -->

    </div>
</div>
<!-- slider -->