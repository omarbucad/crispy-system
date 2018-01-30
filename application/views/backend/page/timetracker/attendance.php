<script type="text/javascript">
    var site_url = "<?php echo site_url('thumbs/images/staff/'); ?>";

    $(document).ready(function(){
        load_staff();
    });

    $(document).on("change" , "#selected_outlet" , function(){
        load_staff();
    });

    function load_staff(){
        var url = "<?php echo site_url('app/timetracker/get_staff'); ?>";
        var selected_outlet = $("#selected_outlet").val();
        var pay_period_id = $('#pay_period_id').val();

        $.ajax({
            url : url ,
            data : {outlet_id : selected_outlet , pay_period_id : pay_period_id} ,
            method : "POST" ,
            success : function(response){

                var json = jQuery.parseJSON(response);
                var ul = $("#div_timesheets").find("ul").html(" ");

                if(json.status){
                    $('#summary_div').removeClass("hide");
                    $.each(json.result , function(k , v){

                        var li = $("<li>" , {"data-staffid" : v.staff_id , class : "list-group-item"});
                        
                        if(k == 0){
                            li.addClass("active");
                        }

                       
                        var img = $("<img>" , {src : site_url+v.image_path+"/60/60/"+v.image_name , alt : v.first_name+' '+v.last_name });
                        var span = $("<span>" , {class : "staff_name"}).html(v.first_name+' '+v.last_name);
                        var span2 = $("<span>" , {class : "badge"}).html('<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>');

                        li.append(img);
                        li.append(span);
                        li.append(span2);
                        ul.append(li);
                    });

                    var staff_id = $('#div_timesheets nav > ul > li').first().data("staffid");
                    load_summary(staff_id);

                }else{
                     $('#summary_div').addClass("hide");
                    var li = $("<li>");
                    var a = $("<a>" , {href : "javascript:void(0);" , "data-toggle" : "modal" , "data-target" : "#add_pay_modal" , text : "Click Here to new Pay Period"});
                    li.append(a);
                    ul.append(li);
                }
            }
        });
    }

    $(document).on("click" , "#add_pay_modal #save" , function(){
        var form = $(this).closest(".modal").find("form");
        form.submit();
    });

    $(document).on("click" , "#div_timesheets nav > ul > li" , function(){
        var staff_id = $(this).data("staffid");

        if(!$(this).hasClass("active")){
            load_summary(staff_id);
        }

        $("#div_timesheets nav > ul > li").removeClass("active");
        $(this).addClass("active");
       
    });

    $(document).on("change" , '#pay_period_id' , function(){
        var staff_id = $("#div_timesheets nav > ul > li.active").data("staffid");
        load_summary(staff_id);
    });

    function load_summary(staff_id){
        var pay_id = $('#pay_period_id').val();
        var url = "<?php echo site_url('app/timetracker/get_staff_summary'); ?>";

        $.ajax({
            url : url ,
            data : {staff_id : staff_id , pay_period_id : pay_id },
            method : "POST" ,
            success : function(response){
                var json = jQuery.parseJSON(response);
                init_summary(json);
            }
        });
    }

    function init_summary(json){
        var data = json.summary_result;
        var summary_div = $('#summary_div');

        summary_div.find('#summary_header').html(data.first_name+" "+data.last_name).append($("<small>").html(": "+data.pay_name));

        summary_div.find('.timesheet_summary #_regular').html(data.field_1);
        summary_div.find('.timesheet_summary #_overtime').html(data.field_2);
        summary_div.find('.timesheet_summary #_double_ot').html(data.field_3);
        summary_div.find('.timesheet_summary #_sick').html(data.field_4);
        summary_div.find('.timesheet_summary #_vacation').html(data.field_5);

        var attendance = json.attendance_result;

        var table = $("#timesheet_table");
        table.find("tbody").html(" ");

        $.each(attendance , function(k , v){
            var tr = $("<tr>");

            var td = $("<td>").append($("<span>" , {class : "edittable"}).html(v.day));
            tr.append(td);
            var td = $("<td>").append($("<span>" , {class : "edittable"}).html(v.time_in));
            tr.append(td);
            var td = $("<td>").append($("<span>" , {class : "edittable"}).html(v.time_out));
            tr.append(td);
            var td = $("<td>").append($("<span>", {id : "_total"}).html(v.total));
            tr.append(td);
            var td = $("<td>");

            var edittext = $("<textarea>" , {rows : 5 , class : "form-control putnote"});
            var btn = $("<button>" , {text : "Save" , class : "btn btn-success"});
            var div = $("<div>" , { class : "notecontainer"});
            div.append(edittext);
            div.append(btn);

            var a = $("<a>" , { href : "javascript:void(0)" , class : "pull-right" , title : "Put a Note" , "data-content" : div[0].outerHTML , "data-original-title" : "Put a Note" , "data-html" : true , "data-placement" : "left" }).html('<i class="fa fa-plus" aria-hidden="true"></i> Add Note');
            a.popover();

            td.append(a);
            tr.append(td);
            var td = $("<td>").append($("<span>" , {id : "_worked"}).html(v.worked));
            tr.append(td);
            var td = $("<td>").append($("<span>" , {id : "_schedule"}).html(v.schedule));
            tr.append(td);
            var td = $("<td>").append($("<span>" , {id : "_diff"}).html(v.diff));
            tr.append(td);

            table.find("tbody").append(tr);
        });

    }
