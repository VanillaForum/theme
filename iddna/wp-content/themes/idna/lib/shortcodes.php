<?php
/*************************************
*	Custom Shortcodes
*************************************/

add_shortcode('idna_icons','idna_icons_function');
function idna_icons_function($atts,$content){
	extract(shortcode_atts(array(      
      'title' => '',
      'icon' => '',
      'image' => '',
      'link' => '#',
      'type' => '',
      'number' => '',
      'rotate' => 'no',
      'text' => ''
   	), $atts));
   	$out = '';
   	if ($icon) {
   		$out = '';
   		$out .= '<span class="content-block-icon">';
   		$out .= '<div class="icon-block-fa">'.$icon.'</div>';
   		$out .= '<p><a href="'.$link.'">'.$title.'</a></p>';
   		$out .= '</span>';
   	}
   	if ($image) {
   		$out = '';
   		$out .= '<span class="content-block-icon">';
   		$out .= '<div style="background:url('.$image.');" class="icon-img-block"></div>';
   		$out .= '<p><a href="'.$link.'">'.$title.'</a></p>';
   		$out .= '</span>';
   	}
   	if ($type == 'info') {
   		$out = '';
   		$out .= '<span class="content-info-block">';
   		$out .= '<div class="icon-info" style="background:url('.$image.');"></div>';
   		$out .= '<div class="i-c_c"><div class="info-number">'.$number.'</div>';
   		$out .= '<div class="info-content">';
   		$out .= '<h4>'.$title.'</h4>';
   		$out .= '<p>'.$text.'</p>';
   		$out .= '</div></div>';
   		$out .= '</span>';
   	}
      if ($type == 'info_icon') {
         if ($rotate == 'yes') {
            $ss = 'rotate';
         }
         $out = '';
         $out .= '<span class="content-info-block">';
         $out .= '<div class="icon-info cf '.$ss.'"><div>'.$icon.'</div></div>';
         $out .= '<div class="i-c_c"><div class="info-number">'.$number.'</div>';
         $out .= '<div class="info-content">';
         $out .= '<h4>'.$title.'</h4>';
         $out .= '<p>'.$text.'</p>';
         $out .= '</div></div>';
         $out .= '</span>';
      }
   	return $out;
}

/**********************************************
*	Flex container Shortcode
**********************************************/

add_shortcode('container_flex','flex_function');
function flex_function($atts,$content){
	$out = '';
	$out .= '<div class="flex-container">'.do_shortcode($content).'</div>';
	return $out;
}

/****************************************
*	Vertical center Shortcode
****************************************/
add_shortcode('vertical_center','vertical_center_function');
function vertical_center_function($atts,$content){
	$out = '';
	$out .= '<div class="vertical-container"><div>'.do_shortcode($content).'</div></div>';
	return $out;
}


/******************************************
*	Columns Shortcodes
******************************************/

/************* ONE HALF ********************/
add_shortcode('one_half','one_half_function');
function one_half_function($atts,$content){
	extract(shortcode_atts(array(      
      'first' => ''
   	), $atts));
   	$out = '';
   	if ($first == 'yes') {
   		$out = '<div class="one-half first">'.do_shortcode($content).'</div>';
   	}else{
   		$out = '<div class="one-half">'.do_shortcode($content).'</div>';
   	}
   	return $out;
}

/************* ONE THIRD ********************/
add_shortcode('one_third','one_third_function');
function one_third_function($atts,$content){
	extract(shortcode_atts(array(      
      'first' => ''
   	), $atts));
   	$out = '';
   	if ($first == 'yes') {
   		$out = '<div class="one-third first">'.do_shortcode($content).'</div>';
   	}else{
   		$out = '<div class="one-third">'.do_shortcode($content).'</div>';
   	}
   	return $out;
}
add_shortcode('two_third','two_third_function');
function two_third_function($atts,$content){
	extract(shortcode_atts(array(      
      'first' => ''
   	), $atts));
   	$out = '';
   	if ($first == 'yes') {
   		$out = '<div class="two-thirds first">'.do_shortcode($content).'</div>';
   	}else{
   		$out = '<div class="two-thirds">'.do_shortcode($content).'</div>';
   	}
   	return $out;
}

/************* ONE FOURTH ********************/
add_shortcode('one_fourth','one_fourth_function');
function one_fourth_function($atts,$content){
	extract(shortcode_atts(array(      
      'first' => ''
   	), $atts));
   	$out = '';
   	if ($first == 'yes') {
   		$out = '<div class="one-fourth first">'.do_shortcode($content).'</div>';
   	}else{
   		$out = '<div class="one-fourth">'.do_shortcode($content).'</div>';
   	}
   	return $out;
}

