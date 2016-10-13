<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Controller : User
 *
 */
class User extends Front_Controller
{
	public function __construct()
	{   parent::__construct();
		if($this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'dispute')
			'';
        elseif($this->session->userdata['user_data']['user_type'] != 2)
           redirect ('home');
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/jquery.uploadifive.min.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/bootstrap-tagsinput.js'), 'type' => 'text/javascript'));
        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/user.js'), 'type' => 'text/javascript'));
        $this->load->model('user_model');
		$this->load->model('project_model');
		$this->load->model('messages_model');
    }
	public function index()
	{
       $this->_authenticate(); 
       $user_type = $this->session->userdata['user_data']['user_type'];
       $data = array();
       $data['page'] = 'user';
       $this->template->view('home',$data);
	}
    public function personal_info() {
       $this->_authenticate(); 
       $data = array();
       $data['page'] = 'user';
       $user_id =$this->session->userdata['user_data']['id'];
       $user_query = array(
            'select' => array('users.*'),
            'where' => array('users.id' => $user_id),
            'row' => 1
        );
       $data['user'] = $this->user_model->get_rows($user_query, 'users');
       $this->template->view('user/personal_info',$data);
    }
    public function my_project() {
       $data = array();
       $data['page'] = 'user';
       $this->template->view('user/my_project',$data);
    }
    
