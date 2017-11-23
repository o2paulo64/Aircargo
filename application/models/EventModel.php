<?php
class EventModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function get_aircraft()
	{
		$this -> db -> select('type');
		$this -> db -> from('Aircraft');
		$query = $this -> db -> get();
		
		return $query;
 	}
	
}
?>