<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class User_Model extends MY_Model {



	private $database_table = 'user';



	public function __construct()

	{

		parent::__construct();

	}



	public function get_rows($filters = array(), $table = 'user')

	{

		return parent::get_rows($filters, $table);

	}



	public function get_columns($table = 'user')

	{

		return parent::get_columns($table);

	}



	public function update_table($data, $where, $table = 'user', $set='')

	{

		return parent::update_table($data, $where, $table, $set='');

	}



	public function get_count($filters = array(), $table = 'user')

	{

		return parent::get_count($filters, $table);

	}



	public function insert($data, $table = 'user')

	{

		return parent::insert($data, $table);

	}



	public function delete($where, $table = 'user')

	{

		return parent::delete($where, $table);

	}



	public function authenticate($email, $password)

	{

		$this->db->from('users');



		$this->db->where(array('email' => $email, 'password' => md5($password)));

		$row = $this->db->get()->row();



		return $row;

	}

	

	public function authenticate_mail($email)

	{

		$this->db->from('users');



		$this->db->where(array('email' => $email));

		$row = $this->db->get()->row();



		return $row;

	}

	

	public function authenticate_hash($hash)

	{

		$this->db->from('recover_password');



		$this->db->where(array('hash' => $hash,'status'=>1));

		$row = $this->db->get()->row();



		return $row;

	}

	

	public function get_username($id)

		// retrieves username for list of projects

	{

		$query = $this->db->query('SELECT id,fname, lname FROM users WHERE id = '.$id);

		return $query;		

	}

	

	public function get_userdata($id)

	// retrieves username for list of projects

	{

		$query = $this->db->query('SELECT * FROM users WHERE id = '.$id);

		return $query;		

	}
	public function get_userdata_new($id)
	{

		$query = $this->db->query('SELECT * FROM users WHERE id = '.$id);

		if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }	

	}
	public function get_card_info($ucid)

	// retrieves username for list of projects

	{

		$query = $this->db->query('SELECT * FROM credit_card_info WHERE user_id = '.$ucid);

		if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }	

	}


}

/* End of file portal_model.php */

/* Location: ./application/models/designation_model.php */

