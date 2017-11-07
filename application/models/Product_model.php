<?php

class Product_model extends CI_Model {

    public function add_tag(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("product_tags" , [
            "store_id" => $store_id ,
            "tag_name" => $this->input->post("tag_name"),
            "created"  => time()
        ]);

        return $this->db->insert_id();
    }

    public function get_tag(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("product_tag_id , tag_name , created");
        $result = $this->db->where("store_id" , $store_id)->order_by("tag_name" , "ASC")->get("product_tags")->result();

        foreach($result as $key => $row){
            $result[$key]->product_tag_id = $this->hash->encrypt($row->product_tag_id);
            $result[$key]->created = convert_timezone($row->created);
        }

        return $result;
    }

    public function add_brand(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("product_brands" , [
            "store_id"      => $store_id ,
            "brand_name"    => $this->input->post("brand_name"),
            "description"   => $this->input->post("description"),
            "created"       => time()
        ]);

        return $this->db->insert_id();
    }

    public function get_brand(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("product_brand_id , brand_name , description , created");
        $result = $this->db->where("store_id" , $store_id)->order_by("brand_name" , "ASC")->get("product_brands")->result();

        foreach($result as $key => $row){
            $result[$key]->product_brand_id = $this->hash->encrypt($row->product_brand_id);
            $result[$key]->description = nl2br($row->description);
            $result[$key]->created = convert_timezone($row->created);
        }

        return $result;
    }


    public function add_supplier(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->trans_start();

        /* ADDRESS */
        $this->db->insert("store_address" , $this->input->post("physical"));
        $physical_address_id = $this->db->insert_id();
        $this->db->insert("store_address" , $this->input->post("postal"));
        $postal_address_id = $this->db->insert_id();

        /* CONTACT */
        $this->db->insert("store_contact" , [
            "first_name"    => $this->input->post("first_name") ,
            "last_name"     => $this->input->post("last_name"),
            "email"         => $this->input->post("email"),
            "fax"           => $this->input->post("fax"),
            "company"       => $this->input->post("company"),
            "mobile"        => $this->input->post("mobile"),
            "phone"         => $this->input->post("phone"),
            "website"       => $this->input->post("website"),
            "field_1"       => $this->input->post("field1"),
            "field_2"       => $this->input->post("field2")
        ]);
        $contact_id = $this->db->insert_id();

        /* SUPPLIER */
        $this->db->insert("supplier" , [
            "store_id"              => $store_id ,
            "contact_id"            => $contact_id ,
            "physical_address"      => $physical_address_id ,
            "postal_address"        => $postal_address_id ,
            "supplier_name"         => $this->input->post("supplier_name"),
            "description"           => $this->input->post("description"),
            "default_markup"        => $this->input->post("default_markup"),
            "status"                => 1 ,
            "created"               => time()
        ]);

        $supplier_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $supplier_id;
        }
    }

    public function get_supplier(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("supplier_id , supplier_name , description , default_markup");
        $this->db->where("store_id" , $store_id);
        $result = $this->db->order_by("supplier_name" , "ASC")->get("supplier")->result();

        foreach($result as $key => $row){
            $result[$key]->supplier_id = $this->hash->encrypt($row->supplier_id);
            $result[$key]->description = nl2br($row->description);

            if(strlen($result[$key]->description) > 50){
                $stringCut = substr($result[$key]->description, 0, 50);
                $result[$key]->description = substr($stringCut, 0, strrpos($stringCut, ' ')).'...';
            }
        }

        return $result;
    }

    public function getSupplierById($id){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("s.supplier_name , s.description , s.default_markup , s.status , s.created");
        $this->db->select("CONCAT(c.first_name , ' ' , c.last_name) as display_name , c.email , c.company , c.fax , c.mobile , c.phone , c.website , c.field_1 , c.field_2");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country , sa1.timezone");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->join("store_contact c" , "c.store_contact_id = s.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = s.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = s.postal_address");
        $this->db->where("s.store_id" , $store_id)->where("s.supplier_id" , $id);

        $result = $this->db->get("supplier s")->row();

        if($result){
            $result->description = nl2br($result->description); 
        }

        return $result;
    }


    public function get_type(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("product_type_id , type_name , created");
        $result = $this->db->where("store_id" , $store_id)->order_by("type_name" , "ASC")->get("product_types")->result();

        foreach($result as $key => $row){
            $result[$key]->product_type_id = $this->hash->encrypt($row->product_type_id);
            $result[$key]->created = convert_timezone($row->created);
        }

        return $result;
    }

    public function add_product_type(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("product_types" , [
            "store_id"      => $store_id ,
            "type_name"     => $this->input->post("type_name"),
            "status"        => 1,
            "created"       => time()
        ]);

        return $this->db->insert_id();
    }
}