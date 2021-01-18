<?php /* Template Name: Checkout */ ?>

<?php get_header( 'checkout' ); ?>

<?php
$payment_mode = edd_get_chosen_gateway();
$form_action  = esc_url( edd_get_checkout_uri( 'payment-mode=' . $payment_mode ) );
?>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">

			<?php if ( function_exists( 'edd_get_cart_contents' ) && edd_get_cart_contents() ) { ?>

			<div class="col-sm-12 title-wrap justify-content-center">
				<h1 class="h3 text-center">Complete Your Purchase</h1>
				<p class="text-center">You're <u>5 minutes away</u> from having a gallery that amazes potential clients.</p>

				<div class="col-lg-8 col-lg-offset-2">
				<?php edd_checkout_cart(); ?>
					<div id="edd_checkout_form_wrap" class="edd_clearfix">
						<?php do_action( 'edd_before_purchase_form' ); ?>
						<form id="edd_purchase_form" class="edd_form" action="<?php echo $form_action; ?>" method="POST">
							<?php
							/**
							 * Hooks in at the top of the checkout form
							 *
							 * @since 1.0
							 */
							do_action( 'edd_checkout_form_top' );

							if ( edd_is_ajax_disabled() && ! empty( $_REQUEST['payment-mode'] ) ) {
								do_action( 'edd_purchase_form' );
							} elseif ( edd_show_gateways() ) {
								do_action( 'edd_payment_mode_select' );
							} else {
								do_action( 'edd_purchase_form' );
							}

							/**
							 * Hooks in at the bottom of the checkout form
							 *
							 * @since 1.0
							 */
							do_action( 'edd_checkout_form_bottom' );


							?>
						</form>
						<?php do_action( 'edd_after_purchase_form' ); ?>
					</div><!--end #edd_checkout_form_wrap-->

				</div><!-- col -->

				<div class="col-lg-5"> <!--right hand side checkout details -->
					
				<?php } else { ?>

					<div class="col-sm-12 title-wrap">
						<h1 class="h3 text-center">Checkout</h1>
						<div class="text-center">
							<p class="empty-cart">Your cart is empty</p>
							<a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'pricing' ) ) ); ?>">Buy Modula Gallery</a>
							<div>
								<img width="600" src="<?php echo get_template_directory_uri(); ?>/assets/images/illustration-13.svg" alt="Cart">
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
</section>

<?php wp_footer(); ?>
<?php get_template_part( 'template-parts/sections/footer-simple' ); ?>

