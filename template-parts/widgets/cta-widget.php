<?php
/**
 * CTA widget template.
 *
 * @var array $args Template arguments.
 */

$title       = $args['title'] ?? '';
$subheader   = $args['subheader'] ?? '';
$button_text = $args['button_text'] ?? '';
$button_url  = $args['button_url'] ?? '';
?>

<div class="oconee-cta-widget">
	<div class="oconee-cta-widget__inner">
		<?php if ( $title ) : ?>
			<h3 class="oconee-cta-widget__title"><?php echo esc_html( $title ); ?></h3>
		<?php endif; ?>

		<?php if ( $subheader ) : ?>
			<p class="oconee-cta-widget__text"><?php echo esc_html( $subheader ); ?></p>
		<?php endif; ?>

		<?php if ( $button_text && $button_url ) : ?>
			<div class="oconee-cta-widget__actions">
				<a class="btn btn--secondary oconee-cta-widget__button" href="<?php echo esc_url( $button_url ); ?>">
					<?php echo esc_html( $button_text ); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
</div>
