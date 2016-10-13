<?php

/*************************************
*	Home Widget Areas
*************************************/
genesis_register_sidebar( array(
	'id'			=> 'home-slider',
	'name'			=> __( 'Slider Area', 'prose' ),
	'description'	=> __( 'This is the home slider widget area', 'idna' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-first',
	'name'			=> __( 'First Home Area', 'prose' ),
	'description'	=> __( 'This is the home first widget area', 'idna' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-second',
	'name'			=> __( 'Second Home Area', 'prose' ),
	'description'	=> __( 'This is the home second widget area', 'idna' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-third',
	'name'			=> __( 'Third Home Area', 'prose' ),
	'description'	=> __( 'This is the home third widget area', 'idna' ),
) );
genesis_register_sidebar( array(
	'id'			=> 'home-fourth',
	'name'			=> __( 'Fourth Home Area', 'prose' ),
	'description'	=> __( 'This is the home fourth widget area', 'idna' ),
) );

genesis_register_sidebar( array(
	'id'			=> 'disclaimer-section',
	'name'			=> __( 'Disclaimer Widget Area', 'prose' ),
	'description'	=> __( 'This is the Disclaimer widget area', 'idna' ),
) );

/**************************************
*	Move Scripts to footer
***************************************/
/*remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);

add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);*/

/****************************************
*	Remove Page titles
****************************************/



/***************************************
*	Popup Link
***************************************/
//add_action('genesis_before','custom_popup_function');
function custom_popup_function(){
	echo '<div id="loader-wrapper">
			<div id="loader"></div>

			<div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

		</div>';
	
}


add_action('genesis_before_header', 'mg_popup');
function mg_popup(){
	echo '<div id="login-dialog" class="zoom-anim-dialog mfp-hide"><div class="main-pup">';
	echo '<div class="one-third first"><img src="'.get_stylesheet_directory_uri().'/images/logoform.png"></div>';
	echo '<div class="two-thirds">';
	echo wp_login_form();
	echo '</div>';
	echo '</div></div>';

	echo '<script>jQuery(document).ready(function() {
	jQuery(".popup-with-zoom-anim").magnificPopup({
		type: "inline",

		fixedContentPos: false,
		fixedBgPos: true,

		overflowY: "auto",

		closeBtnInside: true,
		preloader: false,
		
		midClick: true,
		removalDelay: 300,
		mainClass: "my-mfp-zoom-in"
	});
});</script>';
}

/**********************************************
*	Page thumbnail
**********************************************/
add_action('genesis_after_header','if_has_thumbnail');
function if_has_thumbnail(){
	if (is_page()) {
		if (has_post_thumbnail()) {
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
			$banner_text = get_field('banner_content');
			if ($banner_text) {
				echo '<div class="page-thumbnail"><span class="backgroun-menu"></span>'.get_the_post_thumbnail(get_the_ID(),'full').'<h1 class="banner-text">'.$banner_text.'</h1></div>';
			}else{
				echo '<div class="page-thumbnail"><span class="backgroun-menu"></span>'.get_the_post_thumbnail(get_the_ID(),'full').'<h1 class="banner-text">'.get_the_title().'</h1></div>';
			}
			
		}else{
			remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
			$banner_text = get_field('banner_content');
			if ($banner_text) {
				echo '<div class="page-thumbnail"><span class="backgroun-menu"></span><img src="'.get_stylesheet_directory_uri().'/images/default.jpg"><h1 class="banner-text">'.$banner_text.'</h1></div>';
			}else{
				echo '<div class="page-thumbnail"><span class="backgroun-menu"></span><img src="'.get_stylesheet_directory_uri().'/images/default.jpg"><h1 class="banner-text">'.get_the_title().'</h1></div>';
			}
		}
		add_action('genesis_before_loop','custom_title');
		function custom_title(){
			if (get_field('custom_title')) {
				echo '<h1 class="custom-page-title">'.get_field('custom_title').'</h1>';
			}
		}
	}
}

/******************************************
*	Widget area for Disclaimer
******************************************/
add_action('genesis_after_footer','widget_before_copyright');
function widget_before_copyright(){
	genesis_widget_area( 'disclaimer-section', array(

		'before'	=> 	'<div class="disclaimer-section"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end disclaimer section -->' 

	) );
}



/******************************************
*	Search Form Text
******************************************/
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return esc_attr( '' );
}
add_filter( 'genesis_search_button_text', 'sp_search_button_text' );
function sp_search_button_text( $text ) {
	return ' ';
}

