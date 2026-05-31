<?php
/**
 * Contact widget template.
 *
 * @var array $args Template arguments.
 */

$title = $args['title'] ?? '';
$items = $args['items'] ?? array();
?>

<div class="oconee-contact-widget">
	<h3 class="oconee-contact-widget__title"><?php echo esc_html( $title ); ?></h3>
	<div class="oconee-contact-widget__items">
		<?php foreach ( $items as $item ) : ?>
			<div class="oconee-contact-widget__item">
				<span class="oconee-contact-widget__icon" aria-hidden="true">
					<i class="<?php echo esc_attr( $item['icon'] ); ?>"></i>
				</span>
				<?php if ( ! empty( $item['url'] ) ) : ?>
					<a class="oconee-contact-widget__text" href="<?php echo esc_url( $item['url'] ); ?>" aria-label="<?php echo esc_attr( $item['label'] ); ?>">
						<?php echo esc_html( $item['text'] ); ?>
					</a>
				<?php else : ?>
					<span class="oconee-contact-widget__text"><?php echo esc_html( $item['text'] ); ?></span>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>
