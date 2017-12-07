<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MY_Controller {

	public function __construct() {
       parent::__construct();

       $this->load->model("Product_model" , "product");
    }

	public function index(){
		$this->data['website_title'] = "Products | Accounts Package";
		$this->data['page_name'] = "Product";
		$this->data['main_page'] = "backend/page/product/product";
		$this->data['product_type_list'] = $this->product->get_type();
		$this->data['product_brand_list'] = $this->product->get_brand();
		$this->data['supplier_list'] = $this->product->get_supplier();
		$this->data['product_tag_list'] = $this->product->get_tag();
		$this->data['product_list'] = $this->product->get_product();
		$this->data['product_status'] = $this->product->get_product_status();

		$this->load->view('backend/master' , $this->data);
	}

	public function add(){

		$this->form_validation->set_rules('product_name'		, 'Product Name'			, 'trim|required');

		if ($this->form_validation->run() == FALSE){ 

			$this->data['website_title'] = "Products - Add | Accounts Package";
			$this->data['page_name'] = "Product";
			$this->data['main_page'] = "backend/page/product/add_product";
			$this->data['product_type_list'] = $this->product->get_type();
			$this->data['product_brand_list'] = $this->product->get_brand();
			$this->data['supplier_list'] = $this->product->get_supplier();
			$this->data['default_sales_tax_list'] = $this->store->get_default_salestax_dropdown();
			$this->data['product_tag_list'] = $this->product->get_tag();
			$this->data['store_settings'] = $this->store->get_store_settings();
			$this->data['outlet_list'] = $this->store->get_outlet();
			$this->data['attribute_list'] = $this->product->get_variant_attribute();
			$this->data['product_list'] = $this->product->get_product_list();
			$this->data['product_list_json'] = json_encode($this->data['product_list']);
			$this->data['outlet_list_json'] = json_encode($this->data['outlet_list']);
			$this->data['default_sales_tax_list_json'] = json_encode($this->data['default_sales_tax_list']);


			$this->load->view('backend/master' , $this->data);
		}else{

			if($product_id = $this->product->add_product()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a new Product Tag');	

				redirect("app/product/?id=".$product_id , 'refresh');
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

				redirect("app/product/add" , 'refresh');
			}
		}

	}

	public function view($product_id){
		$product_id = $this->hash->decrypt($product_id);

		$this->data['outlet_list'] = $this->store->get_outlet();
		$this->data['product_information'] = $this->product->get_product_by_id($product_id);
		$this->data['website_title'] = "View Product | Accounts Package";
		$this->data['page_name'] = "Product";
		$this->data['main_page'] = "backend/page/product/view_product";

		$this->load->view('backend/master' , $this->data);
	}

	//STOCK CONTROL

	public function consignment(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Stock Control";
		$this->data['main_page'] = "backend/page/product/consignment";

		$this->load->view('backend/master' , $this->data);
	}

	public function order_stock(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Order Stock";
		$this->data['main_page'] = "backend/page/product/order_stock";
		$this->data['outlet_list'] = $this->store->get_outlet();
		$this->data['supplier_list'] = $this->product->get_supplier();
		$this->data['store_settings'] = $this->store->get_store_settings();

		$this->load->view('backend/master' , $this->data);
	}

	public function return_stock(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Return Stock";
		$this->data['main_page'] = "backend/page/product/return_stock";
		$this->data['outlet_list'] = $this->store->get_outlet();
		$this->data['supplier_list'] = $this->product->get_supplier();
		$this->data['store_settings'] = $this->store->get_store_settings();

		$this->load->view('backend/master' , $this->data);
	}

	public function inventory_count(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Inventory Count";
		$this->data['main_page'] = "backend/page/product/inventory_count";
		$this->data['no_result_found'] = "You have no due inventory counts";

		$this->load->view('backend/master' , $this->data);
	}

	public function inventory_count_upcoming(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Inventory Count";
		$this->data['main_page'] = "backend/page/product/inventory_count";
		$this->data['no_result_found'] = "You have no upcoming inventory counts";

		$this->load->view('backend/master' , $this->data);
	}

	public function inventory_count_completed(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Inventory Count";
		$this->data['main_page'] = "backend/page/product/inventory_count";
		$this->data['no_result_found'] = "You have no upcoming inventory counts";

		$this->load->view('backend/master' , $this->data);
	}

	public function inventory_count_cancelled(){
		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Inventory Count";
		$this->data['main_page'] = "backend/page/product/inventory_count";
		$this->data['no_result_found'] = "You have no upcoming inventory counts";

		$this->load->view('backend/master' , $this->data);
	}

	public function inventory_count_create(){
		$this->form_validation->set_rules('start_date'		, 'Start Date'			, 'trim|required');


		if ($this->form_validation->run() == FALSE){ 
			$this->data['website_title'] = "Stock Control | Accounts Package";
			$this->data['page_name'] = "Inventory Count";
			$this->data['main_page'] = "backend/page/product/inventory_create";
			$this->data['outlet_list'] = $this->store->get_outlet();
			$this->data['product_list'] = $this->product->get_product_list();

			$this->load->view('backend/master' , $this->data);
		}else{

			if($count_id = $this->product->create_stock_count()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Scheduled a Inventory Count');	
				
				if($this->input->post("submit_input") == "start_count"){
					redirect("app/product/inventory-count/start/".$count_id , 'refresh');
				}else{
					redirect("app/product/inventory-count/?inventory_count=".$count_id , 'refresh');
				}
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

				redirect("app/product/inventory-count/create", 'refresh');
			}
		} 
	
	}

	public function inventory_count_start($count_id){
		$count_id = $this->hash->decrypt($count_id);

		$this->data['website_title'] = "Stock Control | Accounts Package";
		$this->data['page_name'] = "Inventory Count";
		$this->data['main_page'] = "backend/page/product/inventory_start";
		$this->data['inventory_information'] = $this->product->get_stock_count_by_id($count_id);

		//print_r_die($this->data['inventory_information']);

		$this->load->view('backend/master' , $this->data);
	}

	// PRODUCT TAGS
	public function tags(){
		$this->data['website_title'] = "Product - Tags | Accounts Package";
		$this->data['page_name'] = "Product Tags";
		$this->data['main_page'] = "backend/page/product/tags";
		$this->data['product_tag_list'] = $this->product->get_tag();

		$this->load->view('backend/master' , $this->data);
	}

	public function add_tag(){

		if($this->input->post("ajax")){
			$this->product->add_tag();
		}else{
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

		
	}

	// PRODUCT BRANDS
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

	// SUPPLIERS
	public function supplier(){
		$this->data['website_title'] = "Product - Supplier | Accounts Package";
		$this->data['page_name'] = "Product Supplier";
		$this->data['main_page'] = "backend/page/product/supplier";
		$this->data['supplier_list'] = $this->product->get_supplier();
		$this->load->view('backend/master' , $this->data);
	}

	public function view_supplier($id){
		$supplier_id = $this->hash->decrypt($id);

		$this->data['website_title'] = "Product - Supplier | Accounts Package";
		$this->data['page_name'] = "Product Supplier";
		$this->data['main_page'] = "backend/page/product/view_supplier";
		$this->data['supplier_information'] = $this->product->getSupplierById($supplier_id);


		$this->load->view('backend/master' , $this->data);

	}

	public function add_supplier(){

		$this->form_validation->set_rules('supplier_name'		, 'Supplier Name'			, 'trim|required');
		$this->form_validation->set_rules('default_markup'		, 'Default Markup'			, 'trim|required');
		$this->form_validation->set_rules('first_name'			, 'Contact Name'			, 'trim|required');

		if ($this->form_validation->run() == FALSE){ 

			$this->data['website_title'] = "Product - Add Supplier | Accounts Package";
			$this->data['page_name'] = "Product Supplier";
			$this->data['main_page'] = "backend/page/product/add_supplier";
			$this->data['countries_list'] = $this->countries_list();

			$this->load->view('backend/master' , $this->data);
		}else{

			if($supplier_id = $this->product->add_supplier()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a new Supplier');	

				redirect("app/product/supplier" , 'refresh');
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

				redirect("app/product/supplier/add" , 'refresh');
			}

			
		}

	}

	// TYPES

	public function type(){
		$this->data['website_title'] = "Product - Types | Accounts Package";
		$this->data['page_name'] = "Product Types";
		$this->data['main_page'] = "backend/page/product/types";
		$this->data['product_type_list'] = $this->product->get_type();
		$this->load->view('backend/master' , $this->data);
	}

	public function add_type(){
		if($this->input->post()){

			if($this->product->add_product_type()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a new Product Type');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	
			}
		}

		redirect("app/product/type" , 'refresh');
	}


	// ATTRIBUTE

	public function attribute(){

	}

	public function add_attribute(){
		if($this->input->post()){ 
			if($attribute_id = $this->product->add_attribute()){
				echo json_encode(["status" => true , "id" => $attribute_id , "value" => $this->input->post("attribute_name")]);
			}else{
				echo json_encode(["status" => false , "message" => "Something went wrong"]);
			}
		}
	}
}
