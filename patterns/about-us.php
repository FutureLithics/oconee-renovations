<?php
/**
 * Title: About Us
 * Slug: oconee-renovations/about-us
 * Categories: oconee-renovations
 */

$about_image = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/images/about-us.jpg';
?>

<!-- wp:group {"align":"full","className":"about-us","layout":{"type":"default"}} -->
<div class="wp-block-group alignfull about-us">
	<!-- wp:columns {"verticalAlignment":"center","className":"about-us__columns","style":{"spacing":{"blockGap":{"left":"4rem"},"padding":{"top":"3rem","bottom":"3rem","left":"2rem","right":"2rem"}}}} -->
	<div class="wp-block-columns are-vertically-aligned-center about-us__columns" style="padding-top:3rem;padding-right:2rem;padding-bottom:3rem;padding-left:2rem">
		<!-- wp:column {"verticalAlignment":"center","className":"about-us__content"} -->
		<div class="wp-block-column is-vertically-aligned-center about-us__content">
			<!-- wp:heading {"level":2,"textColor":"charcoal","className":"about-us__heading"} -->
			<h2 class="wp-block-heading about-us__heading has-charcoal-color has-text-color">About Us</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"textColor":"charcoal","className":"about-us__body"} -->
			<p class="about-us__body has-charcoal-color has-text-color">We provide extra-ordinary customer service and efficiency. We come and speak with you about the work that you'd like to have done. We give you a clear estimate. We get the job done for you in time and on budget.</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph {"textColor":"charcoal","className":"about-us__body"} -->
			<p class="about-us__body has-charcoal-color has-text-color">Oconee Renovations is a team of accountable, licensed professionals who bring a cost-conscious, fresh approach to renovating existing buildings.</p>
			<!-- /wp:paragraph -->

			<!-- wp:list {"className":"about-us__list about-us__body","textColor":"charcoal"} -->
			<ul class="wp-block-list about-us__list about-us__body has-charcoal-color has-text-color">
				<li>Energy efficient construction</li>
				<li>Environmentally conscious</li>
				<li>Cost and time efficient</li>
			</ul>
			<!-- /wp:list -->

			<!-- wp:paragraph {"textColor":"charcoal","className":"about-us__body"} -->
			<p class="about-us__body has-charcoal-color has-text-color">We design and build structures that fulfill not just the dreams, but the needs of discerning clients. Our renovations help to sustain the environment we live in.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:column -->

		<!-- wp:column {"verticalAlignment":"center","className":"about-us__media"} -->
		<div class="wp-block-column is-vertically-aligned-center about-us__media">
			<!-- wp:image {"aspectRatio":"1","scale":"cover","sizeSlug":"large","linkDestination":"none","className":"about-us__image"} -->
			<figure class="wp-block-image size-large about-us__image"><img src="<?php echo esc_url( $about_image ); ?>" alt="About Oconee Renovations" style="aspect-ratio:1;object-fit:cover"/></figure>
			<!-- /wp:image -->
		</div>
		<!-- /wp:column -->
	</div>
	<!-- /wp:columns -->
</div>
<!-- /wp:group -->
