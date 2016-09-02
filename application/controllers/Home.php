<?php
include_once('yelp_api.php'); 

class Home extends CI_Controller {

	public function index(){
		$data = [];
		$data['title'] = 'WIIT | Where Is It!?';

		if( isset($_POST['term']) && isset($_POST['location'])){
			$term = $_POST['term'];
			$location = $_POST['location'];
			$offset = isset($POST['offset']) ? $_POST['offset'] : '0';
			$data['response'] = json_decode(query_api($term, $location, $offset));
		} 

		$this->load->view('layout/header',$data);
		$this->load->view('index');
		$this->load->view('layout/footer');
	}
}

