<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!$this->input->is_ajax_request() AND ENVIRONMENT == 'development' AND $this->router->fetch_method() != 'upload')
			$this->output->enable_profiler(FALSE);
	}

	public function _dropdown($rows, $params = array(), $default = NULL)
	{
		$options = array();

		if (count($rows) > 0)
		{
			if (count($params) == 0)
				$params = array('key' => 'id', 'value' => 'name', 'default' => '- Select -');
			
			if (empty($default))
				$options[''] = $params['default'];

			foreach ($rows as $row)
				$options[$row->$params['key']] = $row->$params['value'];			
		}

		return $options;
	}

	//Data table query
	public function _get_data_table($get, $columns)
	{
		//Paging                
		if ($get['iDisplayLength'] != '-1')
			$query['limit'] = array('limit' => $get['iDisplayLength'], 'from' => $get['iDisplayStart']);

		//Ordering
		if ($this->input->get('iSortCol_0'))
		{            
			for ($i=0 ; $i<intval($get['iSortingCols']); $i++)
			{
				if($get['bSortable_'.intval($get['iSortCol_'.$i])] == 'true')
				{                    
					$sort  = $columns[intval($get['iSortCol_'.$i])];
					$order = $get['sSortDir_'.$i];
					$query['orderby'] = array('field' => $sort, 'order' => $order);
				}
			}
		}

		// Filtering
		if($this->input->get('sSearch') != '')
		{   
			$where = "";

			for ($i=0; $i<count($columns); $i++)
			{
				if($get['bSearchable_'.$i] == 'true')
					$where .= $columns[$i]." LIKE '%".mysql_real_escape_string($get['sSearch'])."%' OR ";
			}

			$where = substr_replace($where, "", -3);
			$query['where'] = $where;
		}

		return $query;		
	}

	public function _encryption($string)
	{ 
		return md5($string.$this->config->item('encryption_key'));
	}
	
	public function redirect($path = '', $end = '')
	{ 
		switch($end)
		{
			case 'backend':
				redirect(backend_url().$path);
				break;

			default:
				redirect(base_url($path));
				break;
		}
	}
	
	public function _pre($data)
	{
		echo '<pre>';
			print_r($data);
		echo '</pre>';
	}

	public function secure_data($data)
	{
		return $this->security->xss_clean(trim($data));
	}

	public function _sendResponse($output, $status = '')
	{
		$this->output->enable_profiler(FALSE);
		if($status)
			$response = array( 'status' => $status, 'output' => $output);
		else
			$response = $output;
		$data['jsondata'] = json_encode($response);
		$this->load->view('json', $data);
	}

	public function check_ajax_request()
	{
		if(!$this->input->is_ajax_request()) {
			redirect(base_url());
			exit;
		}
	}
	
	public function admin_cookie($unm='' , $pwd='')
	{
		$check_set_cookie = $this->input->cookie('portal-remember-me',TRUE);
	
		$admin = array();
		if($check_set_cookie) :
			$data = json_decode($check_set_cookie);
			$admin = array('auth_username' => $data->username, 'auth_password' => base64_decode($data->token));		
		endif;		

		return $admin;
	}
    
    public function email_check()
	{
        $this->load->model('user_model');
        $user_id = (isset($this->session->userdata['user_data']['id'])) ? $this->session->userdata['user_data']['id'] : '';
        $email = $this->security->xss_clean(trim($this->input->get("email")));
        $where;
        if(empty($user_id))
            $where = 'email ="'.$email.'"';
        else
            $where = 'email ="'.$email.'" AND id !="'.$user_id.'"';
		$check_email_count = $this->user_model->get_count(array('where' => $where), 'users');
        
		if ($check_email_count >= 1) :
			$valid = "false";
		else :
			$valid = "true";
		endif;
		
		echo $valid;
		exit;
	}
    
    public function email_send($case, $data)
	{
		$this->load->library ( 'email' );
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $this->email->initialize($config);
//		$this->email->initialize(array('mailtype' => 'html'));
		$this->email->to ( $data['to'] );
		//$this->email->to ( 'pspsofttech@gmail.com' );
		$file = '';
		
		$return = array();
		switch($case)
		{
			case 'Register' :
				$this->email->from ( 'email-validation@DropByTech.com' );
				$subject = 'Drop By Tech Email Validation';
//				$this->email->cc($data['cc']);

				$return['btn_redirect'] = base_url().'home/verify_email?id='.$data['new_hash'];
				$return['form_data'] = $data;
				//$confirmation['full_user_role'] = $data['full_user_role'];
				$view = 'email/register';
			break;
			
			case 'DisputeAdmin' :
				$this->email->from ( 'email-validation@DropByTech.com' );
				$subject = 'A new dispute has begun from user '.$data['username'];

				$return = $data;
				$view	= 'email/dispute-admin';
			break;
			
			case 'DisputeCliente' :
				$this->email->from ( 'email-validation@DropByTech.com' );
				$subject = 'The Drop By Tech team';

				$return = $data;
				$view	= 'email/dispute-cliente';
			break;
			
			case 'Recover' :
				$this->email->from ( 'email-validation@DropByTech.com' );
				$subject = 'Drop By Tech Recover password';

				$return['btn_redirect'] = base_url().'home/recover_password?hash='.$data['new_hash'];
				$return['form_data'] = $data;
				//$confirmation['full_user_role'] = $data['full_user_role'];
				$view = 'email/recover';
			break;
			
			case 'forgot-password' :
				$this->email->from( 'email-validation@classatlas.com' );
				$subject = 'Class Atlas Forgot Password Email';

				$return['btn_redirect'] = base_url().'profile/forgot_password?id='.$data['new_hash'];
				$return['form_data'] = $data;
				//$confirmation['full_user_role'] = $data['full_user_role'];
				$view = 'email/forgot';
			break;

        }
		$this->email->subject ( $subject );
		$body = $this->load->view($view, $return, true);
		$this->email->message ($body);
		if(!empty($file)) {
			$this->email->attach($file);
		}
		$this->email->send();
	}
    
}
class Backend_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->_admin_template();
		$this->_admin_assets();
	}

	public function _admin_template()
	{
		$this->load->library('template', $this->config->item('backend_path').'template');
		$this->template->set_template($this->config->item('backend_path').'template');
	}

	public function _admin_assets()
	{
		$this->load->library('dynamic_load');

		$css_files = array(asset_url('css', 'bootstrap.min.css'), asset_url('css', 'bootstrap-responsive.min.css'), asset_url('css', 'admin.css'));

		foreach ($css_files as $css_file)		
			$this->dynamic_load->add_css(array('href'  => $css_file, 'rel'  => 'stylesheet', 'type' => 'text/css'));

		$js_files = array((ENVIRONMENT == 'production')?'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js':asset_url('js','core/jquery.js'),
							(ENVIRONMENT == 'production')?'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.24/jquery-ui.min.js':asset_url('js','core/jquery-ui.js'),
							asset_url('js','core/bootstrap.min.js'),
							asset_url('js','core/jquery.tmpl.min.js'),
							asset_url('js','app.js'));

		foreach ($js_files as $js_file)
			$this->dynamic_load->add_js('footer', array('src'  => $js_file, 'type' => 'text/javascript'));
	}

