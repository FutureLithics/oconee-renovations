<?php

require_once get_template_directory() . '/lib/init.php';

add_action( 'after_setup_theme', function() {
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'editor-styles' );
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
}, 5 );

add_action( 'enqueue_block_editor_assets', function() {
    wp_enqueue_style(
        'oconee-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );
}, 5 );

add_action( 'init', function() {
    register_block_pattern_category(
        'oconee-renovations',
        array( 'label' => __( 'Oconee Renovations', 'oconee-renovations' ) )
    );
});

add_action( 'get_header', function() {
    remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
});

remove_action( 'genesis_header', 'genesis_do_header' );

add_action( 'genesis_header', function() {
    get_template_part( 'template-parts/site-header' );
});