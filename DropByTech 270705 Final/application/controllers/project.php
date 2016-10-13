<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Controller : Project

 *

 */



/*



PROJECT STATUS FIELD 



 0 = Not Visible

 1 = Published / Open (this is where it gets when a client inserts a project)

 2 = Deleted (not shown anywhere after marked like this)

 3 = Closed (project done or closed for other reason, not shown in list)



*/



class Project extends Front_Controller

{

	public function __construct()

	{   parent::__construct();

        /* for users except contractors, redirect to home

		if($this->session->userdata['user_data']['user_type'] != 2)

            redirect ('home');

		*/

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/jquery.uploadifive.min.js'), 'type' => 'text/javascript'));

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/bootstrap-tagsinput.js'), 'type' => 'text/javascript'));

        $this->dynamic_load->add_js('footer', array('src' => asset_url('js','app/user.js'), 'type' => 'text/javascript'));

        

        $this->load->model('user_model');

		$this->load->model('messages_model');

		$this->load->model('project_model');

		$this->load->model('bid_model');

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

	

	public function test()

	{

		echo "test";

		

	}

	public function find()

	{



		$this->dynamic_load->add_css('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');

		$this->dynamic_load->add_css(asset_url('css','star-rating.css'));

		$this->dynamic_load->add_js('footer', array('src' => asset_url('js','vendor/star-rating.js'), 'type' => 'text/javascript'));

		

		// TODO: review find projects for each user type, check there are no bugs on different searches	

		//ini_set('error_reporting', E_ALL);

		// main function to search projects	

		$title = $_GET['title'];

		$owner = $_GET['owner'];
		$msg = $_GET['r'];

		$data = array();

        $this->_authenticate();



        $user_type = $this->session->userdata['user_data']['user_type'];

		$user_id = $this->session->userdata['user_data']['id'];

		

		if ($user_type == 1) { $data['page'] = 'client'; }

		if ($user_type == 2) { $data['page'] = 'user'; }

		//if ($user_type == 3) { $data['page'] = 'admin'; }

	

		if ($owner == 'me' ) {

			if($data['page'] == 'client'){

				$data['projects'] 			= $this->project_model->find_by_user($user_id)->result();

				$data['archivedProjects'] 	= $this->project_model->get_archived_by_user($user_id)->result();

			}elseif($data['page'] == 'user'){

				$data['projects'] 			= $this->project_model->find_by_bider($user_id)->result();

				$data['archivedProjects'] 	= $this->project_model->get_archived_by_bider($user_id)->result();

			}

			$title = '';

			

		} else {

			if ($title == ''){

				if ($user_type == 2) { 

					//$data['projects'] = $this->project_model->find_all()->result();

					$user_data = $this->user_model->get_userdata($user_id)->result();

					$dist = 75753761521243614368;//40.233599999999996;

					$data['projects'] = $this->project_model->find_closest($user_data[0]->lat,$user_data[0]->lng,$dist,$user_id)->result();

				} else { // have to be a contractor

				

				}

			} else {

				$data['projects'] = $this->project_model->find_by_title($title)->result();

			}

		}

	

		foreach ($data['projects'] as $project){

			$data['bidsCount'][$project->id] = $this->bid_model->total_bids_for_project($project->id);

			$data['clientname'][$project->id] = $this->user_model->get_username($project->clientid)->result();

		}

		

		$user_query = array(

            'select' => array('users.*'),

            'where' => array('users.id' => $user_id),

            'row' => 1

        );

       $data['user'] = $this->user_model->get_rows($user_query, 'users');

		

		$data['user_type'] = $user_type;

		$data['owner'] = $owner;

		

        $this->template->view('project/find',$data);

		

	}

	

	public function archived()

	{

		// main function to search archived projects

		$data = array();

        $data['page'] = 'user';

		if ($title == '') {

			$data['projects'] = $this->project_model->find_all_archived()->result();

		} else {

			$data['projects'] = $this->project_model->find_by_title_archived($title)->result();

		}

		foreach ($data['projects'] as $project){

			$data['bids'][$project->id] = $this->bid_model->total_bids_for_project($project->id);

			$data['clientname'][$project->id] = $this->user_model->get_username($project->id)->result();

		}	

		//var_dump ($data);

        $this->template->view('project/find',$data);		

	}

	

	public function apply()

	{

		// apply to project with id $id

		$data = array();

		$data['projectid'] = $_POST['projectid'];

		$data['contractorid'] = $this->session->userdata['user_data']['id'];

		$data['budget'] = $_POST['budget'];

		$data['deliverydate'] = $_POST['deliverydate'];

		$data['coverletter'] = $_POST['coverletter'];

		//var_dump($data);

		$apply = $this->project_model->my_apply($data);

		redirect(base_url().'project/find?owner=me');

	}

	
	

	public function postproject()

	{

		ini_set('display_errors', 'On');

		error_reporting(E_ALL);

		$status = array();

		$user_id = $this->session->userdata['user_data']['id'];

		if(!empty($user_id)) {

			

			$insert_project  = array();

			$update_fields = array('clientid', 'startdate', 'deliverydate', 'budget','title','description');

			

			foreach($update_fields as $field) {

				$insert_project[$field] = $_POST[$field];

			}

			if(!empty($_POST['details'])){

				$insert_project['details'] = $_POST['details'];

			}

			

			if($_POST['addressSet'] == 'defaultDir'){

				

				$user_data = $this->user_model->get_userdata($user_id)->result();

				if(!empty($user_data[0]->googleCoords)){

					

						$insert_project['newstreet']	= $user_data[0]->address;

						$insert_project['newcity'] 	= $user_data[0]->city;

						$insert_project['newzip'] 	= $user_data[0]->zipcode;

						

						$insert_project['googleCoords']	= $user_data[0]->googleCoords;

						$insert_project['lat'] 			= $user_data[0]->lat;

						$insert_project['lng'] 			= $user_data[0]->lng;

					

				}else{

					

					$status['error'] = 'You need to enter your address in the profile first';

					$status['status'] = 'failure';

					echo json_encode($status);

					exit;

					

				}

				

			}else{

				

				$insert_project['newstreet']	= $_POST['newstreet'];

				$insert_project['newcity'] 	= $_POST['newcity'];

				$insert_project['newzip'] 	= $_POST['newzip'];

				

				$googleMpas = str_replace(array( '(', ')' ), '',$_POST['googleCoords']);

				$latlongData = explode(',',$googleMpas);

				$insert_project['googleCoords'] = $googleMpas;

				

				$insert_project['lat'] = deg2rad($latlongData[0]);

				$insert_project['lng'] = deg2rad($latlongData[1]);

				

			}

			

			$upload_file = false;

			

			if( isset($_FILES["proyectName"]["name"]) && !empty($_FILES["proyectName"]["name"]) ){

			

				$allow	 	=  array('pdf','doc','docx','xml','xmlx','jpg','ppt');

				$fileName	= $_FILES["proyectName"]['name'];

					

				$ext = pathinfo($fileName, PATHINFO_EXTENSION);			

		

				if(in_array($ext,$allow) ) {

					

					$upload_file = true;

						

				}else{

						

					$status['error'] = 'Invalid format file';

					$status['status'] = 'failure';

					echo json_encode($status);

					exit;

						

				}

				

			}



		}

		

		$insert_project['status'] = 1;

		$this->db->insert('projects', $insert_project);

		$proyect_id = $this->db->insert_id();

		

		if($upload_file){

			

			move_uploaded_file($_FILES["proyectName"]['tmp_name'],DIRPROYECTFILES.$fileName);

			$data = array(

				'proyect_id'	=> $proyect_id,

				'name'			=> $fileName

			);

			$this->db->insert('project_files', $data);

			

		}

		

		$status['status'] = 'success';

		echo json_encode($status);

        exit;

	}

	

	public function editproject()

	{

		// edit project

		// NOTE: only used by admin, user cannot change projects once posted

		$this->load->view('project/edit');

	}

	

	public function deleteproject()

	{

		// marks a project as deleted

	}

	

	public function showbid($id)

	{

		//ini_set('error_reporting', E_ALL);

		// show bids for project $id



		$data = array();

        $this->_authenticate();

        $user_type = $this->session->userdata['user_data']['user_type'];

		$user_id = $this->session->userdata['user_data']['id'];



		if ($user_type == 1) { $data['page'] = 'client'; }

		if ($user_type == 2) { $data['page'] = 'user'; }

		//if ($user_type == 3) { $data['page'] = 'admin'; }

		

		//$data['projectid'] = $id;

		

		$data['bids'] = $this->bid_model->find_bids_for_project($id)->result();	// get all bids for project $id

				

		$data['user_type'] = $user_type;

		

		foreach ($data['bids'] as $bid){

			$data['contractorname'][$bid->id] = $this->user_model->get_username($bid->contractorid)->result();

		}

		

		//var_dump ($data);		

        $this->template->view('bid/show',$data);

	}

	

	public function award()

	{

		//award the project

		$data = array();



        $this->_authenticate();

        $user_type = $this->session->userdata['user_data']['user_type'];

		$user_id = $this->session->userdata['user_data']['id'];



		if ($user_type == 1) { $data['page'] = 'client'; }

		if ($user_type == 2) { $data['page'] = 'user'; }

		//if ($user_type == 3) { $data['page'] = 'admin'; }

		

		$data['projectid'] = $_POST['projectid'];

		$data['user_id'] = $_POST['userid'];

		//var_dump($data);

		$award = $this->project_model->award_project($data);

		redirect(base_url().'project/dopayment');

	}

	

	public function done()

	{

		//mark job as complete

		$data = array();



    	$this->_authenticate();

    	$user_type = $this->session->userdata['user_data']['user_type'];

		$user_id = $this->session->userdata['user_data']['id'];



		if ($user_type == 1) { $data['page'] = 'client'; }

		if ($user_type == 2) { $data['page'] = 'user'; }

	

		$data['projectid'] = $_POST['projectid'];

		$data['user_id'] = $this->session->userdata['user_data']['id'];

		//var_dump($data);

		$done = $this->project_model->project_done($data);

		redirect(base_url().'project/find?owner=me');

	}



    public function dopayment()

    {

        $title = $_GET['title'];

        $owner = $_GET['owner'];

        $data = array();

        $this->_authenticate();



        $user_type = $this->session->userdata['user_data']['user_type'];

        $user_id = $this->session->userdata['user_data']['id'];



        if ($user_type == 1) { $data['page'] = 'client'; }

        if ($user_type == 2) { $data['page'] = 'user'; }

        //if ($user_type == 3) { $data['page'] = 'admin'; }

		$user_query = array(

            'select' => array('users.*'),

            'where' => array('users.id' => $user_id),

            'row' => 1

        );

		$data['user'] = $this->user_model->get_rows($user_query, 'users');

        $this->template->view('project/payment',$data);

    }

	

	public function save_message(){

		

		if(!$this->input->post('message')){

			

			$status['error'] = 'Please enter a message.';

			$status['status'] = 'failure';

			

		}else{

		

			$insert_message['message']		= $this->secure_data($this->input->post('message'));

			$insert_message['projectId'] 	= $this->secure_data($this->input->post('project_id'));

			$insert_message['userId'] 		= $this->secure_data($this->input->post('c_user'));

			$this->db->insert('project_messages', $insert_message);

			

			$status['status'] = 'success';

			$status['data'] = '<a class="list-group-item">

								<span class="username"> You <span class="time">' . date("Y-m-d G:i:s") . '</span> </span>

								<p>' . $insert_message['message'] . '</p>

							</a>';

		

		}

        

        echo json_encode($status);

        return false;

		

	}

	

	public function review(){

		var_dump($_POST);

	}

	

	function finish(){



		//award the project

		$data = array();

        $this->_authenticate();

		

		$projectid = $_POST['finishid'];

		$this->db->where('id', $projectid);

		$this->db->update('projects', array('status'=>3));

		redirect(base_url().'project/find?owner=me');

	

	}


/* ADDED BY PADAM JAIN */

public function apply_withdrawal()

	{

		//award the project

		$data = array();



        $this->_authenticate();

        $user_type = $this->session->userdata['user_data']['user_type'];

		$user_id = $this->session->userdata['user_data']['id'];



		if ($user_type == 1) { $data['page'] = 'client'; }

		if ($user_type == 2) { $data['page'] = 'user'; }

		//if ($user_type == 3) { $data['page'] = 'admin'; }

		

		$data['projectid'] = $_POST['projectid'];
		$data['budget'] = $_POST['budget'];
		$data['user_id'] = $_POST['userid'];

		//var_dump($data);

		$award = $this->project_model->applying_withdrawal($data);
		$data['message']="Request Successfully Sent!";
		redirect(base_url().'project/find?owner=me&r=s');
		//$this->template->view('project/find?owner=me',$data);
	}
/* END ADDED BY PADAM JAIN */
	

}