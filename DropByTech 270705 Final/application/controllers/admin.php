<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/*

 * To change this template, choose Tools | Templates

 * and open the template in the editor.

 */



class Admin extends Front_Controller

{

	public function __construct()

	{   parent::__construct();

        

		//if($this->session->userdata['user_data']['user_type'] != 3)

            //redirect ('home');

		

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/jquery.uploadifive.min.js'), 'type' => 'text/javascript'));

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/bootstrap-tagsinput.js'), 'type' => 'text/javascript'));

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/user.js'), 'type' => 'text/javascript'));

        

        $this->load->model('user_model');

		$this->load->model('admin_model');

		$this->load->model('project_model');

		$this->load->model('bid_model');

		$this->load->model('review_model');
		$this->load->library('stripe');

	}

	

	public function index()

	{

       $this->_authenticate(); 

       $user_type = $this->session->userdata['user_data']['user_type'];

       $data = array();

       $this->load->view('admin/index');

	}

	
	function projects(){

		//$this->_authenticate(); 

		$user_type = $this->session->userdata['user_data']['user_type'];

		$page = $this->uri->segment(2);

		$data = array();		
		$data['projects'] = $this->project_model->find_all()->result();

		$this->load->view('admin/projects',$data);
	}
	function withdrawal_requests(){

		//$this->_authenticate(); 
		 $sss=$this->stripe->customer_list();

		$user_type = $this->session->userdata['user_data']['user_type'];

		$page = $this->uri->segment(2);

		$data = array();		
		$data['withdrawal_reqs'] = $this->project_model->find_all_withdrawal()->result();

		$this->load->view('admin/withdrawal_requests',$data);
	}
	function approve_request(){

		//$this->_authenticate(); 

		$user_type = $this->session->userdata['user_data']['user_type'];

		$wid = $this->uri->segment(3);
		$data = array();		
		$data['withdrawal_reqs'] = $this->project_model->find_withdrwl_data($wid);

		$this->load->view('admin/aprv_wthdrwl_rqst',$data);
	}
	function approve_pay()
	{
	
	  /* if(isset($_POST['it_user_id']) && $_POST['it_user_id']!="" && isset($_POST['pay_in_to_no']) && $_POST['pay_in_to_no']!="")
	   {
	      $pay_in_to_seurity=$_POST['pay_in_to_seurity'];
		  $amount=$_POST['amount'];
		  $month=$_POST['month'];
		  $year=$_POST['year'];
		  $pay_in_to_seurity=$_POST['pay_in_to_seurity'];
		  $wthid=$_POST['wthid'];
		  if($_POST['stripe']!="")
		  {
		  
		  }
		  $this->project_model->make_update("withdrawals",array("withdrawal_request_status"=>1));
	   }*/
	   $this->stripe->charge_customer("5", "4000000000000077", "test" );
	   $this->project_model->make_update("UPDATE  withdrawals set withdrawal_request_status=1 where id='".$_POST['wthid']."'");
	    $user_type = $this->session->userdata['user_data']['user_type'];

		$page = $this->uri->segment(2);

		$data = array();		
		$data['withdrawal_reqs'] = $this->project_model->find_all_withdrawal()->result();

		$this->load->view('admin/withdrawal_requests',$data);
	}
	function edit(){

		

		$this->_authenticate(); 

		$user_type = $this->session->userdata['user_data']['user_type'];

		$page = $this->uri->segment(2);

		$data = array();

		$data['page'] = $this->admin_model->get_page_content($page)->result();

		

		$this->load->view('admin/edit',$data);

		

	}

	

	function save_page(){

		

		$this->_authenticate();

		$page		= $this->input->post('page'); 

		$title 		= $this->input->post('title');

		$subtitle 	= $this->input->post('subtitle');

		$content 	= $this->input->post('content');

		

		$update_page_info = array(

			'title'		=> $title,

			'subtitle'	=> $subtitle,

			'content'	=> $content,

		);

		

		$where = array('page' => $page);

        $this->user_model->update_table($update_page_info,$where, 'pages');

		$this->session->set_flashdata('success', 'Page updated!');

		redirect('admin/'.$page);

		

	}

}