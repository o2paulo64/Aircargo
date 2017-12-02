<?php
Class UserModel extends CI_Model
{
	function __construct() 
	{
		parent::__construct();
	}

	function deleteTable($id,$field,$table){
		$this -> db -> where($field,$id);
		$this -> db ->delete($table);
	}

	function updateTable($data,$id,$table)
	{
		$this -> db -> where('id',$id);
		$this -> db ->update($table,$data);
		
	}

	function searchUser($str)
	{
		$this->db->select('*');
		$this -> db -> from('users');
		$this->db->like('lastname',$str, 'both');
		$this->db->or_like('firstname',$str, 'both');
		$query = $this->db->get();
		return $query;
	}

 	function getSpecificUserEventOrDependents($userid,$eventid,$field1,$field2,$table)
 	{
 		$this -> db -> select('*');
		$this -> db -> from($table);
 		$this -> db -> where($field1,$userid);
 		$this -> db -> where($field2,$eventid);
		$query = $this -> db -> get();
		return $query;
 	}

 	function updateDependents($data)
	{	
		$this -> db -> where('userid',$data['userid']);
		$this -> db -> where('eventid',$data['eventid']);
		$this -> db -> where('dependentid',$data['dependentid']);
		$this -> db ->update('dependents',$data);
	}

 	function addToUserEvents($userid,$eventid)
	{
		$data=array(
			'userid' => $userid,
			'eventid' => $eventid
		);
		$this->db->insert('userEvents', $data);
 	}

 	function updateUserEventAttendance($userid,$eventid,$data,$field){

		$this->db->set($field,$data['response']);   
		$this->db->where('userid', $userid); 
		$this->db->where('eventid', $eventid); 
		$this->db->update('userEvents');
 	}

 	function getUsers()
	{
		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> order_by("lastname", "asc");
		$this -> db -> where('id!=', 1);
		$query = $this -> db -> get();
		
		return $query;
	}

	function updatePassword($data)
	{
		$this->db->set('password',$data['password']); 
		$this->db->where('id', $data['id']);   
		$this->db->update('users');
	}

 	function updateStampChecked($id,$eventid){

 		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('id', $id);

		$userInfo = $this -> db -> get();

		$this -> db -> select('*');
		$this -> db -> from('userEvents');
		$this -> db -> where('userid', $id);
		$this -> db -> where('eventid', $eventid);

		$userEventInfo = $this -> db -> get();

		foreach ($userInfo->result_array() as $userRow) {
			foreach ($userEventInfo->result_array() as $userEventRow) {
				$stampValue=$userRow['stamp'];
				$eventValue=$userEventRow['response'];
			}
		}
		if( ($eventValue>=0 && $eventValue<4 )|| $eventValue==NULL){
			$eventValue+=4;
			$stampValue+=1;

			$this->db->set('response',$eventValue); 
			$this->db->where('userid', $id); 
			$this->db->where('eventid', $eventid); 
			$this->db->update('userEvents');

			$this->db->set('stamp',$stampValue); 
			$this->db->where('id', $id); 
			$this->db->update('users');
		}
		

 	}

 	function updateStampUnchecked($id,$eventid){

 		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('id', $id);

		$userInfo = $this -> db -> get();

		$this -> db -> select('*');
		$this -> db -> from('userEvents');
		$this -> db -> where('userid', $id);
		$this -> db -> where('eventid', $eventid);

		$userEventInfo = $this -> db -> get();

		foreach ($userInfo->result_array() as $userRow) {
			foreach ($userEventInfo->result_array() as $userEventRow) {
				$stampValue=$userRow['stamp'];
				$eventValue=$userEventRow['response']; //response of user from specific event
			}
		}

		if($eventValue>3 && $eventValue<8){
			$eventValue-=4;
			if($eventValue==0)$eventValue=NULL;
			$stampValue-=1;

			$this->db->set('response',$eventValue); 
			$this->db->where('userid', $id); 
			$this->db->where('eventid', $eventid); 
			$this->db->update('userEvents');

			$this->db->set('stamp',$stampValue); 
			$this->db->where('id', $id); 
			$this->db->update('users');
		}
 	}

	function resetPoints(){

		$this -> db -> select('*');
		$this -> db -> from('users');
		$this -> db -> where('id!=', 1);
		$query = $this -> db -> get();

		$data=array('stamp' => 0);
		foreach ($query->result_array() as $queryRow) {
			$this -> db -> where('id',$queryRow['id']);
			$this -> db ->update('users',$data);
		}
		
	}
}
?>