<?php
/**
 * author  psofttech
 * helper : config helper
 */

// get site name in whole site using thid function
if(!function_exists('site_name'))
{  
    function site_name()
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();  
        //return the full asset path
        return $CI->config->item('site_name');
    }
}

//get config value
if(!function_exists('config_item'))
{  
    function config_item($field)
    {
        //get an instance of CI so we can access our configuration
        $CI =& get_instance();  
        //return the full asset path
        return $CI->config->config[$field];
    }
}

//return remaing time
if(!function_exists('time_elapsed_string'))
{
	function time_elapsed_string($ptime)
	{
		$etime = time() - $ptime;

		if ($etime < 1)
		{
			return '0 seconds';
		}

		$a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
					30 * 24 * 60 * 60       =>  'month',
					24 * 60 * 60            =>  'day',
					60 * 60                 =>  'hour',
					60                      =>  'minute',
					1                       =>  'second'
					);

		foreach ($a as $secs => $str)
		{
			$d = $etime / $secs;
			if ($d >= 1)
			{
				$r = round($d);
				return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
			}
		}
	}
}
//convert link if string contains domain name
if(!function_exists('to_url'))
{	
	function to_url($str)
	{
		$str = str_replace('"', '\'', $str);
		$str = preg_replace('@(http)?(s)?(://)?(([-\w]+\#)+([^\s]+)+[^,.\s])@', '<a href="http$2://$4" target="_blank">$1$2$3$4</a>', $str);
		$str = nl2br($str);

		return $str;
	}
}
//remove unnecessary tags for string 
if(!function_exists('url_str'))
{
	function url_str($str)
	{
		return str_replace('"', '\'', strip_tags($str));
	}
}

if(!function_exists('get_dd_options'))
{
	function get_dd_options($values, $first_option = 'All')
	{
		foreach($values as $key => $value)
		{
			$data[$value->id] = $value->title;
		}
		return $data;
	}
}
if(!function_exists('trim_text'))
{
    function trim_text($text, $count){ 
        $text = str_replace("  ", " ", $text); 
        $string = explode(" ", $text); 
        for( $wordCounter = 0; $wordCounter <= $count;$wordCounter++ ){ 
            $trimed .= $string[$wordCounter]; 
            if ( $wordCounter < $count ){ $trimed .= " "; } 
            else { $trimed .= ""; } 
        } 
        $trimed = trim($trimed); 
        return $trimed; 
    }    
}
if(!function_exists('link_suffix')){
    function link_suffix($str)
    {
        $title = str_replace(' ', '-', trim(preg_replace('/(\W)+/', ' ', strtolower($str))));

        if( !$title )
            $title = 'all';

        return "$title"; 
    }
}
//get user type
if(!function_exists('get_user_type')){
    function get_user_type()
    {
        //retrive data for user type
        $CI =& get_instance();
        $CI->load->library("session");
		$CI->load->model('user_model');
        $user_type_query = array(
                    'select' => array('user_type.*'),
                    ); 
        $user_type = $CI->user_model->get_rows($user_type_query,'user_type');
        return $user_type;
    }
}
if(!function_exists('get_credit_card_info')){
    function get_credit_card_info($user_id)
    {
        //retrive data for user type
        $CI =& get_instance();
        $CI->load->library("session");
		$CI->load->model('user_model');
        $user_type_query = array(
                    'select' => array('credit_card_info.*'),
                    'where' => array('credit_card_info.user_id' => $user_id),
                    ); 
        $credit_card_info = $CI->user_model->get_rows($user_type_query,'credit_card_info');
        return $credit_card_info;
    }
}
if(!function_exists('get_certificate')){
    function get_certificate($user_id)
    {
        //retrive data for user type
        $CI =& get_instance();
        $CI->load->library("session");
		$CI->load->model('user_model');
        $user_type_query = array(
                    'select' => array('certificate_info.*'),
                    'where' => array('certificate_info.c_user' => $user_id),
                    ); 
        $certificate_info = $CI->user_model->get_rows($user_type_query,'certificate_info');
        return $certificate_info;
    }
}
if(!function_exists('get_skill')){
    function get_skill($user_id)
    {
        //retrive data for user type
        $CI =& get_instance();
        $CI->load->library("session");
		$CI->load->model('user_model');
        $skill_query = array(
                    'select' => array('skill.*'),
                    'where' => array('skill.user_id' => $user_id),
                    ); 
        $skill = $CI->user_model->get_rows($skill_query,'skill');
        return $skill;
    }
}