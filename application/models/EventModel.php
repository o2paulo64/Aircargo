<?php
class EventModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_gov_proj_count()
	{
		$this->db->select('*');
		$this->db->from('gov_projects');
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_gov_proj($limit,$start,$sort,$order)
	{
		$this->db->select('*');
		$this->db->from('gov_projects');
		if($sort!='default')
			$this->db->order_by($sort,$order);
		$this->db->limit($limit,$start);
		$query = $this->db->get();

		return $query;
	}

	function search_gov_proj_count($str)
	{
		$this->db->select('*');
		$this -> db -> from('gov_projects');
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
		$this -> db -> from('gov_projects');
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

	function get_report_count()
	{
		$this->db->select('h.shipping_date,c.operation_name,d.airport_name,b.aircraft_registration,f.classification,f.description');
		$this->db->from('describes as a ');
		$this->db->join('report as b','a.report_id=b.report_id','inner');
		$this->db->join('airlineoperation as c','b.operator_id=c.operator_id','inner');
		$this->db->join('airport as d','b.airport_id=d.airport_id','inner');
		$this->db->join('type as f','a.typeno=f.typeno','inner');
		$this->db->join('transports as h','b.report_id=h.report_id','inner');
		$query = $this->db->get();

		return $query->num_rows();
	}

	function get_report($limit,$start,$sort,$order)
	{
		$this->db->select('h.shipping_date,c.operation_name,d.airport_name,b.aircraft_registration,f.classification,f.description');
		$this->db->from('describes as a ');
		$this->db->join('report as b','a.report_id=b.report_id','inner');
		$this->db->join('airlineoperation as c','b.operator_id=c.operator_id','inner');
		$this->db->join('airport as d','b.airport_id=d.airport_id','inner');
		$this->db->join('type as f','a.typeno=f.typeno','inner');
		$this->db->join('transports as h','b.report_id=h.report_id','inner');
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
