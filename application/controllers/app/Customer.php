<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public function index(){
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/customer";
		$this->data['countries_list'] = $this->countries_list();
		$this->load->view('backend/master' , $this->data);
	}
}
