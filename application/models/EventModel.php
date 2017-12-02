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

	function get_report_count()
	{
		$this->db->select('a.report_id,h.shipping_date,c.operation_name,d.airport_name,b.aircraft_registration,f.classification,f.description,b.cargo_id');
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
		$this->db->select('a.report_id,h.shipping_date,c.operation_name,d.airport_name,b.aircraft_registration,f.classification,f.description,b.cargo_id');
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