/********************************************
*	Special List Shortcode
********************************************/
add_shortcode('special_list','special_list_function');
function special_list_function($atts,$content){
	extract(shortcode_atts(array(      
      'type' => ''
      ), $atts));
	$out = '';
	if ($type == 'check') {
		$out .= '<div class="special-list check-list">'.do_shortcode($content).'</div>';
	}
	return $out;
}



/*********************************************
*  Contact Box Shortcode
*********************************************/
add_shortcode('contact_box','contact_box_function');
function contact_box_function($atts,$content){
   extract(shortcode_atts(array(      
      'type' => '',
      'title' => '',
      'link' => '',
      'last' => ''
      ), $atts));

   $out = '';
   if ($last == 'yes') {
      $clast = 'last';
   }
   if ($type == 'phone') {
      $out = '';
      $out .= '<div class="contact-box-container '.$clast.'">';
      $out .= '<span class="icon-c-box"><i class="fa fa-phone"></i></span>';
      $out .= '<span class="content-c-box phone">';
      $out .= '<h5>'.$title.'</h5>';
      $out .= '<a href="tel:'.$link.'">+'.$link.'</a>';
      $out .= '<p>'.$content.'</p>';
      $out .= '</span>';
      $out .= '</div>';
   }
   if ($type == 'mail') {
      $out = '';
      $out .= '<div class="contact-box-container '.$clast.'">';
      $out .= '<span class="icon-c-box" style="font-size:20px;"><i class="fa fa-envelope"></i></span>';
      $out .= '<span class="content-c-box mail">';
      $out .= '<h5>'.$title.'</h5>';
      $out .= '<a href="mailto:'.$link.'">'.$link.'</a>';
      $out .= '<p>'.$content.'</p>';
      $out .= '</span>';
      $out .= '</div>';
   }
   if ($type == 'skype') {
      $out = '';
      $out .= '<div class="contact-box-container '.$clast.'">';
      $out .= '<span class="icon-c-box"><i class="fa fa-skype"></i></span>';
      $out .= '<span class="content-c-box skype">';
      $out .= '<h5>'.$title.'</h5>';
      $out .= '<a href="'.$link.'">'.$content.'</a>';
      $out .= '</span>';
      $out .= '</div>';
   }

   return $out;
}

add_shortcode('full','full_function');
function full_function($atts,$content){
   $out = '<div class="full-container">'.do_shortcode($content).'</div>';
   return $out;
}
add_shortcode('spacer','spacer_function');
function spacer_function($atts,$content){
   $out = '<div class="spacer"></div>';
   return $out;
}


/***********************************
*	Full width container
***********************************/
add_shortcode('full_width','full_width_function');
function full_width_function($atts,$content){
	extract(shortcode_atts(array(      
      'background_color' => '',
      'background_image' => '',
      'text_color' => '',
      'text_size' => '',
      'top_icon' => ''
      ), $atts));
	$out = '';
	if ($background_color) {
		$style = 'background: '.$background_color.';color:'.$text_color.';font-size:'.$text_size.'px;';
	}
	if ($background_image) {
		$style = 'background: url('.$background_image.');color:'.$text_color.';font-size:'.$text_size.'px;';
	}
   if ($top_icon) {
      $flag = '<div class="flag"><img src="'.$top_icon.'" /></div>';
   }else{
      $flag = '';
   }
	$out .= '<div class="full-width-container" style="'.$style.'"><div class="f-w-wrap">'.$flag;
	$out .= do_shortcode($content);
	$out .= '</div></div>';

	return $out;
}


/*******************************************
*	Follow Shortcode
*******************************************/
add_shortcode('follow','follow_function');
function follow_function($atts,$content){
	extract(shortcode_atts(array(      
      'title' => '',      
      'twitter' => '',
      'google' => '',
      'instagram' => '',
      'youtube' => '',
      'vimeo' => '',
      'linkedin' => ''
      ), $atts));
	$out = '';
	$out .= '<div class="follow-socials">';

	if ($title) {
		$out .= '<span class="title-follow">'.$title.'</span>';
	}
	if ($twitter) {
		$out .= '<span><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></span>';
	}
	if ($google) {
		$out .= '<span><a href="'.$google.'"><i class="fa fa-google-plus"></i></a></span>';
	}
	if ($instagram) {
		$out .= '<span><a href="'.$instagram.'"><i class="fa fa-instagram"></i></a></span>';
	}
	if ($youtube) {
		$out .= '<span><a href="'.$youtube.'"><i class="fa fa-youtube-play"></i></a></span>';
	}
	if ($vimeo) {
		$out .= '<span><a href="'.$vimeo.'"><i class="fa fa-vimeo-square"></i></a></span>';
	}
	if ($linkedin) {
		$out .= '<span><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></span>';
	}

	$out .= '</div>';

	return $out;
}


