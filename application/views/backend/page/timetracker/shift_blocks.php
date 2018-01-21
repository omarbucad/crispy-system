<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
            <h1>Shift Templates</h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Manage your shift blocks. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#shiftblock_modal">Add Shift</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card margin-bottom">
            <div class="container">
                <div class="card-body no-padding-left no-padding-right">
                    <form action="#" method="POST">
                        <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                        <input type="hidden" name="_advance_search_value" id="_advance_search_value" value="false">
                        <div class="row">

                            <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_outlet">Outlet</label>
                                    <select class="form-control" id="s_outlet">
                                        <?php foreach($outlet_list as $row) : ?>
                                            <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_roles">Staff Group</label>
                                    <select class="form-control" id="s_roles">
                                        <?php foreach($staff_group_list as $row) : ?>
                                            <option value="<?php echo $row->group_id; ?>"><?php echo $row->group_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 col-lg-offset-3 text-right no-margin-bottom">
                                <button type="button" class="btn btn-link btn-vertical-center btn-same-size more-filter" data-value="hidden">More filter</button>
                                <input type="submit" name="submit" value="Apply Filter" class="btn btn-primary btn-vertical-center btn-same-size">
                            </div>
                        </div>
                        <div class="row hide" id="view_advance_search">
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">City</label>
                                    <input type="text" name="city" placeholder="City" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Country</label>
                                    <select class="form-control" name="country">
                                        <?php foreach($countries_list as $code =>  $country) : ?>
                                            <option value="<?php echo $code; ?>"><?php echo $country?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Date Created</label>
                                    <input type="text" name="date_created" placeholder="Date Created" class="form-control daterange">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="30%"><a href="javascript:void(0);">Shift Templates <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a></th>
                        <th width="20%">Unpaid Breaks</th>
                        <th width="20%">Position</th>
                        <th width="20%">Outlet</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($shift_blocks_list as $row) : ?>
                        <tr class="customer-row" style="cursor: default;">
                            <td>
                                <div  class="pull-left" style="margin-top:5px;background-color: <?php echo $row->block_color; ?>;width: 10px;height: 10px;-moz-border-radius: 50px;-webkit-border-radius: 50px;border-radius: 50px;">&nbsp;</div> 
                                <span style="padding-left: 5px;"><?php echo $row->group_name; ?><br><small style="padding-left: 15px;"><?php echo $row->start_time.' - '.$row->end_time; ?></small></span>
                            </td>
                            <td><?php echo $row->unpaid_break; ?> Hrs</td>
                            <td><?php echo $row->group_name; ?></td>
                            <td><?php echo $row->outlet_name; ?></td>
                            <td><a href="javascript:void(0);" class="text-underline link-style"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="shiftblock_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Shift Blocks</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/timetracker/shift-templates"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="group_name">Time</label>
                        <div class="form-group">
                            <div class="col-xs-6 no-padding-left">
                                <input type="time" name="pre_time_start" class="form-control" value="<?php echo set_value("pre_time_start"); ?>" placeholder="12:00 AM">
                            </div>
                            <div class="col-xs-6 no-padding-right">
                                <input type="time" name="pre_time_end" class="form-control" value="<?php echo set_value("pre_time_end"); ?>" placeholder="06:00 PM">
                            </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label for="group_name">Unpaid Break</label>
                        <input type="text" name="unpaid_break" class="form-control" >
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_group_form">Add Shift Blocks</button>
            </div>
        </div>
    </div>
</div>