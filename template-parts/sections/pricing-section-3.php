<?php

// wp-modula.com pricing plans
wp_enqueue_script('modula-pricing', ANTREAS_ASSETS_JS . 'pricing.js', array('jquery'), ANTREAS_VERSION, true);

$download1_id = 256715;
$download2_id = 256712;
$download3_id = 515186; // simple
$download4_id = 405675;



$utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : '';
$upgrading = false;

// Agency, Business, Trio, Basic
$download_ids = array(
    $download1_id,
    $download2_id,
    $download3_id,
    //$download4_id,
);

$cart_discounts = edd_get_cart_discounts();


if (isset($_GET['license'])) {
    $license_by_key = edd_software_licensing()->get_license($_GET['license'], true);

    if ($license_by_key) {
        $upgrading = true;
        $download_by_license = $license_by_key->download;
        $upgrades = edd_sl_get_license_upgrades($license_by_key->ID);
    }
}

$downloads = array();
foreach ($download_ids as $id) {
    $download = edd_get_download($id);

    if ($upgrading) {
        $download->upgrade_id = modula_get_upgrade_id_by_download_id($upgrades, $download->ID);
        $download->upgrade_cost = edd_sl_get_license_upgrade_cost($license_by_key->ID, $download->upgrade_id);
        $download->higher_plan = array_search($download->id, $download_ids) >= array_search($download_by_license->id, $download_ids) ? false : true;
    }

    $downloads[] = $download;
}