/*****************************************
*	Custom Width Shortcode
*****************************************/
add_shortcode('custom_width','custom_width_function');
function custom_width_function($atts,$content){
	extract(shortcode_atts(array(      
      'width' => ''
      ), $atts));
	$out = '';
	$out .= '<div class="c-w" style="max-width:'.$width.'px;">'.do_shortcode($content).'</div>';
	return $out;
}


/***************************************
*	Timeline Shortcode
***************************************/
add_shortcode('tl_container','tl_container_function');
function tl_container_function($atts,$content){
	$out = '';
	$out .= '<div class="tl-container">'.do_shortcode($content).'</div>';
	return $out;
}
add_shortcode('tl_line','tl_line_function');
function tl_line_function($atts,$content){
	$out = '';
	$out .= '<div class="tl-divider"></div>';
	return $out;
}
add_shortcode('tl_content','tl_content_function');
function tl_content_function($atts,$content){
	extract(shortcode_atts(array(      
      'title' => '',
      'percent' => '',
      'position' => 'top'
      ), $atts));
	$out = '';
	if ($position == 'top') {
		$classp = 'top';
	}
	if ($position == 'bottom') {
		$classp = 'bottom';
	}
	$out .= '<div class="tl-content '.$classp.'" style="left:'.$percent.'%;">';
	$out .= '<h4>'.$title.'</h4>';
	$out .= '<p>'.$content.'</p>';
	$out .= '</div>';
	return $out;
}


/***************************************
*	Custom Title
***************************************/
add_shortcode('custom_title','custom_title_function');
function custom_title_function($atts,$content){
	extract(shortcode_atts(array(      
      'bold' => false
      ), $atts));
	$out = '';
	
	if ($bold == true) {
		$out .= '<h1 class="custom-bold-title">'.$content.'</h1>';
	}else{
		$out .= '<h1 class="custom-page-title">'.$content.'</h1>';
	}
	return $out;
}

/***********************************
*	Icon List
***********************************/
add_shortcode('big_icon_list','big_icon_list_function');
function big_icon_list_function($atts,$content){
	extract(shortcode_atts(array(      
      'icon_url' => '',
      'text_color' => '',
      'text_size' => ''
      ), $atts));
	$out = '';
	$out .= '<div class="b-i-container">';
	$out .= '<div class="b-i-icon"><img src="'.$icon_url.'"></div>';
	$out .= '<div class="b-i-content" style="color:'.$text_color.';font-size:'.$text_size.'px;">'.$content.'</div>';
	$out .= '</div>';
	return $out;
}

/***************************************
*	Custom Table
***************************************/
add_shortcode('custom_table','custom_table_function');
function custom_table_function($atts,$content){
	extract(shortcode_atts(array(      
      'width' => ''
      ), $atts));
	$out = '';
	$out .= '<table class="custom-table" style="max-width:'.$width.'px;">';
	$out .= do_shortcode($content);
	$out .= '</table>';
	return $out;
}
add_shortcode('ct_head','c_t_head_function');
function c_t_head_function($atts,$content){
	$out = '';
	$out .= '<thead>'.do_shortcode($content).'</thead>';
	return $out;
}
add_shortcode('ct_row','ct_row_function');
function ct_row_function($atts,$content){
	$out = '';
	$out .= '<tr>'.do_shortcode($content).'</tr>';
	return $out;
}
add_shortcode('ct_col','ct_col_function');
function ct_col_function($atts,$content){
	extract(shortcode_atts(array(      
      'width' => '',
      'text_align' => ''
      ), $atts));
	$out = '';
	$out .= '<td style="max-width:'.$width.'px;text-align:'.$text_align.';">'.do_shortcode($content).'</td>';
	return $out;
}



/**************************************
*  Paper popup shortcode
**************************************/
add_shortcode('popup_white','popup_white_function');
function popup_white_function($atts,$content){
   extract(shortcode_atts(array(      
      'id_page' => ''
      ), $atts));
   $out = '';

   query_posts(array('post_type' => 'page', 'orderby' => 'date', 'order' => 'DESC' , 'showposts' => -1));

   $out .= '<div id="terms-dialog" class="zoom-anim-dialog mfp-hide ">';

   if (have_posts()) :
      while (have_posts()) : the_post();
         if (get_the_ID()==$id_page) {
            $out .= '<div class="terms-content"><h1>'.get_the_title().'</h1>'.do_shortcode(get_the_content()).'</div>';
         }
      endwhile;
   endif;

   wp_reset_query();

   $out .= '</div>';
   return $out;
}


