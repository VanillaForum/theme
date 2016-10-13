<?php
/****************************************
*	Template Name: Template 100% Width
****************************************/

$field = get_field_object('contact_home');
$value = get_field('contact_home');

if ($value != '') {
	add_action('genesis_after_content','new_function');
}

function new_function(){
	genesis_widget_area( 'home-third', array( 


		'before'	=> 	'<div class="home-third"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end home third -->' 

	) );
}



genesis();

?>