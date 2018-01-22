<script type="text/javascript">
	var url = "<?php echo site_url('app/timetracker/get_shift_information'); ?>";

	$(document).ready(function(){

		load_data("TODAY");
		
	});

	$(document).on("click" , ".btn-click" , function(){
		var btn_click = $(this).data("type");
		load_data(btn_click);
	});

	$(document).on("change" , "#select_locations" , function(){
		load_data("TODAY");
	});

	function load_data(btn_click){
		var selected_outlet = $("#select_locations").val();
		var today = $('#scheduler-name').data("date");
		$.ajax({
			url : url ,
			method : "POST" ,
			data : {outlet_id : selected_outlet , today : today , btn_click : btn_click},
			success : function(response){
				var json = jQuery.parseJSON(response);
				scheduler_builder(json);
			}
		});
	}
	function table_builder(v){
		var site_url = "<?php echo site_url('thumbs/images/staff/'); ?>";
		var tr = $("<tr>");

		var td = $("<td>" , {class : "border-left border-bottom" , "data-staff" : v.staff_id});
		var div = $("<div>").append($("<img>" , {src : site_url+v.image_path+"/60/60/"+v.image_name , style : "width:30px;"}) );
		var div2 = $("<div>").append('<span>'+v.first_name+' '+v.last_name+'</span><small title="Preferred Hours / Scheduled Hours / Max Hours"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>0 / 0 / '+v.max_hours+'</span></small>');

		td.append(div);
		td.append(div2);

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_monday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_tuesday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_wednesday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_thursday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_friday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right" , "data-dateid" : "#td_saturday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right" , "data-dateid" : "#td_sunday"});
		tr.append(td);

		$(".scheduler-table tbody").append(tr);
	}

	function scheduler_builder(json){
		$('#scheduler-name').data("date" , json.scheduler_name_date).text(json.scheduler_name);
		$(".table-header2").find('#td_sunday').data("date" , json.loop_date["Sun"].date).text(json.loop_date["Sun"].value);
		$(".table-header2").find('#td_monday').data("date" , json.loop_date["Mon"].date).text(json.loop_date["Mon"].value);
		$(".table-header2").find('#td_tuesday').data("date" , json.loop_date["Tue"].date).text(json.loop_date["Tue"].value);
		$(".table-header2").find('#td_wednesday').data("date" , json.loop_date["Wed"].date).text(json.loop_date["Wed"].value);
		$(".table-header2").find('#td_thursday').data("date" , json.loop_date["Thu"].date).text(json.loop_date["Thu"].value);
		$(".table-header2").find('#td_friday').data("date" , json.loop_date["Fri"].date).text(json.loop_date["Fri"].value);
		$(".table-header2").find('#td_saturday').data("date" , json.loop_date["Sat"].date).text(json.loop_date["Sat"].value);

		var staff_list = json.staff_list;
		

		$(".scheduler-table tbody").html("");

		var tr = $("<tr>" , {class : "td_open_shift" , style : "background-color:#e0ffd3;"});
		var td = $("<td>" , {class : "border-left border-bottom text-center"});
		td.append('<span>OpenShifts</span>');

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_monday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_tuesday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_wednesday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_thursday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom" , "data-dateid" : "#td_friday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right" , "data-dateid" : "#td_saturday"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right" , "data-dateid" : "#td_sunday"});
		tr.append(td);

		$(".scheduler-table tbody").append(tr);

		$.each(staff_list , function(k , v){
			table_builder(v);
		});
	}

	$(document).on("click" , ".scheduler-table tbody > tr > td:not(:first-child)" , function(e){
		var dateid = $(this).data("dateid");
		var datename = $(dateid).data("date");
		var staff_id = $(this).parent().find("td").first().data("staff");
		var selected_outlet = $("#select_locations").val();
		var url = "<?php echo site_url('app/timetracker/get_preferred_shift'); ?>";
		var a = $(this);

		if(e.target !== e.currentTarget){
			return false;
		}

		$.ajax({
			url : url ,
			data : {staff_id : staff_id , outlet_id : selected_outlet , date : datename},
			method : "POST",
			success : function(response){

				var modal = $('#assign_shift_modal').modal("show");
				var json = jQuery.parseJSON(response);

				modal.data("click" , a);
				modal.data("staffid" , staff_id);
				

				modal.find(".modal-body > div").html(" ");

				var staff_name = json.staff.first_name+" "+json.staff.last_name;
				var datename = json.date;

				modal.data("datename" , datename);

				modal.find('.modal-title').html("Assign Shift to "+staff_name+" on "+datename);

				$.each(json.shift , function(k , v){

					var section = $("<section>");
					section.append($("<label>" , {text : k}));

					var div = $("<div>" , {class : "row"});

					$.each(v , function(a , b){
		
						var a = $("<a>" , {href: "javascript:void(0);" , "data-blockid" : b.shift_blocks_id, class: "shift-list-a btn btn-block" , style : "background-color : "+b.block_color , text : b.start_time+" - "+b.end_time});
						var span = $("<span>").html(b.group_name);
						a.append(span);

						var div1 = $("<div>" , {class : "col-lg-4"});
						div1.append(a);
						div.append(div1);
					});

					section.append(div);
					modal.find(".modal-body > div").append(section);
				});
				
			}
		});

	});

	$(document).on("click" , ".modal .shift-list-a" , function(){
		var modal = $(this).closest(".modal");
		var clone = $(this).clone();
		var td = modal.data("click");
		var staff_id = modal.data("staffid");
		var datename = modal.data("datename");
		var shift_id = $(this).data("blockid");
		var selected_outlet = $("#select_locations").val();
		var url = "<?php echo site_url('app/timetracker/save_shift'); ?>";

		$.ajax({
			url : url ,
			method : "POST" ,
			data : {staff_id : staff_id , date_name : datename , shift_id : shift_id , outlet_id : selected_outlet },
			success : function(response){
				var json = jQuery.parseJSON(response);

				if(json.status){
					clone.data("shift_id" , json.id);
					clone.addClass("tdShift");
					td.append(clone);
					modal.modal("hide");
				}

				console.log(response);
			}
		});

		
	});
	$(document).on("click" , ".tdShift" , function(){
		var id = $(this).data("shift_id");

		alert(id);
	});
