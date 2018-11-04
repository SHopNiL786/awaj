<?php
use App\Theme\Helper as _;
use App\Model\Post;

get_header();

$data = [];
$data['post'] = new stdClass();
$data['post']->post_title = 'Latest news';

$data['featuredImage'] = _::getAttachmentByPostName('1920x500-latest-news')->guid;
$data['theme'] = 'inner__header--white';

_::view('partial/inner', 'header', $data);

$paged = get_query_var('page_val') ? get_query_var('page_val') : 1;
$the_query = Post::fetch(['post_type' => 'post', 'posts_per_page' => 4, 'category_name' => 'news', 'paged' => $paged]);
?>

    <!-- article -->
    <div class="container">
        <div class="row">
            <div class="columns large-8">

                <?php
                if ($the_query->have_posts()) :
                    while ( $the_query->have_posts() ) : $the_query->the_post();
                        _::view('partial/blog', 'single-preview');
                    endwhile;
                endif;
                ?>

                <?php if($the_query->have_posts()) : ?>
                    <ul class="blog__nav">
                        <li class="blog__nav__primary"><?php previous_posts_link('Previous', $the_query->max_num_pages); ?></li>
                        <li class="blog__nav__secondary"><?php next_posts_link('Next', $the_query->max_num_pages); ?></li>
                    </ul>
                <?php endif; Post::reset(); ?>

            </div>

        </div>
    </div>
    <!-- article -->

<?php
get_footer('dark');
