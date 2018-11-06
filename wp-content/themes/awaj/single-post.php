<?php
use App\Theme\Helper as _;

get_header();

	if (have_posts()) :
		while (have_posts()) : the_post();

			$data = [
				'post' => new stdClass()
			];

			$data['post']->post_title = _::title();

			_::view('partial/inner', 'header-plain', $data);
			?>

			<!-- article -->
			<div class="container">
				<div class="row">
					<div class="columns large-8 large-offset-2">
						<article class="article">
							<?php $featuredImage = _::getFeaturedImageUrl(); if ($featuredImage) : ?>
								<figure><img style="max-width: 100%" src="<?= $featuredImage ?>" alt="<?= $data['post']->post_title ?>"></figure>
								<div class="spacer-50"></div>
							<?php endif; ?>

							<?php the_content(); ?>
						</article>
					</div>
				</div>
			</div>
			<!-- article -->

			<?php

		endwhile;
	else :

		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		get_template_part( 404 ); exit();

	endif;

get_footer('dark');
