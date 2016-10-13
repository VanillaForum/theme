<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bid_Model extends MY_Model {

	private $database_table = 'bids';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_rows($filters = array(), $table = 'bids')
	{
		return parent::get_rows($filters, $table);
	}

	public function find_bids_for_project($id)
		// find bids for project
	{
		$query = $this->db->query('SELECT * FROM bids WHERE projectid = '.$id);
		return $query;
	}
	
	public function get_awarded_bid($projectid,$contractorid)
		// find bids for project
	{
		$query = $this->db->query('SELECT * FROM bids WHERE projectid = '.$projectid . ' AND contractorid = ' . $contractorid);
		return $query;
	}

	public function total_bids_for_project($id)
		// returns number of bids for a project
	{
		$query = $this->db->query('SELECT * FROM bids WHERE projectid = '.$id . ' AND status != 3');
		$rowcount = $query->num_rows();
		return $rowcount;		
	}
	
	public function find_my_bids($id)
		// bids for contractor with id = $id
	{
		$query = $this->db->query('SELECT * FROM bids WHERE contractorid = '.$id);
		return $query;
	}
	
	public function get_bid_status($projectId,$userId){
		$query = $this->db->query('SELECT * FROM bids WHERE contractorid = '.$userId.' AND projectid = '.$projectId);
		return $query;
	}
	
	public function cancel_bid($data)
	{
		// used to award a project
		$this->db->query('UPDATE bids SET status = 3 WHERE contractorid = '.$data['user_id']. ' AND projectid = '.$data['project_id']);
	}
	
}
