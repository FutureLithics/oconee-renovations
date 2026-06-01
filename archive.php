<?php
/**
 * Generic archive template.
 */

add_filter( 'genesis_site_layout', function() {
	return 'full-width-content';
} );

remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', function() {
	global $wp_query;

	$archive_title = wp_strip_all_tags( get_the_archive_title() );
	$archive_title = preg_replace( '/^[^:]+:\s*/', '', $archive_title );

	$get_project_field = static function( $field_name, $post_id = null ) {
		$post_id = $post_id ?: get_the_ID();

		if ( function_exists( 'get_field' ) ) {
			$value = get_field( $field_name, $post_id );

			if ( '' !== $value && null !== $value && false !== $value ) {
				return $value;
			}
		}

		return get_post_meta( $post_id, $field_name, true );
	};

	$get_archive_card_excerpt = static function( $post_id ) use ( $get_project_field ) {
		$acf_excerpt = trim( (string) $get_project_field( 'excerpt', $post_id ) );

		if ( '' !== $acf_excerpt ) {
			return wp_strip_all_tags( $acf_excerpt );
		}

		$wp_excerpt = trim( get_the_excerpt( $post_id ) );

		if ( '' !== $wp_excerpt ) {
			return wp_strip_all_tags( $wp_excerpt );
		}

		$description = trim( (string) $get_project_field( 'description', $post_id ) );

		if ( '' !== $description ) {
			return wp_html_excerpt( wp_strip_all_tags( $description ), 400, '...' );
		}

		return wp_html_excerpt( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ), 400, '...' );
	};

	$get_archive_card_date = static function( $post_id ) use ( $get_project_field ) {
		$completion_date = trim( (string) $get_project_field( 'completion_date', $post_id ) );

		if ( '' !== $completion_date ) {
			$timestamp = strtotime( $completion_date );

			if ( $timestamp ) {
				return wp_date( 'F j, Y', $timestamp );
			}

			return $completion_date;
		}

		return get_the_date( 'F j, Y', $post_id );
	};
	?>
	<section class="archive-listing">
		<header class="archive-listing__header">
			<h1 class="archive-listing__title"><?php echo esc_html( $archive_title ); ?></h1>
			<?php if ( get_the_archive_description() ) : ?>
				<div class="archive-listing__description">
					<?php echo wp_kses_post( wpautop( get_the_archive_description() ) ); ?>
				</div>
			<?php endif; ?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="archive-listing__grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
					$post_id      = get_the_ID();
					$card_excerpt = $get_archive_card_excerpt( $post_id );
					$card_date    = $get_archive_card_date( $post_id );
					$image_html   = get_the_post_thumbnail(
						$post_id,
						'large',
						array(
							'class'    => 'archive-listing__image',
							'alt'      => esc_attr( get_the_title() ),
							'loading'  => 'lazy',
							'decoding' => 'async',
						)
					);
					?>
					<article class="archive-listing__card">
						<a class="archive-listing__card-link" href="<?php the_permalink(); ?>">
							<?php if ( $image_html ) : ?>
								<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php else : ?>
								<div class="archive-listing__image archive-listing__image--placeholder" aria-hidden="true"></div>
							<?php endif; ?>

							<span class="archive-listing__overlay">
								<span class="archive-listing__overlay-inner">
									<span class="archive-listing__meta"><?php echo esc_html( $card_date ); ?></span>
									<span class="archive-listing__card-title"><?php the_title(); ?></span>
									<span class="archive-listing__card-excerpt"><?php echo esc_html( $card_excerpt ); ?></span>
								</span>
							</span>
						</a>
					</article>
				<?php endwhile; ?>
			</div>

			<?php if ( get_next_posts_link() ) : ?>
				<div class="archive-listing__cta-wrap">
					<?php next_posts_link( __( 'View More', 'oconee-renovations' ), $wp_query->max_num_pages ); ?>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<p class="archive-listing__empty"><?php esc_html_e( 'No items found.', 'oconee-renovations' ); ?></p>
		<?php endif; ?>
	</section>
	<?php
} );

genesis();