</script>
<style type="text/css">
	
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
    	<div class="row">
    		<!-- SIDE MENU -->
    		<div class="col-lg-2 ">
    			<a href="javascript:void(0);" class="btn btn-success btn-block " style="text-align: left;line-height: 11px">Publish & Notify <br><small>Entire Schedule</small></a>
    			<div class="text-right">
    				<div class="btn-group" role="group" aria-label="...">
					  <button type="button" class="btn btn-default active">Shift</button>
					  <button type="button" class="btn btn-default">Position</button>
					</div>
    			</div>
    			<nav class="card scheduler-nav">
    				<ul>
    					<li class="bglabel">LOCATIONS</li>
    					<li class="lilocation">
    						<div class="input-group">
    							<select class="form-control" id="select_locations">
    								<?php foreach($outlet_list as $row) : ?>
    									<option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
    								<?php endforeach; ?>
    							</select>
    							<span class="input-group-btn">
    								<button class="btn btn-success" type="button" style="margin: 0px !important;"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
    							</span>
    						</div><!-- /input-group -->
    					</li>
    					<li class="bglabel" style="line-height: 17px;">POSITIONS <a href="javascript:void(0);" class="btn btn-primary btn-xs pull-right" style="font-size: 10px;margin: 0px;">Show all</a></li>
    					<?php foreach($staff_group_list as $row) : ?>
                            <li class="listaffposition">
                            	<div class="checkbox">
								    <label>
								      <input type="checkbox" value="<?php echo $row->group_id; ?>" name=""> <span><?php echo $row->group_name; ?></span>
								    </label>
								</div>
                            </li>
                        <?php endforeach; ?>
    				</ul>
    			</nav>
    		</div>
    		<!-- MAIN TABLE -->
    		<div class="col-lg-10">
    			<div class="card">
    				<table class="scheduler-table">
	    				<thead>
	    					<tr class="table-header">
		    					<td colspan="8">
		    						<a href="javascript:void(0);" class="btn btn-primary btn-xs btn-click" data-type="TODAY">Today</a>
		    						<div class="btn-group btn-group-xs" role="group" aria-label="...">
									  <button type="button" class="btn btn-primary btn-click" data-type="PREV"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
									  <button type="button" class="btn btn-primary"><i class="fa fa-calendar" aria-hidden="true"></i></button>
									  <button type="button" class="btn btn-primary btn-click" data-type="NEXT"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
									</div>
									<span id="scheduler-name" data-date=""></span>
									<div class="pull-right dropdown">
										<a href="javascript:void(0);" class="btn btn-primary btn-xs"><i class="fa fa-print" aria-hidden="true"></i></a>
										<a id="dLabel" data-target="#" class="btn btn-primary btn-xs" href="http://example.com" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tools<span class="caret"></span> </a>

										<ul class="dropdown-menu" aria-labelledby="dLabel">
											<li><a href="javascript:void(0);">Copy Previous Week</a></li>
											<li><a href="javascript:void(0);">Clear Schedule</a></li>
											<li><a href="javascript:void(0);">Save Template</a></li>
											<li><a href="javascript:void(0);">Load Template</a></li>
											<li><a href="javascript:void(0);">Show All Employee</a></li>
											<li><a href="javascript:void(0);">Export Schedule</a></li>
										</ul>
									</div>
		    					</td>
		    				</tr>
		    				<tr class="text-center table-header2">
		    					<td class="text-left border-left border-top border-bottom">STAFF</td>
		    					<td class="border-left border-top border-bottom" id="td_monday"></td>
		    					<td class="border-left border-top border-bottom" id="td_tuesday"></td>
		    					<td class="border-left border-top border-bottom" id="td_wednesday"></td>
		    					<td class="border-left border-top border-bottom" id="td_thursday"></td>
		    					<td class="border-left border-top border-bottom" id="td_friday"></td>
		    					<td class="border-left border-top border-bottom border-right" id="td_saturday"></td>
		    					<td class="border-left border-top border-bottom" id="td_sunday"></td>
		    				</tr>
	    				</thead>
	    				<tbody>
	    					
	    				</tbody>
	    				<tfoot>
	    					<tr class="text-center table-header2">
		    					<td class="text-left border-left border-top border-bottom" id="td_total_1"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_2"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_3"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_4"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_5"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_6"></td>
		    					<td class="border-left border-top border-bottom" id="td_total_7"></td>
		    					<td class="border-left border-top border-bottom border-right" id="td_total_8"></td>
		    				</tr>
	    				</tfoot>
	    			</table>
    			</div>
    		</div>
    	</div>
    </div>
</div>


<div class="modal fade" id="assign_shift_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <small>
                	<a href="javascript:void(0);"></a>
                </small>

                <div></div>
            </div>
            <div class="modal-footer">
                <div class="row">
                	<div class="col-lg-6 text-left no-margin-bottom">
                		 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                	</div>
                	<div class="col-lg-6 text-right no-margin-bottom">
                		<button type="button" class="btn btn-success">Custom Shift</button>
                		<button type="button" class="btn btn-primary">Time-off</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>