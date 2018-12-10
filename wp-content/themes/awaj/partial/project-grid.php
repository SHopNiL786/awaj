<?php
use App\Model\Post;
use App\Theme\Helper as _;

$projects = Post::where(['post_type' => 'project', 'posts_per_page' => 6])->get();
if ($projects->hasPost()) :
?>
<!-- our project -->
<section class="card__container">
    <div class="container">
        <div class="row">
            <div class="columns large-12">
                <h3 class="card__container__hl">Our projects</h3>
                <a href="<?= _::linkCustomPostType('project') ?>" class="card__container__link is--for-medium">See all projects</a>
            </div>
        </div>

        <div class="row">
            <?php $projects->each(function($project) { ?>
                <div class="columns medium-6 large-4">
                    <section class="card" data-sal="fade">
                        <a href="<?= _::link($project->ID) ?>" class="card__link">
                            <figure class="card__fig"><img src="<?= _::getFeaturedImageUrl('full', $project->ID) ?>" alt="<?= $project->post_title ?>"></figure>
                        </a>
                        <h5 class="card__hl"><?= $project->post_title ?></h5>
                        <p class="card__text">
                            <?= wp_trim_words( $project->post_content, 16, NULL ) ?>
                        </p>
                    </section>
                </div>
            <?php }); ?>
        </div>

        <div class="row">
            <div class="columns large-12">
                <a href="<?= _::linkCustomPostType('project') ?>" class="card__container__link is--for-small">See all projects</a>
            </div>
        </div>
    </div>
</section>
<!-- our project -->
<?php endif; ?>