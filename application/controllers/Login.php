<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct() {
       parent::__construct();
       $this->load->helper('cookie');
       $this->load->model('register_model', 'register');

    }
	public function index(){

		$this->data['cookie_outlet'] = $this->input->cookie("store_id");
		$this->load->view('frontend/login' , $this->data);
	}
	public function forgot_password(){
		echo "FORGOT PASSWORD";
	}
	public function do_login(){

		if($this->register->signin($this->input->post())){
			$this->session->set_flashdata('status' , 'success');
			redirect('/app/welcome', 'refresh');

		}else{
			$this->session->set_flashdata('status' , 'failed');
			$this->session->set_flashdata('message' , 'Incorrect Username or Password');

			redirect('/login', 'refresh');
		}
	}
	public function set_store_name(){
		if($store_data = $this->register->checkStoreName($this->input->post("store_name"))){

			$this->input->set_cookie("store_id" , $store_data['store_id']);
			$this->input->set_cookie("store_name" , $store_data['store_name']);

			$this->session->set_flashdata('status' , 'success');
			redirect('/login', 'refresh');

		}else{

			$this->session->set_flashdata('status' , 'failed');
			$this->session->set_flashdata('message' , 'Incorrect Store Name');

			redirect('/login', 'refresh');
		}
	}
	public function logout(){
		$this->session->set_flashdata('status' , 'success');
		$this->session->set_flashdata('message' , 'You have been Logout');

		redirect('/login', 'refresh');
	}
}
