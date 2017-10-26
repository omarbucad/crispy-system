<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public function index(){
		$this->data['website_title'] = "Customers | ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/customer";
		$this->data['countries_list'] = $this->countries_list();
		$this->load->view('backend/master' , $this->data);
	}

	public function add(){
		$this->data['website_title'] = "Add Customers | ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/add";

		$this->data['world_currency'] = $this->world_currency();
		$this->data['timezone_list'] = $this->timezone_list();
		$this->data['countries_list'] = $this->countries_list();

		$this->load->view('backend/master' , $this->data);
	}

	public function import(){
		$this->data['website_title'] = "Import Customers | ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/import";

		$this->load->view('backend/master' , $this->data);
	}

	public function groups(){
		$this->data['website_title'] = "Customers Group| ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/group";

		$this->load->view('backend/master' , $this->data);
	}
}
