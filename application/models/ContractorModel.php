<?php
class ContractorModel extends CI_Model
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

	function get_contract_count()
	{
		$this->db->select('contractor_name, region, district, start_date');
		$this->db->from('contracts as a');
		$this->db->join('contractor as b','a.contractor_id=b.contractor_id','inner');
		$this->db->join('infrastructureoffice as c','c.office_id=a.office_id','inner');
		$query = $this->db->get();

		return $query->num_rows();
	}

	function get_contract($limit,$start,$sort,$order)
	{
		$this->db->select('contractor_name, region, district, start_date');
		$this->db->from('contracts as a');
		$this->db->join('contractor as b','a.contractor_id=b.contractor_id','inner');
		$this->db->join('infrastructureoffice as c','c.office_id=a.office_id','inner');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

}
