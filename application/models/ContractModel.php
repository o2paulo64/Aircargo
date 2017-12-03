<?php
class ContractModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('v_project_contractor');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('v_project_contractor');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_contractor');
		$this->db->like('contractor_name',$str, 'both');
		$this->db->like('region',$str, 'both');
		$this->db->or_like('district',$str, 'both');
		$this->db->or_like('start_date',$str, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function search_gov_proj($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_project_contractor');
		$this->db->like('contractor_name',$str, 'both');
		$this->db->like('region',$str, 'both');
		$this->db->or_like('district',$str, 'both');
		$this->db->or_like('start_date',$str, 'both');

		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function update_proj($ip,$op,$cr)
	{
		$this->db->where('contractor_id',$ip['contractor_id']);
		$this->db->update('Contractor',$ip);

		$this->db->where('office_id',$op['office_id']);
		$this->db->update('InfrastructureOffice',$op);

		$this->db->where('contractor_id',$ip['contractor_id']);
		$this->db->where('office_id',$op['office_id']);
		$this->db->update('contracts',$cr);

	}

	function create_proj1($ip)
	{
		
		$this->db->insert('Contractor',$ip);

		$this->db->select_max('contractor_id');
		$query = $this->db->get('Contractor');
		foreach ($query->result_array() as $row) {
			$ans=$row['contractor_id'];
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
		$this->db->insert('contracts',$cr);
	}

	function delete_proj($data)
	{
		
		$this->db->where('contractor_id',$data['contractor_id']);
		$this->db->delete('Contractor');

		$this->db->where('office_id',$data['office_id']);
		$this->db->delete('InfrastructureOffice');

		$this->db->where('contractor_id',$data['contractor_id']);
		$this->db->where('office_id',$data['office_id']);
		$this->db->delete('contracts');

	}

}
