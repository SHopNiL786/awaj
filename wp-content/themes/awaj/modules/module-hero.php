<!-- hero -->
<section class="hero">
    <figure class="hero__img" style="background-image: url('<?= $heroModuleData->background['url'] ?>')"></figure>

    <div class="hero__body">
        <div class="container">
            <div class="row">
                <div class="columns large-7">
                    <div class="hero__body__content">
                        <div class="hero__body__content__text" data-sal="fade">
                            <h6 class="hero__subhl"><?= $heroModuleData->subtext ?></h6>
                            <h3 class="hero__hl"><?= $heroModuleData->maintext ?></h3>
                            <a href="<?= $heroModuleData->buttonlink ?>" class="hero__button button button__primary button--rounded"><?= $heroModuleData->button ?></a>
                        </div>
                    </div>
                </div>
                <div class="columns large-5">
                    <div class="hero__main__img">
                        <aside class="fancy__img">
                            <figure class="fancy__img__item" style="background-image: url('<?= $heroModuleData->foreground['url'] ?>" data-sal="fade" data-sal-delay="100"></figure>
                            <span class="fancy__img__box is--top-right bg-color-secondary" data-sal="slide-up" data-sal-delay="200"></span>
                            <span class="fancy__img__box is--bottom-right bg-color-white" data-sal="slide-down" data-sal-delay="300"></span>
                            <span class="fancy__img__box is--bottom-left bg-color-primary" data-sal="slide-left" data-sal-delay="400"></span>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hero -->