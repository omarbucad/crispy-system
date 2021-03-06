<?php

class Timetracker_model extends CI_Model {

	public function add_staff(){
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

        $this->db->insert("timetracker_staff" , [
            "contact_id"                => $contact_id ,
            "store_id"                  => $store_id ,
            "physical_address"          => $physical_address,
            "postal_address"            => $postal_address,
            "staff_group"               => $this->hash->decrypt($this->input->post("staff_group")),
            "outlet_id"                 => $this->hash->decrypt($this->input->post("outlet_id")),
            "staff_code"                => ($this->input->post("staff_code")) ? $this->input->post("staff_code") : $this->input->post("first_name").'-'.substr(uniqid('', true), -5) ,
            "dob_day"                   => $this->input->post("date_of_birth")["dd"] ,
            "dob_month"                 => $this->input->post("date_of_birth")["mm"] ,
            "dob_year"                  => $this->input->post("date_of_birth")["yy"] ,
            "gender"                    => $this->input->post("gender") ,
            "field_1"                   => $this->input->post("field1") ,
            "field_2"                   => $this->input->post("field2") ,
            "field_3"                   => $this->input->post("field3") ,
            "field_4"                   => $this->input->post("field4") ,
            "notes"                     => $this->input->post("note") ,
            "max_hours"					=> $this->input->post("max_hour_per_week"),
            "hourly_rate"				=> $this->input->post("hourly_rate"),
            "status"                    => 1 ,
            "created"                   => time(),
        ]);

        $staff_id = $this->db->insert_id();

        $this->do_upload($staff_id); 
        $this->multiple_upload($staff_id);


		$this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $staff_id;
        }
	}

	public function get_staff($count = false){
		$store_id = $this->data['session_data']->store_id;

        $skip = ($this->input->get("per_page")) ? $this->input->get("per_page") : 0;
        $limit = ($this->input->get("limit")) ? $this->input->get("limit") : 10;

        $this->db->select("c.staff_id , c.staff_group , c.contact_id  , c.staff_code , c.dob_day , c.dob_month , c.dob_year , c.gender , c.physical_address , c.postal_address , c.field_1 , c.field_2 , c.field_3 , c.field_4 , c.notes , c.created , c.image_name , c.image_path ");
        $this->db->select("CONCAT(sc.first_name , ' ' , sc.last_name) as display_name , sc.email , sc.fax , sc.phone , sc.website , sc.field_1 as facebook , sc.field_2 as twitter");
        $this->db->select("sa1.street1 as physical_street1 , sa1.street2 as physical_street2, sa1.suburb as physical_suburb ,sa1.city as physical_city, sa1.postcode as physical_postcode, sa1.state as physical_state, sa1.country as physical_country");
        $this->db->select("sa2.street1 as postal_street1 , sa2.street2 as postal_street2, sa2.suburb as postal_suburb ,sa2.city as postal_city, sa2.postcode as postal_postcode, sa2.state as postal_state, sa2.country as postal_country");
        $this->db->select("cg.group_name , cg.group_color , to.outlet_name");

        $this->db->join("store_contact sc" , "sc.store_contact_id = c.contact_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = c.physical_address");
        $this->db->join("store_address sa2" , "sa2.store_address_id = c.postal_address");
        $this->db->join("timetracker_staff_group cg" , "cg.group_id = c.staff_group");
        $this->db->join("store_outlet to" , "to.outlet_id = c.outlet_id");
       
        if($count){
           return $this->db->where("c.store_id" , $store_id)->get("timetracker_staff c")->num_rows();
        }else{
            $result = $this->db->where("c.store_id" , $store_id)->limit($limit , $skip)->get("timetracker_staff c")->result();

            foreach($result as $key => $row){
            	$files = $this->db->where("staff_id" , $row->staff_id)->get("timetracker_staff_files")->result();
            	$result[$key]->staff_files = $files;
            }
        }
        return $result;
	}

	private function multiple_upload($staff_id){

		$year = date("Y");
        $month = date("m");
        $folder = "./public/upload/staff_files/".$year."/".$month;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
            create_index_html($folder);
        }

        $config['upload_path']          = $folder;
        $config['allowed_types']        = "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt";

        $data = $_FILES['other_file'];

        $this->load->library('upload', $config);
        $this->load->library('image_lib');

        if(!empty($_FILES['other_file']['name'])){
        	$filesCount = count($_FILES['other_file']['name']);

        	for($i = 0; $i < $filesCount; $i++){
        		$_FILES['other_file']['name'] = $data['name'][$i];
        		$_FILES['other_file']['type'] = $data['type'][$i];
        		$_FILES['other_file']['tmp_name'] = $data['tmp_name'][$i];
        		$_FILES['other_file']['error'] = $data['error'][$i];
        		$_FILES['other_file']['size'] = $data['size'][$i];

        		$config['file_name'] = md5($staff_id).'_'.time().'_'.$data['name'][$i];

        		$this->upload->initialize($config);

        		if ( $this->upload->do_upload('other_file')){

        			$image = $this->upload->data();

        			$this->db->insert('timetracker_staff_files' , [
        				"staff_id" 		=> $staff_id ,
        				"file_name"     => $year.'/'.$month.'/'.$image['file_name'] ,
        				"file_type"     => $image['file_type'],
        				"full_path"     => $image['full_path'] ,
        				"created"		=> time()
        			]);
        		}
            }//end for loop

        }//end if

	}

	private function do_upload($staff_id){

        $year = date("Y");
        $month = date("m");
        $folder = "./public/upload/staff/".$year."/".$month;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
            mkdir($folder.'/thumbnail', 0777, true);

            create_index_html($folder);
        }
    
        $image_name = md5($staff_id).'_'.time().'_'.$_FILES['file']['name'];
        $image_name = str_replace("^", "_", $image_name);
       
        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $image_name;

        $this->load->library('upload', $config);
        $this->load->library('image_lib');

        if ($this->upload->do_upload('file')){
            $this->db->where("staff_id" , $staff_id)->update("timetracker_staff" , [
                "image_path" => $year."/".$month ,
                "image_name" => $image_name
            ]);
        }
    }

	public function get_group(){
		$store_id = $this->data['session_data']->store_id;

        $this->db->select("group_id , group_name , deletable , group_color , created");
        $this->db->where("store_id" , $store_id)->order_by("group_name" , "ASC");
        $result = $this->db->get("timetracker_staff_group")->result();

        foreach($result as $key => $row){
            $result[$key]->group_id = $this->hash->encrypt($row->group_id);
            $result[$key]->created = convert_timezone($row->created , true);
         }

        return $result;
	}
	
	public function add_group(){
		$store_id = $this->data['session_data']->store_id;

		$this->db->trans_start();

		$this->db->insert("timetracker_staff_group" , [
			"store_id" 		=> $store_id ,
			"group_name" 	=> $this->input->post("group_name") ,
			"group_color" 	=> $this->input->post("group_color") ,
			"created" 		=> time()
		]);

		$last_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $last_id;
        }
	}

	public function get_shift_block_list(){
		$store_id = $this->data['session_data']->store_id;

		$this->db->select("start_time , end_time , unpaid_break , block_color , outlet_name , group_name");

		$this->db->join("store_outlet so" , "so.outlet_id = sb.outlet_id");
		$this->db->join("timetracker_staff_group sg" , "sg.group_id = sb.position");
		$this->db->where("custom_block" , "0");
		$this->db->where("sb.store_id" , $store_id);

		return $this->db->get("timetracker_shift_blocks sb")->result();

	}

	public function add_shift_block($custom = 0){
		$store_id = $this->data['session_data']->store_id;

		$this->db->trans_start();

		$this->db->insert("timetracker_shift_blocks" , [
			"store_id"		 => $store_id ,
			"outlet_id"      => $this->hash->decrypt($this->input->post("outlet_id")),
			"start_time"     => $this->input->post("pre_time_start"),
			"end_time"       => $this->input->post("pre_time_end"),
			"position"       => $this->hash->decrypt($this->input->post("position")),
			"block_color"    => $this->input->post("group_color"),
			"unpaid_break"   => $this->input->post("unpaid_break"),
			"custom_block"   => $custom ,
			"created"        => time()
 		]);
        
        $last_id = $this->db->insert_id();

		$this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $last_id;
        }
	}

    public function get_staff_by_outlet($date_range){
        $store_id = $this->data['session_data']->store_id;
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));
        $date_range = $this->get_only_date($date_range);


        $this->db->join("timetracker_shift_date sd" , "sd.schedule_id = su.schedule_id");
        $this->db->join("timetracker_staff_group sg" , "sg.group_id = sd.position_id");
        $this->db->where("su.store_id" , $store_id);
        $this->db->where("su.outlet_id" , $outlet_id);
        $this->db->where("su.schedule_published" , 0);
        $this->db->where_in("sd.schedule_date" , $date_range);
        $unpublished = $this->db->get("timetracker_shift_schedule_unpublished su")->result();



        $this->db->join("timetracker_staff_group sg" , "sg.group_id = sp.position_id");
        $this->db->where("sp.store_id" , $store_id);
        $this->db->where("sp.outlet_id" , $outlet_id);
        $this->db->where_in("sp.date_schedule" , $date_range);
        $published = $this->db->get("timetracker_shift_schedule_published sp")->result();


        $this->db->select("ts.max_hours , ts.image_path , ts.image_name , sc.first_name , sc.last_name , ts.staff_id");
        $this->db->join("store_contact sc" , "sc.store_contact_id = ts.contact_id");
        $result = $this->db->where("store_id" , $store_id)->where("ts.outlet_id" , $outlet_id)->get("timetracker_staff ts")->result();

        foreach($result as $key => $row){
            $result[$key]->schedule_list = array();

            foreach($published as $r){
                if($row->staff_id == $r->staff_id){
                    $tmp = $r;
                    $tmp->date_id = $this->hash->encrypt($tmp->date_id);
                    $tmp->published = "published";
                    $tmp->total_hours = compute_time_hours($tmp->start_time , $tmp->end_time);
                    $tmp->start_time = substr(date("h:ia" , strtotime($tmp->start_time)) , 0, -1);
                    $tmp->end_time = substr(date("h:ia" , strtotime($tmp->end_time)) , 0, -1);
                    $result[$key]->schedule_list[ date("D" , strtotime($tmp->date_schedule)) ][$tmp->shift_template_id] = $tmp;
                }
            }

            foreach($unpublished as $r){
                if($row->staff_id == $r->staff_id){

                    $tmp = $r;
                    $tmp->date_id = $this->hash->encrypt($tmp->date_id);
                    $tmp->published = "unpublished";
                    $tmp->total_hours = compute_time_hours($tmp->start_time , $tmp->end_time);
                    $tmp->start_time = substr(date("h:ia" , strtotime($tmp->start_time)) , 0, -1);
                    $tmp->end_time = substr(date("h:ia" , strtotime($tmp->end_time)) , 0, -1);

                    $result[$key]->schedule_list[date("D" , strtotime($tmp->schedule_date))][$tmp->shift_template_id] = $tmp;
                }
            }

            $result[$key]->staff_id = $this->hash->encrypt($row->staff_id);
        }


        $this->db->join("timetracker_shift_date sd" , "sd.schedule_id = su.schedule_id");
        $this->db->where("su.store_id" , $store_id);
        $this->db->where("su.outlet_id" , $outlet_id);
        $this->db->where("su.schedule_published" , 0);
        $unpublished_row = $this->db->get("timetracker_shift_schedule_unpublished su")->num_rows();

        return [
            "result" => $result ,
            "unpublished" => ($unpublished_row > 0) ? true : false
        ];
    }


    public function get_preferred_shift(){
        $store_id = $this->data['session_data']->store_id;
        $staff_id = $this->hash->decrypt($this->input->post("staff_id"));
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));

        $staff_information = $this->db->select("sc.first_name , sc.last_name")->where("staff_id" , $staff_id)->join("store_contact sc" , "sc.store_contact_id = ts.contact_id")->get("timetracker_staff ts")->row();

        $this->db->select("sb.shift_blocks_id , sb.start_time , sb.end_time , sb.block_color , sg.group_name , sg.group_color");
        $this->db->join("timetracker_staff_group sg" , "sg.group_id = sb.position");
        $this->db->where("sb.store_id" , $store_id)->where("sb.outlet_id" , $outlet_id)->where("sb.custom_block" , 0)->where("sb.deleted IS NULL");

        $result = $this->db->get("timetracker_shift_blocks sb")->result();

        $shift = array();

        foreach($result as $key => $row){
            $result[$key]->start_time = substr(date("h:ia" , strtotime($row->start_time)) , 0, -1);
            $result[$key]->end_time =  substr(date("h:ia" , strtotime($row->end_time)) , 0, -1);
            $result[$key]->shift_blocks_id = $this->hash->encrypt($row->shift_blocks_id);

            $shift["QUALIFIED"][] = $result[$key];
        }

        return [
            "staff" => $staff_information ,
            "shift" => $shift ,
            "date"  =>  ucfirst(strtolower($this->input->post("date")))
        ];   
    }

    public function get_shift_information_today(){
        $store_id = $this->data['session_data']->store_id;
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));

        if($this->input->post("outlet_id") == "ALL_OUTLET"){

            // TEMPORARY DATE 
            //TODO:: MUST CHECK IF THE TIMEZONE OF STORE OR TIMEZONE OF FIRST OUTLET
            $today = date("F n Y");

        }else{

            //GETTING TIMEZONE OF THE STAFF
            $this->db->select("sa1.timezone as timezone");
            $this->db->join("store_address sa1" , "sa1.store_address_id = so.physical_address");
            $outlet_information = $this->db->where("so.outlet_id" , $outlet_id)->get("store_outlet so")->row();

            $timezone = $outlet_information->timezone;

            //GET THE CURRENT DATE USING THE TIMEZONE
            $date = new DateTime("now", new DateTimeZone($timezone) );
            $today = $date->format('F n Y');

        }

        $this->db->select("ts.max_hours , ts.image_path , ts.image_name , sc.first_name , sc.last_name , ts.staff_id");
        $this->db->join("store_contact sc" , "sc.store_contact_id = ts.contact_id");

        if($this->input->post("outlet_id") != "ALL_OUTLET"){
            $this->db->where("ts.outlet_id" , $outlet_id);
        }

        $result = $this->db->where("ts.store_id" , $store_id)->get("timetracker_staff ts")->result();

        foreach($result as $key => $row){
            $this->db->join("store_outlet o" , "o.outlet_id = sp.outlet_id");
            $this->db->join("timetracker_staff_group sg" , "sg.group_id = sp.position_id");
            $shift_information = $this->db->where("sp.date_schedule" , $today)->where("sp.staff_id" , $row->staff_id)->get("timetracker_shift_schedule_published sp")->row();

            $result[$key]->shift_information = $shift_information;
            $result[$key]->td_list = build_today_td($result[$key]);
        }

        return $result;
    }

    public function assign_shift_to_staff($shift_id = false){
        $store_id = $this->data['session_data']->store_id;
        $staff_id = $this->hash->decrypt($this->input->post("staff_id"));
        $date     = $this->input->post("date_name");
        $shift_id = ($shift_id) ? $shift_id : $this->hash->decrypt($this->input->post("shift_id"));
        $outlet_id= $this->hash->decrypt($this->input->post("outlet_id"));
        $user_id  = $this->data['session_data']->user_id;

        $this->db->trans_start();

        //CHECK THE UNPUBLISHED TABLE IF IT HAS AN UNPUBLISHED DATA IF NOT CREATE A NEW ONE

        $check = $this->db->where([
            "store_id"              =>  $store_id ,
            "schedule_published"    =>  0 ,
            "outlet_id"             =>  $outlet_id
        ])->get("timetracker_shift_schedule_unpublished")->row();

        if(!$check){

            $this->db->insert("timetracker_shift_schedule_unpublished" , [
                "store_id"           => $store_id ,
                "outlet_id"          => $outlet_id ,
                "schedule_published" => 0 ,
                "account_id"         => $user_id ,
                "created"            => time()
            ]);

            $unpublished_shift_id = $this->db->insert_id();

        }else{

            $unpublished_shift_id = $check->schedule_id;
    
        }

        //SAVE SHIFT ID ON UNPUBLISHED TABLE
        $shift_information = $this->db->where("shift_blocks_id" , $shift_id)->get("timetracker_shift_blocks")->row();

        $this->db->insert("timetracker_shift_date" , [
            "schedule_id"       => $unpublished_shift_id ,
            "shift_template_id" => $shift_id ,
            "start_time"        => $shift_information->start_time,
            "end_time"          => $shift_information->end_time,
            "block_color"       => $shift_information->block_color,
            "unpaid_break"      => $shift_information->unpaid_break,
            "position_id"       => $shift_information->position,
            "staff_id"          => $staff_id,
            "schedule_date"     => $date
        ]);

        $last_id = $this->db->insert_id();

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return [
                "id" => $last_id ,
                "total_hours" => compute_time_hours($shift_information->start_time , $shift_information->end_time)
            ];
        }
    }


    public function get_shift_information_by_id($id , $published){
        $date_id = $this->hash->decrypt($id);

        if($published == "published"){
            $this->db->join("timetracker_staff_group sg" , "sg.group_id = sp.position_id");
            $this->db->where("sp.date_id" , $date_id);
            $result = $this->db->get("timetracker_shift_schedule_published sp")->row();   
        }else{
            $this->db->join("timetracker_shift_date sd" , "sd.schedule_id = su.schedule_id");
            $this->db->join("timetracker_staff_group sg" , "sg.group_id = sd.position_id");
            $this->db->where("sd.date_id" , $date_id);
            $result = $this->db->get("timetracker_shift_schedule_unpublished su")->row();
        }

        if($result){
            $result->position_id = $this->hash->encrypt($result->position_id);
        }
        
        return $result;
    }

    public function edit_shift_template(){
        $store_id = $this->data['session_data']->store_id;
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));
        $user_id  = $this->data['session_data']->user_id; 
        $shift_id = $this->hash->decrypt($this->input->post("date_id"));   

        $this->db->trans_start();

        $check = $this->db->where([
            "store_id"              =>  $store_id ,
            "schedule_published"    =>  0 ,
            "outlet_id"             =>  $outlet_id
        ])->get("timetracker_shift_schedule_unpublished")->row();

        if(!$check){

            $this->db->insert("timetracker_shift_schedule_unpublished" , [
                "store_id"           => $store_id ,
                "outlet_id"          => $outlet_id ,
                "schedule_published" => 0 ,
                "account_id"         => $user_id ,
                "created"            => time()
            ]);

            $unpublished_shift_id = $this->db->insert_id();

        }else{

            $unpublished_shift_id = $check->schedule_id;
    
        }

        if($this->input->post("published") == "published"){

            //SAVE SHIFT ID ON UNPUBLISHED TABLE
            $shift_information = $this->db->where("shift_blocks_id" , $shift_id)->get("timetracker_shift_blocks")->row();

            $this->db->insert("timetracker_shift_date" , [
                "schedule_id"       => $unpublished_shift_id ,
                "shift_template_id" => $shift_id ,
                "start_time"        => $shift_information->start_time,
                "end_time"          => $shift_information->end_time,
                "block_color"       => $shift_information->block_color,
                "unpaid_break"      => $shift_information->unpaid_break,
                "position_id"       => $shift_information->position,
                "staff_id"          => $staff_id,
                "schedule_date"     => $date
            ]);

            $last_id = $this->db->insert_id();   

        }else{
            $this->db->where("date_id" , $shift_id)->update('timetracker_shift_date' , [
                "start_time"        => $this->input->post("pre_time_start"),
                "end_time"          => $this->input->post("pre_time_end"),
                "block_color"       => $this->input->post("group_color"),
                "unpaid_break"      => $this->input->post("unpaid_break"),
                "position_id"       => $this->hash->decrypt($this->input->post("position"))
            ]);

            $last_id = $shift_id;
        }


        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $last_id;
        }
    }

    public function publish_shift(){
        $store_id = $this->data['session_data']->store_id;
        $user_id  = $this->data['session_data']->user_id; 
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));

        $this->db->trans_start();


        //GET LIST OF UNPUBLISHED RESULT
        $this->db->join("timetracker_shift_date sd" , "sd.schedule_id = su.schedule_id");
        $this->db->where("su.store_id" , $store_id);
        $this->db->where("su.outlet_id" , $outlet_id);
        $this->db->where("su.schedule_published" , 0);
        $unpublish_result = $this->db->get("timetracker_shift_schedule_unpublished su")->result();

        $schedule_id = $unpublish_result[0]->schedule_id;
       
        //UPDATE THE UNPUBLISHED TABLE
        $this->db->where("schedule_id" , $schedule_id)->update("timetracker_shift_schedule_unpublished" , [
            "schedule_published" => 1 ,
            "published_date"     => time()
        ]);

        $publish_insert_array = array();

        foreach($unpublish_result as $key => $row){
            $publish_insert_array[] = array(
                "store_id"          => $store_id ,
                "outlet_id"         => $outlet_id ,
                "date_id"           => $row->date_id ,
                "shift_template_id" => $row->shift_template_id ,
                "start_time"        => $row->start_time ,
                "end_time"          => $row->end_time ,
                "block_color"       => $row->block_color ,
                "unpaid_break"      => $row->unpaid_break ,
                "position_id"       => $row->position_id ,
                "staff_id"          => $row->staff_id ,
                "date_schedule"     => $row->schedule_date
            );
        }

        $this->db->insert_batch("timetracker_shift_schedule_published" , $publish_insert_array);
        
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function create_pay_period(){
        $store_id  = $this->data['session_data']->store_id;
        $user_id   = $this->data['session_data']->user_id; 
        $daterange = $this->input->post("daterange");
        $daterange = explode("-", $daterange);

        $this->db->trans_start();


        //CREATE PAY PERIOD
        $this->db->insert("timetracker_pay" , [
            "store_id"          => $store_id ,
            "account_id"        => $user_id ,
            "from_date"         => date("F j Y" , strtotime($daterange[0])),
            "to_date"           => date("F j Y" , strtotime($daterange[1])),
            "pay_name"          => date("M j" , strtotime($daterange[0])).' - '.date("M j, Y" , strtotime($daterange[1])),
            "created"           => time()
        ]);

        $pay_id = $this->db->insert_id();


        //THEN INSERT EACH STAFF A SUMMARY
        $staff_list = $this->db->select("ts.staff_id")->where("store_id" , $store_id)->get("timetracker_staff ts")->result();
        $s_list = array();

        foreach($staff_list as $r){
            $s_list[] = array(
                "staff_id" => $r->staff_id ,
                "pay_id"   => $pay_id 
            );
        }

        $this->db->insert_batch("timetracker_summary" , $s_list);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return true;
        }
    }

    public function get_pay_period_list(){
        $store_id = $this->data['session_data']->store_id;

        $result = $this->db->select("pay_name , pay_id")->distinct("pay_name")->where("store_id" , $store_id)->order_by("created" , "DESC")->limit(20)->get("timetracker_pay")->result();
        
        foreach($result as $key => $r){
            $result[$key]->pay_id = $this->hash->encrypt($r->pay_id);
        }

        return $result;
    }

    public function get_attendance_staff(){
        $store_id = $this->data['session_data']->store_id;
        $outlet_id = $this->hash->decrypt($this->input->post("outlet_id"));
        $pay_period_id = $this->hash->decrypt($this->input->post("pay_period_id"));

        $this->db->select("ts.image_path , ts.image_name , sc.first_name , sc.last_name , ts.staff_id");
        $this->db->join("timetracker_staff ts" , "ts.staff_id = tsm.staff_id");
        $this->db->join("store_contact sc" , "sc.store_contact_id = ts.contact_id");
        

        if($this->input->post("outlet_id") != "ALL_OUTLET"){
            $this->db->where("ts.outlet_id" , $outlet_id);
        }

        $result = $this->db->where("ts.store_id" , $store_id)->where("tsm.pay_id" , $pay_period_id)->get("timetracker_summary tsm")->result();

        foreach($result as $key => $row){
            $result[$key]->staff_id = $this->hash->encrypt($row->staff_id);
        }

        return $result;
    }

    public function get_summary_by_id(){
        $staff_id = $this->hash->decrypt($this->input->post("staff_id"));
        $pay_period_id = $this->hash->decrypt($this->input->post("pay_period_id"));

        $this->db->select("tsm.summary_id , tsm.staff_id , tsm.approved , tsm.field_1 , tsm.field_2 , tsm.field_3 , tsm.field_4 , tsm.field_5  , sc.first_name , sc.last_name , tp.pay_name");
        $this->db->join("timetracker_staff ts" , "ts.staff_id = tsm.staff_id");
        $this->db->join("store_contact sc" , "sc.store_contact_id = ts.contact_id");
        $this->db->join("timetracker_pay tp" , "tp.pay_id = tsm.pay_id");
        $result = $this->db->where("tsm.staff_id" , $staff_id)->where("tsm.pay_id" , $pay_period_id)->get("timetracker_summary tsm")->row();

        if($result){
            $result->staff_id = $this->hash->encrypt($result->staff_id);
            $result->summary_id = $this->hash->encrypt($result->summary_id);
        }

        return $result;
    }

    public function get_attendance_list(){
        $staff_id = $this->hash->decrypt($this->input->post("staff_id"));
        $pay_period_id = $this->hash->decrypt($this->input->post("pay_period_id"));

        $pay_information = $this->db->where("pay_id" , $pay_period_id)->get("timetracker_pay")->row();

        $loop_date = loop_date($pay_information->from_date , $pay_information->to_date , true);

        $attendance_list = array();

        $published_information = $this->db->where("staff_id" , $staff_id)->where_in("date_schedule" , $loop_date)->get('timetracker_shift_schedule_published')->result();

        foreach($published_information as $row){

            $schedule = compute_time_hours($row->start_time , $row->end_time);
            $worked   = 0;

            $attendance_list[ strtotime($row->date_schedule) ] = array(
                "tc_id"     => "NO_TIMECLOCK",
                "d"         => date("D" , strtotime($row->date_schedule)) ,
                "day"       => date("D , M j" , strtotime($row->date_schedule)) ,
                "time_in"   => '-' ,
                "time_out"  => '-' ,
                "late"      => '-' ,
                "worked"    => $worked ,
                "schedule"  => round($schedule , 2 ) ,
                "diff"      => round($worked - $schedule  , 2)
            ); 
        }

        $timeclock = $this->db->where("staff_id" , $staff_id)->where_in("shift_date" , $loop_date)->get("timetracker_timeclock")->result();

        foreach($timeclock as $row){
            
            $attendance_list[ strtotime($row->shift_date) ] = array(
                "tc_id"     => $this->hash->encrypt($row->timeclock_id), 
                "d"         => date("D" , strtotime($row->shift_date)) ,
                "day"       => date("D , M j" , strtotime($row->shift_date)) ,
                "time_in"   => date("h:ia" , strtotime($row->time_in)),
                "time_out"  => ($row->time_out) ? date("h:ia" , strtotime($row->time_out)) : "-",
                "late"      => $row->late ,
                "worked"    => $row->worked_hrs ,
                "schedule"  => $row->scheduled_hrs ,
                "diff"      => round($row->worked_hrs - $row->scheduled_hrs   , 2)
            ); 
        }

        ksort($attendance_list);

        return $attendance_list;
    }

    public function insert_clock_time(){
        $staff_id = $this->hash->decrypt($this->input->post("staff_id"));
        $clock_in = $this->input->post("clock_in");
        
        $location = array(
            $this->input->post("longitude") , $this->input->post("latitude")
        );

        $this->db->trans_start();

        //GETTING TIMEZONE OF THE STAFF
        $this->db->select("sa1.timezone as timezone , ts.store_id , ts.outlet_id");
        $this->db->join("store_outlet so" , "so.outlet_id = ts.outlet_id");
        $this->db->join("store_address sa1" , "sa1.store_address_id = so.physical_address");
        $staff_information = $this->db->where("ts.staff_id" , $staff_id)->get("timetracker_staff ts")->row();

        $timezone = $staff_information->timezone;

        //GET THE CURRENT DATE USING THE TIMEZONE
        $date = new DateTime("now", new DateTimeZone($timezone) );
        $clock_date = $date->format('F j Y');

        //TEMPORARY REMOVE IT AFTER TEST
        $clock_date = $this->input->post("date");

        //GET SHIFT INFORMATION
        $this->db->select("start_time , end_time , id");
        $shift_information = $this->db->where("staff_id" , $staff_id)->where("date_schedule" , $clock_date)->get("timetracker_shift_schedule_published")->row();


        //CHECK IF THE STAFF ALREADY CLOCK IN
        $check = $this->db->where("staff_id" , $staff_id)->where("shift_date" , $clock_date)->get("timetracker_timeclock")->row();

        if($check){
            //ALREADY CLOCK . MEANS YOU NEED TO UPDATE THE TIMECLOCK AS OUT

            //COMPUTE FOR WORKED HOURS

            $worked_hrs = compute_time_hours($check->time_in , $clock_in);
            $worked_hrs = round( $worked_hrs , 2);

            $this->db->where("timeclock_id" , $check->timeclock_id)->update("timetracker_timeclock" , [
                "worked_hrs"    => $worked_hrs ,
                "time_out"      => $clock_in,
                "status"        => 1 ,
                "out_location"  => implode(",", $location)
            ]);

            $last_id = $check->timeclock_id;  

        }else{
            //NO DATA YET . INSERT IT AS TIME IN

            //COMPUTE FOR LATE

            $time_in = strtotime($clock_date.' '.$clock_in);
            $shift_time_in = strtotime($clock_date.' '.$shift_information->start_time);

            $late = 0;

            if($time_in > $shift_time_in){
                $late = compute_time_hours($shift_information->start_time , $clock_in);
                $late = round( $late , 2);
            }

            //COMPUTE THE TOTAL HOURS OF SHIFT

            $scheduled_hrs = compute_time_hours($shift_information->start_time, $shift_information->end_time);
            $scheduled_hrs = round( $scheduled_hrs , 2 );

            $this->db->insert("timetracker_timeclock" , [
                "published_id"      =>      $shift_information->id ,
                "staff_id"          =>      $staff_id ,
                "time_in"           =>      $clock_in ,
                "late"              =>      $late ,
                "scheduled_hrs"     =>      $scheduled_hrs ,
                "shift_date"        =>      $clock_date    ,
                "outlet_id"         =>      $staff_information->outlet_id ,
                "created"           =>      time() ,
                "in_location"       =>      implode(",", $location)
            ]);

            $last_id = $this->db->insert_id();
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE){
            return false;
        }else{
            return $last_id;
        }
    }

    private function get_only_date($data){
        $tmp = array();

        foreach($data as $row){
            $tmp[] = ucfirst(strtolower($row['date']));
        }

        return $tmp;
    }
}