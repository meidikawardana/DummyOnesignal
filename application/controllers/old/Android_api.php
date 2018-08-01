<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class ini untuk menyediakan data untuk aplikasi android
class Android_api extends CI_Controller {

	public function __construct(){
		parent::__construct();        
        $this->load->helper('file'); //muat fungsi2 pembantu (helper) untuk penanganan file
    }

	public function index(){
		echo "backend app pendaftaran";
	}
	
	//fungsi ini untuk mengecek & menyediakan data user ketika login app android
	public function login(){
		
		//tampung data dari app android ke variabel
		$username = $this->input->post('username');
		$pass = $this->input->post('pass');
		
		//muat file users_model.php dari folder models
		$this->load->model('users_model');
		
		//buat variabel untuk menampung data yang akan dikirim ke app android
		$result = new stdClass();
		
		if(!$this->users_model->is_username_pass_exists($username, $pass)){ //cek apakah username & password sudah ada
			//jika tidak ada, berarti username / password salah
			$result->status = 0;
			$result->msg = "Maaf, username / password salah";
			$result->username = $username;
			$result->pass = $pass;
		}else{
			//jika ada, kirimkan pesan sukses & data user untuk disimpan di aplikasi
			$a_user = $this->users_model->load_one_user($username, $pass);
			$result->status = 1;
			$result->msg = "Sukses masuk aplikasi";
			$result->a_user = $a_user;
		}
		
		echo json_encode($result);
	}
	
	//fungsi ini untuk menyimpan data pendaftaran user yg diinput di aplikasi android
	public function add_data(){
		
		//muat file data_pendaftaran_model.php dari folder models
		$this->load->model('data_pendaftaran_model');
		
		//buat variabel untuk menampung data yang akan dikirim ke app android
		$result = new stdClass();
		
		//tampung data dari app android ke variabel
		$nama = $this->input->post('nama');
		$noIdentitas = $this->input->post('noKTP');
		
		if($nama === FALSE || $noIdentitas === FALSE){
			//jika data tidak ada, berarti data tidak valid
			$result->status = 0;
			$result->msg = "Maaf, data tidak valid";
			$result->error = "";
			echo json_encode($result);
			die(); //stop fungsi sampai di sini
		}
		
		//cek apakah nomor identitas (ktp / nik) sudah ada di database
		if($this->data_pendaftaran_model->is_exists($noIdentitas)){
			//jika sudah ada, kirimkan data error
			$result->status = 0;
			$result->msg = "Nomor identitas (KTP / NIK) sudah ada di database";
			$result->error = "";
			echo json_encode($result);
			die();	//stop fungsi sampai di sini		
		}
		
		//men-setting opsi2 penyimpanan file gambar ktp
        $config['upload_path'] = './uploads/';//disimpan ke direktori uploads
        $config['allowed_types'] = 'jpg|jpeg|png|gif';//allowed type file
        $config['file_name'] = $_FILES['ktpFile']['name'];       
		
		$this->load->library('upload', $config); //memuat library untuk upload gambar sesuai settingan
		$this->upload->initialize($config); //menginisialisasi proses upload

        //mengecek apakah upload file berhasil atau tidak
        if ( ! $this->upload->do_upload('ktpFile')){
			//jika gagal, kirimkan pesan error
            $error = $this->upload->display_errors();
			$result->status = 0;
			$result->msg = "Maaf, gagal menyimpan foto identitas";
			$result->error = $error;
			echo json_encode($result);
			die(); //stop fungsi sampai di sini					
        }else{
            $data = array('upload_data' => $this->upload->data());
            $upload_data = $this->upload->data(); //Mengambil detail data yang di upload
            $picture = $upload_data['file_name'];//mengakses Nama File yang sudah diupload
			
			$dataDb = new stdClass();
			$dataDb->ktpPath	= "uploads/".$picture; //menampung lokasi penyimpanan file ktp

			//upload tandatanganFile begin===============================			
			$config['file_name'] = $_FILES['tandatanganFile']['name'];

			$this->upload->initialize($config); //menginisialisasi upload file tandatangan

			//mengecek apakah upload file berhasil atau tidak
			if ( ! $this->upload->do_upload('tandatanganFile')){
				$error = $this->upload->display_errors();
				$result->status = 0;
				$result->msg = "Maaf, gagal menyimpan tandatangan";
				$result->error = $error;
				echo json_encode($result);
				die();			
			}else{
				$data = array('upload_data' => $this->upload->data());
				$upload_data = $this->upload->data(); //Mengambil detail data yang di upload
				$picture = $upload_data['file_name'];//Nama File

				$dataDb->tandatanganPath	= "uploads/".$picture;  //menampung lokasi penyimpanan file ktp
				//upload tandatanganFile end=================================				
				
				$dataDb->noIdentitas		= $noIdentitas; //menampung nomor identitas
				$dataDb->nama				= $nama; //menampung nama
				
				//mengubah format tanggal lahir
				$tanggalLahir = $this->input->post("tanggalLahir");
				$tanggalLahirArr = explode("/", $tanggalLahir);
				$time = strtotime($tanggalLahirArr[0]."-".$tanggalLahirArr[1]."-".$tanggalLahirArr[2]);
				$tanggalLahir = date('Y-m-d',$time);				
				
				$dataDb->tanggalLahir		= $tanggalLahir;
				
				//menampung data2 yang dikirim dari app android
				$dataDb->phone 				= $this->input->post("phone");
				$dataDb->email				= $this->input->post("email");
				$dataDb->pekerjaan1 		= $this->input->post("pekerjaan1");
				$dataDb->pekerjaan2 		= $this->input->post("pekerjaan2");
				$dataDb->lokasiPekerjaan 	= $this->input->post("lokasiPekerjaan");
				$dataDb->upah 				= $this->input->post("penghasilanStr");
				$dataDb->kodePaket 			= $this->input->post("programStr");
				$dataDb->bulanIuran 		= $this->input->post("masaStr"); 
				$dataDb->sumberPembayaran 	= $this->input->post("pembayaranStr");
				
				//memasukkan data ke database
				$queryResult = $this->data_pendaftaran_model->insert($dataDb);
				
				//$queryResult adalah id dokumen yang baru dimasukkan
				if($queryResult > 0){ //jika id dokumen lebih besar dari 0
					//artinya berhasil menyimpan data
					$result->status = 1;
					$result->dataDb = $dataDb;
					$result->msg = "Sukses! data Anda berhasil tersimpan";
					$result->error = "";
				}else{
					$result->status = 0;
					$result->dataDb = $dataDb;
					$result->msg = "Maaf, gagal menyimpan seluruh data form";
					$result->error = "";
				}	
			}			
        }		
		
		echo json_encode($result);
	}
}
