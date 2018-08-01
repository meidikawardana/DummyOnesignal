<?php 
class Data_pendaftaran_model extends CI_Model {

	public function __construct(){		
	}	
	
	function is_exists($nomor_identitas){
		$sql = "
			SELECT id 
				FROM data_pendaftaran 
			WHERE nomor_identitas = ?
		";
		
		$query = $this->db->query($sql,array(
				$nomor_identitas				
			));
		
		return ($query->num_rows() > 0) ? 1:0;
	}	
	
	function insert($data){
		$sql = "
			INSERT INTO data_pendaftaran
				(nomor_identitas, nama, tanggal_lahir, handphone, email, pekerjaan1, pekerjaan2
				, lokasi_pekerjaan, upah, kode_paket, bulan_iuran, sumber_pembayaran
				, foto_ktp, foto_tandatangan)
				VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
		";
		
		$query = $this->db->query($sql,array(
				$data->noIdentitas
				, $data->nama
				, $data->tanggalLahir
				, $data->phone
				, $data->email
				, $data->pekerjaan1
				, $data->pekerjaan2
				, $data->lokasiPekerjaan
				, $data->upah
				, $data->kodePaket
				, $data->bulanIuran
				, $data->sumberPembayaran
				, $data->ktpPath
				, $data->tandatanganPath				
			));
		
		if($query)
			return $this->db->insert_id();
		return 0;		
	}

	function load(){
		$sql = "
			SELECT id, nomor_identitas, nama, tanggal_lahir, handphone, email
				, pekerjaan1, pekerjaan2, lokasi_pekerjaan, upah, kode_paket
				, bulan_iuran, sumber_pembayaran, foto_ktp, foto_tandatangan
			FROM data_pendaftaran
				";
		$query = $this->db->query($sql);
		
		return $query->result();
	}
	
	function search($obj, $mode, $query){
		
		$obj_real = "";
		
		if($obj == "identity"){
			$obj_real = "nomor_identitas";
		}else if($obj == "name"){
			$obj_real = "nama";
		}
		
		$search_clause = "";
		if($mode == "exact"){
			$search_clause = " = '{$query}' ";
		}else if($mode == "beginswith"){
			$search_clause = " like '{$query}%'";
		}else if($mode == "like"){
			$search_clause = " like '%{$query}%'";
		}else if($mode == "endswith"){
			$search_clause = " like '%{$query}'";
		}
		
		if($obj_real != ""){
			$sql = "
				SELECT id, nomor_identitas, nama, tanggal_lahir, handphone, email
					, pekerjaan1, pekerjaan2, lokasi_pekerjaan, upah, kode_paket
					, bulan_iuran, sumber_pembayaran, foto_ktp, foto_tandatangan
				FROM data_pendaftaran
				where $obj_real $search_clause
					";
			$query = $this->db->query($sql);
			
			return $query->result();
		}else{
			return array();
		}
	}	
	
	function load_a_document($id){
		$sql = "
			SELECT id, nomor_identitas, nama, tanggal_lahir, handphone, email
				, pekerjaan1, pekerjaan2, lokasi_pekerjaan, upah, kode_paket
				, bulan_iuran, sumber_pembayaran, foto_ktp, foto_tandatangan
				, provinsi
			FROM data_pendaftaran where id = ?
				";
		$query = $this->db->query($sql, array($id));
		
		return $query->row();
	}
	
	function load_a_document_as_arr($id){
		$sql = "
			SELECT nomor_identitas, nama, tanggal_lahir, handphone
				, pekerjaan1, pekerjaan2
				, CONCAT(provinsi,'/',lokasi_pekerjaan) as lokasi_pekerjaan
				, upah, kode_paket
				, bulan_iuran,0 total_iuran, sumber_pembayaran
				, email
				/*, foto_ktp, foto_tandatangan*/
			FROM data_pendaftaran where id = ?
				";
		$query = $this->db->query($sql, array($id));
		
		return $query->result_array()[0];
	}
	
	function load_all_document_as_arr(){
		$sql = "
			SELECT nomor_identitas, nama, tanggal_lahir, handphone
				, pekerjaan1, pekerjaan2
				, CONCAT(provinsi,'/',lokasi_pekerjaan) as lokasi_pekerjaan
				, upah, kode_paket
				, bulan_iuran,0 total_iuran, sumber_pembayaran
				, email
				/*, foto_ktp, foto_tandatangan*/
			FROM data_pendaftaran
			order by id
				";
		$query = $this->db->query($sql);
		
		return $query->result_array();
	}	
}