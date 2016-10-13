<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller : Review
 *
 */
class Page extends Front_Controller
{
	public function __construct()
	{   parent::__construct();
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/home.js'), 'type' => 'text/javascript'));
		$this->load->model('user_model');
		$this->load->model('admin_model');
    }
	public function index()
	{
	   $data = array();
	   $page = $this->admin_model->get_page_content($this->uri->segment(1))->result();
       $data['page'] = $page;
	   $this->template->view('page',$data);
	}
}