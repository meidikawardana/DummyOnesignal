<?php 
class Ip_address_model extends CI_Model {

	public function __construct(){		
	}
	
	function load(){
		$sql = "
					SELECT id, ip_addr
					FROM ip_address
				";
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function update($params){
		$sql = "
			UPDATE ip_address
				SET					
					ip_addr=?
				WHERE id=?
		";
		
		$query = $this->db->query($sql,array(
				$params->ip_addr
				, $params->id
			));
		
		return $query;
	}	
}