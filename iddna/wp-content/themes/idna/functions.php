<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );


/*****************************************
*	Adding functions
*****************************************/
include_once( get_stylesheet_directory() . '/lib/theme_functions.php' );

/*****************************************
*	Adding shortcodes
*****************************************/
include_once( get_stylesheet_directory() . '/lib/shortcodes.php' );

/*****************************************
*	Adding widgets
*****************************************/
include_once( get_stylesheet_directory() . '/lib/widgets/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Mobile First Theme' );
define( 'CHILD_THEME_URL', 'http://briangardner.com/themes/mobile-first/' );
define( 'CHILD_THEME_VERSION', '1.0.4' );
/*
<script src="//use.typekit.net/rdp7aap.js"></script>

<script>try{Typekit.load();}catch(e){}</script>
*/
//* Enqueue scripts and styles
add_action( 'genesis_before_footer', 'mobile_first_scripts_styles' );
function mobile_first_scripts_styles() {

	wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), '1.0', true);

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:400,700', array(), CHILD_THEME_VERSION );

	/********************************
	*	Custom Styles
	********************************/
	wp_enqueue_style( 'custom-css', get_stylesheet_directory_uri().'/css/custom.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'font-awesome-css', get_stylesheet_directory_uri().'/css/font-awesome.css', array(), CHILD_THEME_VERSION );

	/****************************
	*	Magnific Popup
	******************************/
	wp_enqueue_script('magnific-js', get_stylesheet_directory_uri() . '/js/popup/jquery.magnific-popup.js', array('jquery'), '1.0', true);

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 61,
	'height'          => 51,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );

add_filter('widget_text', 'do_shortcode');

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );

//* Hook sticky message before site header
add_action( 'genesis_before', 'mobile_first_sticky_message' );
function mobile_first_sticky_message() {

	genesis_widget_area( 'sticky-message', array(
		'before' => '<div class="sticky-message">',
		'after'  => '</div>',
	) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar' );
function mobile_first_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_comments_gravatar' );
function mobile_first_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Register widget areas
/*genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'bg-mobile-first' ),
	'description' => __( 'This is the sticky message widget area.', 'bg-mobile-first' ),
) );*/

genesis_register_sidebar( array(
	'id'			=> 'top-area',
	'name'			=> __( 'Top Area', 'prose' ),
	'description'	=> __( 'This is the Top widget area', 'idna' ),
) );

add_action('genesis_before_header','top_widget_area');
function top_widget_area(){
	genesis_widget_area( 'top-area', array(
		'before' => '<div class="top-area-content" class="top-w-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

//* slider
/*add_action( 'genesis_after_header', 'widget_before_content_sidebar_wrap');
function widget_before_content_sidebar_wrap() {
	if ( is_front_page() ) {
			genesis_widget_area( 'home-slider', array(
			'before' => '<div class="home-slider" class="widget-area">',
			'after'  => '</div>',
		) );
	}
 
}*/
function fb_disable_feed() {
wp_die( __('No feed available,please visit our <a href="'. get_bloginfo('url') .'">homepage</a>!') );
}

add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);
add_action('do_feed_rss2_comments', 'fb_disable_feed', 1);
add_action('do_feed_atom_comments', 'fb_disable_feed', 1);