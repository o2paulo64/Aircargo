<?php
class EventModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('region,district,location_name,description,cost');
		$this->db->from('creates as c ');
		$this->db->join('infrastructureproject as p','c.project_id=p.project_id','natural');
		$this->db->join('infrastructureoffice as o','c.office_id=o.office_id','inner');

		$this->db->where('p.project_id=c.project_id and o.office_id=c.office_id');
		$query = $this->db->get();

		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('region,district,location_name,description,cost');
		$this->db->from('creates as c ');
		$this->db->join('infrastructureproject as p','c.project_id=p.project_id','natural');
		$this->db->join('infrastructureoffice as o','c.office_id=o.office_id','inner');

		$this->db->where('p.project_id=c.project_id and o.office_id=c.office_id');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}
}
?>