/******************************************
*	Search results page
******************************************/
add_filter('genesis_noposts_text','my_noposts_text');

function my_noposts_text() {

  $my_text = "We didn’t find any result for your search";

  return $my_text;

}


/*******************************************
*	Theme Options
*******************************************/

/***********************************************
*	Genesis logo options
***********************************************/
/*-----------------------Genesis Socials-----------------------------*/

function be_options_defaults( $defaults ) {

	$defaults['footer_text'] = '';
	$defaults['footer_img'] = '';
 
	return $defaults;
}
add_filter( 'genesis_theme_settings_defaults', 'be_options_defaults' );
 
function be_register_sanitization_filters() {
	genesis_add_option_filter( 'html', GENESIS_SETTINGS_FIELD,
		array(
			'footer_text',
			'footer_img',
		) );
}
add_action( 'genesis_settings_sanitizer_init', 'be_register_sanitization_filters' );

function be_register_settings_footer_box( $_genesis_theme_settings_pagehook ) {
	add_meta_box('be-footer-settings', 'Footer', 'be_footer_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high');
}
add_action('genesis_theme_settings_metaboxes', 'be_register_settings_footer_box');

function be_footer_settings_box() {
	?>
	<p>Footer text:<br />
 	<textarea style="min-height:200px;width:380px;"name="<?php echo GENESIS_SETTINGS_FIELD; ?>[footer_text]"><?php echo esc_attr( genesis_get_option('footer_text') ); ?></textarea>
 	<p>Footer image:<br />
	<input type="text" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[footer_img]" value="<?php echo esc_attr( genesis_get_option('footer_img') ); ?>" size="50" /> </p>
 	
	<?php
}


/**********************************
*	Footer Custom Copyright
**********************************/
add_filter( 'genesis_footer_creds_text', 'sp_footer_creds_text' );
function sp_footer_creds_text() {
	$footer_info = do_shortcode(genesis_get_option('footer_text'));
	$value = genesis_get_option('footer_img');
	
	if (genesis_get_option('footer_text')!='' && genesis_get_option('footer_img')!='') {
		echo '<div class="creds"><span class="footer-img"><img src="'.$value.'"></span><span class="footer-text">'.$footer_info.'</span></div>';
	}else{
		echo '<div class="creds"><span class="footer-text">'.$footer_info.'</span></div>';
	}
}



/*************************************
*	Add Page before footer
*************************************/
add_action('genesis_after_content_sidebar_wrap','before_footer_function');
function before_footer_function(){
	genesis_widget_area( 'home-fourth', array( 


		'before'	=> 	'<div class="home-fourth"><div class="wrap">', 

		'after'	    =>	'</div></div><div class="clear"></div><!-- end home fourth -->' 

	) );
}