// get addons
$addons = modula_theme_get_all_extensions($downloads);
$addons->posts = array_reverse($addons->posts);
?>
<section class="section pricing-tables">
    <div class="container main-table">
        <div class="plans-table row justify-content-center">
            <?php foreach ($downloads as $download) : ?>
                <div class="col-sm-4 col-md-4 col-lg-3 plan">
                    <h4 class="plans-table__title mb-2"><?php echo explode('-', $download->post_title)[1]; ?></h4>
                    <?php if (has_excerpt($download->ID) && '' != get_the_excerpt($download->ID)): ?>
                        <div class="plans-table__package_description"><?php echo get_the_excerpt($download->ID); ?></div>
                    <?php endif; ?>
                    <p class="plans-table__excerpt"></p>
                    <div class="plans-table__price">
                        <?php if ($upgrading && $download->higher_plan) : ?>
                            <div class="plans-table__initial-price">
                                $<?php echo floor(edd_get_download_price($download->ID)); ?>
                            </div>
                        <?php elseif (count($cart_discounts) > 0) : ?>
                            <div class="plans-table__initial-price">
                                $<?php echo floor(edd_get_download_price($download->ID)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($upgrading && $download->higher_plan) { ?>
                            <sup>$</sup><?php echo $download->upgrade_cost; ?>
                        <?php } else { ?>
                            <sup>$</sup><?php echo floor(modula_edd_get_download_price($download->ID)); ?><sup>.00</sup>
                        <?php } ?>
                    </div>
                    <div class="plans-table__savings mb-2">
                        <?php if ($upgrading && $download->higher_plan) : ?>
                            <div class="plans-table__savings">
                                <p class="wp-block-machothemes-highlight mb-2">
                                    <mark class="wp-block-machothemes-highlight__content">
                                        $<?php echo edd_get_download_price($download->ID) - $download->upgrade_cost; ?>
                                        savings
                                    </mark>
                                </p>
                            </div>
                        <?php elseif (count($cart_discounts) > 0) : ?>
                            <div class="plans-table__savings">
                                <p class="wp-block-machothemes-highlight mb-2">
                                    <mark class="wp-block-machothemes-highlight__content">
                                        $<?php echo edd_get_download_price($download->ID) - modula_edd_get_download_price($download->ID); ?>
                                        savings
                                    </mark>
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ($upgrading && $download->higher_plan) : ?>
                        <a class="button plans-table__button plans-table__button"
                           href="<?php echo esc_url(edd_sl_get_license_upgrade_url($license_by_key->ID, $download->upgrade_id)); ?>"
                           title="Upgrade">Upgrade</a>
                    <?php else : ?>
                        <?php echo do_shortcode('[purchase_link price="0" class="edd-submit button plans-table__button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]'); ?>
                    <?php endif; ?>

                    <div class="plans-table__content">
                        <?php //echo get_the_content(null, null, $download->ID) ?>
                        <?php

                        switch ($download->ID) {
                            case $download1_id: ?>
                                <ul>
                                    <li>⭐️ <a class="compare-plans-button" href="/pricing">All Premium Add-ons</a></li>
                                    <li>⭐️ License for <b>99 sites</b></li>
                                    <li>⭐️ <b>VIP Support</b></li>
                                    <li>Includes Whitelabeling</li>
                                </ul>
                                <?php break;
                            case $download2_id: ?>
                                <ul>
                                    <li>⭐️ <a class="compare-plans-button" href="/pricing">All Premium Add-ons</a></li>
                                    <li>License for <b>5 sites</b></li>
                                    <li>Priority Support</li>
                                </ul>
                                <?php break;
                            case $download3_id: ?>
                                <ul>
                                    <li><a class="compare-plans-button" href="/pricing">All Basic Add-ons</a></li>
                                    <li>License for <b>3 site</b></li>
                                    <li>Regular Support</li>
                                </ul>
                                <?php break;
                        }

                        ?>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="row justify-content-center mt-3">
            <div class="compare-plans-button">👉
                <a class="compare-plans-button"
                   href="/pricing"><?php _e('Compare Pricing Plans', 'modula-theme'); ?></a>
            </div>
        </div>
    </div>


    <div class="container main-table">
        <div class="row">
            <div class="pricing-messsage-row">
                <div class="col-xs-12">
                    <div class="pricing-message">
                        <div class="pricing-message__content">
                            <h5>100% No-Risk Money Back Guarantee!</h5>
                            <p>Tens of thousands of businesses use Modula to build their galleries, showcase their
                                portfolios, optimize their images and speed up their sites!</p>

                            <p class="mb-0">But in the unlikely event that Modula just isn’t for you, let us know
                                and we’ll give
                                you a full refund within the first 14 days of your purchase.</p>
                            <img style="max-width: 150px;"
                                 src="https://wp-modula.com/wp-content/uploads/2021/05/cristian-signature-small.png"
                                 alt="Modula CEO handwritten signature"/>
                            <p class="mb-0"><b>Raiber Cristian</b></p>
                            <p>CEO, WP Modula</p>
                            <small class="pricing-note">All pricing in USD. You can upgrade your plan or cancel at any
                                time. Renewals are at full price when using a discount.</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- row -->
</section>
<section class="section testimonials-section-3 pt-0">
    <div class="container">


        <div class="testimonial__stars"></div>
        <div class="row justify-content-center">
            <div class="testimonial__author col-sm-1">
                <?php echo wp_get_attachment_image(225676, "thumbnail", false, array('class' => 'testimonial__avatar')); ?>
            </div>
            <div class="testimonial__content col-sm-7">
                <p class="mb-0">Modula is <b>one of the leading gallery plugins</b> in the WordPress economy
                    today. Their variety of displays matched with customer support make them a terrific
                    option - Tom McFarlin.</p>
            </div><!-- testimonial -->
            <div class="col-xs-12 text-center mt-3">
                <a class="button button--xl" href="<?php echo esc_url(get_permalink(get_page_by_path('pricing'))); ?>">
                    Get Started Now with Modula
                </a>
                <div>
                    <small class="cta_money_back_guarantee text-center">
                        14 day money back guarantee, love it or get a full refund.
                    </small>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section pricing-table--comparison" id="pricing">
    <div class="container">
        <div id="pricing-table" class="pricing-table pricing-table--header row">
            <div class="col-xs-3">

                <div class="pricing-table__message">
                    <div class="row align-items-center">
                        <div class="col-xs-12">
                            <h6>You can change plans or cancel your account at any time</h6>
                            <small>Choose a plan and you can upgrade or cancel it any time you want.</small>
                        </div>

                    </div>
                </div><!-- pricing-table__message -->
            </div>

            <?php foreach ($downloads as $download) : ?>
                <div class="col-xs-3 <?php echo isset($download->higher_plan) && $download->higher_plan === false ? 'pricing-table-inactive' : ''; ?>">

                    <h4 class="pricing-table__title mb-2"><?php echo explode('-', $download->post_title)[1]; ?></h4>

                    <div class="pricing-table__price mb-2">
                        <?php if ($upgrading && $download->higher_plan) : ?>
                            <div class="pricing-table__initial-price">
                                $<?php echo floor(edd_get_download_price($download->ID)); ?>
                            </div>
                        <?php elseif (count($cart_discounts) > 0) : ?>
                            <div class="pricing-table__initial-price">
                                $<?php echo floor(edd_get_download_price($download->ID)); ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($upgrading && $download->higher_plan) { ?>
                            <sup>$</sup><?php echo $download->upgrade_cost; ?>
                        <?php } else { ?>
                            <sup>$</sup><?php echo floor(modula_edd_get_download_price($download->ID)); ?><sup>.00</sup>
                        <?php } ?>
                    </div>

                    <?php if ($upgrading && $download->higher_plan) : ?>
                        <div class="pricing-table__savings">
                            <p class="wp-block-machothemes-highlight mb-2">
                                <mark class="wp-block-machothemes-highlight__content">
                                    $<?php echo edd_get_download_price($download->ID) - $download->upgrade_cost; ?>
                                    savings
                                </mark>
                            </p>
                        </div>
                    <?php elseif (count($cart_discounts) > 0) : ?>
                        <div class="pricing-table__savings">
                            <p class="wp-block-machothemes-highlight mb-2">
                                <mark class="wp-block-machothemes-highlight__content">
                                    $<?php echo edd_get_download_price($download->ID) - modula_edd_get_download_price($download->ID); ?>
                                    savings
                                </mark>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if ($upgrading && $download->higher_plan) : ?>
                        <a class="button pricing-table__button"
                           href="<?php echo esc_url(edd_sl_get_license_upgrade_url($license_by_key->ID, $download->upgrade_id)); ?>"
                           title="Upgrade">Upgrade</a>
                    <?php else : ?>
                        <?php echo do_shortcode('[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]'); ?>
                    <?php endif; ?>

                </div><!-- col -->

            <?php endforeach; ?>

        </div>

        <div class="pricing-table row">
            <div class="col-xs-3">
                Supported Sites
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">The number of sites on which you can use Modula.</span>
				</span>
            </div>

            <?php foreach ($downloads as $download) : ?>

                <div class="col-xs-3">
                    <?php echo modula_nr_of_sites($download->ID); ?>
                </div>

            <?php endforeach; ?>

        </div><!-- row -->


        <div class="pricing-table row">
            <div class="col-xs-3">
                Support for 1 full year
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">In case you ever run into issues with our plugin (unlikely), feel free to reach out to our support at any time. 
					<br/>------------
					<br/>1. Priority support - tickets get handled in 12 hours or less.
					<br/>2. Regular support - tickets get handled in 48 hours or less.
					<br/>------------
					<br/>* On weekends, response time might slow down to 48hours for priority and up to 96 hours for regular support.</span>
				</span>
            </div>
            <div class="col-xs-3">
                <mark>Priority</mark>
            </div>
            <div class="col-xs-3">
                <mark>Priority</mark>
            </div>
            <div class="col-xs-3">
                Regular
            </div>
        </div><!-- row -->

        <div class="pricing-table row">
            <div class="col-xs-3">
                Updates for 1 full year
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">You’ll have access to free updates for 1 year or until you cancel your subscription. 
					<br/> All of our subscriptions are automatically renewing and renew every 12 months from the last payment date.
					</span>
				</span>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
        </div><!-- row -->


        <div class="pricing-table row">
            <div class="pricing-breaker">
                <h4><?php esc_html_e('Basic Add-ons', 'modula-theme'); ?></h4>
            </div><!--pricing-breaker-->
        </div><!--row -->

        <div class="pricing-table row">
            <div class="col-xs-3">
                Gallery Filters
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">Easily create <a
                                href="<?php echo esc_url(get_permalink(get_page_by_path('demo/filters'))); ?>">filterable WordPress galleries</a> with Modula.</span>
				</span>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
        </div><!-- row -->

        <div class="pricing-table row <?php echo isset($utm_medium) && $utm_medium === 'sorting-metabox' ? 'pricing-table--highlight' : ''; ?>">
            <div class="col-xs-3">
                Gallery Sorting
                <span class="tooltip">
					<i class="icon-question-circle"></i>
					<span class="tooltip__text">Multiple choices for sorting out images from your gallery: manual, date created, date modified, alphabetically, reverse or random</span>
				</span>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
            <div class="col-xs-3">
                <i class="icon-ok"></i>
            </div>
        </div><!-- row -->

        <?php while ($addons->have_posts()) : ?>
            <?php $addons->the_post(); ?>
            <?php if (get_the_id() == 503915): ?>
                <div class="pricing-table row">
                    <div class="pricing-breaker">
                        <h4><?php esc_html_e('Premium Add-ons', 'modula-theme'); ?></h4>
                    </div>
                </div>
            <?php elseif (get_the_id() == 474995): ?>
                <div class="pricing-table row">
                    <div class="pricing-breaker">
                        <h4><?php esc_html_e('Included only with Agency plans', 'modula-theme'); ?></h4>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row pricing-table <?php echo isset($utm_medium) && $utm_medium === get_post_field('post_name') ? 'pricing-table--highlight' : ''; ?>">
                <div class="col-xs-3">
                    <?php echo modula_get_post_meta(get_the_id(), 'pricing_title') != '' ? modula_get_post_meta(get_the_id(), 'pricing_title') : get_the_title(); ?>

                    <?php if (modula_get_post_meta(get_the_id(), 'tooltip') != '' || has_excerpt()) : ?>
                        <span class="tooltip">
							<i class="icon-question-circle"></i>
							<span class="tooltip__text"><?php echo modula_get_post_meta(get_the_id(), 'tooltip') != '' ? modula_get_post_meta(get_the_id(), 'tooltip') : get_the_excerpt(); ?></span>
						</span>
                    <?php endif; ?>
                </div>

                <?php foreach ($downloads as $download) : ?>
                    <div class="col-xs-3">
                        <?php if (false === array_search(get_the_id(), $download->get_bundled_downloads())) : ?>
                            <i class="icon-cancel"></i>
                        <?php else : ?>
                            <i class="icon-ok"></i>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div><!-- row -->

        <?php endwhile; ?>

        <div class="pricing-table pricing-table--last row">
            <div class="col-xs-3">
                <!-- left this here as a spacer -->
            </div>

            <?php foreach ($downloads as $download) : ?>

                <div class="col-xs-3 <?php echo isset($download->higher_plan) && $download->higher_plan === false ? 'pricing-table-inactive' : ''; ?>">

                    <?php if ($upgrading && $download->higher_plan) : ?>
                        <a class="button pricing-table__button"
                           href="<?php echo esc_url(edd_sl_get_license_upgrade_url($license_by_key->ID, $download->upgrade_id)); ?>"
                           title="Upgrade">Upgrade</a>
                    <?php else : ?>
                        <?php echo do_shortcode('[purchase_link price="0" class="edd-submit button pricing-table__button" text="Buy Now" id="' . $download->ID . '" direct="true"]'); ?>
                    <?php endif; ?>

                </div><!-- col -->

            <?php endforeach; ?>

        </div><!-- row -->

    </div><!-- container -->

</section>
