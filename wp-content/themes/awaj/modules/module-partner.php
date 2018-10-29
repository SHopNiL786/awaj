<!-- partner -->
<section class="partner">
    <div class="container">
        <div class="column">

            <h3 class="partner__hl"><?= $partnerModuleData->title ?></h3>
            <ul class="partner__list">
                <?php
                    for($i = 1; $i <= 14; $i++) {
                        if (isset($partnerModuleData->{'logo_'.$i})) {
                            $link = $partnerModuleData->{'logo_'.$i.'_link'};

                            echo '<li class="partners__list__item">
                                    <a href="'.$link.'" target="_blank" rel="nofollow">
                                    <img src="'.$partnerModuleData->{'logo_'.$i}['url'].'" alt="'.get_the_title($partnerModuleData->{'logo_'.$i}['attachment_id']).'">
                                    </a>
                                </li>';
                        }
                    }
                ?>
            </ul>

        </div>
    </div>
</section>
<!-- partner -->
