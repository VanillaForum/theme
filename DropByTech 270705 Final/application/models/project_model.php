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



class Project_Model extends MY_Model {



	private $database_table = 'projects';



	public function __construct()

	{

		parent::__construct();

	}



	public function get_rows($filters = array(), $table = 'projects')

	{

		return parent::get_rows($filters, $table);

	}



	public function find_all()

		// find projects published

	{

		$query = $this->db->query('SELECT * FROM projects WHERE status = 1 ORDER BY postdate DESC'); 

		return $query;

	}

	

	public function find_closest($lat,$lng,$dist,$userId)

	{

		$query = $this->db->query("SELECT 

			d.*,( (2*atan2(sqrt(a),sqrt(1-a)) ) * 6371 ) as dist

			FROM(

				SELECT *, ( power(sin((p.lat - '$lat')/2),2) +

					cos('$lat') * cos(p.lat) *

					power(sin((p.lng - '$lng')/2),2) ) as a

					FROM projects p

			) d

			WHERE d.id NOT IN (SELECT projectid FROM bids WHERE contractorid = '$userId')

			HAVING dist<='$dist' ORDER BY dist ASC,postdate DESC"); 

		return $query;

	}



	public function find_all_archived()

		// find projects archived status = 4 (archived by user)

	{

		$query = $this->db->query('SELECT * FROM projects WHERE status = 4 ORDER BY postdate DESC'); 

		return $query;

	}



	public function find_by_title($title)

		// find projects by title

	{

		$query = $this->db->query("SELECT * FROM projects WHERE status = 1 AND title LIKE '%" .$title. "%' ORDER BY postdate DESC");

		return $query;

	}

	

	public function find_by_title_archived($title)

		// find projects by title

	{

		$query = $this->db->query("SELECT * FROM projects WHERE status = 4 AND title LIKE '%" .$title. "%' ORDER BY postdate DESC");

		return $query;

	}



	

	public function find_by_category($category)

		// find projects by category

	{

		$query = $this->db->query('SELECT * FROM projects WHERE category = "'.$category.'" ORDER BY postdate DESC');

		return $query;

	}

	

	public function find_by_user($id)

		// find my projects or user project according to user id

	{

		$query = $this->db->query('SELECT * FROM projects WHERE clientid = ' .$id. ' AND (status = 1 OR status = 5) ORDER BY postdate DESC');

		return $query;		

	}

	

	public function find_by_bider($id)

		// find my projects or user project according to user id

	{

		$query = $this->db->query('SELECT p.* FROM projects p

			LEFT JOIN bids b ON b.projectid = p.id 

			WHERE b.contractorid = ' .$id. ' AND (p.status = 1 OR p.status = 5) ORDER BY postdate DESC');

		return $query;		

	}

	

	public function get_messages_by_bider($projectid,$userid,$ownerid)

		// find my projects or user project according to user id

	{

		$query = $this->db->query('SELECT * FROM project_messages

			WHERE projectId = ' .$projectid. ' AND (userId = ' .$userid. ' OR userId = ' . $ownerid . ') ORDER BY message_date DESC');

		return $query;		

	}

	

	public function get_archived_by_user($id)

	{

		$query = $this->db->query('SELECT * FROM projects WHERE clientid = ' .$id. ' AND status = 4 OR status = 3 ORDER BY postdate DESC');

		return $query;		

	}

	

	public function get_archived_by_bider($id)

		// find my projects or user project according to user id

	{

		$query = $this->db->query('SELECT p.* FROM projects p

			LEFT JOIN bids b ON b.projectid = p.id 

			WHERE b.contractorid = ' .$id. ' AND p.status = 4 OR p.status = 3 ORDER BY postdate DESC');

		return $query;		

	}

	

	public function find_by_awarded($id)

		// find projects awarded to user id

	{

		$query = $this->db->query('SELECT * FROM projects WHERE awardedid = ' .$id);

		return $query;		

	}

	public function find_by_user_archived($id)

		// find my projects archived or user project according to user id

	{

		$query = $this->db->query('SELECT * FROM projects WHERE clientid = ' .$id. ' AND status = 4 ORDER BY postdate DESC');

		return $query;		

	}

		

		

	public function post_project($data)

	{

		//var_dump($data);

		$this->db->insert('projects', $data);	

		// posts a new project

		

	}

	

	public function my_apply($data)

	{

		// used to apply to a project

		$this->db->insert('bids', $data);

	}

	

	public function award_project($data)

	{

		// used to award a project

		$this->db->query('UPDATE projects SET awardedid = '.$data['user_id']. ' WHERE id = '.$data['projectid']);

	}

	public function applying_withdrawal($data)

	{
		$actBdgt=($data['budget']*80)/100;

		// used to award a project

		$this->db->query('insert into withdrawals (ammount,project_id,userid,withdrawal_request_status,withdrawal_request_date) values ("'.$actBdgt.'","'.$data['projectid'].'","'.$data['user_id'].'",0,"'.date("Y-m-d H:i:s").'")');

	}
	public function check_wthdrawal_request($pid,$uid)

		// find projects awarded to user id

	{

		$query = $this->db->query('select * from withdrawals where project_id="'.$pid.'" and userid="'.$uid.'"');

		return $query;		

	}
	public function find_all_withdrawal()

		// find projects published

	{

		$query = $this->db->query('SELECT * FROM withdrawals ORDER BY withdrawal_request_date DESC'); 

		return $query;

	}
	public function find_withdrwl_data($wid)

		// find projects published

	{

		$query = $this->db->query('SELECT * FROM withdrawals where id="'.$wid.'"'); 

		if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }

	}
	public function get_files($id)

	{

		// used to award a project

		$query = $this->db->query('SELECT * FROM project_files WHERE proyect_id =' . $id);

		return $query;

	}

	

	public function project_done($data)

	{

		// used to award a project

		$this->db->query('UPDATE projects SET status = 3 WHERE id = '.$data['projectid']);

	}

	public function find_wthdrwl_project($pid)

	{
		$query = $this->db->query('SELECT * FROM projects WHERE id = "' .$pid.'"');
		if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
		//return $query;		

	}
	        function get_all_record($table='',$limit = '', $offset = '', $sortby = '', $orderby = 'DESC') {
      

        //Ordering Data
            if($sortby!="")
            {
              $this->db->order_by($sortby, $orderby);
            }
            //Setting Limit for Paging
            if ($limit != '' && $offset == 0) {
                $this->db->limit($limit);
            } else if ($limit != '' && $offset != 0) {
                $this->db->limit($limit, $offset);
            }
    
            //Executing Query
            $query = $this->db->get($table);
    
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
        
         function get_recordByid($table,$data) {
      

        //Ordering Data
           
    
            //Executing Query
            $query = $this->db->get_where($table,$data);
    
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
        function updates($table,$data,$where)
	{
		
		
		if($this->db->where($where)->update($table,$data))
		{
			return "updated";
		}
		else
		{
			return false;
		}
	}
	function make_update($quer)
	{
	    $query=$this->db->query($quer);
	  
	}
	function make_query($quer)
	{
	    $query=$this->db->query($quer);
	   if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
	}

}