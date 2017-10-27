<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {
	
	public function __construct() {
       parent::__construct();

       $this->load->model('register_model', 'register');
    }

	public function index(){
		$this->load->view('frontend/index' , $this->data);
	}

	public function register(){

		$this->form_validation->set_rules('retail_type'		, 'Retail Type'			, 'trim|required');
		$this->form_validation->set_rules('store_quantity'	, 'Store Quantity'		, 'trim|required');
		$this->form_validation->set_rules('store_name'		, 'Store Name'			, 'trim|required');
		$this->form_validation->set_rules('first_name'		, 'First Name'			, 'trim|required');
		$this->form_validation->set_rules('email_address'	, 'Email Address'		, 'trim|required|valid_email');
		$this->form_validation->set_rules('username'		, 'Username'			, 'trim|required|min_length[3]|max_length[15]');
		$this->form_validation->set_rules('password'		, 'Password'			, 'trim|required|min_length[5]');
		$this->form_validation->set_rules('city'			, 'City'				, 'trim|required');
		$this->form_validation->set_rules('country'			, 'Country'				, 'trim|required');
		$this->form_validation->set_rules('phone'			, 'Phone'				, 'trim|required');


		if ($this->form_validation->run() == FALSE){
			$this->data['website_title'] = "Sign up for free trial | ".$this->data['application_name'];
			$this->data['world_currency'] = $this->world_currency();
			$this->data['countries_list'] = $this->countries_list();
		}else{

			if($user_id = $this->register->signup()){
				$this->session->set_flashdata('status' , 'success');
				$this->register->signin($user_id);
				redirect('/app/welcome', 'refresh');
			}else{
				$this->session->set_flashdata('status' , 'failed');
				redirect('/welcome/register', 'refresh');
			}

		}

		$this->load->view('frontend/register' , $this->data);
	}

}
