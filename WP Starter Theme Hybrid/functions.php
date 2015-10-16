<?php
/**
 * "Funny, 'cause I look around at this world you're so eager to be a part of and all I see is six billion
 * lunatics looking for the fastest ride out. Who's not crazy? Look around, everyone's drinking, smoking,
 * shooting up, shooting each other, or just plain screwing their brains out 'cause they don't want 'em anymore.
 * I'm crazy? Honey, I'm the original one-eyed chicklet in the kingdom of the blind, 'cause at least I admit the
 * world makes me nuts. Name one person who can take it here. That's all I'm asking. Name one."
 * ~ Glorificus (Buffy the Vampire Slayer: Season 5 - Weight of the World)
 *
 * Theme Authors: Make sure to add a favorite quote of yours above, maybe something that inspired you to
 * create this theme.
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License as published by the Free Software Foundation; either version 2 of the License,
 * or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * You should have received a copy of the GNU General Public License along with this program; if not, write
 * to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 * @package    ATheme
 * @subpackage Functions
 * @version    1.0.0
 * @author     DevriX
 * @link       http://devrix.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// ----------------------------------------------------------------------------
// Note:
// The theme placeholder is atheme , so find and replace this string to update
// to the real theme name :)
// ----------------------------------------------------------------------------

// Get the template directory and make sure it has a trailing slash.
$atheme_base_dir = trailingslashit( get_template_directory() );

// Load the Hybrid Core framework and theme files.
require_once( $atheme_base_dir . 'hybrid-core/hybrid.php' );

// Launch the Hybrid Core framework.
new Hybrid();

define( 'THEME_DOMAIN', 'atheme' );


/* Add custom scripts. */
add_action( 'wp_enqueue_scripts', 'atheme_base_enqueue_scripts', 5 );

/* Add custom styles. */
add_action( 'wp_enqueue_scripts', 'atheme_base_enqueue_styles', 5 );

/** Remove this CSS and the admin bar */
add_action( 'get_header', 'atheme_remove_admin_login_header' );

/* Register custom menus. */
add_action( 'init', 'atheme_base_register_menus', 5 );

/* Register widgets */
add_action( 'widgets_init', 'atheme_load_widget' );

/* Do theme setup on the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'atheme_theme_setup', 5 );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function atheme_theme_setup() {

	// Enable custom template hierarchy.
	add_theme_support( 'hybrid-core-template-hierarchy' );

	// The best thumbnail/image script ever.
	add_theme_support( 'get-the-image' );

	// Breadcrumbs. Yay!
	add_theme_support( 'breadcrumb-trail' );

	// Nicer [gallery] shortcode implementation.
	add_theme_support( 'cleaner-gallery' );

	// Automatically add feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Post formats.
	add_theme_support(
		'post-formats',
		array( 'aside', 'audio', 'chat', 'image', 'gallery', 'link', 'quote', 'status', 'video' )
	);

	// Handle content width for embeds and images.
	hybrid_set_content_width( 780 );
}

/**
 * Load scripts for the front end.
 *
 * @since  0.1.0
 * @return void
 */
function atheme_base_enqueue_scripts () {

	// Include jQuery from WP Core
	wp_enqueue_script( "jquery" );

	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/assets/scripts/owl.carousel.min.js', array(), '0.1.0', true );
	wp_enqueue_script( 'foundation', get_template_directory_uri() . '/assets/scripts/foundation.min.js', array('jquery'), '1.1.0', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/scripts/scripts.js', array(), '1.1.1', true );
}

/**
 * Load stylesheets for the front end.
 *
 * @since  0.1.0
 * @return void
 */
function atheme_base_enqueue_styles () {
	wp_enqueue_style( 'font-droid', 'https://fonts.googleapis.com/css?family=Droid+Sans:400,700' );
	wp_enqueue_style( 'font-droid-arabic', 'http://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/master.css' );
}
/**
 *
 * Remove custom CSS for header from WP
 *
 * @since 0.1.0
 * @return void
 */
function atheme_remove_admin_login_header () {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}

/**
 * Registers nav menu locations.
 *
 * @since 0.1.0
 * @return void
 */
function atheme_base_register_menus () {
	register_nav_menu( 'primary', _x( 'Primary navigation', 'primary-navigation', THEME_DOMAIN ) );
}

/**
 * Register and load the widget
 *
 * @return void
 */
function atheme_load_widget() {

}

/**
 * Printing SVG element with given url and dimentions.
 * You can set width and height together, not only one of them.
 * 
 * @param  string $url    	The path to the svg
 * @param  int $width  		SVG Height, not required
 * @param  int $height 		SVG Width, not required
 * @return string         	The html elements output
 * @since  v1.0.0
 */
function atheme_svg ( $url, $width = "", $height = "", $print = true ) {
	if ( empty( $url ) ) {
		return;
	}

	// Return or print
	$output = '';

	// Don't set height and width if its empty
	if ( empty( $height ) || empty( $width ) ) {
		$output .= "<svg version='1.1' xmlns='http://www.w3.org/2000/svg'>";
	} else {
		$output .= "<svg height='$height' width='$width' version='1.1' xmlns='http://www.w3.org/2000/svg'>";
	}

	$output .= file_get_contents( $url );
	$output .= "</svg>";

	if ( $print === false ) {
		return $output;
	}

	echo $output;
}