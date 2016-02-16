<?php

if ( ! function_exists( 'dxstarter_setup' ) ) :
function dxstarter_setup() {

	// Make the theme translatable
	load_theme_textdomain( 'dxstarter', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'dxstarter' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
}
endif;
add_action( 'after_setup_theme', 'dxstarter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dxstarter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dxstarter_content_width', 640 );
}
add_action( 'after_setup_theme', 'dxstarter_content_width', 0 );

/**
 * Register widget area.
 */
function dxstarter_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dxstarter' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'dxstarter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dxstarter_scripts() {
	wp_enqueue_style( 'dxstarter-style', get_template_directory_uri() . '/assets/css/master.min.css' );
	wp_enqueue_script( 'dxstarter-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dxstarter_scripts' );

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';