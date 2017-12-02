<?php
class ContructionModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('v_gov_projects');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('v_gov_projects');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_gov_projects');
		$this->db->like('region',$str, 'both');
		$this->db->or_like('district',$str, 'both');
		$this->db->or_like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('fundsource_type',$str, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function search_gov_proj($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_gov_projects');
		$this->db->like('region',$str, 'both');
		$this->db->or_like('district',$str, 'both');
		$this->db->or_like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('fundsource_type',$str, 'both');

		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}


}
