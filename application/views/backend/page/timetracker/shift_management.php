<script type="text/javascript">
	var url = "<?php echo site_url('app/timetracker/get_shift_information'); ?>";
	var get_shift_information_by_id_url = '<?php echo site_url("app/timetracker/get_shift_information_by_id"); ?>';
	var save_shift = "<?php echo site_url('app/timetracker/save_shift'); ?>";
	var get_preferred_shift = "<?php echo site_url('app/timetracker/get_preferred_shift'); ?>";
	var publish_shift = "<?php echo site_url('app/timetracker/publish_shift'); ?>";
	var site_url = "<?php echo site_url('thumbs/images/staff/'); ?>";
</script>
<script type="text/javascript" src="<?php echo site_url('public/js/shift.js?version='.$version) ?>"></script>

<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
    	<div class="row">
    		<!-- SIDE MENU -->
    		<div class="col-lg-2 ">
    			<a href="javascript:void(0);" class="btn btn-success btn-block btn-publish text-uppercase" style="text-align: left;line-height: 20px;font-size: 15px;"></a>
    			<nav class="card scheduler-nav">
    				<ul>
    					<li class="bglabel">COLOR</li>
    					<li class="lilocation">
    						<select class="form-control" id="select_color">
                                <option value="Shift">Shift</option>
                                <option value="Position">Position</option>
                            </select>
    					</li>
    					<li class="bglabel">LOCATIONS</li>
    					<li class="lilocation">
    						<select class="form-control" id="select_locations">
                                <?php foreach($outlet_list as $row) : ?>
                                    <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                                <?php endforeach; ?>
                            </select>
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
                		<button type="button" class="btn btn-success btn-custom-shift">Custom Shift</button>
                		<button type="button" class="btn btn-primary">Time-off</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="assign_custom_shift_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/timetracker/shift-templates"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <input type="hidden" name="shift_template" value="true">
                    <input type="hidden" name="staff_id" value="true">
                    <input type="hidden" name="date_name" value="true">
                    <input type="hidden" name="outlet_id" value="true">
                    <div class="form-group">
                    	<label for="group_name">Time</label>
                    	<div style="overflow: hidden;">
                    		<div class="col-xs-6 no-padding-left">
                    			<input type="time" name="pre_time_start" class="form-control" placeholder="12:00 AM">
                    		</div>
                    		<div class="col-xs-6 no-padding-right">
                    			<input type="time" name="pre_time_end" class="form-control" placeholder="06:00 PM">
                    		</div>
                    	</div>
                    </div>
                     <div class="form-group">
                        <label for="group_name">Unpaid Break</label>
                        <div class="input-group">
						  <input type="text" class="form-control" name="unpaid_break" placeholder="Hours" aria-describedby="basic-addon2">
						  <span class="input-group-addon" id="basic-addon2">Hours</span>
						</div>
                    </div>
                    <div class="form-group">
                        <label for="s_outlet">Outlet</label>
                        <select class="form-control" id="s_outlet" name="outlet_id">
                            <?php foreach($outlet_list as $row) : ?>
                                <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="s_roles">Staff Position</label>
                        <select class="form-control" id="s_roles" name="position">
                            <?php foreach($staff_group_list as $row) : ?>
                                <option value="<?php echo $row->group_id; ?>"><?php echo $row->group_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="group_color">Color</label>
                        <input type="color" name="group_color" class="form-control" id="group_color" style="width:70px">
                    </div>

                   
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                	<div class="col-lg-6 text-left no-margin-bottom">
                		<div class="checkbox no-margin">
	                    	<label>
	                    		<input type="checkbox" name="save_template" value="1"> Save as "Shift Template" also , so i can use it later
	                    	</label>
	                    </div>
                	</div>
                	<div class="col-lg-6 text-right no-margin-bottom">
                		<button type="button" class="btn btn-primary btn-create-shift" data-publish="true">Create & Publish</button>
                		<button type="button" class="btn btn-primary btn-create-shift" data-publish="false">Create</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit_shift_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/timetracker/edit_shift_template"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <input type="hidden" name="outlet_id">
                    <input type="hidden" name="staff_id">
                    <input type="hidden" name="date_id">
                    <input type="hidden" name="published">
                    <div class="form-group">
                    	<label for="group_name">Time</label>
                    	<div style="overflow: hidden;">
                    		<div class="col-xs-6 no-padding-left">
                    			<input type="time" name="pre_time_start" class="form-control" placeholder="12:00 AM">
                    		</div>
                    		<div class="col-xs-6 no-padding-right">
                    			<input type="time" name="pre_time_end" class="form-control" placeholder="06:00 PM">
                    		</div>
                    	</div>
                    </div>
                     <div class="form-group">
                        <label for="group_name">Unpaid Break</label>
                        <div class="input-group">
						  <input type="text" class="form-control" name="unpaid_break" placeholder="Hours" aria-describedby="basic-addon2">
						  <span class="input-group-addon" id="basic-addon2">Hours</span>
						</div>
                    </div>

                    <div class="form-group">
                        <label for="s_roles">Staff Position</label>
                        <select class="form-control" id="s_roles" name="position">
                            <?php foreach($staff_group_list as $row) : ?>
                                <option value="<?php echo $row->group_id; ?>"><?php echo $row->group_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" maxlength="255" rows="4" placeholder="Notes" name="notes" id="notes"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="group_color">Color</label>
                        <input type="color" name="group_color" class="form-control" id="group_color2" style="width:70px">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="row">
                	<div class="col-lg-3 text-left no-margin-bottom">
                		 <button type="button" class="btn btn-danger btn-remove-shift">Delete</button>
                	</div>
                	<div class="col-lg-9 text-right no-margin-bottom">
                		<button type="button" class="btn btn-primary" >Replace</button>
                		<button type="button" class="btn btn-success btn-update-shift" >Save</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm_remove_shift_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Confirm Removal of Shift of [NAME]</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to remove this shift? you will not be able to recovered it. <br> Proceed?</p>
            </div>
            <div class="modal-footer">
                <div class="row">
                	<div class="col-lg-3 text-left no-margin-bottom">
                		 <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                	</div>
                	<div class="col-lg-9 text-right no-margin-bottom">
                		<button type="button" class="btn btn-success btn-proceed"  data-url="<?php echo site_url("app/timetracker/remove_shift"); ?>">Proceed</button>
                	</div>
                </div>
            </div>
        </div>
    </div>
</div>