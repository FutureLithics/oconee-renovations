<?php
/**
 * Site Header.
 */

?>

<div class="site-header-inner">
    <div class="site-branding">
        <a class="site-logo xl-2" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php bloginfo( 'name' ); ?>
        </a>
    </div>

    <button
        class="site-header-menu-toggle"
        type="button"
        aria-expanded="false"
        aria-controls="primary-navigation-dialog"
        aria-label="<?php esc_attr_e( 'Open menu', 'oconee-renovations' ); ?>"
    >
        <span></span>
        <span></span>
        <span></span>
    </button>

    <div class="header-right" id="primary-navigation-dialog">
        <nav class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'oconee-renovations' ); ?>">
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'fallback_cb'    => false,
            ) );
            ?>
        </nav>

        <a class="btn btn--primary header-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
            Contact Us
        </a>
    </div>
</div>