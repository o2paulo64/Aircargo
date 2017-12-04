<?php
class DeliveryModel extends CI_Model
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

	function advance_search_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_gov_projects');
		if($str['region'])
			$this->db->like('region',$str, 'both');
		if($str['district'])
			$this->db->like('district',$str['district'], 'both');
		if($str['location_name'])		
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['fundsource_type'])
			$this->db->like('fundsource_type',$str['fundsource_type'], 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_gov_projects');
		if($str['region'])
			$this->db->like('region',$str, 'both');
		if($str['district'])
			$this->db->like('district',$str['district'], 'both');
		if($str['location_name'])		
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['fundsource_type'])
			$this->db->like('fundsource_type',$str['fundsource_type'], 'both');
		
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
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

	

	function get_cargo_count()
	{
		$this->db->select('a.report_id,b.aircraft_registration,a.project_id,f.location_name,a.shipping_date,d.type_of_objects,d.no_objects,d.overall_cost');
		$this->db->from('transports as a');
		$this->db->join('report as e','a.report_id=e.report_id','inner');
		$this->db->join('aircraft as b','e.aircraft_registration=b.aircraft_registration','inner');
		$this->db->join('cargo as d','d.cargo_id=e.cargo_id','inner');
		$this->db->join('infrastructureproject as f','f.project_id=a.project_id','inner');
		$query = $this->db->get();

		return $query->num_rows();
	}

	function get_cargo($limit,$start,$sort,$order)
	{
		$this->db->select('a.report_id,b.aircraft_registration,a.project_id,f.location_name,a.shipping_date,d.type_of_objects,d.no_objects,d.overall_cost');
		$this->db->from('transports as a');
		$this->db->join('report as e','a.report_id=e.report_id','inner');
		$this->db->join('aircraft as b','e.aircraft_registration=b.aircraft_registration','inner');
		$this->db->join('cargo as d','d.cargo_id=e.cargo_id','inner');
		$this->db->join('infrastructureproject as f','f.project_id=a.project_id','inner');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	
}