    public function  save_persopnal_info(){
        $this->_authenticate();
        $status = array();
        $user_id = $this->input->post('user_id');
        if(!empty($user_id)) {
            if ($this->form_validation->run('upi-form') == FALSE) {
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
	public function dispute(){
		$this->_authenticate();
        $status = array();
        $message = $this->input->post('message');
        if(!empty($message)) {
            $data['username']	= $this->session->userdata['user_data']['fname'].' '.$this->session->userdata['user_data']['lname'];
			$data['useremail']	= $this->session->userdata['user_data']['email'];
			$data['message'] 	= $message;
			$data['to']			= "benjamin_carrera@live.com.mx";
			$this->email_send('DisputeAdmin', $data);
			
			$dataTwo['username']	= $this->session->userdata['user_data']['fname'].' '.$this->session->userdata['user_data']['lname'];
			$dataTwo['to']			= $this->session->userdata['user_data']['email'];
			$this->email_send('DisputeCliente', $dataTwo);
			
            $status['status'] = 'success';
        }else{
			$status['status'] = 'failure';
		}
        echo json_encode($status);
        exit;
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
    public function save_certificate(){
        $this->_authenticate();
        $status = array();
        $user_id = $this->input->post('c_user');
        if(!empty($user_id)) {
            if ($this->form_validation->run('c-form') == FALSE) {
                $status['error'] = 'Oops, looks like there are some errors buddy';
                $status['status'] = 'failure';
			}
			else 
            {
                $file    = FCPATH. $this->config->item('asset_url').'certificate/temp/'.$this->input->post('upload_file_name');
                $newfile = FCPATH. $this->config->item('asset_url').'certificate/'.$this->input->post('upload_file_name');;
                
                if(copy($file, $newfile)) {
                    unlink($file);
                }
                $insert_certificate_info  = array();
				$insert_fields = array('c_name', 'c_authority', 'c_licence_no', 'c_url','c_expire','c_sdate','c_edate','c_user','c_user');
				foreach($insert_fields as $field) {
					$insert_certificate_info[$field] = $this->secure_data($this->input->post($field));
				}
                $insert_certificate_info['c_document'] = $this->input->post('upload_file_name');
                $this->user_model->insert($insert_certificate_info, 'certificate_info');	
				$insert_id        = $this->db->insert_id();
				$status['status'] = 'success';
                $status['cid'] = $insert_id;
                $status['file_name'] = $this->input->post('upload_file_name');
			}
            echo json_encode($status);
            return false;
        }
    }
    public function upload()
    {
        $this->output->enable_profiler(FALSE);
        if($this->input->post('ajax'))
        {
            $ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
          
            $config['upload_path'] = FCPATH."assets/certificate/temp";
            $config['allowed_types'] = 'jpg|gif|jpeg|png|pdf';
            $config['overwrite'] = TRUE;
            $config['max_size'] = '10485760';
            $config['file_name'] = $this->secure_data( time() .'_'. rand(). '.' .$ext );

            $this->load->library('upload', $config);
            
            if($_FILES['Filedata']['size'] > 10485760) {
                    $data['status'] = 'failure'; 
                    $data['message'] = 'The file you are attempting to upload is larger than the permitted size.';
            }
            
            elseif (!$this->upload->do_upload('Filedata'))
            {
                $data['status'] = 'failure'; 
                $data['message'] = $this->upload->display_errors('','');
            }
            else
            {
                $data['status'] = 'success'; 
                $data['upload_data'] = $this->upload->data();
                $data['file_path'] = base_url().'assets/certificate/temp/'.$config['file_name'];
                $data['upload_file_name'] = $config['file_name'];
                $data['original_file_name'] = $_FILES['Filedata']['name'];
                
            }
            echo json_encode($data);
        }
    }
    public function uploadphoto()
    {
        $this->output->enable_profiler(FALSE);
        if($this->input->post('ajax'))
        {
            $ext = pathinfo($_FILES['Filedata']['name'], PATHINFO_EXTENSION);
          
            $config['upload_path'] = FCPATH."assets/images/userphoto/temp";
            $config['allowed_types'] = 'jpg|png';
            $config['overwrite'] = TRUE;
            $config['max_size'] = '10485760';
            $config['file_name'] = $this->secure_data( time() .'_'. rand(). '.' .$ext );

            $this->load->library('upload', $config);
            
            if($_FILES['Filedata']['size'] > 10485760) {
                    $data['status'] = 'failure'; 
                    $data['message'] = 'The file you are attempting to upload is larger than the permitted size.';
            }
            
            elseif (!$this->upload->do_upload('Filedata'))
            {
                $data['status'] = 'failure'; 
                $data['message'] = $this->upload->display_errors('','');
            }
            else
            {
                $data['status'] = 'success'; 
                $data['upload_data'] = $this->upload->data();
                $data['file_path'] = base_url().'assets/images/userphoto/temp/'.$config['file_name'];
                $data['upload_file_name'] = $config['file_name'];
                $data['original_file_name'] = $_FILES['Filedata']['name'];
                
            }
            echo json_encode($data);
        }
    }
    public function ajax(){
        $method  = $this->secure_data($this->input->post('method'));
        $user_id = $this->secure_data($this->session->userdata['user_data']['id']);
        if($method == 'delete-certificate'){
            $c_id = $this->input->post('id');
            $where = array('certificate_info.id' => $c_id);
			$this->user_model->delete($where, 'certificate_info');
            $return['status'] = 'success';
        }
        else if($method =='add_skill'){
            $data  = array();
            $skills = explode(',',$this->secure_data($this->input->post('skill')));
            foreach($skills as $skill)
            {
                $data['skill'] =   $skill;    
                $data['user_id'] = $user_id;
                $this->user_model->insert($data,'skill');
            }
            $html = $this->load->view('user/getskill','', TRUE);
            $return['html'] = $html;
            $return['status'] = 'success';
        }
        else if($method == 'remove_skill'){
            $skill_id = $this->input->post('id');
            $where = array('skill.id' => $skill_id);
			$this->user_model->delete($where, 'skill');
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
			redirect(base_url().'user/personal_info');
				
		}else{
			echo $this->upload->display_errors();	
		}
		die();
	}
	
	public function profile($userId){
		
		$data = array();
		$data['page'] = 'user';
		$user_id = $userId;
		$user_query = array(
            'select' => array('users.*'),
            'where' => array('users.id' => $user_id),
            'row' => 1
        );
		$data['user'] = $this->user_model->get_rows($user_query, 'users');
		$this->template->view('user/profile',$data);
		
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
		$data['messages'] = $this->messages_model->get_user_messages($user_id)->result();
        $this->template->view('user/message',$data);
		
	}
	
	public function disable(){
		
		
		
	}
	
}
?>