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

    public function get_product_list($low_inventory = false , $outlet_id = 0){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("product_name , product_handle , p.product_id , variant_name , p.has_variant , pv.product_variant_id , pv.supply_price , i.current_inventory , i.reorder_point , i.reorder_amount ");
        $this->db->join("product_variants pv" , "pv.product_id = p.product_id");
        $this->db->join("inventory i" , "i.product_variant_id = pv.product_variant_id" , "LEFT");

        if($low_inventory){
            $this->db->where("i.current_inventory < i.reorder_point");
        }

        if($outlet_id){
           $this->db->where("i.outlet_id" , $outlet_id);
        }

        $result = $this->db->where("p.store_id" , $store_id)->where("status" , 1)->order_by("product_name" , "ASC")->get("product p")->result();

        foreach($result as $key => $row){
            $result[$key]->product_id = $this->hash->encrypt($row->product_id);
            $result[$key]->product_variant_id = $this->hash->encrypt($row->product_variant_id);
            $result[$key]->order_quantity = ($row->current_inventory < $row->reorder_point) ?  $row->reorder_amount : 0;

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
        $store_id = $this->data['session_data']->store_id;

        return [
            "active"    => $this->db->where("status" , 1)->where("store_id" , $store_id)->get("product")->num_rows(),
            "inactive"  => $this->db->where("status" , 0)->where("store_id" , $store_id)->get("product")->num_rows(),
            "all"       => $this->db->where("store_id" , $store_id)->get("product")->num_rows(),
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

        $this->db->select("p.product_id , p.description , p.product_name , p.product_handle");
        $this->db->select("pt.type_name , pb.brand_name , s.supplier_name , pv.supply_price , pv.retail_price_wot , pv.sku");
        $this->db->join("product_types pt" , "pt.product_type_id = p.product_type_id");
        $this->db->join("product_brands pb" , "pb.product_brand_id = p.brand_id" );
        $this->db->join("supplier s" , "s.supplier_id = p.supplier_id");
        $this->db->join("product_variants pv" , "pv.product_id = p.product_id");
        $product = $this->db->where("p.product_id" , $product_id)->group_by("product_id" , "ASC")->get("product p")->row();

        $product->supply_price = number_format($product->supply_price , 2);
        $product->retail_price_wot = number_format($product->retail_price_wot , 2);

        $outlet = array(); 
        foreach($this->data['outlet_list'] as $key => $row){
            $outlet[] = array(
                "outlet_id" => $row->outlet_id ,
                "outlet_name" => $row->outlet_name ,
                "stock" => $this->db->select("current_inventory")->join("product_variants pv" , "pv.product_variant_id = i.product_variant_id")->where("outlet_id" , $this->hash->decrypt($row->outlet_id ))->where("product_id" , $product_id)->get("inventory i")->row()->current_inventory
            );
        }

        $product->outlet = $outlet;
        //TAGS

        $tags = $this->db->select("tag_name, tag_id")->join("product_tags pt" , "pt.product_tag_id = ppt.tag_id")->where("product_id" , $product->product_id)->get("product_product_tags ppt")->result();
        $tags_template = "";
        foreach($tags as $k => $r){
            $tags_template .= ' <a href="'.site_url("app/product/?tags=").$this->hash->encrypt($r->tag_id).'"><span class="label label-success">'.trim($r->tag_name).'</span></a>';
        }
        $product->tags = $tags_template;
        return $product;
    }

    public function create_stock_count(){
        $store_id = $this->data['session_data']->store_id;
        $user_id = $this->data['session_data']->user_id;

        $this->db->trans_start();

        $this->db->insert("inventory_stock_control" , [
            "count_name"        => $this->input->post("count_name"),
            "start_date"        => $this->input->post("start_date"),
            "start_time"        => $this->input->post("start_time"),
            "schedule_time"     => strtotime($this->input->post("start_date").' '.$this->input->post("start_time")),
            "outlet_id"         => $this->hash->decrypt($this->input->post("outlet")),
            "store_id"          => $store_id,
            "count_type"        => $this->input->post("count_type"),
            "include_inactive"  => ($this->input->post("include_inactive")) ? 1 : 0,
            "status"            => "IN PROGRESS",
            "user_id"           => $user_id,
            "created"           => time()
        ]);

        $stock_control_id = $this->db->insert_id();

        if($this->input->post("count_type") == "partial"){
            $product_variant_list = $this->input->post("product_id");

            foreach($product_variant_list as $key => $product){

                $inventory = $this->db->select("reorder_point , reorder_amount")
                ->where("product_variant_id" , $this->hash->decrypt($product))
                ->where("outlet_id" , $this->hash->decrypt($this->input->post("outlet")))
                ->get("inventory")->row();

                $product_variant_list[$key] = array(
                    "product_variant_id"    => $this->hash->decrypt($product),
                    "expected"              => $inventory->reorder_point ,
                    "reorder_amount"        => $inventory->reorder_amount,
                    "stock_control_id"      => $stock_control_id,
                    "status"                => "uncounted"
                );
            }

        }else{

            $this->db->select("i.reorder_amount , i.reorder_point as expected , i.product_variant_id")
                ->join("product_variants pv" , "pv.product_id = p.product_id")
                ->join("inventory i" , "i.product_variant_id = pv.product_variant_id")
                ->where("p.store_id" , $store_id)
                ->where("i.outlet_id" , $this->hash->decrypt($this->input->post("outlet")));
            
            if(!$this->input->post("include_inactive")){
                $this->db->where("status" , 1);
            }

            $product_variant_list = $this->db->get("product p")->result();

            foreach($product_variant_list as $key => $product){
                $product_variant_list[$key]->stock_control_id = $stock_control_id;
                $product_variant_list[$key]->status = "uncounted";
            }

        }

        $this->db->insert_batch("inventory_stock_count" , $product_variant_list);


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $this->hash->encrypt($stock_control_id);
        }
    }

    public function get_stock_count($stock_type = ""){
        $store_id = $this->data['session_data']->store_id;
        $current_time = time();

        $this->db->select("stock_control_id , count_name , start_date , start_time , i.status , i.created , i.outlet_id , schedule_time");
        $this->db->select("u.display_name");
        $this->db->select("so.outlet_name");
        $this->db->join("user u" , "u.user_id = i.user_id");
        $this->db->join("store_outlet so" , "so.outlet_id = i.outlet_id");
        $this->db->where("i.store_id" , $store_id);

        switch ($stock_type) {
            case 'due':
                $this->db->where("i.schedule_time > " , $current_time)->where("status" , "IN PROGRESS");
                break;
            case 'upcoming':
                $this->db->where("i.schedule_time < " , $current_time)->where("status" , "IN PROGRESS");
                break;
            case 'completed':
                $this->db->where("status" , "COMPLETED");
                break;
            case 'cancelled':
                $this->db->where("status" , "CANCELLED");
                break;
            default:
                return $this->db->where("stock_control_id" , $stock_type)->get("inventory_stock_control i ")->row();
                break;
        }

        $result = $this->db->get("inventory_stock_control i ")->result();
        
        foreach($result as $key => $row){
            $result[$key]->created = convert_timezone($row->created , true);
        }

        return $result;
    }

    public function get_stock_count_by_id($stock_id){
        $stock_information = $this->get_stock_count($stock_id);

        if($stock_information){
            $stock_information->created = convert_timezone($stock_information->created , true);
            $stock_information->schedule_time = convert_timezone($stock_information->schedule_time , true);
            $stock_information->stock_control_id = $this->hash->encrypt($stock_information->stock_control_id);

            $this->db->select("pv.sku , pv.variant_name , pv.supply_price , pv.markup_price , pv.retail_price_wot , pv.product_variant_id");
            $this->db->select("p.product_name , p.product_handle");
            $this->db->select("i.expected , i.counted , i.status , i.reorder_amount , i.stock_count_id");
            $this->db->join("product p" , "p.product_id = pv.product_id");
            $this->db->join("inventory_stock_count i" , "i.product_variant_id = pv.product_variant_id");
            $this->db->where("stock_control_id" , $stock_id);
            $stock_information->products = $this->db->get("product_variants pv")->result();

            foreach($stock_information->products as $key => $row){
                $stock_information->products[$key]->product_variant_id = $this->hash->encrypt($row->product_variant_id);     
                $stock_information->products[$key]->stock_count_id = $this->hash->encrypt($row->stock_count_id);     
            }

            $this->db->select("p.product_name , pv.variant_name , pv.product_variant_id , lc.stock_count_id , lc.quantity");

            $last_counted = $this->db
            ->join("inventory_stock_count sc" , "sc.stock_count_id = lc.stock_count_id")
            ->join("product_variants pv" , "pv.product_variant_id = sc.product_variant_id")
            ->join("product p" , "p.product_id = pv.product_id")
            ->where("lc.stock_control_id" , $this->hash->decrypt($stock_information->stock_control_id))
            ->get("inventory_stock_last_counted lc")->result();

            foreach($last_counted as $key => $row){
                $last_counted[$key]->stock_count_id = $this->hash->encrypt($row->stock_count_id);
                $last_counted[$key]->product_variant_id = $this->hash->encrypt($row->product_variant_id);
            }

            $stock_information->last_counted = $last_counted;
        }

        return $stock_information;
    }

    public function get_stock_count_by_id_review($stock_id){
        $inventory_information = $this->get_stock_count_by_id($stock_id);
        $product_list = $inventory_information->products;
        $result = array();
        $all = array();
        $uncounted = array();
        $excluded = array();
        $unmatched = array();
        $matched = array();

        //ALL TAB
        foreach($product_list as $row){
            $all[] = array(
                "product_name"                 => ($row->variant_name) ? $row->product_name.' - '.$row->variant_name : $row->product_name,
                "expected"                     => $row->expected ,
                "total"                        => $row->counted ,
                "unit"                         => $row->counted - $row->expected ,
                "cost"                         => ($row->counted - $row->expected) * $row->supply_price,
                "product_variant_id"           => $row->product_variant_id ,
                "sku"                          => $row->sku
            );

            if($row->expected == $row->counted){
                $matched[] = array(
                    "product_name"                 => ($row->variant_name) ? $row->product_name.' - '.$row->variant_name : $row->product_name,
                    "expected"                     => $row->expected ,
                    "total"                        => $row->counted ,
                    "unit"                         => $row->counted - $row->expected ,
                    "cost"                         => ($row->counted - $row->expected) * $row->supply_price,
                    "product_variant_id"           => $row->product_variant_id,
                    "sku"                          => $row->sku
                );
            }

             if($row->expected != $row->counted){
                $unmatched[] = array(
                    "product_name"                 => ($row->variant_name) ? $row->product_name.' - '.$row->variant_name : $row->product_name,
                    "expected"                     => $row->expected ,
                    "total"                        => $row->counted ,
                    "unit"                         => $row->counted - $row->expected ,
                    "cost"                         => ($row->counted - $row->expected) * $row->supply_price,
                    "product_variant_id"           => $row->product_variant_id,
                    "sku"                          => $row->sku
                );
            }

            if($row->status == "uncounted"){
                $uncounted[] = array(
                    "product_name"                 => ($row->variant_name) ? $row->product_name.' - '.$row->variant_name : $row->product_name,
                    "expected"                     => $row->expected ,
                    "total"                        => $row->counted ,
                    "unit"                         => $row->counted - $row->expected ,
                    "cost"                         => ($row->counted - $row->expected) * $row->supply_price,
                    "product_variant_id"           => $row->product_variant_id,
                    "sku"                          => $row->sku
                );
            }

            if($row->status == "excluded"){
                $excluded[] = array(
                    "product_name"                 => ($row->variant_name) ? $row->product_name.' - '.$row->variant_name : $row->product_name,
                    "expected"                     => $row->expected ,
                    "total"                        => $row->counted ,
                    "unit"                         => $row->counted - $row->expected ,
                    "cost"                         => ($row->counted - $row->expected) * $row->supply_price,
                    "product_variant_id"           => $row->product_variant_id,
                    "sku"                          => $row->sku
                );
            }

        }

        $inventory_information->products = array(
            "all" => $all ,
            "excluded" => $excluded ,
            "uncounted" => $uncounted ,
            "unmatched" => $unmatched, 
            "matched" => $matched 
        );

        return $inventory_information;
    }

    public function get_stock_control_list($status = "DUE"){
        $store_id = $this->data['session_data']->store_id;
        $current_time = time();

        $this->db->select("tc.stock_control_id , tc.count_name , tc.status , o.outlet_name , tc.created , tc.count_type");
        $this->db->join("store_outlet o" , "o.outlet_id = tc.outlet_id");
        $this->db->where("tc.store_id" , $store_id);

        switch ($status) {
            case 'DUE':
                $this->db->where("tc.schedule_time < " , $current_time)->where("tc.status" , "IN PROGRESS");
                break;
            case 'UPCOMING':
                $this->db->where("tc.schedule_time > " , $current_time)->where("tc.status" , "IN PROGRESS");
                break;
            case 'COMPLETED':
                $this->db->where("tc.status" , "COMPLETED");
                break;
            case 'CANCELLED':
                $this->db->where("tc.status" , "CANCELLED");
                break;
            default:
                # code...
                break;
        }

        $result = $this->db->get("inventory_stock_control tc")->result();

        foreach($result as $key => $row){
            $result[$key]->created = fromNow($row->created);
            $result[$key]->count_type = ucwords($row->count_type);
            $result[$key]->stock_control_id = $this->hash->encrypt($row->stock_control_id);

            if($status == "CANCELLED"){
                $result[$key]->stock_control_link = site_url("app/product/inventory-count/$row->stock_control_id");
            }else{
                $result[$key]->stock_control_link = site_url("app/product/inventory-count/start/$row->stock_control_id");
            }
        }

        return $result;

    }

    public function update_stock_control($id , $status){
        $this->db->trans_start();

        $this->db->where("stock_control_id" , $id)->update("inventory_stock_control" , ["status" => $status]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }
    public function order_stock($type = "ORDER"){
        $store_id = $this->data['session_data']->store_id;
        $user_id = $this->data['session_data']->user_id;

        $this->db->trans_start();

        $this->db->insert("inventory_order" , [
            "reference_name"    => $this->input->post("reference_name") ,
            "order_type"        => $type ,
            "created"           => time() ,
            "due_date"          => strtotime($this->input->post("due_date")),
            "order_number"      => $this->input->post("order_no"),
            "status"            => "Open" ,
            "items_count"       => 0 ,
            "order_from"        => $this->hash->decrypt($this->input->post("order_from")) ,
            "deliver_to"        => $this->hash->decrypt($this->input->post("deliver_to")) ,
            "supplier_invoice"  => $this->input->post("supplier_invoice") ,
            "autofill"          => $this->input->post("auto_fill"),
            "created_by"        => $user_id ,
            "store_id"          => $store_id
        ]);

        $inventory_order_id = $this->db->insert_id();

        //AUTO SELECT BELOW MINIMUM STOCK

        if($type == "ORDER" AND $this->input->post("auto_fill")){

            $data = $this->get_product_list(true , $this->hash->decrypt($this->input->post("deliver_to")) );


            $product_variant_id = array();
            $total_cost = 0;

            foreach($data as $key => $row){
                $product_variant_id[] = array(
                    "inventory_order_id" => $inventory_order_id ,
                    "order_number"       => ($key + 1) ,
                    "product_variant_id" => $this->hash->decrypt($row->product_variant_id) ,
                    "quantity"           => $row->order_quantity,
                    "supply_price"       => $row->supply_price ,
                    "current_stock"      => $row->current_inventory,
                    "total_price"        => ($row->order_quantity * $row->supply_price)
                );

                $total_cost += ($row->order_quantity * $row->supply_price);
            }

            $this->db->insert_batch("inventory_stock_order" , $product_variant_id);


            //UPDATE INVENTORY ORDER FOR TOTAL COST

            $this->db->where("inventory_order_id" , $inventory_order_id)->update("inventory_order" , [
                "total_cost" => $total_cost , 
                "items_count" => count( $product_variant_id )
            ]);

        }


         
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $this->hash->encrypt($inventory_order_id);
        }
    }

    public function get_consignment(){
        $store_id = $this->data['session_data']->store_id;

        $this->db->select("ord.inventory_order_id , ord.reference_name , ord.order_type , ord.created , ord.due_date , ord.order_number , ord.status , ord.items_count , ord.total_cost , s.supplier_name as order_from , so.outlet_name as deliver_to , ord.supplier_invoice , ord.autofill , ord.created_by , u.display_name");
        $this->db->join("supplier s" , "s.supplier_id = ord.order_from" , "LEFT");
        $this->db->join("store_outlet so" , "so.outlet_id = ord.deliver_to" , "LEFT");
        $this->db->join("user u" , "u.user_id = ord.created_by");
        $this->db->where("ord.store_id" , $store_id);
        $result = $this->db->order_by("ord.created" , "DESC")->get("inventory_order ord")->result();

        foreach($result as $key => $row){
            $result[$key]->inventory_order_id = $this->hash->encrypt($row->inventory_order_id);
            $result[$key]->created = convert_timezone($row->created);
            $result[$key]->due_date = convert_timezone($row->due_date);
            $result[$key]->order_from = ($row->order_from) ? $row->order_from : "Any";

            if($row->order_type == "ORDER"){
                $result[$key]->edit_link = $this->config->site_url("app/product/order-stock/edit/".$result[$key]->inventory_order_id);
            }else{
                $result[$key]->edit_link = $this->config->site_url("app/product/return-stock/edit/".$result[$key]->inventory_order_id);
            }
            
        }

        return $result;
    }

    public function get_consignment_by_id($id){
        $id = $this->hash->decrypt($id);

        $this->db->select("ord.inventory_order_id , ord.reference_name , ord.order_type , ord.created , ord.due_date , ord.order_number , ord.status , ord.items_count , ord.total_cost , s.supplier_name as order_from , so.outlet_name as deliver_to , ord.supplier_invoice , ord.autofill , ord.created_by , u.display_name , ord.deliver_to as d_to");
        $this->db->join("supplier s" , "s.supplier_id = ord.order_from" , "LEFT");
        $this->db->join("store_outlet so" , "so.outlet_id = ord.deliver_to" , "LEFT");
        $this->db->join("user u" , "u.user_id = ord.created_by");
        $this->db->where("ord.inventory_order_id" , $id);
        $result = $this->db->order_by("ord.created" , "DESC")->get("inventory_order ord")->row();

        if($result){
            $result->inventory_order_id = $this->hash->encrypt($result->inventory_order_id);

            if($result->order_type == "ORDER"){
                $result->edit_link = $this->config->site_url("app/product/order-stock/edit/".$result->inventory_order_id);
            }else{
                $result->edit_link = $this->config->site_url("app/product/return-stock/edit/".$result->inventory_order_id);
            }

            if($result->order_from == ""){
                $result->order_from = "ANY";
            }

            $result->due_date = convert_timezone($result->due_date);
            $result->created = convert_timezone($result->created);

            //LIST OF PRODUCT VARIANTS

            $this->db->select("inventory_order_id , io.order_number , io.product_variant_id , quantity , io.supply_price , total_price , i.current_inventory , io.current_stock , io.recieved_stock");
            $this->db->select("pv.variant_name , p.product_name , pv.markup_price , pv.retail_price_wot , pv.sku , pv.supplier_code");
            $this->db->join("product_variants pv" , "pv.product_variant_id = io.product_variant_id");
            $this->db->join("product p" , "p.product_id = pv.product_id");
            $this->db->join("inventory i" , "i.product_variant_id = io.product_variant_id");
            $this->db->where("io.inventory_order_id" , $this->hash->decrypt($result->inventory_order_id));
            $this->db->where("i.outlet_id" , $result->d_to);
            $this->db->order_by("io.order_number" , "DESC");
            
            $product_list = $this->db->get("inventory_stock_order io")->result();

            $result->total_inventory = 0;
            $result->total_ordered = 0;
            $result->total_recieved = 0;
            $result->total_price = 0;
            $result->total_retail_price = 0;
            
            foreach($product_list as $key => $row){
                $product_list[$key]->product_variant_id = $this->hash->encrypt($row->product_variant_id);
                $product_list[$key]->inventory_order_id = $this->hash->encrypt($row->inventory_order_id);
                $product_list[$key]->total_retail_price = $row->quantity * $row->retail_price_wot;


                $result->total_inventory += $row->current_inventory;
                $result->total_ordered += $row->quantity;
                $result->total_recieved += $row->recieved_stock;
                $result->total_price += $row->total_price;
                $result->total_retail_price += $product_list[$key]->total_retail_price;
            }

            $result->product_list = $product_list;
        }

        return $result;
    }

    public function save_stock_settings(){
        $inventory_order_id = $this->hash->decrypt($this->input->post("inventory_order_id"));
        $list = $this->input->post("product_variant");

        $this->db->trans_start();


        //REMOVE ALL THE DATA IN INVENTORY ORDER
        $this->db->where("inventory_order_id" , $inventory_order_id)->delete("inventory_stock_order");

        $data = array();

        $total_price = 0;

        //PREPARE THE DATA FOR BATCH INSERT
        foreach($list['product_variant_id'] as $key => $row){
            $data[] = array(
                "product_variant_id" => $this->hash->decrypt($list['product_variant_id'][$key]),
                "order_number"       => $list['order_number'][$key],
                "quantity"           => $list['quantity'][$key],
                "supply_price"       => $list['supply_price'][$key],
                "total_price"        => $list['total_price'][$key],
                "current_stock"      => $list['current_stock'][$key],
                "inventory_order_id" => $inventory_order_id
            );

            $total_price += $list['total_price'][$key];
        }

        //INSERT THE NEW DATA FOR INVENTORY ORDER
        $this->db->insert_batch("inventory_stock_order" , $data);


        //UPDATE THE TOTAL COST ON INVENTORY ORDER TABLE
        $this->db->where("inventory_order_id" , $inventory_order_id)->update("inventory_order" , [
            "total_cost"   => $total_price ,
            "items_count"  => count($data)
        ]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function update_consignment(){
        $inventory_order_id = $this->hash->decrypt($this->input->post("inventory_order_id"));

        $this->db->trans_start();

        $this->db->where("inventory_order_id" , $inventory_order_id)->update("inventory_order" , [
            "reference_name"   => $this->input->post("order_name"), 
            "due_date"         => strtotime($this->input->post("due_date")),
            "order_number"     => $this->input->post("order_number"),
            "supplier_invoice" => $this->input->post("supplier_invoice")
        ]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function save_stock_count(){
        $stock_control_id = $this->hash->decrypt($this->input->post("stock_control_id"));
        $product = $this->input->post("product");

        $this->db->trans_start();   


        //UPDATE THE STOCK COUNT
        foreach($product["stock_count_id"] as $key => $row){

            $stock_count_id = $product['stock_count_id'][$key];
            $counted        = $product['counted'][$key];
            $status         = $product['status'][$key];

            $this->db->where("stock_count_id" , $this->hash->decrypt($stock_count_id))->update("inventory_stock_count" , [
                "counted" => $counted ,
                "status"  => $status
            ]);
        }


        //REMOVE LAST COUNTED
        $this->db->where("stock_control_id" , $stock_control_id)->delete("inventory_stock_last_counted");

        //ADD COUNTED
        $counted = array();
        $stock = $this->input->post("stock");

        if($stock){
            foreach($stock['stock_count_id'] as $key => $row){
                $counted[] = array(
                    "stock_control_id"=> $stock_control_id ,
                    "stock_count_id"  => $this->hash->decrypt($stock['stock_count_id'][$key]),
                    "quantity"        => $stock['quantity'][$key],
                    "created"         => time()
                );
            }
            $this->db->insert_batch("inventory_stock_last_counted" , $counted);
        }

    
        //UPDATE THE STOCK CONTROL
        $this->db->where("stock_control_id" , $stock_control_id)->update("inventory_stock_control" , [
            "updated" => time()
        ]);

        $this->db->trans_complete();


        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }
}