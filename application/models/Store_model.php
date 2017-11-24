<?php

class Store_model extends CI_Model {

    public function get_general_setup(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("s.store_name , s.default_currency , s.sku_generation_type , s.current_sequence_sku , s.display_price_settings , s.physical_address , s.postal_address , s.contact_id");
        $this->db->select("tc.first_name as contact_first_name , tc.last_name as contact_last_name , tc.email as contact_email , tc.phone as contact_phone , tc.website as contact_website , tc.field_1 , tc.field_2");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country , sa1.timezone");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->join("store_contact tc" , "tc.store_contact_id = s.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = s.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = s.postal_address");
        $result = $this->db->where("s.store_id" , $store_id)->get("store s")->row();

        return $result;
    }
    
    public function update_general(){

        $store_id = $this->data['session_data']->store_id;

        $this->db->trans_start();

        $physical = $this->input->post("physical");
        $physical["timezone"] = $this->input->post("timezone");
        $postal = $this->input->post("postal");
        $postal["timezone"] = $this->input->post("timezone");


        $this->db->where("store_address_id" , $this->input->post("physical_address_id"))->update("store_address" , $physical);
        $this->db->where("store_address_id" , $this->input->post("postal_address_id"))->update("store_address" , $postal);
        $this->db->where("store_contact_id" , $this->input->post("contact_id"))->update("store_contact" , [
            "first_name"    => $this->input->post("contact_first_name") , 
            "last_name"     => $this->input->post("contact_last_name") , 
            "email"         => $this->input->post("contact_email") , 
            "phone"         => $this->input->post("contact_phone_number") , 
            "website"       => $this->input->post("contact_website") , 
            "field_1"       => $this->input->post("contact_field_1") , 
            "field_2"       => $this->input->post("contact_field_2") 
        ]);
        $this->db->where("store_id" , $store_id)->update("store" , [
            "store_name"            => $this->input->post("store_name") ,
            "default_currency"      => $this->input->post("default_currency") ,
            "sku_generation_type"   => $this->input->post("sku_generation_type") ,
            "current_sequence_sku"  => $this->input->post("current_sequence_sku") ,
            "display_price_settings"=> $this->input->post("display_price_settings")
        ]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function get_sales_tax(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("st.sales_tax_id , st.tax_name , st.tax_rate , st.deletable");
        $this->db->where("st.deleted IS NULL");
        $result = $this->db->where("st.store_id" , $store_id)->order_by("st.tax_rate" , "ASC")->get("store_sales_tax st")->result();

        foreach($result as $key => $row){
            $result[$key]->sales_tax_id = urlencode($this->hash->encrypt($row->sales_tax_id));
        }
  
        return $result;
    }

    public function get_outlet(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("so.outlet_id , so.outlet_name , so.sales_tax_id , so.deletable");
        $result = $this->db->where("so.store_id" , $store_id)->order_by("outlet_name" , "ASC")->get("store_outlet so")->result();

        foreach($result as $key => $row){
            $result[$key]->outlet_id = urlencode($this->hash->encrypt($row->outlet_id));

            $s = explode("|", $row->sales_tax_id);
            
            if($s[0] == "S"){
                $sales_tax = $this->db->select("CONCAT(st.tax_name , ' ( ' , st.tax_rate , '% )') as tax_name , tax_rate")->where("sales_tax_id" , $s[1])->get("store_sales_tax st")->row();
                $result[$key]->tax_name = $sales_tax->tax_name;
                $result[$key]->tax_rate = $sales_tax->tax_rate;
                
            }else{
                $sales_group = $this->db->select("tax_sales_group_name , sales_tax_id ")->where("sales_tax_group_id" , $s[1])->get("store_sales_tax_group")->row();
                $tax_id = $this->db->select_sum("tax_rate")->where_in("sales_tax_id" , json_decode($sales_group->sales_tax_id))->get("store_sales_tax")->row();
                $result[$key]->tax_name = $sales_group->tax_sales_group_name.' ( '.$tax_id->tax_rate.' % )';
                $result[$key]->tax_rate = $tax_id->tax_rate;
            }

        }
        
        return $result;
    }

    public function get_group_tax(){
        $store_id = $this->data['session_data']->store_id;
        $this->db->select("sales_tax_group_id , tax_sales_group_name , sales_tax_id");
        $result = $this->db->where("store_id" , $store_id)->order_by("tax_sales_group_name" , "ASC")->get("store_sales_tax_group")->result();

        foreach($result as $key => $row){

            $this->db->select("st.tax_name , st.tax_rate");
            $r = $this->db->where_in("sales_tax_id" , json_decode($row->sales_tax_id))->get("store_sales_tax st")->result();
            foreach($r as $x){
                if(isset($result[$key]->sales_tax_group_rate)){
                    $result[$key]->sales_tax_group_rate += $x->tax_rate;
                }else{
                    $result[$key]->sales_tax_group_rate = $x->tax_rate;
                }
            }
            $result[$key]->sales_tax_count = count($r);
            $result[$key]->tax_sales = $r;
            $result[$key]->sales_tax_group_id = urlencode($this->hash->encrypt($row->sales_tax_group_id));
        }

        return $result;
    }

    public function add_sales_tax(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("store_sales_tax" , [
            "store_id"  => $store_id ,
            "tax_name"  => $this->input->post("tax_name") ,
            "tax_rate"  => $this->input->post("tax_rate") ,
            "deletable" => "YES" ,
            "created"   => time()
        ]);

        return $this->db->insert_id();
    }

    public function add_sales_tax_group(){
        $store_id = $this->data['session_data']->store_id;
        $this->db->insert("store_sales_tax_group" , [
            "store_id"              => $store_id ,
            "tax_sales_group_name"  => $this->input->post("tax_group_name") ,
            "sales_tax_id"          => json_encode($this->input->post("sales_tax_id")),
            "created_by"            => $this->data['session_data']->user_id ,
            "created"               => time()
        ]); 

        return $this->db->insert_id();
    }

    public function get_outlet_and_registers(){
        $store_id = $this->data['session_data']->store_id;
        $this->db->select("so.outlet_name , so.sales_tax_id , so.outlet_id");
        $this->db->where("so.store_id" , $store_id);
        $result = $this->db->get("store_outlet so")->result();

        foreach($result as $key => $row){
            $s = explode("|", $row->sales_tax_id);

            if($s[0] == "S"){
                $sales_tax = $this->db->select("tax_name , tax_rate")->where("sales_tax_id" , $s[1])->get("store_sales_tax")->row();
                $sales_tax = $sales_tax->tax_name.' ('.$sales_tax->tax_rate.'%)';
            }else{
                $sales_group = $this->db->select("tax_sales_group_name , sales_tax_id")->where("sales_tax_group_id" , $s[1])->get("store_sales_tax_group")->row();
                $tax_id = $this->db->select_sum("tax_rate")->where_in("sales_tax_id" , json_decode($sales_group->sales_tax_id))->get("store_sales_tax")->row();
                $sales_tax = $sales_group->tax_sales_group_name.' ('.$tax_id->tax_rate.' %)';
            }

            $result[$key]->sales_tax_id = $sales_tax;
            $store_register = $this->db->where("outlet_id" , $row->outlet_id)->get("store_register")->result();

            $cash_register = array();

            foreach($store_register as $k => $sr){
                $cash_register[$k]['register_id'] = $this->hash->encrypt($sr->register_id);
                $cash_register[$k]['register_name'] = $sr->register_name;
                $cash_register[$k]['register_open'] = $sr->register_open;
                $cash_register[$k]['register_details'] = register_details($sr);
            }

            $result[$key]->store_register = $cash_register;
            $result[$key]->outlet_id = $this->hash->encrypt($row->outlet_id);

        }

        return $result;
    }

    public function get_default_salestax_dropdown(){
        $result = array();

        $result["sales_tax"] = $this->get_sales_tax();

        foreach($result["sales_tax"] as $k => $row){
            $result["sales_tax"][$k]->sales_tax_id = "S|".$this->hash->decrypt(urldecode($row->sales_tax_id));
            $result["sales_tax"][$k]->tax_name = $row->tax_name.' ('.$row->tax_rate.'%)';
        }

        $result["group_sales_tax"] = $this->get_group_tax();

        foreach($result["group_sales_tax"] as $k => $row){
            $result["group_sales_tax"][$k]->sales_tax_group_id = "G|".$this->hash->decrypt(urldecode($row->sales_tax_group_id));
            $result["group_sales_tax"][$k]->tax_sales_group_name = $row->tax_sales_group_name.' ('.$row->sales_tax_count.' taxes , '.$row->sales_tax_group_rate.'%)';
        }
        
        return $result;
    }

    public function add_outlet(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->trans_start();

        /* CONTACT DETAILS */
        $this->db->insert("store_contact" , [
            "email"     => $this->input->post("contact_email_address") ,
            "phone"     => $this->input->post("contact_phone_number") ,
            "field_1"   => $this->input->post("contact_field_1") ,
            "field_2"   => $this->input->post("contact_field_2") ,
        ]);
        $contact_id = $this->db->insert_id();

        /* STORE ADDRESS */
        $this->db->insert("store_address" , $this->input->post("physical"));
        $physical_address_id = $this->db->insert_id();

        /* OUTLET */
        $this->db->insert("store_outlet" , [
            "store_id"                  => $store_id ,
            "contact_id"                => $contact_id ,
            "physical_address"          => $physical_address_id,
            "sales_tax_id"              => $this->input->post("sales_tax"),
            "outlet_name"               => $this->input->post("outlet_name") ,
            "order_number_prefixes"     => $this->input->post("order_number_prefix") ,
            "order_number"              => $this->input->post("order_number") ,
            "supplier_return_prefixes"  => $this->input->post("supplier_return_prefix") ,
            "supplier_return"           => $this->input->post("supplier_return_number") ,
            "negative_inventory"        => ($this->input->post("negative_inventory")) ? 1 : 0 ,
            "deletable"                 => "YES" ,
            "status"                    => 1 ,
            "created"                   => time() ,
        ]);
        $outlet_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $outlet_id;
        }
    }

    public function add_register($outlet_id){

        $this->db->insert("store_register" , [
            "outlet_id"                 => $outlet_id,
            "register_name"             => $this->input->post("register_name"),
            "cash_management"           => $this->input->post("cash_management"),
            "select_user_for_next_sale" => $this->input->post("select_user_for_next_sale"),
            "email_receipt"             => $this->input->post("email_receipt"),
            "print_receipt"             => $this->input->post("print_receipt"),
            "ask_for_a_note"            => $this->input->post("ask_for_a_note"),
            "print_note_on_receipt"     => $this->input->post("print_note_on_receipt"),
            "show_discount_on_receipt"  => $this->input->post("show_discount_on_receipt"),
            "status"                    => 1,
            "created"                   => time()
        ]);

        return $this->db->insert_id();
    }

    public function get_outlet_by_id($outlet_id , $field = false){
        if($field){
            $this->db->select($field);
        }else{
            //select all
        }

        $result = $this->db->where("outlet_id" , $outlet_id)->get("store_outlet")->row();


        return $result;
    }

    public function get_store_settings(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("s.store_name , s.default_currency , s.default_sales_tax , s.sku_generation_type , s.current_sequence_sku , s.display_price_settings");
        $this->db->select("CONCAT(st.tax_name , ' ( ' , st.tax_rate , '% )' ) as tax_name , st.tax_rate");
        $this->db->join("store_sales_tax st" , "st.sales_tax_id = s.default_sales_tax");
        $this->db->where("s.store_id" , $store_id);
        $result = $this->db->get("store s")->row();
        $result->sequence_sku = ($result->sku_generation_type == "GENERATE_BY_SEQUENCE") ? ($result->current_sequence_sku + 1) : "";
        return $result;
    }

}