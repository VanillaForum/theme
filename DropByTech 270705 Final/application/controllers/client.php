<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller : Client
 *
 */

class Client extends Front_Controller
{
	public function __construct()
	{   
        parent::__construct();
         if($this->session->userdata['user_data']['user_type'] != 1)
            redirect ('home');
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/client.js'), 'type' => 'text/javascript'));
        $this->load->model('user_model');
		$this->load->model('project_model');
		$this->load->model('messages_model');
		$this->load->model('review_model');
        
	}
	public function index()
	{
       $data = array();
       $data['page'] = 'client';
       $this->template->view('home',$data);
	}
    public function personal_info() {
		ini_set('error_reporting', E_ALL);
       $this->_authenticate();
       $data = array();
       $data['page'] = 'client';
       $user_id =$this->session->userdata['user_data']['id'];
       $user_query = array(
            'select' => array('users.*'),
            'where' => array('users.id' => $user_id),
            'row' => 1
        );
       $data['user'] = $this->user_model->get_rows($user_query, 'users');
	   $data['reviews'] = $this->review_model->get_my_ratings($user_id)->result();
       $this->template->view('client/personal_info',$data);
    }
    public function my_project() {
       $data = array();
       $data['page'] = 'client';
       $this->template->view('client/my_project',$data);
    }
	
    public function  save_persopnal_info(){
        $this->_authenticate();
        $status = array();
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)) {
            if ($this->form_validation->run('cpi-form') == FALSE) {
                $status['error'] = 'Oops, looks like there are some errors buddy';
                $status['status'] = 'failure';
			}
			else 
            {

				$update_user_info  = array();
				$update_fields = array('fname', 'lname', 'email', 'phone','businees_name','business_url','address','zipcode','city','about_business');
				foreach($update_fields as $field) {
					$update_user_info[$field] = $this->secure_data($this->input->post($field));
				}
				//Google Maps Data
				$googleMpas = str_replace(array( '(', ')' ), '',$this->input->post('googleCoords'));
				$latlongData = explode(',',$googleMpas);
				$update_user_info['googleCoords'] = $googleMpas;
				$update_user_info['lat'] = deg2rad($latlongData[0]);
				$update_user_info['lng'] = deg2rad($latlongData[1]);
				
				$where = array('id' => $user_id);
                $this->user_model->update_table($update_user_info,$where, 'users');
                $this->session->set_flashdata('success', 'Your Account has been Updated created!');
                $status['status'] = 'success';
			}
            echo json_encode($status);
            return false;
		}
    }
    public function save_preference_info(){
        $this->_authenticate();
        $status = array();
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)) {
            $update_user_info  = array();
            $new_password = $this->input->post('newpassword');
            $repeat_password = $this->input->post('repeatpassword');
            if($new_password != $repeat_password){
                $status['status'] = 'failure';
                $status['error'] = 'Both Password must be Same !';
            }
            else
            {
                $update_user_info['receive_notification'] = $this->input->post('receive_notification');
				if($this->input->post('password') != "9bd0fd8bbbabcf6a8d400389b1d9c510")
					$update_user_info['password'] = md5($this->input->post('newpassword'));
                $where = array('id' => $user_id);
                $this->user_model->update_table($update_user_info,$where, 'users');
                $this->session->set_flashdata('success', 'Your Account has been updated!');
                $status['status'] = 'success';
            }
        }
        echo json_encode($status);
        return false;
    }
    public function check_password(){
        $user_id = (isset($this->session->userdata['user_data']['id'])) ? $this->session->userdata['user_data']['id'] : '';
        $password = $this->security->xss_clean(trim($this->input->get("password")));
        $where;
        if(empty($user_id))
            $where = 'password ="'.md5 ($password).'"';
        else
            $where = 'password ="'.md5 ($password).'" AND id ="'.$user_id.'"';
		    $check_email_count = $this->user_model->get_count(array('where' => $where), 'users');
        if ($check_email_count >= 1 || $password == "9bd0fd8bbbabcf6a8d400389b1d9c510") :
			$valid = "true";
		else :
			$valid = "false";
		endif;
		
		echo $valid;
		exit;
    }
    public function save_credit_card(){
        $status = array();
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)) {
            if ($this->form_validation->run('creditcard-form') == FALSE) {
                $status['error'] = 'Oops, looks like there are some errors buddy';
                $status['status'] = 'failure';
			}
			else 
            {
				$insert_credit_card_info  = array();

				$insert_fields = array('card_name', 'card_no', 'security_code', 'card_month','card_year','user_id');

				foreach($insert_fields as $field) {
					$insert_credit_card_info[$field] = $this->secure_data($this->input->post($field));
				}
			    
				$this->user_model->insert($insert_credit_card_info, 'credit_card_info');	// Remove comment
				$insert_id = $this->db->insert_id();
				$status['status'] = 'success';
                $status['cc_no'] = substr($this->input->post('card_no'), -4);
                $status['id'] = $insert_id;
			}
            echo json_encode($status);
            return false;
        }
    }
    public function save_new_project(){
        $status = array();
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)) {
            if ($this->form_validation->run('client-post-project-form') == FALSE) {
                $status['error'] = 'Oops, looks like there are some errors buddy';
                $status['status'] = 'failure';
			}
			else 
            {
				$insert_credit_card_info  = array();

				$insert_fields = array('card_name', 'card_no', 'security_code', 'card_month','card_year','user_id');

				foreach($insert_fields as $field) {
					$insert_credit_card_info[$field] = $this->secure_data($this->input->post($field));
				}
			    
				$this->user_model->insert($insert_credit_card_info, 'credit_card_info');
				$insert_id = $this->db->insert_id();
				$status['status'] = 'success';
                $status['cc_no'] = substr($this->input->post('card_no'), -4);
                $status['id'] = $insert_id;
			}
            echo json_encode($status);
            return false;
        }
    } 
    public function ajax(){
        $method  = $this->secure_data($this->input->post('method'));
        $user_id = $this->secure_data($this->session->userdata['user_data']['id']);
        if($method == 'delete-cc'){
            $cc_id = $this->input->post('id');
            $where = array('credit_card_info.id' => $cc_id);
			$this->user_model->delete($where, 'credit_card_info');
            
            $return['status'] = 'success';
        }
        echo json_encode($return);
    }
    
	public function photoupload(){
		// upload profile photo
		//ini_set('error_reporting', E_ALL);
		
		$config['upload_path'] = __DIR__.'/../../assets/images/userphoto/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size'] = '1024';
		//$config['max_width'] = '1024';
		//$config['max_height'] = '768';
		
		$this->load->library('upload', $config);
		$upload = $this->upload->do_upload('myfile');
		if($upload){
			
			$data		= $this->upload->data();
			$user_id 	= $this->session->userdata['user_data']['id'];
			$this->db->where('id', $user_id);
			$this->db->update('users', array('avatar'=>$data['file_name']));
			redirect(base_url().'client/personal_info');
				
		}else{
			echo $this->upload->display_errors();	
		}
		die();
	}
	
	public function messages(){
		
		$user_id =$this->session->userdata['user_data']['id'];
		$user_query = array(
            'select' => array('users.*'),
            'where' => array('users.id' => $user_id),
            'row' => 1
        );
		$data = array();
		$data['user'] = $this->user_model->get_rows($user_query, 'users');
		$data['messages'] = $this->messages_model->get_client_messages($user_id)->result();
        $this->template->view('client/message',$data);
		
	}
	
	public function disable(){
		
		
		
	}
	
}