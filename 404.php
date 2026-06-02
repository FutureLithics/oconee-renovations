<?php
/**
 * 404 template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'full-width-content';
} );

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', function() {
	?>
	<section class="not-found-page">
		<div class="not-found-page__inner">
			<p class="not-found-page__eyebrow"><?php esc_html_e( '404 Not Found', 'oconee-renovations' ); ?></p>
			<h1 class="not-found-page__title"><?php esc_html_e( 'That page could not be found.', 'oconee-renovations' ); ?></h1>
			<p class="not-found-page__text"><?php esc_html_e( 'The page may have moved, the link may be outdated, or the URL may have been entered incorrectly.', 'oconee-renovations' ); ?></p>
			<div class="not-found-page__actions">
				<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go Home', 'oconee-renovations' ); ?></a>
				<a class="btn btn--outline" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Contact Us', 'oconee-renovations' ); ?></a>
			</div>
		</div>
	</section>
	<?php
} );

genesis();
