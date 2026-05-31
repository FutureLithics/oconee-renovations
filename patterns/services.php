<?php
/**
 * Title: Services
 * Slug: oconee-renovations/services
 * Categories: oconee-renovations
 */

$icon_url = trailingslashit( get_stylesheet_directory_uri() ) . 'assets/icons/faHouseChimney.svg';

$cards = array(
	array(
		'title' => 'Kitchens',
		'text'  => 'Custom kitchen upgrades designed to improve functionality, storage, and everyday living with quality craftsmanship and durable finishes.',
	),
	array(
		'title' => 'Bathrooms',
		'text'  => 'Beautiful and practical bathroom renovations including vanities, tile work, fixtures, trim, and custom improvements.',
	),
	array(
		'title' => 'Basements',
		'text'  => 'Transform unfinished or outdated basements into comfortable living spaces, entertainment areas, workshops, or home offices.',
	),
	array(
		'title' => 'Garages',
		'text'  => 'Functional garage improvements including storage solutions, framing, shelving, workspaces, and interior finishing work.',
	),
	array(
		'title' => 'Patios',
		'text'  => 'Outdoor patio spaces built for relaxation, entertaining, and lasting durability with attention to detail and clean design.',
	),
	array(
		'title' => 'Decks',
		'text'  => 'Custom decks and exterior structures crafted to extend your living space and enhance the beauty of your home.',
	),
);
?>

<!-- wp:group {"align":"full","className":"services","backgroundColor":"fine","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull services has-fine-background-color has-background">
	<!-- wp:heading {"textAlign":"center","level":2,"textColor":"charcoal","className":"services__heading"} -->
	<h2 class="wp-block-heading has-text-align-center services__heading has-charcoal-color has-text-color">Master Carpentry Services</h2>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"align":"center","textColor":"charcoal","className":"services__subheading"} -->
	<p class="has-text-align-center services__subheading has-charcoal-color has-text-color">Custom renovations, trim work, cabinetry, repairs, and home improvements built with precision, reliability, and attention to detail.</p>
	<!-- /wp:paragraph -->

	<!-- wp:group {"className":"services__grid","layout":{"type":"default"}} -->
	<div class="wp-block-group services__grid">
		<?php foreach ( $cards as $card ) : ?>
		<!-- wp:group {"className":"services__card","layout":{"type":"default"}} -->
		<div class="wp-block-group services__card">
			<!-- wp:html -->
			<div class="services__card-icon" aria-hidden="true"><img src="<?php echo esc_url( $icon_url ); ?>" alt="" width="48" height="48" decoding="async" /></div>
			<!-- /wp:html -->

			<!-- wp:heading {"textAlign":"center","level":3,"textColor":"charcoal","className":"services__card-title"} -->
			<h3 class="wp-block-heading services__card-title has-text-align-center has-charcoal-color has-text-color"><?php echo esc_html( $card['title'] ); ?></h3>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"align":"center","textColor":"charcoal","className":"services__card-text"} -->
			<p class="has-text-align-center services__card-text has-charcoal-color has-text-color"><?php echo esc_html( $card['text'] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
