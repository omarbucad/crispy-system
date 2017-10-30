<?php

class Register_model extends CI_Model {

    public function signup(){

        $this->db->trans_start();

        // ------------ 
        $user_data = array(
            "first_name" => $this->input->post("first_name") ,
            "last_name" => $this->input->post("last_name") ,
            "username" => $this->input->post("username") , 
            "email_address" => $this->input->post("email_address") ,
            "password" => $this->input->post("password") ,
            "ip_address" => $this->input->ip_address() ,
            "subdomain_unique_address" => str_replace(" ", "_", $this->input->post("store_name")).'_'.time() ,
            "role" => "ADMIN" ,
            "created" => time()
        );

        $this->db->insert("user" , $user_data);
        $user_id = $this->db->insert_id();
        // ------------ 


        // ------------ 

        $user_plan = array(
            "user_id" => $user_id ,
            "plan_type" => "TRIAL" ,
            "plan_created" => time() ,
            "plan_expiration" => strtotime("+1 month") ,
            "who_updated" => $user_id ,
            "ip_address" => $this->input->ip_address() ,
            "active" => 1,
            "updated" => time()
        );
        $this->db->insert("user_plan" , $user_plan);

        // ------------ 


        // ------------ 
        $store_data = array(
            "store_name" => $this->input->post("store_name") ,
            "retailer_type" => $this->input->post("retail_type") ,
            "default_currency" => $this->input->post("currency") ,
            "user_id" => $user_id,
            "created" => time(),
            "main_outlet" => 1
        );
        $this->db->insert("store" , $store_data);
        $store_id = $this->db->insert_id();
        // ------------ 


        // ------------ 
        $this->db->insert("store_address" , array("street1" => ""));
        $physical_address = $this->db->insert_id();

        $this->db->insert("store_address" , array("street1" => ""));
        $postal_address = $this->db->insert_id();

        $this->db->insert("store_contact" , ["store_id" => $store_id]);
        $contact_id = $this->db->insert_id();

        $this->db->where("store_id" , $store_id)->update("store" , ["physical_address" => $physical_address , "default_address" => $postal_address , "contact_id" => $contact_id]);
        // ------------ 


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $user_id;
        }
    }

    public function signin($user_id){
        $this->db->select("u.user_id , u.first_name , u.last_name , CONCAT(u.first_name , ' ' ,u.last_name) as full_name , u.email_address , u.role");
        $this->db->select("up.plan_type , s.store_id as main_outlet , s.retailer_type");
        $this->db->join("user_plan up" , "up.user_id = u.user_id");
        $this->db->join("store s" , "s.user_id = u.user_id");
        $result = $this->db->where("u.user_id" , $user_id)->where("up.active" , 1)->where("s.main_outlet" , 1)->get("user u")->row();

        $this->session->set_userdata("user" , $result);
    }
}