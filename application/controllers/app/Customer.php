<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

	public function __construct() {
       parent::__construct();

       $this->load->model("Customer_model" , "customer");
    }

	public function index(){
		$this->data['website_title'] = "Customers | ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/customer";
		$this->data['countries_list'] = $this->countries_list();
		$this->data['customer_group_list']	= $this->customer->get_group();

		$this->data['config']["base_url"] = base_url("app/customer/") ;
		$this->data['config']["total_rows"] = $this->customer->get_customer(true);

		$this->pagination->initialize($this->data['config']);

		$this->data["links"] = $this->pagination->create_links();

		$customer_list = $this->customer->get_customer();

		foreach($customer_list as $key => $row){
			$customer_list[$key]->physical_country = $this->countries_list($row->physical_country);
			$customer_list[$key]->postal_country = $this->countries_list($row->postal_country);
			$customer_list[$key]->date_of_birth = date_of_birth($row->dob_day , $row->dob_month , $row->dob_year);
			$customer_list[$key]->gender = convert_gender($row->gender);
		}

		$this->data['customer_list'] = $customer_list;
		$this->load->view('backend/master' , $this->data);
	}

	public function add(){
		$this->form_validation->set_rules('first_name'		, 'Customer Name'			, 'trim|required');
		
		$dob = $this->input->post("date_of_birth");

		if($dob["dd"] OR $dob["mm"] OR $dob["yy"]){
			$this->form_validation->set_rules('date_of_birth[dd]'	, 'Day of Birth'	, 'trim|required|max_length[2]');
			$this->form_validation->set_rules('date_of_birth[mm]'	, 'Month of Birth'	, 'trim|required|max_length[2]');
			$this->form_validation->set_rules('date_of_birth[yy]'	, 'Year of Birth'	, 'trim|required|min_length[4]|max_length[4]');
		}

		if ($this->form_validation->run() == FALSE){ 

			$this->data['website_title'] = "Add Customers | ".$this->data['application_name'];
			$this->data['page_name'] = "Customers";
			$this->data['main_page'] = "backend/page/customer/add";

			$this->data['world_currency'] = $this->world_currency();
			$this->data['timezone_list'] = $this->timezone_list();
			$this->data['countries_list'] = $this->countries_list();
			$this->data['customer_group_list']	= $this->customer->get_group();

			$this->load->view('backend/master' , $this->data);

		}else{


			if($customer_id = $this->customer->add_customer()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a Customer');	

				redirect("app/customer/?customer_id=".$this->hash->encrypt($customer_id).'?submit=submit' , 'refresh');

			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

				redirect("app/customer/add-customer" , 'refresh');
			}

		}

	}

	public function import(){
		$this->data['website_title'] = "Import Customers | ".$this->data['application_name'];
		$this->data['page_name'] = "Customers";
		$this->data['main_page'] = "backend/page/customer/import";

		$this->load->view('backend/master' , $this->data);
	}

	public function groups(){
		$this->form_validation->set_rules('group_name'		, 'Group Name'	, 'trim|required');

		if ($this->form_validation->run() == FALSE){

			$this->data['website_title'] 		= "Customers Group| ".$this->data['application_name'];
			$this->data['page_name'] 			= "Customers";
			$this->data['main_page'] 			= "backend/page/customer/group";
			$this->data['customer_group_list']	= $this->customer->get_group();


			$this->load->view('backend/master' , $this->data);
			
		}else{

			if($group_id = $this->customer->add_group()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a Customer group');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

			}

			redirect("app/customer/groups" , 'refresh');

		}
	}
}
