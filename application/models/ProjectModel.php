<?php
class ProjectModel extends CI_Model
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
			$this->db->like('region',$str['region'], 'both');
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
			$this->db->like('region',$str['region'], 'both');
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

	function update_proj($ip,$op,$cr)
	{
		$this->db->where('project_id',$ip['project_id']);
		$this->db->update('InfrastructureProject',$ip);

		$this->db->where('office_id',$op['office_id']);
		$this->db->update('InfrastructureOffice',$op);

		$this->db->where('project_id',$ip['project_id']);
		$this->db->where('office_id',$op['office_id']);
		$this->db->update('creates',$cr);

	}

	function create_proj1($ip)
	{
		
		$this->db->insert('InfrastructureProject',$ip);

		$this->db->select_max('project_id');
		$query = $this->db->get('InfrastructureProject');
		foreach ($query->result_array() as $row) {
			$ans=$row['project_id'];
		}
		return $ans;

	}

	function create_proj2($op)
	{

		$this->db->insert('InfrastructureOffice',$op);

		$this->db->select_max('office_id');
		$query = $this->db->get('InfrastructureOffice');
		foreach ($query->result_array() as $row) {
			$ans=$row['office_id'];
		}
		return $ans;
	}

	function create_proj3($cr)
	{
		$this->db->insert('creates',$cr);
	}

	function delete_proj($data)
	{
		
		$this->db->where('project_id',$data['project_id']);
		$this->db->delete('InfrastructureProject');

		$this->db->where('office_id',$data['office_id']);
		$this->db->delete('InfrastructureOffice');

		$this->db->where('project_id',$data['project_id']);
		$this->db->where('office_id',$data['office_id']);
		$this->db->delete('creates');

	}

}
