<?php

require_once get_template_directory() . '/lib/init.php';

/**
 * Cache-busting version for theme CSS/JS.
 * WP_DEBUG: new version every request. Otherwise: filemtime when the file changes.
 */
function oconee_asset_version( $relative_path = 'style.css' ) {
    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        return (string) time();
    }

    $path = get_stylesheet_directory() . '/' . ltrim( $relative_path, '/' );

    return file_exists( $path ) ? (string) filemtime( $path ) : wp_get_theme()->get( 'Version' );
}

/**
 * Bust cache for the child theme stylesheet (and block editor theme styles).
 */
add_action( 'wp_enqueue_scripts', function() {
    $handle = get_stylesheet();

    if ( ! wp_style_is( $handle, 'registered' ) ) {
        return;
    }

    wp_styles()->registered[ $handle ]->ver = oconee_asset_version( 'style.css' );
}, 20 );

add_filter( 'editor_stylesheets', function( $stylesheets ) {
    $version = oconee_asset_version( 'style.css' );

    return array_map(
        static function( $url ) use ( $version ) {
            return add_query_arg( 'ver', $version, $url );
        },
        $stylesheets
    );
} );

add_action( 'after_setup_theme', function() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'appearance-tools' );
    add_theme_support( 'core-block-patterns' );
});

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'oconee-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );

    wp_enqueue_script(
        'oconee-site-header',
        get_stylesheet_directory_uri() . '/assets/js/site-header.js',
        array(),
        oconee_asset_version( 'assets/js/site-header.js' ),
        true
    );
}, 5 );

add_action( 'wp_enqueue_scripts', function() {
    if ( ! wp_style_is( 'global-styles', 'enqueued' ) ) {
        return;
    }

    wp_add_inline_style(
        'global-styles',
        '.wp-block-button.is-style-outline > .wp-block-button__link:hover{color:var(--btn-outline-color-hover,#292D31)!important;background:var(--btn-outline-bg-hover,#B87333)!important;border-color:var(--btn-outline-bg-hover,#B87333)!important}'
        . '.wp-block-button:not(.is-style-outline) > .wp-block-button__link:hover{background:var(--btn-filled-bg-hover,#965F29)!important;border-color:var(--btn-filled-bg-hover,#965F29)!important;color:var(--btn-filled-color,#F3F4F6)!important}'
    );
}, 20 );

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style(
        'oconee-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css',
        array(),
        '6.5.1'
    );
}, 5 );

/**
 * Clear theme pattern cache when the theme version or any pattern file changes.
 * Note: this refreshes the pattern library only — blocks already on a page are stored in the DB.
 */
add_action( 'after_setup_theme', function() {
    $theme = wp_get_theme();

    if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        $theme->delete_pattern_cache();
        return;
    }

    $version = $theme->get( 'Version' );
    $option  = 'oconee_patterns_theme_version';

    if ( get_option( $option ) !== $version ) {
        $theme->delete_pattern_cache();
        update_option( $option, $version );
        return;
    }

    $patterns_dir = get_stylesheet_directory() . '/patterns/';
    $latest_mtime = 0;

    if ( is_dir( $patterns_dir ) ) {
        foreach ( glob( $patterns_dir . '*.php' ) as $file ) {
            $latest_mtime = max( $latest_mtime, (int) filemtime( $file ) );
        }
    }

    $mtime_option = 'oconee_patterns_latest_mtime';

    if ( (int) get_option( $mtime_option, 0 ) !== $latest_mtime ) {
        $theme->delete_pattern_cache();
        update_option( $mtime_option, $latest_mtime );
    }
}, 20 );

add_action( 'init', function() {
    register_block_pattern_category(
        'oconee-renovations',
        array( 'label' => __( 'Oconee Renovations', 'oconee-renovations' ) )
    );
}, 9 );

/**
 * Register any theme patterns core did not pick up (e.g. stale pattern cache).
 */
add_action( 'init', function() {
    $dir = get_stylesheet_directory() . '/patterns/';
    if ( ! is_dir( $dir ) ) {
        return;
    }

    $registry = WP_Block_Patterns_Registry::get_instance();
    $headers  = array(
        'title'       => 'Title',
        'slug'        => 'Slug',
        'description' => 'Description',
        'categories'  => 'Categories',
        'inserter'    => 'Inserter',
    );

    foreach ( glob( $dir . '*.php' ) as $file ) {
        $data = get_file_data( $file, $headers );
        if ( empty( $data['slug'] ) || empty( $data['title'] ) ) {
            continue;
        }

        if ( $registry->is_registered( $data['slug'] ) ) {
            continue;
        }

        $properties = array(
            'title'    => $data['title'],
            'filePath' => $file,
        );

        if ( ! empty( $data['description'] ) ) {
            $properties['description'] = $data['description'];
        }
        if ( ! empty( $data['categories'] ) ) {
            $properties['categories'] = array_filter( wp_parse_list( (string) $data['categories'] ) );
        }
        if ( ! empty( $data['inserter'] ) ) {
            $properties['inserter'] = in_array( strtolower( $data['inserter'] ), array( 'yes', 'true' ), true );
        }

        register_block_pattern( $data['slug'], $properties );
    }
}, 11 );

add_action( 'get_header', function() {
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
});

remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_after_header', 'genesis_do_nav' );
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

add_action( 'genesis_header', function() {
    get_template_part( 'template-parts/site-header' );
});

/**
 * Front page: no sidebar (full-width content).
 */
add_filter( 'genesis_site_layout', function( $layout ) {
    if ( is_front_page() ) {
        return 'full-width-content';
    }

    return $layout;
} );