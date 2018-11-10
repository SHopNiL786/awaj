<?php
use App\Theme\Helper as _;

get_header();

$post = new stdClass();
$post->post_title = 'Search results';
$post->sub_header_text = esc_html('Results for - "'.get_search_query().'"');

$data = [
    'post' => $post,
];

_::view('partial/inner', 'header-plain', $data);
?>

    <div class="container">
        <div class="row">
            <div class="columns large-12">

                <?php
                if (have_posts()) :
                    echo '<ul class="search__result">';
                        while ( have_posts() ) : the_post();
                            _::view('partial/search', 'result-item');
                        endwhile;
                    echo '</ul>';
                endif;
                ?>

                <?php if(have_posts()) : ?>
                    <ul class="blog__nav">
                        <li class="blog__nav__primary"><?php previous_posts_link('Previous'); ?></li>
                        <li class="blog__nav__secondary"><?php next_posts_link('Next'); ?></li>
                    </ul>
                <?php endif; ?>

            </div>

        </div>
    </div>

<?php
get_footer('dark');
