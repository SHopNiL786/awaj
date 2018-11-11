<?php
use App\Theme\Helper as _;

get_header();

$post = get_post();

$customField = _::acfFields($post->ID);

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);
?>

    <!-- meta -->
    <section class="meta theme--dark">
        <div class="container">
            <div class="row">

                <?php if (isset($customField->duration_of_project)) : ?>
                <div class="columns large-4" data-sal="slide-left" data-sal-delay="500">
                    <h6 class="meta__hl">Duration of project</h6>
                    <p class="meta__text">
                        <?php
                            echo $customField->duration_of_project;
                            if ($customField->duration_of_project > 1) {
                                echo ' months';
                            } else {
                                echo ' month';
                            }
                        ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php if (isset($customField->donors)) : ?>
                <div class="columns large-4" data-sal="slide-left" data-sal-delay="600">
                    <h6 class="meta__hl">Donor</h6>
                    <p class="meta__text">
                        <?= $customField->donors ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php if (isset($customField->partners)) : ?>
                <div class="columns large-4" data-sal="slide-left" data-sal-delay="700">
                    <h6 class="meta__hl">Partner(s)</h6>
                    <p class="meta__text">
                        <?= $customField->partners ?>
                    </p>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
    <!-- meta -->

    <!-- slider -->
    <?php $sliderImages = _::groupBy('slider_image', $customField); if (count($sliderImages) > 0) : ?>
    <section class="slider">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach($sliderImages as $sliderImage) : ?>
                <div class="swiper-slide">
                    <figure class="slider__fig" style="background-image: url('<?= $sliderImage ?>')"></figure>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="swiper-pagination"></div>
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>
        </div>
    </section>
    <?php endif; ?>
    <!-- slider -->

    <!-- article -->
    <div class="container">
        <div class="row">
            <div class="columns large-8 large-offset-2">

                <article class="article">
                    <?= apply_filters('the_content', $post->post_content) ?>
                </article>

            </div>
        </div>
    </div>
    <!-- article -->


<?php
_::view('partial/latest', 'news', ['theme' => 'bg-color-light']);

get_footer('dark');
