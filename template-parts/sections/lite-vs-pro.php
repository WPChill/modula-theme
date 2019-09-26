<?php
$utm_medium = isset( $_GET['utm_medium'] ) ? $_GET['utm_medium'] : '';

//get addons
$args = array(
	'post_type'      => 'download',
	'post_status'    => array( 'publish' ),
	'posts_per_page' => -1,
	'order' => 'ASC',
	'orderby' => 'menu_order',
	'tax_query'      => array(
		array(
			'taxonomy' => 'download_category',
			'field'    => 'slug',
			'terms'    => 'addons',
		),
	),
);
// this will show hidden extensions as well
remove_action( 'pre_get_posts', array( EDD_Hide_Download::get_instance(), 'pre_get_posts' ), 9999 );
$addons = new WP_Query( $args );
?>

<section class="lite-vs-pro-section">

	<div class="container lite-vs-pro-table">

		<a id="lite-vs-pro" style="position: relative; top: -90px;"></a>

		<div class="row text-center">
			<div class="col-xs-12">
				<h3>Feature Comparison LITE vs PRO plans</h3>
			</div>
		</div><!-- row -->

		<div class="row">
			<div class="col-md-9">

				<div class="pricing-table pricing-table--header row">
					<div class="col-xs-4">
						<div class="pricing-table__message visible-xs waypoint">
							<div class="row align-items-center">
								<div class="col-xs-10">
								swipe left to see the entire table
								</div>
								<div class="col-xs-2">
									<i class="icon-right-open-big"></i>
								</div>
							</div>
						</div><!-- pricing-table__message -->
					</div>
					<div class="col-xs-4">
						<h4 class="pricing-table__title">Agency, Business, Trio or Basic</h4>
						<br />
						<a class="button pricing-table__button" href="#pricing">Upgrade Now</a>
					</div>
					<div class="col-xs-4">
						<h4 class="pricing-table__title">Lite</h4>
						<br />
						<a style="opacity: 0; pointer-events:none" class="button pricing-table__button" href="https://wordpress.org/plugins/modula-best-grid-gallery/" target="_blank">Download Lite</a>
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Included Lightbox Styles
					</div>
					<div class="col-xs-4">
						6 Unique Styles
					</div>
					<div class="col-xs-4">
						Only 1
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Included Hover Effects
					</div>
					<div class="col-xs-4">
						40 Unique Hover Effects
					</div>
					<div class="col-xs-4">
						Only 1
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Included Loading Effects
					</div>
					<div class="col-xs-4">
						4 Unique Loading Effects
					</div>
					<div class="col-xs-4">
						Only 1
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Gallery Filters
					</div>
					<div class="col-xs-4">
						<i class="icon-ok"></i>
					</div>
					<div class="col-xs-4">
						<i class="icon-cancel"></i>
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Gallery Sorting
						<span class="tooltip">
							<i class="icon-question-circle"></i>
							<span class="tooltip__text">Multiple choices for sorting out images from your gallery: manual, date created, date modified, alphabetically, reverse or random</span>
						</span>
					</div>
					<div class="col-xs-4">
						<i class="icon-ok"></i>
					</div>
					<div class="col-xs-4">
						<i class="icon-cancel"></i>
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Number of Images
					</div>
					<div class="col-xs-4">
						Unlimited Images
					</div>
					<div class="col-xs-4">
						Only 20 Images
					</div>
				</div><!-- row -->

				<div class="pricing-table row">
					<div class="col-xs-4">
						Number of Galleries
					</div>
					<div class="col-xs-4">
					   Unlimited Galleries
					</div>
					<div class="col-xs-4">
						Unlimited Galleries
					</div>
				</div><!-- row -->

				<?php while ( $addons->have_posts() ): ?>
					<?php $addons->the_post(); ?>

					<div class="row pricing-table <?php echo isset( $utm_medium ) && $utm_medium === get_post_field( 'post_name' ) ? 'pricing-table--highlight' : ''; ?>">
						<div class="col-xs-4">
							<?php echo modula_get_post_meta( get_the_id(), 'pricing_title' ) != '' ? modula_get_post_meta( get_the_id(), 'pricing_title' ) : strstr( get_the_title()," " ) . ' Extension'; ?>

							<?php if ( modula_get_post_meta( get_the_id(), 'tooltip' ) != '' || has_excerpt() ): ?>
								<span class="tooltip">
									<i class="icon-question-circle"></i>
									<span class="tooltip__text"><?php echo modula_get_post_meta( get_the_id(), 'tooltip' ) != '' ? modula_get_post_meta( get_the_id(), 'tooltip' ) : get_the_excerpt(); ?></span>
								</span>
							<?php endif; ?>
						</div>
						<div class="col-xs-4">
							<i class="icon-ok"></i>
						</div>
						<div class="col-xs-4">
							<i class="icon-cancel"></i>
						</div>
					</div><!-- row -->

				<?php endwhile; ?>

				<div class="pricing-table pricing-table--last row">
					<div class="col-xs-4">
					</div>
					<div class="col-xs-4">
						<a class="button pricing-table__button" href="#pricing">Upgrade Now</a>
					</div>
					<div class="col-xs-4">
					</div>
				</div><!-- row -->

			</div><!-- col -->
		</div><!-- row -->
	</div><!-- container -->




</section>

