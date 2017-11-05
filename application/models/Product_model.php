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
}