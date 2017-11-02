<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends MY_Controller {
	public function __construct() {
       parent::__construct();

       $this->load->model("Store_model" , "store");
    }


	public function general(){
		$this->data['website_title'] = "Setup - General Information | Accounts Package";
		$this->data['page_name'] = "General Setup";
		$this->data['main_page'] = "backend/page/setup/general";
		$this->data['world_currency'] = $this->world_currency();
		$this->data['timezone_list'] = $this->timezone_list();
		$this->data['countries_list'] = $this->countries_list();
		$this->data['general_information'] = $this->store->get_general_setup();

		$this->load->view('backend/master' , $this->data);
	}

	public function general_update(){
		if($this->input->post()){

			if($this->store->update_general()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Updated');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Server Timeout');	
			}
		}

		redirect("app/setup/general" , 'refresh');
	}

	public function account($type){
		if($type == ""){
			redirect('/app/setup/account/manage', 'refresh');
		}

		$this->data['website_title'] = "Setup - Account | Accounts Package";
		$this->data['page_name'] = "Account";
		$this->data['main_page'] = "backend/page/setup/account";
		$this->data['setup_page'] = $type; 
		$this->load->view('backend/master' , $this->data);
	}

	public function add_users(){
		$this->data['website_title'] = "Setup - Add Users | Accounts Package";
		$this->data['page_name'] = "Users";
		$this->data['main_page'] = "backend/page/setup/add_users";
		$this->load->view('backend/master' , $this->data);
	}

	public function users(){
		$this->data['website_title'] = "Setup - Users | Accounts Package";
		$this->data['page_name'] = "Users";
		$this->data['main_page'] = "backend/page/setup/users";
		$this->load->view('backend/master' , $this->data);
	}

	public function roles(){
		$this->data['website_title'] = "Setup - Users | Accounts Package";
		$this->data['page_name'] = "Users";
		$this->data['main_page'] = "backend/page/setup/roles";
		$this->load->view('backend/master' , $this->data);
	}

	public function sales_tax(){
		$this->data['website_title'] = "Setup - Sales Tax | Accounts Package";
		$this->data['page_name'] = "Sales Tax";
		$this->data['main_page'] = "backend/page/setup/sales_tax";
		$this->load->view('backend/master' , $this->data);
	}
}
