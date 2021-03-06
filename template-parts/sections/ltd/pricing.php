<?php

//localhost
//$download1_id = 219346;
//$download2_id = 219344;
//$download3_id = 219340;
//$download4_id = 219279;

//wp-modula.com pricing plans
$download1_id = 400415;
$download2_id = 400424;
$download3_id = 400425;
$download4_id = 256704;

wp_enqueue_script( 'waypoints' );

$utm_medium = isset( $_GET['utm_medium'] ) ? $_GET['utm_medium'] : '';
$upgrading = false;

//Agency, Business, Trio, Basic
$download_ids = array( $download1_id, $download2_id, $download3_id );

$cart_discounts = edd_get_cart_discounts();



if ( isset( $_GET['license'] ) ) {
	$license_by_key = edd_software_licensing()->get_license( $_GET['license'], true );

	if ( $license_by_key ) {
		$upgrading = true;
		$download_by_license = $license_by_key->download;
		$upgrades = edd_sl_get_license_upgrades( $license_by_key->ID );
	}
}

$downloads = array();
foreach ( $download_ids as $id ) {
	$download = edd_get_download( $id );

	if ( $upgrading ) {
		$download->upgrade_id = modula_get_upgrade_id_by_download_id( $upgrades, $download->ID );
		$download->upgrade_cost = edd_sl_get_license_upgrade_cost( $license_by_key->ID, $download->upgrade_id );
		$download->higher_plan = array_search( $download->id, $download_ids) >= array_search( $download_by_license->id, $download_ids) ? false : true;
	}

	$downloads[] = $download;
}

//get addons
$addons = modula_theme_get_all_extensions( $downloads );

