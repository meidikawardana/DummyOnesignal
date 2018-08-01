<?php 
class Admin_model extends CI_Model {

	public function __construct(){		
	}
	
	function is_exists($name,$pass){
		$sql = "
			SELECT id 
				FROM admin 
			WHERE name = ? and pass = ?
		";
		
		$query = $this->db->query($sql,array(
				$name, $pass				
			));
		
		return ($query->num_rows() > 0) ? 1:0;
	}
	
	function load(){
		$sql = "
					SELECT id, name username
					FROM admin
				";
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function update($params){
		$sql = "
			UPDATE admin
				SET					
					name=?,
					pass=?
				WHERE id=?
		";
		
		$query = $this->db->query($sql,array(
				$params->username
				, $params->pass
				, $params->user_id
			));
		
		return $query;
	}	
}