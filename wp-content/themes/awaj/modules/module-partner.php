<!-- partner -->
<section class="partner">
    <div class="container">
        <div class="column">

            <h3 class="partner__hl"><?= $partnerModuleData->title ?></h3>
            <ul class="partner__list">
                <?php
                    for($i = 1; $i <= 14; $i++) {
                        if (isset($partnerModuleData->{'logo_'.$i})) {
                            echo '<li class="partners__list__item"><img src="'.$partnerModuleData->{'logo_'.$i}['url'].'" alt="'.get_the_title($partnerModuleData->{'logo_'.$i}['attachment_id']).'"></li>';
                        }
                    }
                ?>
            </ul>

        </div>
    </div>
</section>
<!-- partner -->