?>
<section class="pricing-section">

	<a id="pricing" style="position: relative; top: -90px;"></a>

	<div class="container main-table">

		<div class="pricing-table pricing-table--header row">
			<div class="col-xs-4">

				<div class="pricing-table__message visible-xs waypoint">
					<div class="row align-items-center">
						<div class="col-xs-12">
						swipe left to see the entire table
						</div>
					
					</div>
				</div><!-- pricing-table__message -->
			</div>

			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-4 <?php echo isset( $download->higher_plan ) && $download->higher_plan === false ? 'pricing-table-inactive': ''; ?>">

					<h4 class="pricing-table__title mb-2"><?php echo $download->post_title; ?></h4>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<div class="pricing-table__initial-price">
							$<?php echo floor( edd_get_download_price( $download->ID ) ); ?>
						</div>
					<?php elseif ( count( $cart_discounts ) > 0 ): ?>
						<div class="pricing-table__initial-price">
							$<?php echo floor( edd_get_download_price( $download->ID ) ); ?>
						</div>
					<?php endif; ?>

					<div class="pricing-table__price mb-2">
						<?php if ( $upgrading && $download->higher_plan ): ?>
							<sup>$</sup><?php echo $download->upgrade_cost; ?>
						<?php else: ?>
							<sup>$</sup><?php echo edd_get_download_price( $download->ID ); ?>
						<?php endif; ?>
					</div>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<div class="pricing-table__savings">
							<p class="wp-block-machothemes-highlight mb-2">
								<mark class="wp-block-machothemes-highlight__content">$<?php echo edd_get_download_price( $download->ID ) - $download->upgrade_cost; ?> savings</mark>
							</p>
						</div>
					<?php elseif ( count( $cart_discounts ) > 0 ): ?>
						<div class="pricing-table__savings">
							<p class="wp-block-machothemes-highlight mb-2">
								<mark class="wp-block-machothemes-highlight__content">$<?php echo edd_get_download_price( $download->ID ) - edd_get_download_price( $download->ID ); ?> savings</mark>
							</p>
						</div>
					<?php endif; ?>

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<a class="button pricing-table__button" href="<?php echo esc_url( edd_sl_get_license_upgrade_url( $license_by_key->ID, $download->upgrade_id ) ); ?>" title="Upgrade">Upgrade</a>
					<?php else: ?>
						<?php echo do_shortcode( '[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]' ) ?>
					<?php endif; ?>

				</div><!-- col -->

			<?php endforeach; ?>

		</div>

		<div class="pricing-table row">
			<div class="col-xs-4">
				Supported Sites
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">The number of sites on which you can use Modula.</span>
				</span>
			</div>

			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-4">
					<?php echo modula_nr_of_sites( $download->ID ); ?>
				</div>

			<?php endforeach; ?>

		</div><!-- row -->

		<div class="row pricing-table">
			<div class="col-xs-4">
				Lifetime Support
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">In case you ever run into issues with our plugin (unlikely), feel free to reach out to our support at any time.</span>
				</span>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

		<div class="pricing-table row">
			<div class="col-xs-4">
				Lifetime of Free Updates
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">You’ll have lifetime access to updates – including future versions of Strong Testimonials.</span>
				</span>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

        <div class="pricing-table row">
            <div class="pricing-breaker">
                <h4>Modula Extensions</h4>
            </div>
        </div><!--row -->

		<div class="pricing-table row">
			<div class="col-xs-4">
				Gallery Filters
				<span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">Easily create <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'demo/filters' ) ) ); ?>">filterable WordPress galleries</a> with Modula.</span>
				</span>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

		<div class="pricing-table row <?php echo isset( $utm_medium ) && $utm_medium === 'sorting-metabox' ? 'pricing-table--highlight' : ''; ?>">
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
				<i class="icon-ok"></i>
			</div>
			<div class="col-xs-4">
				<i class="icon-ok"></i>
			</div>
		</div><!-- row -->

		<?php while ( $addons->have_posts() ): ?>
			<?php $addons->the_post(); ?>

			<div class="row pricing-table <?php echo isset( $utm_medium ) && $utm_medium === get_post_field( 'post_name' ) ? 'pricing-table--highlight' : ''; ?>">
				<div class="col-xs-4">
					<?php echo modula_get_post_meta( get_the_id(), 'pricing_title' ) != '' ? modula_get_post_meta( get_the_id(), 'pricing_title' ) : get_the_title(); ?>

					<?php if ( modula_get_post_meta( get_the_id(), 'tooltip' ) != '' || has_excerpt() ): ?>
						<span class="tooltip">
							<i class="icon-question-circle"></i>
							<span class="tooltip__text"><?php echo modula_get_post_meta( get_the_id(), 'tooltip' ) != '' ? modula_get_post_meta( get_the_id(), 'tooltip' ) : get_the_excerpt(); ?></span>
						</span>
					<?php endif; ?>
				</div>

				<?php foreach ( $downloads as $download ): ?>
					<div class="col-xs-4">
						<?php if ( false === array_search( get_the_id(), $download->get_bundled_downloads() ) ): ?>
							<i class="icon-cancel"></i>
						<?php else: ?>
							<i class="icon-ok"></i>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>

			</div><!-- row -->

		<?php endwhile; ?>

		<div class="pricing-table pricing-table--last row">
			<div class="col-xs-4 text-left">
				<span class="mb-0"><small>Prices are listed in USD<br/> and don't include VAT</small></span>
			</div>

			<?php foreach( $downloads as $download ): ?>

				<div class="col-xs-4 <?php echo isset( $download->higher_plan ) && $download->higher_plan === false ? 'pricing-table-inactive': ''; ?>">

					<?php if ( $upgrading && $download->higher_plan ): ?>
						<a class="button pricing-table__button" href="<?php echo esc_url( edd_sl_get_license_upgrade_url( $license_by_key->ID, $download->upgrade_id ) ); ?>" title="Upgrade">Upgrade</a>
					<?php else: ?>
						<?php echo do_shortcode( '[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]' ) ?>
					<?php endif; ?>

				</div><!-- col -->

			<?php endforeach; ?>

		</div><!-- row -->



	</div><!-- container -->

	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="pricing-message">
					<div class="pricing-message__content">
						<h5>100% No-Risk Money Back Guarantee!</h5>
						<p>You are fully protected by our 100% No-Risk-Double-Guarantee.  If you don’t like Modula over the next 14 days, then we will happily refund 100% of your money. No questions asked.</p>
					</div>
				</div>
			</div>
		</div><!-- row -->
	</div><!-- container -->

</section>

