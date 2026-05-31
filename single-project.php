<?php
/**
 * Single Project template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'full-width-content';
} );

add_filter( 'genesis_post_info', function( $post_info ) {
	if ( is_singular( 'project' ) ) {
		return '';
	}

	return $post_info;
} );

add_action( 'genesis_after_header', function() {
	if ( ! is_singular( 'project' ) ) {
		return;
	}

	$hero_url = get_the_post_thumbnail_url( null, 'full' );

	if ( ! $hero_url ) {
		return;
	}
	?>
	<div class="project-entry-hero" style="background-image: url('<?php echo esc_url( $hero_url ); ?>');">
		<div class="project-entry-hero__overlay" aria-hidden="true"></div>
	</div>
	<?php
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

	$published_time = get_the_date( DATE_W3C );
	$published_text = get_the_date( 'F j, Y' );
	$modified_time  = get_the_modified_date( DATE_W3C );
	$modified_text  = get_the_modified_date( 'F j, Y' );
	?>
	<header class="project-entry-header">
		<h1 class="project-entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<p class="project-entry-meta">
			<time datetime="<?php echo esc_attr( $published_time ); ?>">Published <?php echo esc_html( $published_text ); ?></time>
			<?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) : ?>
				<span class="project-entry-meta__separator">|</span>
				<time datetime="<?php echo esc_attr( $modified_time ); ?>">Updated <?php echo esc_html( $modified_text ); ?></time>
			<?php endif; ?>
		</p>
	</header>
	<?php
}, 5 );

add_action( 'genesis_entry_content', function() {
	if ( ! is_singular( 'project' ) ) {
		return;
	}

	$edit_link = get_edit_post_link();

	if ( ! $edit_link ) {
		return;
	}
	?>
	<p class="project-entry-edit">
		<a href="<?php echo esc_url( $edit_link ); ?>"><?php esc_html_e( 'Edit Project', 'oconee-renovations' ); ?></a>
	</p>
	<?php
}, 15 );

add_action( 'genesis_after_entry', function() {
	if ( ! is_singular( 'project' ) || ! is_active_sidebar( 'sidebar' ) ) {
		return;
	}
	?>
	<aside class="project-sidebar sidebar sidebar-primary widget-area" aria-label="<?php esc_attr_e( 'Project details', 'oconee-renovations' ); ?>">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside>
	<?php
}, 15 );

genesis();
