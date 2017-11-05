<?php

class Customer_model extends CI_Model {

    public function add_group(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("customer_group" , [
            "store_id"      => $store_id ,
            "group_name"    => $this->input->post("group_name") ,
            "created"       => time(),
            "deletable"     => "YES"
        ]);

        return $this->db->insert_id();
    }

    public function get_group(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("group_id , group_name , deletable , created");
        $this->db->where("store_id" , $store_id)->order_by("group_name" , "ASC");
        $result = $this->db->get("customer_group")->result();

        foreach($result as $key => $row){
            $result[$key]->group_id = $this->hash->encrypt($row->group_id);
            $result[$key]->created = convert_timezone($row->created , true);
         }

        return $result;
    }

    public function add_customer(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->trans_start();

        /* CONTACT */

        $this->db->insert("store_contact" , [
            "first_name"        => $this->input->post("first_name"),
            "last_name"         => $this->input->post("last_name"),
            "email"             => $this->input->post("email"),
            "fax"               => $this->input->post("fax"),
            "phone"             => $this->input->post("phone_number"),
            "website"           => $this->input->post("website"),
            "field_1"           => $this->input->post("field1"),
            "field_2"           => $this->input->post("field2"),
        ]);

        $contact_id = $this->db->insert_id();

        /* ADDRESS */

        $this->db->insert("store_address" , $this->input->post("physical"));
        $physical_address = $this->db->insert_id();
        
        $this->db->insert("store_address" , $this->input->post("postal"));
        $postal_address = $this->db->insert_id();

        /* CUSTOMER */

        $this->db->insert("customer" , [
            "contact_id"                => $contact_id ,
            "store_id"                  => $store_id ,
            "physical_address"          => $physical_address,
            "postal_address"            => $postal_address,
            "customer_group"            => $this->hash->decrypt($this->input->post("customer_group")),
            "company"                   => $this->input->post("company") ,
            "customer_code"             => ($this->input->post("customer_code")) ? $this->input->post("customer_code") : $this->input->post("first_name").'-'.substr(uniqid('', true), -5) ,
            "dob_day"                   => $this->input->post("date_of_birth")["dd"] ,
            "dob_month"                 => $this->input->post("date_of_birth")["mm"] ,
            "dob_year"                  => $this->input->post("date_of_birth")["yy"] ,
            "gender"                    => $this->input->post("gender") ,
            "direct_mail_communication" => ($this->input->post("direct_email")) ? 1 : 0 ,
            "field_1"                   => $this->input->post("field1") ,
            "field_2"                   => $this->input->post("field2") ,
            "field_3"                   => $this->input->post("field3") ,
            "field_4"                   => $this->input->post("field4") ,
            "notes"                     => $this->input->post("note") ,
            "status"                    => 1 ,
            "created"                   => time(),
        ]);

        $customer_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $customer_id;
        }
    }

    public function get_customer($count = false){
        $store_id = $this->data['session_data']->store_id;

        $skip = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $limit = ($this->input->get("limit")) ? $this->input->get("limit") : 10;

        $this->db->select("c.customer_group , c.contact_id , c.company , c.customer_code , c.dob_day , c.dob_month , c.dob_year , c.gender , c.physical_address , c.postal_address , c.field_1 , c.field_2 , c.field_3 , c.field_4 , c.notes , c.created");
        $this->db->select("CONCAT(sc.first_name , ' ' , sc.last_name) as display_name , sc.email , sc.fax , sc.phone , sc.website , sc.field_1 as facebook , sc.field_2 as twitter");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->select("cg.group_name");
        $this->db->join("store_contact sc" , "sc.store_contact_id = c.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = c.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = c.postal_address");
        $this->db->join("customer_group cg" , "cg.group_id = c.customer_group");
       
        if($count){
           return $this->db->where("c.store_id" , $store_id)->get("customer c")->num_rows();
        }else{
            $result = $this->db->where("c.store_id" , $store_id)->limit($limit , $skip)->get("customer c")->result();
        }
        
        return $result;
    }
}