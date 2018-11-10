<?php
use App\Theme\Helper as _;
use App\Model\Post;

get_header();

$data = [];
$data['post'] = new stdClass();
$data['post']->post_title = 'Case studies';

$data['featuredImage'] = _::getAttachmentByPostName('1920x500-case-studies')->guid;

_::view('partial/inner', 'header', $data);

$categoryId = _::getCategoryIdByName('case-studies', 'slug');
$paged = get_query_var('page_val') ? get_query_var('page_val') : 1;
$the_query = Post::fetch(['post_type' => 'post', 'posts_per_page' => 4, 'cat' => $categoryId, 'paged' => $paged]);
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

            <aside class="columns large-offset-1 large-3">
                <?php $categories = get_categories(['parent' => $categoryId]); ?>
                <div class="blog__aside__nav">
                    <ul>
                        <li><a href="<?= _::getCategoryLink($categoryId) ?>">All case studies</a></li>
                        <?php foreach($categories as $category) : ?>
                            <li><a href="<?= _::getCategoryLink($category->term_id) ?>"><?= $category->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </aside>

        </div>
    </div>
    <!-- article -->

<?php
get_footer('dark');
