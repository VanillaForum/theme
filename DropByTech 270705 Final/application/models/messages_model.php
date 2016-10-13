<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*

PROJECT STATUS FIELD 

 0 = Not Visible
 1 = Published / Open (this is where it gets when a client inserts a project)
 2 = Deleted (not shown anywhere after marked like this)
 3 = Project Done / Closed (project done or closed for other reason)
 4 = Archived (user archived project after is closed)
 5 = Working (can be closed/cancelled)

*/

class Messages_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_user_messages($user_id)
		// find projects by title
	{
		$query = $this->db->query("SELECT pm.id,pm.message,pm.projectId,pm.userId,pm.message_date,pm.`status` ,p.title 
			FROM project_messages pm
			LEFT JOIN projects p ON p.id=pm.projectId
			LEFT JOIN bids b ON b.projectid=p.id
			WHERE b.contractorid=" . $user_id . " AND pm.userId!=" . $user_id . " ORDER BY pm.message_date DESC");
		return $query;
	}
	
	public function get_client_messages($user_id)
		// find projects by title
	{
		$query = $this->db->query("SELECT pm.id,pm.message,pm.projectId,pm.userId,pm.message_date,pm.`status` ,p.title 
			FROM project_messages pm
			LEFT JOIN projects p ON p.id=pm.projectId
			WHERE p.clientid=" . $user_id . " AND pm.userId!=" . $user_id . " ORDER BY pm.message_date DESC");
		return $query;
	}
	
	public function get_user_messages_count($user_id)
		// find projects by title
	{
		$query = $this->db->query("SELECT count(pm.id) as 'count'
			FROM project_messages pm
			LEFT JOIN projects p ON p.id=pm.projectId
			LEFT JOIN bids b ON b.projectid=p.id
			WHERE b.contractorid=" . $user_id . " AND pm.userId!=" . $user_id . " AND pm.`status` = 0");
		return $query;
	}
	
	public function get_cliente_messages_count($user_id)
		// find projects by title
	{
		$query = $this->db->query("SELECT count(pm.id) as 'count'
			FROM project_messages pm
			LEFT JOIN projects p ON p.id=pm.projectId
			WHERE p.clientid=" . $user_id . " AND pm.userId!=" . $user_id . " AND pm.`status` = 0");
		return $query;
	}
	
}
