<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller : Review
 *
 */
class Review extends Front_Controller
{
	public function __construct()
	{   parent::__construct();
        if($this->session->userdata['user_data']['user_type'] != 2)
            redirect ('home');
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/jquery.uploadifive.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/bootstrap-tagsinput.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/user.js'), 'type' => 'text/javascript'));
		$this->load->model('user_model');
        $this->load->model('review_model');
    }
	public function index()
	{
	   $this->_authenticate(); 
       $user_type = $this->session->userdata['user_data']['user_type'];
       $data = array();
       $data['page'] = 'user';
       $this->template->view('home',$data);
	}
}