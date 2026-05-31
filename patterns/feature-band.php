<?php
/**
 * Title: Feature Band
 * Slug: oconee-renovations/feature-band
 * Categories: oconee-renovations
 */

$icon_base = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/icons/';
?>

<!-- wp:group {"align":"full","className":"feature-band","backgroundColor":"ash","style":{"spacing":{"padding":{"top":"1.25rem","bottom":"1.25rem"}}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull feature-band has-ash-background-color has-background" style="padding-top:1.25rem;padding-bottom:1.25rem">
	<!-- wp:columns {"className":"feature-band__columns is-not-stacked-on-mobile","style":{"spacing":{"blockGap":{"left":"2rem"}}}} -->
	<div class="wp-block-columns feature-band__columns is-not-stacked-on-mobile">
		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:html -->
			<div class="feature-band__item">
				<span class="feature-band__icon" aria-hidden="true"><img src="<?php echo esc_url( $icon_base . 'faClock.png' ); ?>" alt="" width="14" height="14" decoding="async" /></span>
				<span class="feature-band__label">On Time</span>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:html -->
			<div class="feature-band__item">
				<span class="feature-band__icon" aria-hidden="true"><img src="<?php echo esc_url( $icon_base . 'faMoneyBillTrendUp.png' ); ?>" alt="" width="14" height="14" decoding="async" /></span>
				<span class="feature-band__label">On Budget</span>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column -->
		<div class="wp-block-column">
			<!-- wp:html -->
			<div class="feature-band__item">
				<span class="feature-band__icon" aria-hidden="true"><img src="<?php echo esc_url( $icon_base . 'faGem.png' ); ?>" alt="" width="14" height="14" decoding="async" /></span>
				<span class="feature-band__label">Exclusive</span>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