/*****************************************
*	Contact form 7 change message body
*****************************************/
add_action('wpcf7_before_send_mail', 'custom_wpcf7_before_send_mail');
function custom_wpcf7_before_send_mail($form) {
  $id = $form->id; // gets current form id

  // CF7 form id => "form label (for you to distinguish)" -- you don't need this, but if you use multiple forms, it may be useful to TARGET x, y, or z forms instead of all forms
  $formTypes = array(
    42 => "Contact Page",
    //202 => "Questions/Comments Form"
  );

  // check if we want to run this code on selected form
  if(array_key_exists($id, $formTypes)) {
    // get current FORM instance
	    $wpcf7 = WPCF7_ContactForm::get_current();

	    // get current SUBMISSION instance
	    $submission = WPCF7_Submission::get_instance();

	    // get submission data
	    $data = $submission->get_posted_data();

	    // nothing's here... do nothing...
	    if(empty($data)) return;

	    // extract posted data
	    $name         = isset($data['name'])          ? $data['name']     : "";
	    $company      = isset($data['company'])  	  ? $data['company']     : "";
	    $email        = isset($data['email'])         ? $data['email']         : "";
	    $phone        = isset($data['phone'])         ? $data['phone']         : "";
	    $country      = isset($data['country'])       ? $data['country']     : "";
	    $state        = isset($data['state'])     	  ? $data['state']     : ""; 
	    $provincesca  = isset($data['provincesca'])   ? $data['provincesca']     : "";  
	    $subject      = isset($data['subject'])       ? $data['subject']     : "";   
	    $message      = isset($data['message'])       ? $data['message']       : "";

	    // do other stuff here

	    $mail = $wpcf7->prop('mail');

	    $blogtime = current_time( 'mysql' );

	    if ($subject == "Consumer") {
	    	//$mail['recipient'] = str_replace("", "", "<info@suisselifescience.com>");
	    	$mail['recipient'] = str_replace("", "", "<info@suisselifescience.com>");
	    	if ($country == "USA") {
	    		$mail['subject'] = str_replace("", "", "CONSUMER INQUIRY - ".$country."(".$state.")-idna.works(".$blogtime.")");
	    	}
	    	if ($country == "Canada") {
	    		$mail['subject'] = str_replace("", "", "CONSUMER INQUIRY - ".$country."(".$provincesca.")-idna.works(".$blogtime.")");
	    	}
	    	$goURL = 'usa/';
	    	$wpcf7->set_properties( array( 'additional_settings' => "on_sent_ok: \"location = '".$goURL."';\"" ) );	    	
	    }

	    if ($subject == "Distribution") {
	    	$mail['recipient'] = str_replace("", "", "<omar.fogliadini@suisselifescience.com>");
	    	if ($country == "USA") {
	    		$mail['subject'] = str_replace("", "", "DISTRIBUTION INQUIRY - ".$country."(".$state.")-idna.works(".$blogtime.")");
	    	}
	    	if ($country == "Canada") {
	    		$mail['subject'] = str_replace("", "", "DISTRIBUTION INQUIRY - ".$country."(".$provincesca.")-idna.works(".$blogtime.")");
	    	}
	    }
	    if ($subject == "Press") {
	    	$mail['recipient'] = str_replace("", "", "<omar.fogliadini@suisselifescience.com>");
	    	if ($country == "USA") {
	    		$mail['subject'] = str_replace("", "", "PRESS INQUIRY - ".$country."(".$state.")-idna.works(".$blogtime.")");
	    	}
	    	if ($country == "Canada") {
	    		$mail['subject'] = str_replace("", "", "PRESS INQUIRY - ".$country."(".$provincesca.")-idna.works(".$blogtime.")");
	    	}
	    	$goURL = 'thank-you/';
	    	$wpcf7->set_properties( array( 'additional_settings' => "on_sent_ok: \"location = '".$goURL."';\"" ) );
	    }
	    if ($subject == "Other") {
	    	$mail['recipient'] = str_replace("", "", "<omar.fogliadini@suisselifescience.com>");
	    	if ($country == "USA") {
	    		$mail['subject'] = str_replace("", "", "OTHER INQUIRY - ".$country."(".$state.")-idna.works(".$blogtime.")");
	    	}
	    	if ($country == "Canada") {
	    		$mail['subject'] = str_replace("", "", "OTHER INQUIRY - ".$country."(".$provincesca.")-idna.works(".$blogtime.")");
	    	}
	    	$goURL = 'usa/';
	    	$wpcf7->set_properties( array( 'additional_settings' => "on_sent_ok: \"location = '".$goURL."';\"" ) );
	    }
    // Find/replace the "special" tag as defined in your CF7 email body
    //$mail['body'] = str_replace("", "", "nononono");
    

    // Save the email body
    $wpcf7->set_properties(array("mail" => $mail, "subject" => $subject));

    // return current cf7 instance
    return $wpcf7;
  }
}



/*******************************************
* Add Load
*******************************************/
add_action ('genesis_before', 'load_function');
function load_function(){
 if (!is_page('368')){
   echo '<div id="loading"><div class="loading"></div><div class="loading-logo"></div></div>'; 
 }
 
}


?>