//	public function _admin_authenticate()
//	{
//		$this->load->library('session');
//		if ((!isset($this->session->userdata['user_data']['is_login']) OR !isset($this->session->userdata['user_data']['id'])))
//			$this->redirect('login');
//	}

}

class Front_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->_front_template();
		$this->_front_assets();
	}
    
    public function _front_template()
    {
		$this->load->library('template', $this->config->item('backend_path').'template');
		$this->template->set_template($this->config->item('backend_path').'template');
    }

	public function _front_assets()
	{
		$this->load->library('dynamic_load');

		$css_files = array( 
                        asset_url('css', 'framework.css'),
                        asset_url('css', 'style.css'),
              		);

		foreach ($css_files as $css_file)		
			$this->dynamic_load->add_css(array('href'  => $css_file, 'rel'  => 'stylesheet', 'type' => 'text/css'));

		$js_files = array(
                            asset_url('js','vendor/jquery.min.js'),
                            asset_url('js','vendor/jquery-ui.js'),				
                            asset_url('js','vendor/bootstrap.js'),
							asset_url('js','vendor/bootstrap-multiselect.js'),
							asset_url('js','vendor/owl.carousel.js'),
							asset_url('js','vendor/jquery.placeholder.js'),
                            asset_url('js','vendor/jquery.validate.js'),
                            asset_url('js','vendor/additional-methods.min.js'),
							asset_url('js','app/custom.js'),
                            asset_url('js','app/app.js'));

		foreach ($js_files as $js_file)
			$this->dynamic_load->add_js('footer', array('src'  => $js_file, 'type' => 'text/javascript'));
	}

	public function _authenticate()
	{
		$this->load->library('session');
		if ((!isset($this->session->userdata['user_data']['is_login']) OR !isset($this->session->userdata['user_data']['id'])))
			$this->redirect('home');
	}

}


/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */