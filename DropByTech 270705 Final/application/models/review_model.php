<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Review_Model extends MY_Model {

	private $database_table = 'reviews';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_rows($filters = array(), $table = 'reviews')
	{
		return parent::get_rows($filters, $table);
	}

	public function my_average_rating($id)
		// returns average rating for a user
	{
		// first get all my rating values
		//$ratings = get_my_ratings($id);
		// now calculate
		
		// return
	}
	
	public function get_my_ratings($id)
		// returns all ratings for user $id
	{
		$query = $this->db->query('SELECT * FROM reviews WHERE toid = '.$id);
		return $query;
	}
	
	public function post_rating($data)
	{
		$this->db->insert('ratings', $data);	
	}
	
	public function has_feedback($id)
		// returns if project $id has already been given feedback, if it returns 1 it means it has, otherwise row count is 0
		// - used on project list to disable 'give feedback' button if already have given 
	{
		$query = $this->db->query('SELECT * FROM reviews WHERE projectid = '.$id);
		$rowcount = $query->num_rows();
		return $rowcount;
	}
}
