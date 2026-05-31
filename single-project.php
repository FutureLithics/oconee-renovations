<?php
/**
 * Single Project template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'content-sidebar';
} );

add_action( 'genesis_entry_content', function() {
	if ( ! is_singular( 'project' ) ) {
		return;
	}

	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;
	?>
	<header class="project-entry-header">
		<h1 class="project-entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="project-entry-image">
			<?php echo get_the_post_thumbnail( null, 'large', array( 'class' => 'project-entry-image__image' ) ); ?>
		</figure>
	<?php endif; ?>
	<?php
}, 5 );

genesis();
