<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genesis Sample' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.4' );

//* Enqueue Scripts and Styles
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'vanilla_bootstrap1', get_stylesheet_directory_uri() . '/css/bootstrap.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'vanilla_bootstrap2', get_stylesheet_directory_uri() . '/css/bootstrap-theme.min.css', array(), CHILD_THEME_VERSION );
     wp_enqueue_style( 'vanilla_bootstrap3', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'vanilla_bootstrap', get_stylesheet_directory_uri() . '/css/mystyles.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'vanilla_bootstrap_js', get_stylesheet_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/jquery.sticky.js', array ( 'jquery' ), 1.1, true);
	//wp_enqueue_script( 'vanilla_bootstrap_js1','https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js', array('jquery'), '1.0.0', true );
	$output = array(
		'mainMenu' => __( 'Menu', 'genesis-sample' ),
		'subMenu'  => __( 'Menu', 'genesis-sample' ),
	);
	wp_localize_script( 'genesis-sample-responsive-menu', 'genesisSampleL10n', $output );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 160,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Remove Footer
 remove_action('genesis_footer', 'genesis_do_footer');
 remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
 remove_action('genesis_footer', 'genesis_footer_markup_close', 15);

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );
add_image_size('blog', 642, 294, true);

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

//header removal
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );


//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

	return 90;

}

//* Replaced the default sidebar search bar.

add_filter( 'genesis_search_button_text', 'b3m_search_button_dashicon' );
function b3m_search_button_dashicon( $text ) {
	
	return esc_attr( '&#xf179;' );
	
}

//* Customize search form input button text
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
   return esc_attr( 'Keyword search...' );
}


//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}


/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 35;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function custom_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );


//* Register vanilla main navigation area
genesis_register_sidebar( array(
	'id'          => 'before-header',
	'name'        => __( 'Navigation Menu', 'genesis' ),
	'description' => __( 'This is the Navigation Menu widget area.', 'theme-name' ),
) );

add_action( 'genesis_before', 'bg_before_header_widget_area' );
function bg_before_header_widget_area() {
	genesis_widget_area( 'before-header', array(
		'before' => '<nav class="vanilla-top-nav">',
		'after'  => '</nav>',
	) );
}

//* Register vanilla slider area
genesis_register_sidebar( array(
	'id'          => 'vanilla-slider',
	'name'        => __( 'Vanilla Slider', 'genesis' ),
	'description' => __( 'This is the Vanilla Slider Area.', 'theme-name' ),
) );

add_action( 'genesis_before', 'bg_header_widget_area' );
function bg_header_widget_area() {
	genesis_widget_area( 'vanilla-slider', array(
		'before' => '<div class="vanilla-slider-bh afclr">',
		'after'  => '</div>',
	) );
}
//* Register vanilla category navigation area
genesis_register_sidebar( array(
	'id'          => 'vanilla-category-nav',
	'name'        => __( 'Vanilla Category Navigation', 'genesis' ),
	'description' => __( 'This is the Vanilla category navigation Area.', 'theme-name' ),
) );

add_action( 'genesis_before', 'bg_cat_nav_widget_area' );
function bg_cat_nav_widget_area() {
	genesis_widget_area( 'vanilla-category-nav', array(
		'before' => '<div class="vanilla-category-nav-bh">',
		'after'  => '</div>',
	) );
}

//* Register vanilla logo area
genesis_register_sidebar( array(
	'id'          => 'vanilla-logo',
	'name'        => __( 'Vanilla logo', 'genesis' ),
	'description' => __( 'This is the Vanilla logo Area.', 'theme-name' ),
) );

add_action( 'genesis_after_sidebar_widget_area', 'bg_logo_widget_area' );
function bg_logo_widget_area() {
	genesis_widget_area( 'vanilla-logo', array(
		'before' => '<div class="vanilla-logo">',
		'after'  => '</div>',
	) );
}