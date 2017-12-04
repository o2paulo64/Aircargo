<?php
class ReportModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('v_ai_report');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('v_ai_report');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_ai_report');
		$this->db->or_like('operation_name',$str, 'both');
		$this->db->or_like('airport_name',$str, 'both');
		$this->db->or_like('aircraft_registration',$str, 'both');
		$this->db->or_like('classification',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_ai_report');
		if($str['operation_name'])
			$this->db->like('operation_name',$str['operation_name'], 'both');
		if($str['airport_name'])
			$this->db->like('airport_name',$str['airport_name'], 'both');
		if($str['type'])
			$this->db->like('type',$str['type'], 'both');
		if($str['classification'])
			$this->db->like('classification',$str['classification'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_ai_report');
		if($str['operation_name'])
			$this->db->like('operation_name',$str['operation_name'], 'both');
		if($str['airport_name'])
			$this->db->like('airport_name',$str['airport_name'], 'both');
		if($str['type'])
			$this->db->like('type',$str['type'], 'both');
		if($str['classification'])
			$this->db->like('classification',$str['classification'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function search_gov_proj($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_ai_report');
		$this->db->or_like('operation_name',$str, 'both');
		$this->db->or_like('airport_name',$str, 'both');
		$this->db->or_like('aircraft_registration',$str, 'both');
		$this->db->or_like('classification',$str, 'both');
		$this->db->or_like('description',$str, 'both');

		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function update_proj($ip,$op,$cr,$t)
	{
		

		$this->db->where('airport_id',$ip['airport_id']);
		$this->db->update('Airport',$ip);

		$this->db->where('aircraft_registration',$op['aircraft_registration']);
		$this->db->update('Aircraft',$op);

		$this->db->where('operator_id',$cr['operator_id']);
		$this->db->update('AirlineOperation',$cr);

		$this->db->where('typeno',$t['typeno']);
		$this->db->update('Type',$t);


	}

	function create_proj1($ip)
	{
		
		$this->db->insert('Airport',$ip);

		$this->db->select_max('airport_id');
		$query = $this->db->get('Airport');
		foreach ($query->result_array() as $row) {
			$ans=$row['airport_id'];
		}
		return $ans;

	}

	function create_proj2($op)
	{

		$this->db->insert('Aircraft',$op);

		$ans=$op['aircraft_registration'];
		return $ans;
	}

	function create_proj3($cr)
	{
		
		$this->db->insert('AirlineOperation',$cr);

		$this->db->select_max('operator_id');
		$query = $this->db->get('AirlineOperation');
		foreach ($query->result_array() as $row) {
			$ans=$row['operator_id'];
		}
		return $ans;

	}

	function create_proj4($t)
	{
		
		$this->db->insert('Type',$t);

		$this->db->select_max('typeno');
		$query = $this->db->get('Type');
		foreach ($query->result_array() as $row) {
			$ans=$row['typeno'];
		}
		return $ans;

	}

	function create_cargo()
	{
		$data=array(
			'type_of_objects' => 'To be Updated',
			'overall_cost' => 0,
			'no_objects' => 0
		);

		$this->db->insert('Cargo',$data);

		$this->db->select_max('cargo_id');
		$query = $this->db->get('Cargo');
		foreach ($query->result_array() as $row) {
			$ans=$row['cargo_id'];
		}
		return $ans;
	}

	function create_proj5($r)
	{
		$this->db->insert('Report',$r);
		$this->db->select_max('report_id');
		$query = $this->db->get('Report');
		foreach ($query->result_array() as $row) {
			$ans=$row['report_id'];
		}
		return $ans;

	}

	function create_proj6($descr)
	{
		$this->db->insert('describes',$descr);
	}

	function delete_proj($data)
	{
		
		$this->db->where('airport_id',$data['airport_id']);
		$this->db->delete('Airport');

		$this->db->where('aircraft_registration',$data['aircraft_registration']);
		$this->db->delete('Aircraft');

		$this->db->where('operator_id',$data['operator_id']);
		$this->db->delete('AirlineOperation');

		$this->db->where('typeno',$data['typeno']);
		$this->db->delete('Type');

		$this->db->where('report_id',$data['report_id']);
		$this->db->where('operator_id',$data['operator_id']);
		$this->db->where('airport_id',$data['airport_id']);
		$this->db->delete('report');

		$this->db->where('report_id',$data['report_id']);
		$this->db->where('typeno',$data['typeno']);
		$this->db->delete('describes');


	}

}
