<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
       parent::__construct();

       $this->load->model("Product_model" , "product");
    }

	public function index(){
		$this->data['page_name'] = "Home";
		$this->data['main_page'] = "backend/page/dashboard/dashboard";
		$this->load->view('backend/master' , $this->data);
	}

	public function tags(){
		$this->data['website_title'] = "Product - Tags | Accounts Package";
		$this->data['page_name'] = "Product Tags";
		$this->data['main_page'] = "backend/page/product/tags";
		$this->data['product_tag_list'] = $this->product->get_tag();

		$this->load->view('backend/master' , $this->data);
	}

	public function add_tag(){

		if($this->input->post()){

			if($this->product->add_tag()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a new Product Tag');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	
			}
		}

		redirect("app/product/tags" , 'refresh');
	}

	public function brands(){
		$this->data['website_title'] = "Product - Brands | Accounts Package";
		$this->data['page_name'] = "Brands";
		$this->data['main_page'] = "backend/page/product/brands";
		$this->data['product_brand_list'] = $this->product->get_brand();

		$this->load->view('backend/master' , $this->data);
	}

	public function add_brand(){
		if($this->input->post()){

			if($this->product->add_brand()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a new Brand');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	
			}
		}

		redirect("app/product/brands" , 'refresh');
	}
}
