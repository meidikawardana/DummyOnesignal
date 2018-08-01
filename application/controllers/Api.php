<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//class ini untuk menyediakan data untuk aplikasi android
class Api extends CI_Controller {
	
	public function send_notification(){

		$user_id = $this->input->post('user_id');
		$title = $this->input->post('title');		
		$message = $this->input->post('message');
		
		$this->load->model('users_model');
		$a_user = $this->users_model->load_one_user_by_id($user_id);
		
	
		$heading = array(
		   "en" => $title
		);		
	
		$content = array(
			"en" => $message
			);
		
		$fields = array(
			'app_id' => "b8f1cea4-dc44-40dc-b696-593522ad2d99",
			'include_player_ids' => array(
				$a_user->onesignal_userid
			),
			// 'data' => array("foo" => "bar"),
			'contents' => $content
			, 'headings' => $heading
		);
		
		$fields = json_encode($fields);    	
    	// print($fields);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic MzQ3ZjYxYjQtODU1My00MGRkLWFkNGMtZDA5YjcxMzZiYmE4'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		echo json_encode($response);
	}
}
