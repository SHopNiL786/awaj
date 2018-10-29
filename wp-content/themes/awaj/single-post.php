<?php
use App\Theme\Helper as _;

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	single post data

<?php endwhile; ?>


	<div class="navigation">
		<div class="next-posts"><?php next_posts_link(); ?></div>
		<div class="prev-posts"><?php previous_posts_link(); ?></div>
	</div>

<?php else : ?>

	<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		<h2>Not Found</h2>
	</div>

<?php endif; ?>

<?php
get_footer();
