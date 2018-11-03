<?php
use App\Model\Post;
use App\Theme\Helper as _;

get_header();

$data = [
    'post' => new stdClass(),
];

$data['post']->post_title = 'All projects';

_::view('partial/inner', 'header-plain', $data);

$projects = Post::where(['post_type' => 'project'])->get();
if ($projects->hasPost()) :
?>

    <!-- our project -->
    <section class="card__container" style="background: none">
        <div class="container">
            <div class="row">
                <?php $projects->each(function($project) { ?>
                    <div class="columns medium-6 large-4">
                        <section class="card">
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
        </div>
    </section>
    <!-- our project -->

<?php endif;

get_footer('dark');
