<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title-archive' ); ?>

<section class="main">
	<div class="container">
		<div class="row">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<div class="col-sm-6 col-lg-4">
						<?php get_template_part( 'template-parts/post' ); ?>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php //get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<?php the_posts_pagination( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
