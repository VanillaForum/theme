<?php
/*****************************
*	Custom Front Page
*****************************/
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action('genesis_after_header','slider_home');
function slider_home(){
	genesis_widget_area( 'home-slider', array( 

		'before'	=>	'<div class="home-slider">', 

		'after'		=>	'</div><div class="clear"></div><!-- end home slider -->'
	) );
}

if ( is_active_sidebar( 'home-slider' ) || is_active_sidebar( 'home-first' ) ) {
	add_action( 'genesis_before_content_sidebar_wrap', 'idna_home_loop_helper', 1 );
}
function idna_home_loop_helper() {

	echo '<div id="home-featured">';

	genesis_widget_area( 'home-first', array( 

		'before'	=>	'<div class="home-first"><div class="wrap">', 

		'after'		=>	'</div></div><div class="clear"></div><!-- end home first -->'
	) );

	genesis_widget_area( 'home-second', array( 


		'before'	=> 	'<div class="home-second"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end home second -->' 

	) );

	genesis_widget_area( 'home-third', array( 


		'before'	=> 	'<div class="home-third"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end home third -->' 

	) );


	echo '</div>';

}

genesis();
?>