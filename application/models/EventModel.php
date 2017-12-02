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
}