<?php
/* Template Name: Staff template */
use App\Model\Post;
use App\Theme\Helper as _;

get_header();

$post = new stdClass();
$post->post_title = 'Our team';

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);


$staffCategory = get_category_by_slug('staff');
$categories = get_categories(['child_of' => $staffCategory->term_id]);

if (count($categories) > 0) :
    foreach($categories as $category) :
        ?>

        <!-- Executive team -->
        <section class="avatar__container">

            <div class="container">
                <div class="column">
                    <h4 class="avatar__header__hl"><?= $category->name ?></h4>
                </div>
            </div>

            <!-- team -->
            <div class="container">
                <div class="column">

                    <div class="avatars">
                        <?php
                        $staffs = Post::where(['post_type' => 'staff', 'posts_per_page' => -1, 'cat' => $category->term_id])->get();
                        $staffs->each(function($staff){
                            ?>
                                <a href="<?= _::link($staff->ID) ?>" class="avatar__link">
                                    <figure class="avatar" style="background-image: url('<?= _::getFeaturedImageUrl('full', $staff->ID) ?>')" data-sal="fade">
                                        <figcaption class="avatar__caption">
                                            <span class="avatar__hl"><?= $staff->post_title ?></span>
                                            <span class="avatar__text"><?= _::acfField( 'designation', $staff->ID ) ?></span>
                                        </figcaption>
                                    </figure>
                                </a>
                            <?php
                        });
                        ?>
                    </div>

                </div>
            </div>
            <!-- team -->
        </section>
        <!-- Executive team -->

        <?php
    endforeach;
endif;

?>
    <div class="spacer-100"></div>
<?php
get_footer('dark');
