<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index(){
		$this->data['main_page'] = "backend/page/dashboard/dashboard";
		$this->load->view('backend/master' , $this->data);
	}
}
