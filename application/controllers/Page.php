<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class ini untuk menampilkan halaman2 ke user
class Page extends CI_Controller {
	
	public function index(){ //ketika halaman ini diakses
	
		$this->load->model('users_model');
		
		$data = array();
		$data['users'] = $this->users_model->load();
	
		$this->load->view('main_view', $data); //tampilkan file login.php di folder view
	}	
}