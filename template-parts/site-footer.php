<?php
/**
 * Site Footer.
 */

$footer_sidebars = array( 'footer-1', 'footer-2', 'footer-3' );
$has_footer_widgets = false;

foreach ( $footer_sidebars as $footer_sidebar ) {
	if ( is_active_sidebar( $footer_sidebar ) ) {
		$has_footer_widgets = true;
		break;
	}
}
?>

<?php if ( $has_footer_widgets ) : ?>
	<div class="site-footer-main">
		<div class="site-footer-main__inner">
			<?php foreach ( $footer_sidebars as $footer_sidebar ) : ?>
				<div class="site-footer-main__column">
					<?php dynamic_sidebar( $footer_sidebar ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<div class="site-subfooter">
	<div class="site-subfooter__inner">
		<p class="site-subfooter__text">
			&copy;2026
			<a href="https://futurelithics.com" target="_blank" rel="noopener noreferrer">FutureLithics</a>
		</p>
	</div>
</div>
