<?php
/**
 * Title: Recent Projects
 * Slug: oconee-renovations/recent-projects
 * Categories: oconee-renovations
 */

$projects_page = get_page_by_path( 'projects' );
$contact_page  = get_page_by_path( 'contact' );
$excluded_ids  = array_filter(
	array(
		(int) get_option( 'page_on_front' ),
		(int) get_option( 'page_for_posts' ),
		$projects_page ? (int) $projects_page->ID : 0,
		$contact_page ? (int) $contact_page->ID : 0,
	)
);

$projects = get_posts(
	array(
		'post_type'      => 'project',
		'post_status'    => 'publish',
		'posts_per_page' => 4,
		'orderby'        => 'date',
		'order'          => 'DESC',
		'post__not_in'   => $excluded_ids,
		'meta_query'     => array(
			array(
				'key'     => '_thumbnail_id',
				'compare' => 'EXISTS',
			),
		),
	)
);

$projects_index_url = $projects_page ? get_permalink( $projects_page ) : home_url( '/projects/' );
?>

<!-- wp:group {"align":"full","className":"recent-projects","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull recent-projects has-background">
	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"charcoal","className":"recent-projects__heading"} -->
	<h2 class="wp-block-heading has-text-align-center recent-projects__heading has-charcoal-color has-text-color">Recent Projects</h2>
	<!-- /wp:heading -->

	<!-- wp:group {"className":"recent-projects__grid","layout":{"type":"default"}} -->
	<div class="wp-block-group recent-projects__grid">
		<?php if ( ! empty( $projects ) ) : ?>
			<?php foreach ( $projects as $project ) : ?>
				<!-- wp:html -->
				<a class="recent-projects__card" href="<?php echo esc_url( get_permalink( $project ) ); ?>">
					<?php
					echo wp_get_attachment_image(
						get_post_thumbnail_id( $project ),
						'large',
						false,
						array(
							'class'    => 'recent-projects__image',
							'alt'      => esc_attr( get_the_title( $project ) ),
							'loading'  => 'lazy',
							'decoding' => 'async',
						)
					);
					?>
					<span class="recent-projects__overlay">
						<span class="recent-projects__title"><?php echo esc_html( get_the_title( $project ) ); ?></span>
					</span>
				</a>
				<!-- /wp:html -->
			<?php endforeach; ?>
		<?php else : ?>
			<!-- wp:paragraph {"align":"center","textColor":"charcoal","className":"recent-projects__empty"} -->
			<p class="has-text-align-center recent-projects__empty has-charcoal-color has-text-color">Add featured images to your recent project pages to populate this section.</p>
			<!-- /wp:paragraph -->
		<?php endif; ?>
	</div>
	<!-- /wp:group -->

	<!-- wp:html -->
	<div class="recent-projects__cta-wrap">
		<a class="btn btn--secondary recent-projects__cta" href="<?php echo esc_url( $projects_index_url ); ?>">View More</a>
	</div>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->
