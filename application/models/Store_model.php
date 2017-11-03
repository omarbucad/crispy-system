<?php

class Store_model extends CI_Model {

    public function get_general_setup(){
        $user = $this->session->userdata("user");

        $this->db->select("s.store_name , s.default_currency , s.sku_generation_type , s.current_sequence_sku , s.display_price_settings , s.physical_address , s.postal_address , s.contact_id");
        $this->db->select("tc.first_name as contact_first_name , tc.last_name as contact_last_name , tc.email as contact_email , tc.phone as contact_phone , tc.website as contact_website , tc.field_1 , tc.field_2");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country , sa1.timezone");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->join("store_contact tc" , "tc.store_contact_id = s.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = s.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = s.postal_address");
        $result = $this->db->where("s.store_id" , $user->store_id)->get("store s")->row();

        return $result;
    }
    
    public function update_general(){

        $store_id = $this->encryption->decrypt($this->input->post("store_id"));

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
            $result[$key]->sales_tax_id = urlencode($this->encryption->encrypt($row->sales_tax_id));
        }
  
        return $result;
    }

    public function get_outlet(){
        $store_id = $this->data['session_data']->store_id;
        $this->db->select("so.outlet_id , so.outlet_name , CONCAT(st.tax_name , ' (' , st.tax_rate , '%)') as tax_name , so.deletable");
        $this->db->join("store_sales_tax st" , "st.sales_tax_id = so.sales_tax_id");

        $result = $this->db->where("so.store_id" , $store_id)->get("store_outlet so")->result();

        foreach($result as $key => $row){
            $result[$key]->outlet_id = urlencode($this->encryption->encrypt($row->outlet_id));
        }
        
        return $result;
    }

    public function get_group_tax(){
        $store_id = $this->data['session_data']->store_id;
        $this->db->select("sales_tax_group_id , tax_sales_group_name , sales_tax_id");
        $result = $this->db->where("store_id" , $store_id)->get("store_sales_tax_group")->result();

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
            $result[$key]->sales_tax_group_id = urlencode($this->encryption->encrypt($row->sales_tax_group_id));
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
}