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

class Admin_Model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function get_page_content($page)
		// find projects by title
	{
		$query = $this->db->query("SELECT * FROM pages WHERE page = '$page'");
		return $query;
	}
	
}
