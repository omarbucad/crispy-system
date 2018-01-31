<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Timetracker extends MY_Controller {

	public function __construct() {
       parent::__construct();

       $this->load->model("Timetracker_model" , "timetracker");
    }

	public function index(){
		$this->data['website_title'] = "Timetracker | Accounts Package";
		$this->data['page_name'] = "Dashboard";
		$this->data['main_page'] = "backend/page/timetracker/dashboard";
		$this->data['outlet_list'] = $this->store->get_outlet();
		
		$this->load->view('backend/master' , $this->data);
	}

	public function shift_management(){
		$this->data['website_title'] = "Timetracker | Accounts Package";
		$this->data['page_name'] = "Scheduler";
		$this->data['main_page'] = "backend/page/timetracker/shift_management";
		$this->data['outlet_list'] = $this->store->get_outlet();
		$this->data['staff_group_list']	= $this->timetracker->get_group();

		$this->load->view('backend/master' , $this->data);
	}

	public function staff(){
		$this->data['website_title'] = "Timetracker | Accounts Package";
		$this->data['page_name'] = "Staff";
		$this->data['main_page'] = "backend/page/timetracker/staff";
		$this->data['countries_list'] = $this->countries_list();
		$this->data['staff_group_list']	= $this->timetracker->get_group();
		$this->data['outlet_list'] = $this->store->get_outlet();
		

		$this->data['config']["base_url"] = base_url("app/customer/") ;
		$this->data['config']["total_rows"] = $this->timetracker->get_staff(true);

		$this->pagination->initialize($this->data['config']);

		$this->data["links"] = $this->pagination->create_links();

		$staff_list = $this->timetracker->get_staff();

		foreach($staff_list as $key => $row){
			$staff_list[$key]->physical_country = $this->countries_list($row->physical_country);
			$staff_list[$key]->postal_country = $this->countries_list($row->postal_country);
			$staff_list[$key]->date_of_birth = date_of_birth($row->dob_day , $row->dob_month , $row->dob_year);
			$staff_list[$key]->gender = convert_gender($row->gender);
			$staff_list[$key]->image_path = ($row->image_path) ? $row->image_path : "1/1";
            $staff_list[$key]->image_name = ($row->image_name) ? $row->image_name : "default.jpg";
		}

		$this->data['staff_list'] = $staff_list;

		$this->load->view('backend/master' , $this->data);
	}

	public function add_staff(){

		$this->form_validation->set_rules('first_name'		, 'Staff Name'			, 'trim|required');
		
		$dob = $this->input->post("date_of_birth");

		if($dob["dd"] OR $dob["mm"] OR $dob["yy"]){
			$this->form_validation->set_rules('date_of_birth[dd]'	, 'Day of Birth'	, 'trim|required|max_length[2]');
			$this->form_validation->set_rules('date_of_birth[mm]'	, 'Month of Birth'	, 'trim|required|max_length[2]');
			$this->form_validation->set_rules('date_of_birth[yy]'	, 'Year of Birth'	, 'trim|required|min_length[4]|max_length[4]');
		}

		if ($this->form_validation->run() == FALSE){ 

			$this->data['website_title'] = "Timetracker | Accounts Package";
			$this->data['page_name'] = "Add Staff";
			$this->data['main_page'] = "backend/page/timetracker/add_staff";
			$this->data['staff_group_list']	= $this->timetracker->get_group();
			$this->data['outlet_list'] = $this->store->get_outlet();
			$this->data['countries_list'] = $this->countries_list();


			$this->load->view('backend/master' , $this->data);
		}else{

			if($staff_id = $this->timetracker->add_staff()){

				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a Staff');	

				redirect("app/timetracker/staff" , 'refresh');

			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	

				redirect("app/timetracker/staff/add" , 'refresh');

			}
			
		}
		
	}

	public function position(){
		
		$this->form_validation->set_rules('group_name'		, 'Position Name'	, 'trim|required');

		if ($this->form_validation->run() == FALSE){  

			$this->data['website_title'] = "Timetracker | Accounts Package";
			$this->data['page_name'] = "Staff Position";
			$this->data['main_page'] = "backend/page/timetracker/group";
			$this->data['staff_group_list']	= $this->timetracker->get_group();

			$this->load->view('backend/master' , $this->data);

		}else{

			if($group_id = $this->timetracker->add_group()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a Staff group');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	
			}

			redirect("app/timetracker/position" , 'refresh');
		}
	}

	public function shift_templates(){

		$this->form_validation->set_rules('pre_time_start'		, 'Start Time'	, 'trim|required');
		$this->form_validation->set_rules('pre_time_end'		, 'End Time'	, 'trim|required');

		if ($this->form_validation->run() == FALSE){  

			$this->data['website_title'] = "Timetracker | Accounts Package";
			$this->data['page_name'] = "Shift Templates";
			$this->data['main_page'] = "backend/page/timetracker/shift_blocks";
			$this->data['staff_group_list']	= $this->timetracker->get_group();
			$this->data['outlet_list'] = $this->store->get_outlet();
			$this->data['shift_blocks_list'] = $this->timetracker->get_shift_block_list();

			$this->load->view('backend/master' , $this->data);
		}else{
		
			if($this->input->post("shift_template")){
				$save_template = ($this->input->post("save_template")) ? 0 : 1;

				if($shift_id = $this->timetracker->add_shift_block($save_template)){ 

					$post = $this->input->post();
					$post['total_hours'] = compute_time_hours($post['pre_time_start'] , $post['pre_time_end']);
					$post['pre_time_start'] = substr(date("h:ia" , strtotime($post['pre_time_start'])) , 0, -1);
					$post['pre_time_end'] = substr(date("h:ia" , strtotime($post['pre_time_end'])) , 0, -1);

					$schedule_id = $this->timetracker->assign_shift_to_staff($shift_id);

					echo json_encode([
						"status" => true ,
						"id" => $this->hash->encrypt($schedule_id['id']) ,
						"total_hours" => $schedule_id['total_hours'],
						"data" => $post ,
						"published" => "unpublished"
					]);
				}else{
					echo json_encode([
						"status" => false ,
						"message" => "Saving Failed. Please Try again Later"
					]);
				}
			}else{
				if($group_id = $this->timetracker->add_shift_block()){
					$this->session->set_flashdata('status' , 'success');	
					$this->session->set_flashdata('message' , 'Successfully Added a Shift Block');	
				}else{
					$this->session->set_flashdata('status' , 'error');
					$this->session->set_flashdata('message' , 'Something went wrong');	
				}

				redirect("app/timetracker/shift-templates" , 'refresh');
			}
			
		}
	}

	public function get_shift_information(){

		$data = array();

		if($this->input->post()){

			$today = $this->input->post("today");
			$click = $this->input->post("btn_click");

			switch ($click) {
				case 'NEXT':
					$from =  strtoupper(date('F j Y', strtotime('next monday 12:00:00 '.  $today)));
					$to =  strtoupper(date('F j Y', strtotime('+7 days - 1 seconds '.  $from)));
					break;
				case 'PREV':
					$from =  strtoupper(date('F j Y', strtotime('monday last week 12:00:00 '.  $today)));
					$to =  strtoupper(date('F j Y', strtotime('+7 days - 1 seconds'.  $from)));
					break;
				case 'TODAY':
					$from =  strtoupper(date('F j Y', strtotime('monday this week 12:00:00')));
					$to =  strtoupper(date('F j Y', strtotime('+7 days - 1 seconds ' . $from)));
					break;
				default:
					$from =  strtoupper(date('F j Y', strtotime('monday this week 12:00:00' .$today)));
					$to =  strtoupper(date('F j Y', strtotime('+7 days - 1 seconds ' . $from)));
					break;
			}

			$data['scheduler_name'] = $from .' - '.$to;
			$data['scheduler_name_date'] = $from;
			$data['loop_date'] = loop_date($from , $to);
			$data['staff_list'] = $this->timetracker->get_staff_by_outlet($data['loop_date']);


			echo json_encode($data);
		}
	}

	public function get_shift_information_by_id(){
		if($this->input->post()){
			$date_id = $this->input->post("date_id");
			$published = $this->input->post("published");

			$result = $this->timetracker->get_shift_information_by_id($date_id , $published);

			echo json_encode($result);
		}
	}

	public function get_preferred_shift(){
		echo json_encode($this->timetracker->get_preferred_shift());
	}
	public function get_shift_information_today(){
		$data['result'] = $this->timetracker->get_shift_information_today();
		$data['my_name'] = strtoupper($this->session->userdata("user")->display_name);
		$data['store_name'] = strtoupper($this->session->userdata("user")->store_name);

		echo json_encode($data);
	}

	public function save_shift(){
		if($last_id = $this->timetracker->assign_shift_to_staff()){
			echo json_encode([
				"status" => true ,
				"id" => $this->hash->encrypt($last_id['id']),
				"total_hours" => $last_id['total_hours']
			]);
		}else{
			echo json_encode([
				"status" => false ,
				"message" => "Saving Failed. Please Try again Later"
			]);
		}
	}

	public function edit_shift_template(){

		if($date_id = $this->timetracker->edit_shift_template()){

			$post = $this->input->post();
			$post['pre_time_start'] = substr(date("h:ia" , strtotime($post['pre_time_start'])) , 0, -1);
			$post['pre_time_end'] = substr(date("h:ia" , strtotime($post['pre_time_end'])) , 0, -1);

			echo json_encode([
				"status" => true ,
				"id" =>  $this->hash->encrypt($date_id) ,
				"data" => $post ,
				"published" => "unpublished"
			]);

		}else{
			echo json_encode([
				"status" => false ,
				"message" => "Saving Failed. Please Try again Later"
			]);
		}
	}

	public function remove_shift(){
		if($this->input->post()){
			$date_id = $this->hash->decrypt($this->input->post("date_id"));
			
			$this->db->trans_start();	

			if($this->input->post("published") == "unpublished"){
				$info = $this->db->select("schedule_id")->where("date_id" , $date_id)->get("timetracker_shift_date")->row();

				$this->db->where("date_id" , $date_id)->delete("timetracker_shift_date");
				$check_row = $this->db->where("schedule_id" , $info->schedule_id)->get("timetracker_shift_date")->num_rows(); 

				if($check_row == 0){
					$this->db->where("schedule_id" , $info->schedule_id)->delete("timetracker_shift_schedule_unpublished");
				}

			}else{
				$this->db->where("date_id" , $date_id)->delete("timetracker_shift_schedule_published");
			}

			$this->db->trans_complete();	


			if($check_row == 0){
				echo json_encode(["published" => true]);
			}else{
				echo json_encode(["published" => false]);
			}
		}
	}

	public function publish_shift(){
		if($this->timetracker->publish_shift()){
			echo json_encode(["status" => true]);
		}else{
			echo json_encode(["status" => false]);
		}
	}

	public function attendance(){

		$this->form_validation->set_rules('daterange'		, 'Date'	, 'trim|required');

		if ($this->form_validation->run() == FALSE){  

			$this->data['website_title'] = "Timetracker | Accounts Package";
			$this->data['page_name'] = "Staff Attendance";
			$this->data['main_page'] = "backend/page/timetracker/attendance";
			$this->data['outlet_list'] = $this->store->get_outlet();
			$this->data['pay_period_list'] = $this->timetracker->get_pay_period_list();

			$this->load->view('backend/master' , $this->data);

		}else{

			if($this->timetracker->create_pay_period()){
				$this->session->set_flashdata('status' , 'success');	
				$this->session->set_flashdata('message' , 'Successfully Added a Pay Period');	
			}else{
				$this->session->set_flashdata('status' , 'error');
				$this->session->set_flashdata('message' , 'Something went wrong');	
			}

			redirect("app/timetracker/attendance" , 'refresh');
		}

		
	}

	public function get_staff(){

		$result = $this->timetracker->get_attendance_staff();

		if($result){
			echo json_encode([
				"status" => true ,
				"result" => $result
			]);
		}else{
			echo json_encode([
				"status" => false
			]);
		}

	}

	public function get_staff_shift(){
		if($this->input->post()){
			$staff_id = $this->hash->decrypt($this->input->post("staff_id"));
	        $pay_id = $this->hash->decrypt($this->input->post("pay_id"));

	        $pay_information = $this->db->select("from_date , to_date , pay_name")->where("pay_id" , $pay_id)->get("timetracker_pay")->row();
	        $date_range = loop_date($pay_information->from_date , $pay_information->to_date , true);

	        
	        $result = $this->db->where("staff_id" , $staff_id)->where_in("date_schedule" , $date_range)->get("timetracker_shift_schedule_published")->result();
	        
	        $shift_information = array();

	        foreach($result as $row){
	            $shift_information[strtotime($row->date_schedule)] = array(
	            	"day"			=> date("D" , strtotime($row->date_schedule)),
	                "date_schedule" => date("D , M j" , strtotime($row->date_schedule)) ,
	                "start_time"    => substr(date("h:ia" , strtotime($row->start_time)) , 0, -1),
	                "end_time"      => substr(date("h:ia" , strtotime($row->end_time)) , 0, -1),
	                "block_color"   => $row->block_color ,
	                "unpaid_break"  => $row->unpaid_break
	            );
	        }
	       

	        ksort($shift_information);

	        echo json_encode([
	        	"result" => $shift_information ,
	        	"pay_name" => $pay_information->pay_name
	        ]);
		}
	}

	public function get_staff_summary(){
		$data['attendance_result'] = $this->timetracker->get_attendance_list();
		$data['summary_result'] = $this->timetracker->get_summary_by_id();

		echo json_encode($data);
	}

	public function get_notes_by_timeclock(){
		if($this->input->post("timeclock_id")){

			if($this->input->post("timeclock_id") == "NO_TIMECLOCK"){
				echo json_encode(['status' => false , "notes" => "<p class='text-center'>NO NOTES</p>"]);
			}else{
				$id = $this->hash->decrypt($this->input->post("timeclock_id"));

				$this->db->select("notes");
				$info = $this->db->where("timeclock_id" , $id)->get("timetracker_timeclock")->row();

				if($info->notes){

					$a = json_decode($info->notes);
					$c = "";
					
					foreach($a as $b){
						$c .= "<p>".$b->notes."</p>";
					}

					echo json_encode(['status' => true , "notes" => $c]);
				}else{
					echo json_encode(['status' => false , "notes" => "<p class='text-center'>NO NOTES</p>"]);
				}
			}
		}
	}

	public function timeclock(){
		if($this->input->post()){
			$this->timetracker->insert_clock_time();
		}

		?>
				<form action="http://192.168.1.147/crispy-system/app/timetracker/timeclock" method="POST">
					<input type="time" name="clock_in">
					<input type="hidden" name="staff_id" value="M-KFHwByqm7sQhTd-PVaCA">
					<select name="date">
						<option value="January 16 2018">January 16</option>
						<option value="January 17 2018">January 17</option>
						<option value="January 18 2018">January 18</option>
						<option value="January 19 2018">January 19</option>
						<option value="January 20 2018">January 20</option>
						<option value="January 21 2018">January 21</option>
						<option value="January 22 2018">January 22</option>
						<option value="January 23 2018">January 23</option>
						<option value="January 24 2018">January 24</option>
						<option value="January 25 2018">January 25</option>
						<option value="January 26 2018">January 26</option>
					</select>
					<input type="submit" value="submit" name="submit">
				</form>	

			<?php
	}
}
