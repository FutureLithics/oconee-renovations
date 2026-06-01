<?php
/**
 * Single Project template.
 */

if ( ! function_exists( 'oconee_get_project_field' ) ) {
	function oconee_get_project_field( $field_name, $post_id = null ) {
		$post_id = $post_id ?: get_the_ID();

		if ( function_exists( 'get_field' ) ) {
			$value = get_field( $field_name, $post_id );

			if ( '' !== $value && null !== $value && false !== $value ) {
				return $value;
			}
		}

		return get_post_meta( $post_id, $field_name, true );
	}
}

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
	$description    = trim( (string) oconee_get_project_field( 'description' ) );
	$completion_raw = trim( (string) oconee_get_project_field( 'completion_date' ) );
	$meta_label     = __( 'Published', 'oconee-renovations' );
	$meta_time      = $published_time;
	$meta_text      = $published_text;

	if ( '' !== $completion_raw ) {
		$completion_timestamp = strtotime( $completion_raw );

		$meta_label = __( 'Completed', 'oconee-renovations' );
		$meta_text  = $completion_timestamp ? wp_date( 'F j, Y', $completion_timestamp ) : $completion_raw;
		$meta_time  = $completion_timestamp ? wp_date( DATE_W3C, $completion_timestamp ) : '';
	}
	?>
	<header class="project-entry-header">
		<h1 class="project-entry-title"><?php echo esc_html( get_the_title() ); ?></h1>
		<p class="project-entry-meta">
			<time datetime="<?php echo esc_attr( $meta_time ); ?>"><?php echo esc_html( $meta_label . ' ' . $meta_text ); ?></time>
			<?php if ( get_the_modified_time( 'U' ) > get_the_time( 'U' ) ) : ?>
				<span class="project-entry-meta__separator">|</span>
				<time datetime="<?php echo esc_attr( $modified_time ); ?>">Updated <?php echo esc_html( $modified_text ); ?></time>
			<?php endif; ?>
		</p>
		<?php if ( '' !== $description ) : ?>
			<p class="project-entry-description"><?php echo esc_html( $description ); ?></p>
		<?php endif; ?>
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

genesis();
