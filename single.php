<?php
/**
 * Default single post template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'full-width-content';
} );

add_filter( 'genesis_post_info', function( $post_info ) {
	if ( is_single() && ! is_singular( 'project' ) ) {
		return '';
	}

	return $post_info;
} );

add_action( 'genesis_entry_content', function() {
	if ( ! is_single() || is_singular( 'project' ) ) {
		return;
	}

	static $rendered = false;

	if ( $rendered ) {
		return;
	}

	$rendered = true;

	$published_time = get_the_date( DATE_W3C );
	$published_text = get_the_date( 'F j, Y' );
	$modified_time  = get_the_modified_date( DATE_W3C );
	$modified_text  = get_the_modified_date( 'F j, Y' );
	?>
	<header class="default-entry-header">
		<h1 class="default-entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<p class="default-entry-meta">
			<time datetime="<?php echo esc_attr( $published_time ); ?>"><?php echo esc_html( 'Published ' . $published_text ); ?></time>
			<?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) : ?>
				<span class="default-entry-meta__separator">|</span>
				<time datetime="<?php echo esc_attr( $modified_time ); ?>"><?php echo esc_html( 'Updated ' . $modified_text ); ?></time>
			<?php endif; ?>
		</p>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="default-entry-image">
			<?php echo get_the_post_thumbnail( null, 'large', array( 'class' => 'default-entry-image__image' ) ); ?>
		</figure>
	<?php endif; ?>
	<?php
}, 5 );

add_action( 'genesis_entry_content', function() {
	if ( ! is_single() || is_singular( 'project' ) ) {
		return;
	}

	$edit_link = get_edit_post_link();

	if ( ! $edit_link ) {
		return;
	}
	?>
	<p class="default-entry-edit">
		<a href="<?php echo esc_url( $edit_link ); ?>"><?php esc_html_e( 'Edit Post', 'oconee-renovations' ); ?></a>
	</p>
	<?php
}, 15 );

genesis();
