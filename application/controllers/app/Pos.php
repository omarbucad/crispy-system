<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends MY_Controller {

	public function __construct() {
       parent::__construct();

       $this->load->model("pos_model" , "pos");
    }

    public function sell(){
    	$this->data['website_title'] = "Sell | ".$this->data['application_name'];
  		$this->data['page_name'] = "Sell";
  		$this->data['main_page'] = "backend/page/pos/sell";

  		$this->load->view('backend/master' , $this->data);
    }
}