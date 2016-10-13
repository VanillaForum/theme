<?php

/***************************************
*	Template Name: Template How it works
***************************************/
add_action('genesis_after_content','call_home_third_function');
function call_home_third_function(){
	genesis_widget_area( 'home-third', array( 


		'before'	=> 	'<div class="home-third"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end home third -->' 

	) );
}

genesis();
?>