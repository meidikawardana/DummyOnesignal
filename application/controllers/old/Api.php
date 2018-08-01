<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class ini untuk menyediakan data untuk website
class Api extends CI_Controller {

	public function index(){		
		echo "backend web pendaftaran";
	}
	
	//fungsi ini untuk mengecek admin ketika login web
	public function login(){
		
		//tampung data dari website ke variabel
		$name = $this->input->post('name');
		$pass = $this->input->post('pass');
		
		$this->load->model('admin_model'); //muat file admin_model.php di folder models
		
		$result = new stdClass();
		$result->isExists = $this->admin_model->is_exists($name, $pass); //cek apakah nama & password ada di database
		
		if($result->isExists == 1){ //jika ada, maka
			$this->session->is_user_loginned = "yes"; //tandai bahwa admin sudah login. simpan penanda di session
		}
		
		echo json_encode($result); //kirimkan data ke website
	}
	
	//fungsi ini untuk menyediakan data semua pengguna
	public function load_user(){
		$this->load->model('users_model'); //muat file users_model.php dari folder models
		$result = $this->users_model->load(); //dapatkan data semua pengguna dari database
		echo json_encode($result); //kirimkan data ke website
	}
	
	//fungsi ini untuk menyediakan data admin
	public function load_admin(){
		$this->load->model('admin_model'); //muat file admin_model.php dari folder models
		$result = $this->admin_model->load(); //dapatkan data admin dari database
		echo json_encode($result); //kirimkan data ke website
	}

	//fungsi ini untuk menyediakan data ip address
	public function load_ip_address(){
		$this->load->model('ip_address_model'); //muat file ip_address_model.php dari folder models
		$result = $this->ip_address_model->load(); //dapatkan data ip address dari database
		echo json_encode($result); //kirimkan data ke website
	}	

	//fungsi ini untuk menyimpan data pengguna ke database
	public function add_user(){
		
		//tampung data dari website ke variabel
		$username = $this->input->post('username');
		$name = $this->input->post('name');
		$pass = $this->input->post('pass');
		$pass_default = $this->input->post('pass_default');
		
		$this->load->model('users_model'); //muat file users_model.php dari folder models
		
		$result = new stdClass(); //buat variabel untuk menampung data yang akan dikirim ke web
		if($this->users_model->is_exists($name, $username)){  //cek apakah username & password sudah ada
			$result->saved = 0;
			$result->msg = "Username / Nama pengguna sudah ada";
			echo json_encode($result);
			die(); //stop fungsi sampai di sini
		}
		
		//buat obyek untuk dimasukkan ke database
		$data = new stdClass();
		$data->username = $username;
		$data->name = $name;
		$data->pass = $pass;
		$data->pass_default = $pass_default;
		
		$insert_id = $this->users_model->insert($data);
		
		if($insert_id > 0){
			$result->saved = 1;
			$result->msg = "Berhasil menyimpan data pengguna";
		}else{
			$result->saved = 0;
			$result->msg = "Data pengguna gagal disimpan";
		}
		
		echo json_encode($result); //kirimkan data ke website
	}
	
	//fungsi ini untuk mengedit data user
	public function edit_user(){
		//tampung data dari website ke variabel
		$user_id = $this->input->post('id');
		$username = $this->input->post('username');
		$name = $this->input->post('name');
		
		$this->load->model('users_model'); //muat file users_model.php dari folder models
		
		$result = new stdClass();	//buat variabel untuk menampung data yang akan dikirim ke web	
			
		//buat obyek untuk mengubah tabel di database
		$params = new stdClass();
		$params->user_id = $user_id;
		$params->username = $username;
		$params->name = $name;
			
		//cek apakah ada username sudah ada
		if($this->users_model->is_other_user_exists($name, $username, $user_id)){
			$result->saved = 0;
			$result->msg = "Username / Nama pengguna sudah ada";		
			echo json_encode($result);
			die(); //stop fungsi sampai di sini 
		}
		
		//update data di tabel database
		$queryResult = $this->users_model->update($params);
		if($queryResult){
			$result->saved = 1;
			$result->msg = "Sukses mengedit data pengguna";
		}else{
			$result->saved = 0;
			$result->msg = "Gagal mengedit data pengguna";				
		}
		
		echo json_encode($result); //kirimkan data ke website
	}
	
