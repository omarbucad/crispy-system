<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setup extends MY_Controller {
	public function __construct() {
       parent::__construct();

       $this->load->model("Store_model" , "store");
       $this->load->model("Register_model" , "register");
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

		$this->form_validation->set_rules('username'		, 'Username'			, 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('display_name'	, 'Display Name'		, 'trim|required|min_length[2]|max_length[15]');
		$this->form_validation->set_rules('email'			, 'Email Address'		, 'trim|required|valid_email');
		$this->form_validation->set_rules('outlet_id'		, 'Outlet'				, 'trim|required');
		$this->form_validation->set_rules('role'			, 'Role'				, 'trim|required');
		$this->form_validation->set_rules('password'		, 'Password'			, 'trim|required|md5');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password'	, 'trim|required|matches[password]|md5');


		if ($this->form_validation->run() == FALSE){

			$this->data['website_title'] = "Setup - Add Users | Accounts Package";
			$this->data['page_name'] = "Users";
			$this->data['main_page'] = "backend/page/setup/add_users";
			$this->load->view('backend/master' , $this->data);

		}else{

			if($id = $this->register->add_user()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'New User has been Added');
				$id = $this->hash->encrypt($id);

				redirect("app/setup/users/view/?id=".$id , 'refresh');	

			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Server Timeout');	

				redirect("app/setup/users/add" , 'refresh');
			}
		}

	}

	public function users(){
		$this->data['website_title'] = "Setup - Users | Accounts Package";
		$this->data['page_name'] = "Users";
		$this->data['main_page'] = "backend/page/setup/users";
		$this->data['user_list'] = $this->register->get_user();
		$this->load->view('backend/master' , $this->data);
	}

	public function view_users(){
		echo $id = $this->hash->decrypt($this->input->get("id"));
	}

	public function update_target(){
		if($this->input->post()){
			$id = $this->hash->decrypt($this->input->post("id"));
			$type = $this->input->post("type");
			$value = $this->input->post("value");

			switch ($type) {
				case 'daily_target':
					$this->db->where("user_id" , $id)->update("user_target_sales" , ["daily_target" => $value]);
					break;
				case 'weekly_target':
					$this->db->where("user_id" , $id)->update("user_target_sales" , ["weekly_target" => $value]);
					break;
				case 'monthly_target':
					$this->db->where("user_id" , $id)->update("user_target_sales" , ["monthly_target" => $value]);
					break;
				default:
					# code...
					break;
			}
		}
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
		$this->data['sales_tax_list'] = $this->store->get_sales_tax();
		$this->data['outlet_list']	= $this->store->get_outlet();
		$this->data['group_sales_tax_list'] = $this->store->get_group_tax();
		$this->load->view('backend/master' , $this->data);
	}

	public function add_sales_tax(){
		if($id = $this->store->add_sales_tax()){
			$this->session->set_flashdata('status' , 'success');	
			$this->session->set_flashdata('message' , 'New Tax sales Added');	
		}else{
			$this->session->set_flashdata('status' , 'error');
			$this->session->set_flashdata('message' , 'Server Timeout');	
		}

		redirect("app/setup/sales-taxes" , 'refresh');
	}
	public function add_group_sales_tax(){
		$this->form_validation->set_rules('tax_group_name'		, 'Retail Type'			, 'trim|required');
		$this->form_validation->set_rules('sales_tax_id[0]'		, 'Sale Tax'			, 'trim|required');
		$this->form_validation->set_rules('sales_tax_id[1]'		, 'Sale Tax'			, 'trim|required');

		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('status' , 'error');
			$this->session->set_flashdata('message' , "Please input all the fields");	
		}else{
			if($data = $this->store->add_sales_tax_group()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'New Group Tax sales Added');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Server Timeout');	
			}
		}

		redirect("app/setup/sales-taxes" , 'refresh');
	}
	public function outlet(){
		echo $this->hash->decrypt($this->input->get("id"));
	}
	public function add_outlet(){

		$this->form_validation->set_rules('outlet_name'		, 'Outlet Name'			, 'trim|required');

		if($this->form_validation->run() == FALSE){

			$this->data['website_title'] = "Setup - Add Outlet | Accounts Package";
			$this->data['page_name'] = "Add Outlet";
			$this->data['main_page'] = "backend/page/setup/add_outlet";
			$this->data['timezone_list'] = $this->timezone_list();
			$this->data['countries_list'] = $this->countries_list();
			$this->data['default_sales_tax_list'] = $this->store->get_default_salestax_dropdown();

			$this->load->view('backend/master' , $this->data);

		}else{
			if($id = $this->store->add_outlet()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'New Store Outlet has been Added');	

				redirect("app/setup/outlet/?id=".$this->hash->encrypt(urlencode($id)) , 'refresh');

			}else{

				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Server Timeout');

				redirect("app/setup/add-outlet" , 'refresh');	
			}
		}
	}
	public function add_register(){
		$outlet_id = $this->hash->decrypt($this->input->get("id"));

		$this->form_validation->set_rules('register_name'		, 'Register Name'			, 'trim|required');

		if($this->form_validation->run() == FALSE){ 
			$this->data['website_title'] = "Setup - Add Register | Accounts Package";
			$this->data['page_name'] = "Cash Register";
			$this->data['main_page'] = "backend/page/setup/add_register";
			$this->data['outlet_name']	= $this->store->get_outlet_by_id($outlet_id , "outlet_name")->outlet_name;

			$this->load->view('backend/master' , $this->data);
		}else{

			if($id = $this->store->add_register($outlet_id)){

				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'New Register has been Added');	

				redirect("app/setup/outlets-and-registers" , 'refresh');

			}else{

				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Server Timeout');

				redirect("app/setup/add-register" , 'refresh');	
			}
		}

		
	}
	public function outlets_and_registers(){
		$this->data['website_title'] = "Setup - Outlets And Registers | Accounts Package";
		$this->data['page_name'] = "Outlets and Registers";
		$this->data['main_page'] = "backend/page/setup/outlet_and_registers";
		$this->data['outlet_list'] = $this->store->get_outlet_and_registers();
		$this->load->view('backend/master' , $this->data);
	}
}
