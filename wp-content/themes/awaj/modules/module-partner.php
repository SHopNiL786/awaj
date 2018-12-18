<?php
use App\Theme\Helper as _;
?>
<!-- partner -->
<section class="partner<?= isset($partnerModuleData->theme) ? ' '.$partnerModuleData->theme : '' ?>">
    <div class="container">
        <div class="column">

            <?php if ($partnerModuleData->title) : ?>
                <h3 class="partner__hl"><?= $partnerModuleData->title ?></h3>
            <?php endif; ?>
            <ul class="partner__list">
                <?php
                    for($i = 1; $i <= 21; $i++) {
                        if (isset($partnerModuleData->{'logo_'.$i}) && _::notNull($partnerModuleData->{'logo_'.$i}['url'])) {
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
