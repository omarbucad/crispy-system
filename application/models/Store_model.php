<?php

class Store_model extends CI_Model {

    public function get_general_setup(){
        $user = $this->session->userdata("user");

        $this->db->select("s.store_name , s.default_currency , s.timezone , s.sku_generation_type , s.current_sequence_sku , s.display_price_settings , s.physical_address , s.default_address , s.contact_id");
        $this->db->select("tc.first_name as contact_first_name , tc.last_name as contact_last_name , tc.email as contact_email , tc.phone as contact_phone , tc.website as contact_website , tc.field_1 , tc.field_2");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->join("store_contact tc" , "tc.store_contact_id = s.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = s.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = s.default_address");
        $result = $this->db->where("s.store_id" , $user->main_outlet)->get("store s")->row();


        return $result;
    }
    
    public function update_general(){
        $store_id = $this->encryption->decrypt($this->input->post("store_id"));

        $this->db->trans_start();

        $this->db->where("store_address_id" , $this->input->post("physical_address_id"))->update("store_address" , $this->input->post("physical"));
        $this->db->where("store_address_id" , $this->input->post("postal_address_id"))->update("store_address" , $this->input->post("postal"));
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
            "timezone"              => $this->input->post("timezone") ,
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
}