/*******************************************
*  How it works list
*******************************************/
add_shortcode('hiw_content','hiw_content_function');
function hiw_content_function($atts,$content){
   $out = '';
   $out .= '<div class="hiw-container-list">'.do_shortcode($content).'</div>';
   return $out;
}
add_shortcode('hiw_block','hiw_block_function');
function hiw_block_function($atts,$content){
   extract(shortcode_atts(array(
   	  'number' => '',
      'text_large' => '',
      'top' => '0'
      ), $atts));
   $out = '';

   	if ($number == 1) {
   		$out .= '<div class="hiw-container">';
   		$out .= '<div class="hiw-content left" style="width:'.$text_large.'px;height:273px;"><div class="hiw-1">';   		
   		$out .= do_shortcode($content);
   		$out .= '</div></div>';
   		$out .= '<div class="middle-hiw"><img src="'.get_stylesheet_directory_uri().'/images/1-list.png"></div>';
   		$out .= '<div class="hiw-content empty" style="width:'.$text_large.'px;"><p></p></div>';
   		$out .= '</div>';
   	}
   	if ($number == 2) {
   		$out .= '<div class="hiw-container">';
   		$out .= '<div class="hiw-content empty" style="width:'.$text_large.'px;"><p></p></div>';
   		$out .= '<div class="middle-hiw"><img src="'.get_stylesheet_directory_uri().'/images/2-list.png"></div>';   		
   		$out .= '<div class="hiw-content right" style="width:'.$text_large.'px;height:196px;"><div class="hiw-2">';   		
   		$out .= do_shortcode($content);
   		$out .= '</div></div>';
   		$out .= '</div>';
   	}
   	if ($number == 3) {
   		$out .= '<div class="hiw-container">';
   		$out .= '<div class="hiw-content left" style="width:'.$text_large.'px;height:196px;"><div class="hiw-3">';   		
   		$out .= do_shortcode($content);
   		$out .= '</div></div>';
   		$out .= '<div class="middle-hiw"><img src="'.get_stylesheet_directory_uri().'/images/3-list.png"></div>';
   		$out .= '<div class="hiw-content empty" style="width:'.$text_large.'px;"><p></p></div>';
   		$out .= '</div>';
   	}
   	if ($number == 4) {
   		$out .= '<div class="hiw-container">';
   		$out .= '<div class="hiw-content empty" style="width:'.$text_large.'px;"><p></p></div>';
   		$out .= '<div class="middle-hiw"><img src="'.get_stylesheet_directory_uri().'/images/4-list.png"></div>';   		
   		$out .= '<div class="hiw-content right" style="width:'.$text_large.'px;height:196px;"><div class="hiw-4">';   		
   		$out .= do_shortcode($content);
   		$out .= '</div></div>';
   		$out .= '</div>';
   	}
   	if ($number == 5) {
   		$out .= '<div class="hiw-container">';
   		$out .= '<div class="hiw-content left" style="width:'.$text_large.'px;height:196px;"><div class="hiw-5">';   		
   		$out .= do_shortcode($content);
   		$out .= '</div></div>';
   		$out .= '<div class="middle-hiw"><img src="'.get_stylesheet_directory_uri().'/images/5-list.png"></div>';
   		$out .= '<div class="hiw-content empty" style="width:'.$text_large.'px;"><p></p></div>';
   		$out .= '</div>';
   	}

   return $out;
   
}
add_shortcode('hiw_title','hiw_title_function');
function hiw_title_function($atts,$content){
	extract(shortcode_atts(array(
      'number' => '',
      'align' => ''
      ), $atts));
	$out = '';
	if ($align == 'left') {
		$out .= '<h4 class="left"><span>'.$number.'</span>'.do_shortcode($content).'</h4>';
	}
	if ($align == 'right') {
		$out .= '<h4 class="right">'.do_shortcode($content).'<span>'.$number.'</span></h4>';
	}
	
	return $out;

}
add_shortcode('hiw_c','hiw_c_function');
function hiw_c_function($atts,$content){
	extract(shortcode_atts(array(
      'align' => ''
      ), $atts));
	$out = '';
	$out .= '<div class="hiw-c '.$align.'">'.$content.'</div>';
	return $out;
}

/********************************************************
*  Custom Wrap
********************************************************/
add_shortcode('custom_wrap','custom_wrap_function');
function custom_wrap_function($atts,$content){
   extract(shortcode_atts(array(
      'width' => ''
      ), $atts));
   $out = '';
   $out .= '<div class="wrap" style="max-width:'.$width.'px;">'.do_shortcode($content).'</div>';
   return $out;
}

/*******************************************************
*  Custom Text
*******************************************************/
add_shortcode('custom_text','custom_text_function');
function custom_text_function($atts,$content){
   extract(shortcode_atts(array(
      'size' => '',
      'align' => '',
      'color' => ''
      ), $atts));
   $out = '';
   $out .= '<div class="custom-text" style="font-size:'.$size.'px;text-align:'.$align.';color:'.$color.';">'.$content.'</div>';
   return $out;
}


?>