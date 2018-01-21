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

		var td = $("<td>" , {class : "border-left border-bottom"});
		var div = $("<div>").append($("<img>" , {src : site_url+v.image_path+"/60/60/"+v.image_name , style : "width:30px;"}) );
		var div2 = $("<div>").append('<span>'+v.first_name+'</span><small title="Preferred Hours / Scheduled Hours / Max Hours"><i class="fa fa-clock-o" aria-hidden="true"></i> <span>'+v.max_hours+' / 0 / 0</span></small>');

		td.append(div);
		td.append(div2);

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right"});
		tr.append(td);

		$(".scheduler-table tbody").append(tr);
	}
	function scheduler_builder(json){

		$('#scheduler-name').data("date" , json.scheduler_name_date).text(json.scheduler_name);
		$(".table-header2").find('#td_sunday').text(json.loop_date["Sun"]);
		$(".table-header2").find('#td_monday').text(json.loop_date["Mon"]);
		$(".table-header2").find('#td_tuesday').text(json.loop_date["Tue"]);
		$(".table-header2").find('#td_wednesday').text(json.loop_date["Wed"]);
		$(".table-header2").find('#td_thursday').text(json.loop_date["Thu"]);
		$(".table-header2").find('#td_friday').text(json.loop_date["Fri"]);
		$(".table-header2").find('#td_saturday').text(json.loop_date["Sat"]);

		var staff_list = json.staff_list;
		

		$(".scheduler-table tbody").html("");

		var tr = $("<tr>" , {class : "td_open_shift" , style : "background-color:#e0ffd3;"});
		var td = $("<td>" , {class : "border-left border-bottom text-center"});
		td.append('<span>OpenShifts</span>');

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});

		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right"});
		tr.append(td);

		var td = $("<td>" , {class : "border-left border-bottom border-right"});
		tr.append(td);

		$(".scheduler-table tbody").append(tr);

		$.each(staff_list , function(k , v){
			table_builder(v);
		});
	}

</script>
<style type="text/css">
	.scheduler-nav > ul{
		list-style-type: none;
		padding: 0px;
	}
	.scheduler-nav  li.bglabel{
		background-color: #f0f0f0;
		padding: 5px;
		font-size: 10px;
		font-weight: bold;
		overflow: hidden;
	}
	.scheduler-nav li.lilocation{
		padding: 20px 5px;
	}

	.scheduler-nav li.listaffposition > div{
		margin: 0px !important;
	}
	.scheduler-nav li.listaffposition{
		padding: 2px 5px;
	}
	.scheduler-nav li.listaffposition  input[type="checkbox"]{
		margin-right: 10px;
	}
	.scheduler-nav li.listaffposition  span{
		font-size: 11px;
    	font-weight: bold;
	}
	.scheduler-table{
		width: calc(100% - 2px);
    	margin: auto;
	}
	.scheduler-table .table-header , .scheduler-table .table-header2{
		background-color: #f0f0f0;
	}
	.scheduler-table .table-header > td{
		padding: 5px;
	}
	.scheduler-table .table-header > td > *:not(:last-child){
		margin-right: 15px;
	}
	.scheduler-table .table-header #scheduler-name{
		font-weight: bold;
	}
	.border-left{
		border-left:1px solid rgba(0,0,0,0.1);
	}
	.border-top{
		border-top:1px solid rgba(0,0,0,0.1);
	}
	.border-right{
		border-right:1px solid rgba(0,0,0,0.1);
	}
	.border-bottom{
		border-bottom:1px solid rgba(0,0,0,0.1);
	}
	.scheduler-table .table-header2 > td{
		padding: 5px;
		width: calc(100% / 8);
		font-size: 10px;
		font-weight: bold;
	}
	.scheduler-table tbody > tr > td{
		overflow: hidden;
		padding: 5px;
	}
	.scheduler-table tbody > tr > td > div{
		float: left;
	}
	.scheduler-table tbody > tr > td > div:first-child{
		width: 40px;
		margin:5px auto;
		text-align: center;
	}
	.scheduler-table tbody > tr > td > div:last-child{ 
		width: calc(100% - 40px);
		line-height: 12px;
		padding-top: 7px;
	}
	.scheduler-table tbody > tr > td > div:last-child > span{
		font-weight: bold;
		font-size: 12px;
		display: block;
	}
	.scheduler-table tbody > tr > td > a{
		display: block;
		background-color: red;
		font-size: 11px;
		font-weight: bold;
		color:white;
		padding: 7px 5px;
	}
	.scheduler-table tbody > tr > td > a:hover{
		color:white;
	}
	.scheduler-table tbody > tr > td > a > span{
		background-color: rgba(0,0,0,0.3);
		padding: 5px;
		margin: 5px;
	}
	.td_open_shift > td{
		height: 40px;
	}
	.td_open_shift > td > span{
		font-weight: bold;
	}
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
									<span id="scheduler-name" data-date="JANUARY 21 2018">JANUARY 21 2018 - JANUARY 28 2018</span>
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
		    					<td class="text-left border-left border-top border-bottom" id="td_total_1">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_2">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_3">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_4">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_5">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_6">100 hrs</td>
		    					<td class="border-left border-top border-bottom" id="td_total_7">100 hrs</td>
		    					<td class="border-left border-top border-bottom border-right" id="td_total_8">100 hrs</td>
		    				</tr>
	    				</tfoot>
	    			</table>
    			</div>
    		</div>
    	</div>
    </div>
</div>