</script>
<style type="text/css">
    .daterangepicker.dropdown-menu {
        z-index: 100001 !important;
    }

    .notecontainer{
        overflow: hidden;
    }
    .notecontainer > *{
        float: left;
    }

    .notecontainer > textarea{
        width:140px;
        height:80px;
        resize:none;
        display: block;
        border-right: none;
    }
    .notecontainer > button{
        height: 80px;
        border: none;
        margin: 0px;
    }
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="row">
            <div class="col-lg-2" id="attendance_side_menu">
                <div class="card">
                    <section class="s_header">
                        <span>Pay Periods</span>
                        <button data-toggle="modal" data-target="#add_pay_modal""><i class="fa fa-plus" aria-hidden="true"></i></button>
                    </section>
                    <section>
                        <select class="form-control" id="pay_period_id">
                            <?php if($pay_period_list) : ?>
                                <?php foreach($pay_period_list as $row) : ?>
                                    <option value="<?php echo $row->pay_id; ?>"><?php echo $row->pay_name; ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                 <option value="NO_DATA">NO PAY PERIOD DATA</option>
                            <?php endif; ?>
                        </select>
                    </section>
                    <section class="ac-btn-group">
                        <button >EDIT</button>
                        <button >CLOSE OUT</button>
                    </section>
                </div>
                <div class="card">
                    <section>
                        <select class="form-control" id="selected_outlet">
                            <option value="ALL_OUTLET">All Locations</option>
                            <?php foreach($outlet_list as $row) : ?>
                                <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                </div>
                <div class="card" id="div_timesheets">
                    <label>Timesheets</label>
                    <nav>
                        <ul class="list-group">
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="card hide" id="summary_div">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 no-margin-bottom">
                                <h2 style="margin-top: 5px;" id="summary_header"></h2>
                            </div>
                            <div class="col-lg-6 no-margin-bottom text-right">
                                <button class="btn btn-default">SHOW SHIFTS</button>
                                <button class="btn btn-default">EXPORT</button>
                                <button class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i></button>
                                <button class="btn btn-success">APPROVE</button>
                            </div>
                        </div>
                        <h4>Timesheet summary</h4>
                        <nav class="timesheet_summary">
                            <ul>
                                <li>Regular : <span id="_regular">0</span></li>
                                <li>Overtime : <span id="_overtime">0</span></li>
                                <li>Double OT : <span id="_double_ot">0</span></li>
                                <li>Sick : <span id="_sick">0</span></li>
                                <li>Vacation : <span id="_vacation">0</span></li>
                            </ul>
                        </nav>
                        <table class="table table-bordered" id="timesheet_table">
                            <thead>
                                <tr>
                                    <th width="15%">DAY</th>
                                    <th width="10%">IN</th>
                                    <th width="10%">OUT</th>
                                    <th width="10%">TOTAL</th>
                                    <th width="25%">DETAILS</th>
                                    <th width="10%">WORKED</th>
                                    <th width="10%">SCHEDULED</th>
                                    <th width="10%">DIFFERENCE</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th colspan="3">TOTAL</th>
                                    <th>0.00</th>
                                    <th></th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                    <th>0.00</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>
                                        <span>Mon , Jan 1</span>
                                    </td>
                                    <td>
                                        <span>7:00a</span>
                                    </td>
                                    <td>
                                        <span>4:00p</span>
                                    </td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td>
                                        -
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>Tue , Jan 2</span>
                                    </td>
                                    <td>
                                        <span>TIME </span>
                                    </td>
                                    <td>
                                        <span>OFF</span>
                                    </td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td></td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td>
                                        <span>9.00</span>
                                    </td>
                                    <td>
                                        -
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="add_pay_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Pay Period</h4>
      </div>
      <div class="modal-body">
            <form action="<?php echo site_url('app/timetracker/attendance'); ?>" method="POST">
                <div class="form-group">
                    <label>Date</label>
                    <input type="text" name="daterange" class="daterange form-control">
                </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>
  </div>
</div>