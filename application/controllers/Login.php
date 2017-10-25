<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function __construct() {
       parent::__construct();

    }
	public function index(){
		$this->load->view('frontend/login' , $this->data);
	}
	public function forgot_password(){
		echo "FORGOT PASSWORD";
	}
	public function do_login(){
		print_r_die($this->input->post("username"));
	}
}
