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
            $result[$key]->count = $this->db->join("product p" , "p.product_id = ppt.product_id")->where("store_id" , $store_id)->where("tag_id" , $row->product_tag_id)->get("product_product_tags ppt")->num_rows();
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
            $result[$key]->count = $this->db->where("brand_id" , $row->product_brand_id)->get("product")->num_rows();
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
            $result[$key]->count = $this->db->where("supplier_id" , $row->supplier_id)->get("product")->num_rows();
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

        $this->db->select("product_type_id , type_name , created ");
        $result = $this->db->where("store_id" , $store_id)->order_by("type_name" , "ASC")->get("product_types")->result();

        foreach($result as $key => $row){
            $result[$key]->count = $this->db->where("product_type_id" , $row->product_type_id)->get("product")->num_rows();
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


    public function add_attribute(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->insert("product_variants_attribute" , [
            "store_id"          => $store_id ,
            "attribute_name"    => $this->input->post("attribute_name")
        ]);

        return $this->db->insert_id();
    }

    public function get_variant_attribute(){
        $store_id = $this->data['session_data']->store_id;

        return $this->db->select("attribute_name")->where("store_id" , $store_id)->order_by("attribute_name" , "ASC")->get("product_variants_attribute")->result();
    }

    public function get_product_list(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("product_name , product_handle , p.product_id , variant_name , p.has_variant , pv.product_variant_id");
        $this->db->join("product_variants pv" , "pv.product_id = p.product_id");
        $result = $this->db->where("store_id" , $store_id)->where("status" , 1)->order_by("product_name" , "ASC")->get("product p")->result();

        foreach($result as $key => $row){
            $result[$key]->product_id = $this->hash->encrypt($row->product_id);
            $result[$key]->product_variant_id = $this->hash->encrypt($row->product_variant_id);

            if($row->has_variant){
                $result[$key]->p_name = $row->product_name.' - '.$row->variant_name;
            }else{
                $result[$key]->p_name = $row->product_name;
            }

        }


        return $result;
    }

    public function get_product(){
        $store_id = $this->data['session_data']->store_id;
        $status = $this->input->get("status") ? $this->input->get("status") : 1;

        $this->db->select("p.product_id , p.product_name , p.product_handle , p.description , p.created , p.has_variant , p.track_inventory , p.brand_id , p.supplier_id");
        $this->db->select("s.supplier_name , pb.brand_name");
        $this->db->join("supplier s" , "s.supplier_id = p.supplier_id" , "LEFT");
        $this->db->join("product_brands pb" , "pb.product_brand_id = p.brand_id" , "LEFT");

        $result = $this->db->where("p.store_id" , $store_id)->where("p.status" , $status)->get("product p")->result();

        foreach($result as $key => $row){
            if($row->track_inventory){
                $result[$key]->inventory = $this->db->select_sum("current_inventory")->join("product_variants pv" , "pv.product_variant_id = i.product_variant_id")->where("product_id" , $row->product_id)->get("inventory i")->row()->current_inventory;
            }else{
                $result[$key]->inventory = "&#8734;";      
            }    
            
            $result[$key]->brand_name = ($row->brand_name) ? '<a href="'.site_url("app/product/?brand=").$this->hash->encrypt($row->supplier_id).'" class="link-style"><span>'.$row->brand_name.'</span></a>' : "-";
            $result[$key]->supplier_name = ($row->supplier_name) ? '<a href="'.site_url("app/product/?supplier=").$this->hash->encrypt($row->brand_id).'" class="link-style"><span>'.$row->supplier_name.'</span></a>' : "-";
            $result[$key]->created = convert_timezone($row->created);
            //tags
            $tags = $this->db->select("tag_name, tag_id")->join("product_tags pt" , "pt.product_tag_id = ppt.tag_id")->where("product_id" , $row->product_id)->get("product_product_tags ppt")->result();
            $tags_template = "";
            foreach($tags as $k => $r){
               if($k == 0){
                    $tags_template .= '<a href="'.site_url("app/product/?tags=").$this->hash->encrypt($r->tag_id).'" class="link-style"><span>'.trim($r->tag_name).'</span></a>';
               }else{
                    $tags_template .= ' , <a href="'.site_url("app/product/?tags=").$this->hash->encrypt($r->tag_id).'" class="link-style"><span>'.trim($r->tag_name).'</span></a>';
               }
            }

            $result[$key]->tags = $tags_template;

            //variants
            $variants = $this->db->select("pv.product_variant_id , sku , variant_name , retail_price_wot , markup_price , supply_price")
            ->where("product_id" , $row->product_id)
            ->get("product_variants pv")->result();

            foreach($variants as $k => $r){

                if($row->track_inventory){
                    $variants[$k]->inventory = $this->db->select_sum("current_inventory")->where("product_variant_id" , $r->product_variant_id)->get("inventory")->row()->current_inventory;
                }else{
                    $variants[$k]->inventory = "&#8734;";
                }
                $variants[$k]->retail_price_wot = number_format($r->retail_price_wot,2);
            }

            $result[$key]->variants = $variants;
            $result[$key]->variants_count = count($variants);
            $result[$key]->product_id = $this->hash->encrypt($row->product_id);

        }

        return $result;
    }

    public function get_product_status(){
        return [
            "active"    => $this->db->where("status" , 1)->get("product")->num_rows(),
            "inactive"  => $this->db->where("status" , 0)->get("product")->num_rows(),
            "all"       => $this->db->get("product")->num_rows(),
        ];
    }

    public function add_product(){
        $store_id = $this->data['session_data']->store_id;


        $this->db->trans_start();

        //PRODUCT 

        $this->db->insert("product" , [
            "store_id"                  => $store_id ,
            "product_name"              => $this->input->post("product_name"),
            "product_handle"            => $this->input->post("product_handle"),
            "description"               => $this->input->post("description"),
            "supplier_id"               => $this->hash->decrypt($this->input->post("supplier")),
            "brand_id"                  => $this->hash->decrypt($this->input->post("brand")),
            "product_type_id"           => $this->hash->decrypt($this->input->post("type")),
            "sales_account_code"        => $this->input->post("sales_account_code"),
            "purchase_account_code"     => $this->input->post("purchase_account_code"),
            "product_type"              => $this->input->post("product_type"),
            "has_variant"               => ($this->input->post("has_variant")) ? 1 : 0,
            "track_inventory"           => ($this->input->post("track_inventory")) ? 1 : 0,
            "status"                    => 1,
            "created"                   => time(),
        ]);

        $product_id = $this->db->insert_id();


        //PRODUCT TAGS
        if($this->input->post("tags")){

            $tags = array();

            foreach($this->input->post("tags") as $tag_id){
                $tags[] = array(
                    "product_id"    => $product_id ,
                    "tag_id"        => $this->hash->decrypt($tag_id)
                );
            }
            
            $this->db->insert_batch("product_product_tags" , $tags);
        }

        
        if($this->input->post("product_type") == "STANDARD"){
            $last_sku = $this->input->post("sku");
            // HAS VARIANT BEEN CHECKED

            if($this->input->post("has_variant")){
                //VARIANTS

                $attribute = $this->input->post("attribute");

                foreach($attribute['product_attribute'] as $key => $variant){

                    $this->db->insert("variants" , [
                        "variant"       => $variant ,
                        "product_id"    => $product_id
                    ]);

                    $variant_id = $this->db->insert_id();

                    $value = explode(",", $attribute['product_attribute_value'][$key]);
                    $v = array();

                    foreach($value as $val){
                        $v[] = array(
                            "variant_id"    => $variant_id ,
                            "value"         => $val
                        );
                    }
                    $this->db->insert_batch("variants_value" , $v);
                }

                //VARIANTS

                $variants = $this->input->post("variant");

                foreach($variants as $variant_name => $variant_data){

                    $last_sku = $variant_data['sku'];

                    $this->db->insert("product_variants" , [
                        "product_id"            => $product_id ,
                        "variant_name"          => $variant_name,
                        "sku"                   => $variant_data['sku'] ,
                        "supplier_code"         => $variant_data['supplier_code'],
                        "supply_price"          => $variant_data['supply_price'],
                        "retail_price_wot"      => $variant_data['retail_price_wot'],
                        "product_enabled"       => ($variant_data['product_enabled']) ? 1 : 0,
                        "markup_price"          => $variant_data['markup'] 
                    ]);

                    $product_variant_id = $this->db->insert_id();

                    //INVENTORY
                    $inventory = $variant_data['inventory'];
                    $i = array();

                    foreach($inventory as $outlet_id => $value){
                        $i[] = array(
                            "store_id"              => $store_id ,
                            "product_variant_id"    => $product_variant_id ,
                            "outlet_id"             => $this->hash->decrypt($outlet_id),
                            "current_inventory"     => $value['current_inventory'],
                            "reorder_point"         => $value['reorder_point'],
                            "reorder_amount"        => $value['reorder_amount']
                        );
                    }

                    $this->db->insert_batch("inventory" , $i);


                    //OUTLET
                    $tax = $variant_data['tax'];
                    $t = array();

                    foreach($tax as $outlet_id => $value){
                        $t[] = array(
                            "store_id"              => $store_id ,
                            "product_variant_id"    => $product_variant_id,
                            "outlet_id"             => $this->hash->decrypt($outlet_id),
                            "sales_tax_id"          => ($value['sales_tax_id'] == "DEFAULT") ? $value['default_tax_id'] : $value['sales_tax'],
                            "retail_price_wt"       => 0
                        );
                    }

                    $this->db->insert_batch("product_variants_outlet" , $t);

                }

            }else{
                //NO VARIANTS

                //VARIANTS
                $this->db->insert("product_variants" , [
                    "product_id"        => $product_id ,
                    "variant_name"      => "" ,
                    "sku"               => $this->input->post("sku") ,
                    "supplier_code"     => $this->input->post("supplier_code"),
                    "supply_price"      => $this->input->post("supply_price"),
                    "product_enabled"   => 1 ,
                    "markup_price"      => $this->input->post("markup_price"), 
                    "retail_price_wot"  => $this->input->post("retail_price_wot")
                ]);

                $product_variant_id = $this->db->insert_id();

                //INVENTORY

                $inventory = $this->input->post("inventory");
                $i = array();
                $o = array();

                foreach($inventory as $outlet_id => $value){
                    $i[] = array(
                        "store_id"              => $store_id ,
                        "product_variant_id"    => $product_variant_id ,
                        "outlet_id"             => $this->hash->decrypt($outlet_id),
                        "current_inventory"     => $value['current_inventory'],
                        "reorder_point"         => $value['reorder_point'],
                        "reorder_amount"        => $value['reorder_amount']
                    );


                    if($this->input->post("price_settings") == "WOT"){
                        //TAX INCLUSIVE
                        $o[] = array(
                            "store_id"              => $store_id ,
                            "product_variant_id"    => $product_variant_id,
                            "outlet_id"             => $this->hash->decrypt($outlet_id),
                            "sales_tax_id"          => $this->input->post("sales_tax"),
                            "retail_price_wt"       => $this->input->post("retail_price_wt")
                        );
                    }
                   
                }

                $this->db->insert_batch("inventory" , $i);

                //OUTLET
                if($this->input->post("price_settings") == "WT"){
                    
                    $outlet = $this->input->post("outlet_tax");

                    foreach($outlet as $outlet_id => $value){
                        $o[] = array(
                            "store_id"              => $store_id ,
                            "product_variant_id"    => $product_variant_id,
                            "outlet_id"             => $this->hash->decrypt($outlet_id),
                            "sales_tax_id"          => ($value['sales_tax'] == "DEFAULT") ? $value['default_tax_id'] : $value['sales_tax'] ,
                            "retail_price_wt"       => $value['retail_price']
                        );
                    }
                }

                $this->db->insert_batch("product_variants_outlet" , $o);

            }

        }else{
            //COMPOSITE
            $last_sku = $this->input->post("composite_sku");

            //VARIANTS
            $this->db->insert("product_variants" , [
                "product_id"        => $product_id ,
                "variant_name"      => "" ,
                "sku"               => $this->input->post("composite_sku") ,
                "supplier_code"     => $this->input->post("supplier_code"),
                "supply_price"      => $this->input->post("supply_price"),
                "product_enabled"   => 1 ,
                "markup_price"      => $this->input->post("markup_price"), 
                "retail_price_wot"  => $this->input->post("retail_price_wot")
            ]);

            $product_variant_id = $this->db->insert_id();

            if($this->input->post("price_settings") == "WT"){

                $outlet = $this->input->post("outlet_tax");

                foreach($outlet as $outlet_id => $value){
                    $o[] = array(
                        "store_id"              => $store_id ,
                        "product_variant_id"    => $product_variant_id,
                        "outlet_id"             => $this->hash->decrypt($outlet_id),
                        "sales_tax_id"          => ($value['sales_tax'] == "DEFAULT") ? $value['default_tax_id'] : $value['sales_tax'] ,
                        "retail_price_wt"       => $value['retail_price']
                    );
                }
            }else{
                $inventory = $this->input->post("inventory");
                $o = array();

                foreach($inventory as $outlet_id => $value){
                    $o[] = array(
                        "store_id"              => $store_id ,
                        "product_variant_id"    => $product_variant_id,
                        "outlet_id"             => $this->hash->decrypt($outlet_id),
                        "sales_tax_id"          => $this->input->post("sales_tax"),
                        "retail_price_wt"       => $this->input->post("retail_price_wt")
                    );
                   
                }
            }

            $this->db->insert_batch("product_variants_outlet" , $o);

            $composite = $this->input->post("composite");

            $p = array();

            foreach($composite['product_id'] as $key => $product_id){
                if($product_id){
                    $p[] = array(
                        "product_variant_id"      => $product_variant_id ,
                        "product_id"              => $this->hash->decrypt($composite['product_id'][$key]),
                        "quantity"                => $composite['quantity'][$key]
                    );
                }
            }

            $this->db->insert_batch("product_composite" , $p);

        }


        if($this->input->post("sku_generation_type") == "GENERATE_BY_SEQUENCE"){
            $this->db->where("store_id" , $store_id)->update("store" , ["current_sequence_sku" => $last_sku]);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $this->hash->encrypt($product_id);
        }
    }


    public function get_product_by_id($product_id){
        $product = $this->db->where("p.product_id" , $product_id)->get("product p")->row();
        return $product;
    }
}