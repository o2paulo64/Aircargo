<?php
class CargoModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('v_cargo_delivery');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('v_cargo_delivery');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_cargo_delivery');
		$this->db->like('type_of_objects',$str, 'both');
		$this->db->or_like('no_objects',$str, 'both');
		$this->db->or_like('overall_cost',$str, 'both');
		$this->db->or_like('type',$str, 'both');
		$this->db->or_like('operation_name',$str, 'both');
		$this->db->or_like('airport_name',$str, 'both');
		$this->db->or_like('rnum',$str, 'both');
		$this->db->or_like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('shipping_date',$str, 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('v_cargo_delivery');
		if($str['type_of_objects'])
			$this->db->like('type_of_objects',$str['type_of_objects'], 'both');
		if($str['no_objects'])
			$this->db->like('no_objects',$str['no_objects'], 'both');
		if($str['overall_cost'])
			$this->db->like('overall_cost',$str['overall_cost'], 'both');
		if($str['type'])
			$this->db->like('type',$str['type'], 'both');
		if($str['operation_name'])
			$this->db->like('operation_name',$str['operation_name'], 'both');
		if($str['airport_name'])
			$this->db->like('airport_name',$str['airport_name'], 'both');
		if($str['rnum'])
			$this->db->like('rnum',$str['rnum'], 'both');
		if($str['location_name'])
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['shipping_date'])
			$this->db->like('shipping_date',$str['shipping_date'], 'both');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function advance_search($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_cargo_delivery');
		if($str['type_of_objects'])
			$this->db->like('type_of_objects',$str['type_of_objects'], 'both');
		if($str['no_objects'])
			$this->db->like('no_objects',$str['no_objects'], 'both');
		if($str['overall_cost'])
			$this->db->like('overall_cost',$str['overall_cost'], 'both');
		if($str['type'])
			$this->db->like('type',$str['type'], 'both');
		if($str['operation_name'])
			$this->db->like('operation_name',$str['operation_name'], 'both');
		if($str['airport_name'])
			$this->db->like('airport_name',$str['airport_name'], 'both');
		if($str['rnum'])
			$this->db->like('rnum',$str['rnum'], 'both');
		if($str['location_name'])
			$this->db->like('location_name',$str['location_name'], 'both');
		if($str['description'])
			$this->db->like('description',$str['description'], 'both');
		if($str['cost'])
			$this->db->like('cost',$str['cost'], 'both');
		if($str['shipping_date'])
			$this->db->like('shipping_date',$str['shipping_date'], 'both');
		
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function search_gov_proj($limit,$start,$sort,$order,$str)
	{
		$this->db->select('*');
		$this -> db -> from('v_cargo_delivery');
		$this->db->like('type_of_objects',$str, 'both');
		$this->db->or_like('no_objects',$str, 'both');
		$this->db->or_like('overall_cost',$str, 'both');
		$this->db->or_like('type',$str, 'both');
		$this->db->or_like('operation_name',$str, 'both');
		$this->db->or_like('airport_name',$str, 'both');
		$this->db->or_like('rnum',$str, 'both');
		$this->db->or_like('location_name',$str, 'both');
		$this->db->or_like('description',$str, 'both');
		$this->db->or_like('cost',$str, 'both');
		$this->db->or_like('shipping_date',$str, 'both');

		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();
		return $query;
	}

	function update_proj($ip,$op,$cr,$carg,$infra,$trans)
	{
		

		$this->db->where('airport_id',$ip['airport_id']);
		$this->db->update('Airport',$ip);

		$this->db->where('operator_id',$op['operator_id']);
		$this->db->update('AirlineOperation',$op);

		$this->db->where('aircraft_registration',$cr['aircraft_registration']);
		$this->db->update('Aircraft',$cr);

		$this->db->where('cargo_id',$carg['cargo_id']);
		$this->db->update('Cargo',$carg);

		$this->db->where('project_id',$infra['project_id']);
		$this->db->update('InfrastructureProject',$infra);

		$this->db->where('report_id',$trans['report_id']);
		$this->db->where('project_id',$trans['project_id']);
		$this->db->update('transports',$trans);
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

	function create_proj4($carg)
	{
		
		$this->db->insert('Cargo',$carg);

		$this->db->select_max('cargo_id');
		$query = $this->db->get('Cargo');
		foreach ($query->result_array() as $row) {
			$ans=$row['cargo_id'];
		}
		return $ans;

	}

	function create_proj5($infra)
	{
		
		$this->db->insert('InfrastructureProject',$infra);

		$this->db->select_max('project_id');
		$query = $this->db->get('InfrastructureProject');
		foreach ($query->result_array() as $row) {
			$ans=$row['project_id'];
		}
		return $ans;

	}

	function create_proj6($r)
	{
		$this->db->insert('Report',$r);
		$this->db->select_max('report_id');
		$query = $this->db->get('Report');
		foreach ($query->result_array() as $row) {
			$ans=$row['report_id'];
		}
		return $ans;

	}

	function create_proj7($trans)
	{
		$this->db->insert('transports',$trans);
	}

	function delete_proj($data)
	{
		
		$this->db->where('airport_id',$data['airport_id']);
		$this->db->delete('Airport');

		$this->db->where('aircraft_registration',$data['aircraft_registration']);
		$this->db->delete('Aircraft');

		$this->db->where('operator_id',$data['operator_id']);
		$this->db->delete('AirlineOperation');

		$this->db->where('cargo_id',$data['cargo_id']);
		$this->db->delete('Cargo');

		$this->db->where('project_id',$data['project_id']);
		$this->db->delete('InfrastructureProject');

		$this->db->where('report_id',$data['report_id']);
		$this->db->where('operator_id',$data['operator_id']);
		$this->db->where('airport_id',$data['airport_id']);
		$this->db->delete('report');

		$this->db->where('report_id',$data['report_id']);
		$this->db->where('project_id',$data['project_id']);
		$this->db->delete('transports');


	}

}
