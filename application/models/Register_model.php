<?php

class Register_model extends CI_Model {

    public function signup(){

        $this->db->trans_start();

        /*  USER INFORMATION  */
        $this->db->insert("user" ,[
            "display_name"  => $this->input->post("first_name").' '.$this->input->post("last_name") ,
            "username"      => $this->input->post("username"),
            "password"      => $this->input->post("password"),
            "email_address" => $this->input->post("email_address"),
            "role"          => "ADMIN" ,
            "created"       => time()
        ]);
        $user_id = $this->db->insert_id();

        /* USER TARGET SALES */

        $this->db->insert("user_target_sales" , [
            "user_id"       => $user_id ,
            "outlet_id"     => 0 ,
            "daily_target"  => 0.00 ,
            "weekly_target" => 0.00 ,
            "monthly_target"=> 0.00
        ]);

        /* STORE ADDRESS */

        $this->db->insert("store_address" , ["country" => $this->input->post("country") , "city" => $this->input->post("city")]);
        $physical_address_id = $this->db->insert_id();
        $this->db->insert("store_address" , ["country" => $this->input->post("country") , "city" => $this->input->post("city")]);
        $postal_address_id = $this->db->insert_id();
        $this->db->insert("store_address" , ["country" => $this->input->post("country") , "city" => $this->input->post("city")]);
        $outlet_physical_address_id = $this->db->insert_id();

        /* STORE CONTACT INFORMATION */

        $this->db->insert("store_contact" , [
            "first_name"    => $this->input->post("first_name") ,
            "last_name"     => $this->input->post("last_name") ,
            "email"         => $this->input->post("email_address") ,
            "phone"         => $this->input->post("phone")
        ]);

        $contact_id = $this->db->insert_id();


        /* STORE INFORMATION */
        $store_subdomain = str_replace(" ", "", $this->input->post("store_name"));
        $store_subdomain = strtolower($store_subdomain);

        $this->db->insert("store" , [
            "store_name"            => $this->input->post("store_name") ,
            "retailer_type"         => $this->input->post("retail_type") ,
            "user_id"               => $user_id ,
            "physical_address"      => $physical_address_id ,
            "postal_address"        => $postal_address_id ,
            "sku_generation_type"   => "GENERATE_BY_SEQUENCE_NUMBER",
            "current_sequence_sku"  => 1000 ,   
            "display_price_settings"=> "WT" ,
            "default_currency"      => $this->input->post("currency"),
            "contact_id"            => $contact_id ,
            "store_subdomain"       => $store_subdomain,
            "created"               => time()
        ]);
        $store_id = $this->db->insert_id();

        /*  SALES TAX INFORMATION   */
        $this->db->insert("store_sales_tax" , [
            "store_id"  => $store_id ,
            "tax_name"  => "No Tax" ,
            "tax_rate"  => 0 ,
            "deletable" => "NO" ,
            "created"   => time()
        ]);
        $sales_tax_id = $this->db->insert_id();


        /* STORE OUTLET */
        $this->db->insert("store_outlet" , [
            "store_id"              => $store_id ,
            "outlet_name"           => "Main Outlet" ,
            "order_number_prefixes" => "",
            "order_number"          => 1000,
            "sales_tax_id"          => $sales_tax_id,
            "negative_inventory"    => 0 ,
            "physical_address"      => $outlet_physical_address_id ,
            "deletable"             => "NO",
            "status"                => 1 ,
            "created"               => time()
        ]);
        $outlet_id = $this->db->insert_id();

        /* STORE REGISTER */

        $this->db->insert("store_register" , [
            "register_name"             => "Main Register" ,
            "cash_management"           => "CASH" ,
            "select_user_for_next_sale" => 0 ,
            "email_reciept"             => 1 ,
            "print_reciept"             => 1 ,
            "ask_for_a_note"            => 2 , /*0 - Never | 1 - on save/layby/Account/Return | 2 - On all sales*/
            "print_note_on_reciept"     => 1 ,
            "show_discount_on_reciept"  => 1 ,
            "status"                    => 1 ,
            "created"                   => time() 
        ]);
        $register_id = $this->db->insert_id();


        /* STORE PLAN */

        $this->db->insert("user_plan" , [
            "user_id" => $user_id ,
            "plan_type" => "TRIAL" ,
            "plan_created" => time() ,
            "plan_expiration" => strtotime("+1 month") ,
            "who_updated" => $user_id ,
            "ip_address" => $this->input->ip_address() ,
            "active" => 1,
            "updated" => time()
        ]);

        /* UPDATE USER */
        $this->db->where("user_id" , $user_id)->update("user" , [
            "outlet_id" => 0 , /* 0 - All outlet */ 
            "store_id" => $store_id
        ]);
        $this->db->where("store_id" , $store_id)->update("store" , [
            "main_outlet_id" => $outlet_id
        ]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return [
                "user_id"       => $user_id ,
                "store_id"      => $this->encryption->encrypt($store_id) ,
                "store_name"    => $this->input->post("store_name")
            ];
        }
    }

    public function signin($user){
        $this->db->select("u.user_id , u.display_name , u.email_address , u.role , u.store_id , u.outlet_id");
        $this->db->select("up.plan_type , s.store_name");
        $this->db->join("user_plan up" , "up.user_id = u.user_id");
        $this->db->join("store s" , "s.store_id = u.store_id");

        if(is_array($user)){
            $this->db->where("u.username" , $user['username']);
            $this->db->where("u.password" , md5($user['password']));
            $this->db->where("u.store_id" , $this->encryption->decrypt($this->input->cookie("store_id")));
        }else{
            $this->db->where("u.user_id" , $user);
        }

        $result = $this->db->where("up.active" , 1)->get("user u")->row();

        if($result){
            $this->login_trail($result->user_id);
            $this->session->set_userdata("user" , $result);
        }

        return $result;
    }

    public function checkStoreName($storeName){
        $this->db->select("store_id , store_name");
        $this->db->where("store_name" , $storeName);
        $result = $this->db->get("store")->row();

        if($result){
            return ["store_id" => $this->encryption->encrypt($result->store_id) , "store_name" => $result->store_name];
        }

        return false;
    }

    private function login_trail($user_id){
        $this->db->insert("login_trail" , [
            "user_id"       => $user_id ,
            "ip_address"    => $this->input->ip_address() ,
            "user_agent"    => $_SERVER['HTTP_USER_AGENT'] ,
            "login_time"    => time()
        ]);
    }
}