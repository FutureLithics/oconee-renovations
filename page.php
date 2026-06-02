<?php
/**
 * Default page template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'full-width-content';
} );

add_action( 'genesis_entry_content', function() {
	if ( ! is_page() || is_front_page() ) {
		return;
	}

	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;
	?>
	<header class="default-entry-header">
		<h1 class="default-entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="default-entry-image">
			<?php echo get_the_post_thumbnail( null, 'large', array( 'class' => 'default-entry-image__image' ) ); ?>
		</figure>
	<?php endif; ?>
	<?php
}, 5 );

add_action( 'genesis_entry_content', function() {
	if ( ! is_page() || is_front_page() ) {
		return;
	}

	$edit_link = get_edit_post_link();

	if ( ! $edit_link ) {
		return;
	}
	?>
	<p class="default-entry-edit">
		<a href="<?php echo esc_url( $edit_link ); ?>"><?php esc_html_e( 'Edit Page', 'oconee-renovations' ); ?></a>
	</p>
	<?php
}, 15 );

genesis();
