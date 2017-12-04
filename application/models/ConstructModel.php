<?php
class ConstructModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('v_project_construction');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('v_project_construction');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_construction');
		$this->db->like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('contractor_name',$str, 'both');
		$this->db->or_like('actual_start',$str, 'both');
		$this->db->or_like('actual_completion',$str, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_construction');
		if($str['location_name'])
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['contractor_name'])		
			$this->db->like('contractor_name',$str['contractor_name'], 'both');
		if($str['actual_start'])
			$this->db->like('actual_start',$str['actual_start'], 'both');
		if($str['actual_completion'])
			$this->db->like('actual_completion',$str['actual_completion'], 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_construction');
		if($str['location_name'])
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['contractor_name'])		
			$this->db->like('contractor_name',$str['contractor_name'], 'both');
		if($str['actual_start'])
			$this->db->like('actual_start',$str['actual_start'], 'both');
		if($str['actual_completion'])
			$this->db->like('actual_completion',$str['actual_completion'], 'both');
		
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function search_gov_proj($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_construction');
		$this->db->like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('contractor_name',$str, 'both');
		$this->db->or_like('actual_start',$str, 'both');
		$this->db->or_like('actual_completion',$str, 'both');

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

		$this->db->where('contractor_id',$op['contractor_id']);
		$this->db->update('Contractor',$op);

		$this->db->where('contractor_id',$cr['contractor_id']);
		$this->db->where('project_id',$cr['project_id']);
		$this->db->update('builds',$cr);

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

		$this->db->insert('Contractor',$op);

		$this->db->select_max('contractor_id');
		$query = $this->db->get('Contractor');
		foreach ($query->result_array() as $row) {
			$ans=$row['contractor_id'];
		}
		return $ans;
	}

	function create_proj3($cr)
	{
		$this->db->insert('builds',$cr);
	}

	function delete_proj($data)
	{
		
		$this->db->where('project_id',$data['project_id']);
		$this->db->delete('InfrastructureProject');

		$this->db->where('contractor_id',$data['contractor_id']);
		$this->db->delete('Contractor');

		$this->db->where('contractor_id',$data['contractor_id']);
		$this->db->where('project_id',$data['project_id']);
		$this->db->delete('builds');

	}

}
