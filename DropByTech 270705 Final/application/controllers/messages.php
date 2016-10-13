<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller : Client
 *
 */

class Messages extends Front_Controller
{
	public function __construct()
	{   
        parent::__construct();
         if(!isset($this->session->userdata['user_data']['user_type']))
            redirect ('home');
		$this->load->model('messages_model');
        
	}
	public function update_messages()
	{
		$this->db->where('projectId', $_POST['projectId']);
		$this->db->where('userId', $_POST['userid']);
		$this->db->update('project_messages', array('status'=>1));
		die();
	}
	
}