	//fungsi ini untuk mengubah data admin
	public function edit_admin(){
		//tampung data dari website ke variabel
		$user_id = $this->input->post('id');
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		
		$this->load->model('admin_model'); //muat file admin_model.php dari folder models
		
		$result = new stdClass(); //buat variabel untuk menampung data yang akan dikirim ke web	
			
		//buat obyek untuk mengubah tabel di database
		$params = new stdClass();
		$params->user_id = $user_id;
		$params->username = $username;
		$params->pass = $pass;
		
		//update data di tabel database
		$queryResult = $this->admin_model->update($params);
		if($queryResult){
			$result->saved = 1;
			$result->msg = "Sukses mengedit data admin";
		}else{
			$result->saved = 0;
			$result->msg = "Gagal mengedit data admin";				
		}
		
		echo json_encode($result);
	}
	
	//fungsi ini untuk mengubah data ip address server
	public function edit_ip_address(){
		//tampung data dari website ke variabel
		$id = $this->input->post('id');
		$ip_addr = $this->input->post('ip_addr');		
		
		$this->load->model('ip_address_model'); //muat file ip_address_model.php dari folder models
		
		$result = new stdClass(); //buat variabel untuk menampung data yang akan dikirim ke web			
			
		//buat obyek untuk mengubah tabel di database
		$params = new stdClass();
		$params->id = $id;
		$params->ip_addr = $ip_addr;		
		
		//update data di tabel database
		$queryResult = $this->ip_address_model->update($params);
		if($queryResult){
			$result->saved = 1;
			$result->msg = "Sukses mengedit data ip address server";
		}else{
			$result->saved = 0;
			$result->msg = "Gagal mengedit data ip address server";				
		}
		
		echo json_encode($result);
	}	
	
	//fungsi ini untuk menghapus data user
	public function delete_user(){
		//tampung data dari website ke variabel
	    $user_id = $this->input->post('id');
	    
	    $this->load->model('users_model'); //muat file users_model.php dari folder models
	    
	    $result = new stdClass(); //buat variabel untuk menampung data yang akan dikirim ke web
	    
		//buat obyek untuk hapus data
	    $params = new stdClass();
	    $params->user_id = $user_id;
	    
		//hapus data di tabel database
	    $queryResult = $this->users_model->delete($params);
	    if($queryResult){
	        $result->saved = 1;
	        $result->msg = "Sukses menghapus pengguna";
	    }else{
	        $result->saved = 0;
	        $result->msg = "Gagal menghapus pengguna";
	    }
	    
	    echo json_encode($result);
	}
	
	//fungsi ini untuk mendapatkan data pendaftaran
	public function load_data(){
		
		$action = "";
		
		//jika user sedang mencari sesuatu, tampung variabel2 pencariannya
		if($this->uri->segment(3)){ //jika segment ke-3 tidak kosong, artinya user sedang mencari sesuatu
			$action = $this->uri->segment(3);
			$obj = $this->uri->segment(4);
			$mode = $this->uri->segment(5);
			$query = urldecode($this->uri->segment(6));
		}
		
		$this->load->model('data_pendaftaran_model'); //muat file data_pendaftaran_model.php dari folder models
		
		if($action == ""){
			$result = $this->data_pendaftaran_model->load(); //muat semua data dari tabel data_pendaftaran
		}else if($action == "search"){
			$result = $this->data_pendaftaran_model->search($obj, $mode, $query); //muat data2 dari tabel data_pendaftaran sesuai yang dicari user
		}
		
		$result_display = array(); //buat variabel untuk menampung data yang akan dikirim ke website
		
		foreach($result as $a_row){ //untuk setiap baris data
			
			$tanggal_lahir = $a_row->tanggal_lahir;
			$tanggal_lahir_arr = explode("-",$tanggal_lahir);
			$tanggal_lahir_display = $tanggal_lahir_arr[2]."-".$tanggal_lahir_arr[1]."-".$tanggal_lahir_arr[0];
		
			$a_row->tanggal_lahir = $tanggal_lahir_display;	 //format tanggal lahir		
			
			$a_row->upah = number_format($a_row->upah,0,",",".").",-"; //format upah
			
			$a_row->pekerjaan1 = strtolower($a_row->pekerjaan1); //format pekerjaan1
			$a_row->pekerjaan2 = strtolower($a_row->pekerjaan2); //format pekerjaan2
			$a_row->lokasi_pekerjaan = ucwords(strtolower($a_row->lokasi_pekerjaan));	//format lokasi pekerjaan		
			
			array_push($result_display, $a_row); //simpan data di variabel 
		}
		
		echo json_encode($result_display); //kirimkan data ke website
	}		
}
