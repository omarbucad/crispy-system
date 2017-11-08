<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index(){

		$this->data['page_name'] = $this->data['session_data']->store_name;
		$this->data['main_page'] = "backend/page/dashboard/first_time";
		$this->load->view('backend/master' , $this->data);
	}
}
