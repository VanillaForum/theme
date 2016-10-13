<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Author : psofttech
 * Controller : Home
 */
class Home extends Front_Controller
{  
   // load default js for home page and call model
	public function __construct()
	{   parent::__construct();
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/home.js'), 'type' => 'text/javascript'));
        $this->load->model('user_model');
	}
    
    // load default  home page 
	public function index()
	{
        $data = array();
        $data['page'] = 'home';
        $this->template->view('home',$data);
	}
    public function save(){
        $status = array();
        $add = $this->secure_data($this->input->post('save'));
        if($this->input->post()) {
            if ($this->form_validation->run('signup_form') == FALSE) {
                $status['error'] = 'Oops, looks like there are some errors buddy';
                $status['status'] = 'failure';
			}
			else 
            {

				$insert_user_info  = array();

				$insert_fields = array('fname', 'lname', 'email', 'user_type');

				foreach($insert_fields as $field) {
					$insert_user_info[$field] = $this->secure_data($this->input->post($field));
				}
				$insert_user_info['time'] = time();
				$insert_user_info['email_varification'] = 0;
                $insert_user_info['password']   = md5($this->secure_data($this->input->post('password')));
                
				$this->user_model->insert($insert_user_info, 'users');	// Remove comment
				$insert_id        = $this->db->insert_id();
				$data['username'] = $insert_user_info['fname'].' '.$insert_user_info['lname'];
				$data['new_hash'] = md5($insert_id);
				$data['to']       = $this->secure_data($this->input->post('email'));
				$data['type']     = $type;
				$this->email_send('Register', $data);
                $status['status'] = 'success';
			}
            echo json_encode($status);
            return false;
            
		}
    }
	public function recover_password()
	{
		
		$hash = (isset($_GET['hash'])) ? $_GET['hash'] : '';
		
		$data = array();
        $data['hash'] = $hash;
        $this->template->view('recover',$data);
		
	}
	public function validate_recover(){
		
		$status = array();
		
		$hash = $this->input->post('hash');
		$authenticate = $this->user_model->authenticate_hash($hash);
		
		if($authenticate){
			
			$password = md5($this->secure_data($this->input->post('password')));
			$userId = $authenticate->userID;
			
			$updateData = array('password'=>$password);
			
			$this->db->where('id', $userId);
			$this->db->update('users', $updateData);
			
			$this->db->where('userID', $userId);
			$this->db->where('hash', $hash);
			$this->db->update('recover_password', array('status'=>0));
			
			$status['status'] = 'success';		
			echo json_encode($status);
			return false;
			
		}else{
			
			$status['error'] = 'Invalid request';
            $status['status'] = 'failure';
            echo json_encode($status);
        	return false;
			
		}
		
	}
    public function login()
	{
		$status = array();
		if ($this->input->post()) {
			$email = $this->secure_data($this->input->post('email'));
			$password = $this->secure_data($this->input->post('password'));
			
			if ($this->form_validation->run('login-form') == FALSE) {
                $status['error'] = "Please fill up all the data correctly.";
				$status['status'] = 'failure';
				echo json_encode($status);
				return false;
			}
			else {
				
				$authenticate = $this->user_model->authenticate($email, $password);
                if (($authenticate)  && ($authenticate->email_varification == 1)) {
			        $user_data    = array();
					$session_keys = array('id','fname','lname','email','user_type');

					foreach($session_keys as $session_key) {
						$user_data[$session_key] = $authenticate->$session_key;
					}
					
					$user_data['is_login']     = 1;
					$session_data['user_data'] = $user_data;

					$this->session->set_userdata($session_data);
                    $status['user_type'] = $authenticate->user_type;
					
					$status['status'] = 'success';
					
					echo json_encode($status);
					return false;
					
				}
                else if(($authenticate)  && ($authenticate->email_varification == 0)){
                    $status['error'] = 'You have to verify your email address first';
                    $status['status'] = 'failure';
                    $status['user_type'] = $authenticate->user_type;
                    echo json_encode($status);
                    return false;
                }
				else {
					$status['error'] = 'Invalid User Name or Password';
					$status['status'] = 'failure';
                    $status['user_type'] = $authenticate->user_type;
					echo json_encode($status);
					return false;
				}
			}
		}
		else {
			$status['error'] = 'Invalid email or password';
			$status['status'] = 'failure';
            $status['user_type'] = $authenticate->user_type;
			echo json_encode($status);
			return false;
		}
	}
    public function verify_email() {
           
        $id = $this->secure_data($this->input->get("id"));
        $date = strtotime(date('Y-m-d', strtotime("-7 days")));
        if (!empty($id)) {
            $user = $this->save_session($id);
            $user_data['email_varification'] = 1;
            $where = array('MD5(id)' => $id);
            $this->user_model->update_table($user_data, $where, 'users');
            $this->session->set_flashdata('success', 'Your Account has been successfully verified');  
        } 
        $this->_authenticate();
        if($user->user_type == '1'){
            redirect('client/personal_info');
        }
        else{
             redirect('user/personal_info');
        }
    }
    public function save_session($id = '') {

        $id = $this->secure_data($id);

        $query = array(
            'select' => array('*'),
            'where' => array('md5(id)' => $id),
            'row' => 1
        );

        $results = $this->user_model->get_rows($query, 'users');
        $user_data = array();
        $session_keys = array('id', 'email','fname','lname','user_type');

        foreach ($session_keys as $session_key) {
            $user_data[$session_key] = $results->$session_key;
        }
        
        $user_data['is_login'] = 1;
        $session_data['user_data'] = $user_data;
        $this->session->set_userdata($session_data);
        return $results;
    }
	public function recover()
	{
		$status = array();
		if ($this->input->post()) {
			$email = $this->secure_data($this->input->post('email'));
			
			if ($this->form_validation->run('recover-password') == FALSE) {
                $status['error'] = "Please fill up all the data correctly.";
				$status['status'] = 'failure';
				echo json_encode($status);
				return false;
			}
			else {
				
				$authenticate = $this->user_model->authenticate_mail($email);
                if (($authenticate)  && ($authenticate->email_varification == 1)) {
					
					$hashActivacion = sha1(mt_rand(10000,99999).time().$authenticate->id.$authenticate->password);
					
					$dataInsert = array(
			        	'userID' 	=> $authenticate->id,
			        	'hash'		=> $hashActivacion
					);
					
					$this->user_model->insert($dataInsert, 'recover_password');
					
					$data['username'] = $insert_user_info['fname'].' '.$insert_user_info['lname'];
					$data['new_hash'] = $hashActivacion;
					$data['to']       = $this->secure_data($this->input->post('email'));
					$this->email_send('Recover', $data);
					
					$status['status'] = 'success';
					echo json_encode($status);
					return false;
					
				}
                else if(($authenticate)  && ($authenticate->email_varification == 0)){
                    $status['error'] = 'You have to verify your email address first';
                    $status['status'] = 'failure';
                    $status['user_type'] = $authenticate->user_type;
                    echo json_encode($status);
                    return false;
                }
				else {
					$status['error'] = 'Invalid Email';
					$status['status'] = 'failure';
                    $status['user_type'] = $authenticate->user_type;
					echo json_encode($status);
					return false;
				}
			}
		}
		else {
			$status['error'] = 'Invalid Email';
			$status['status'] = 'failure';
            $status['user_type'] = $authenticate->user_type;
			echo json_encode($status);
			return false;
		}	
	}
    public function logout()
	{   
		$this->load->library('session');
		$user_id =$this->session->userdata['user_data']['id'];
		$this->session->sess_destroy();
		$this->redirect('home');
	
	}
	
	function resend_notification(){
		
		$status = array();
		if ($this->input->post('email')) {
			$email = $this->secure_data($this->input->post('email'));
			$authenticate = $this->user_model->authenticate_mail($email);
            if (($authenticate)) {
				$data['username'] = $authenticate->fname.' '.$authenticate->lname;
				$data['new_hash'] = md5($authenticate->id);
				$data['to']       = $this->secure_data($this->input->post('email'));
				$data['type']     = $type;
				$this->email_send('Register', $data);
					
				$status['status'] = 'success';
				echo json_encode($status);
				return false;
					
			}else {
				$status['error'] = 'Invalid Email';
				$status['status'] = 'failure';
                $status['user_type'] = $authenticate->user_type;
				echo json_encode($status);
				return false;
			}
		}
		else {
			$status['error'] = 'Invalid Email';
			$status['status'] = 'failure';
            $status['user_type'] = $authenticate->user_type;
			echo json_encode($status);
			return false;
		}
		
	}
}