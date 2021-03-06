<?php get_header(); ?>

<section class="title-single-section">
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-7 text-left">
	            <h1 class="h2 title-single__title mb-0"><strong><?php echo esc_html( get_the_title() ); ?></strong>
	            </h1>
            </div>
        </div>
    </div>
</section>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<div class="post-content col-md-7">
						<?php the_content(); ?>
						<?php do_action( 'modula_after_single_content' );  ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>