<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = array();

    public function __construct() {
       parent::__construct();

       $this->data['website_title'] = "Accounts Package";
       $this->data['application_name'] = "Accounts Package";
       $this->data['version'] = "1.0";
       $this->data['year'] = date("Y");
       $this->data['csrf_token_name'] = $this->security->get_csrf_token_name();
       $this->data['csrf_hash'] = $this->security->get_csrf_hash();

    }

}