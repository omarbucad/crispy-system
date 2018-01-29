<script type="text/javascript">
    var site_url = "<?php echo site_url('thumbs/images/staff/'); ?>";
    var today_url = "<?php echo site_url('app/timetracker/get_shift_information_today'); ?>";

    $(document).ready(function(){
        var selected_location = $('#select_locations option:eq(1)').attr("selected" , "selected").val();
        load_data(selected_location);
    });

    $(document).on("click" , ".btn-load-data" , function(){
        var selected_location = $('#select_locations').val();
        load_data(selected_location);
    });

    function load_data(selected_location){
        $.ajax({
            url : today_url ,
            data : {outlet_id : selected_location} ,
            method : "POST" ,
            success : function(response){
                var json = jQuery.parseJSON(response);
                var table = $("#dashboard_timetracker_table > tbody");
                $("#welcome_message").html("HI "+json.my_name+" TODAY'S SCHEDULE FOR "+json.store_name);
                table.html(" ");
                $.each(json.result , function(k , v){
                    table.append(build_td(v));
                });

            }
        });
    }

    function build_td(json){
        var tr = $("<tr>");

        var td = $("<td>");
        var div_img = $("<div>").append($("<img>" , {style : "width:20px;" , src : site_url+json.image_path+"/60/60/"+json.image_name}));
        var div_span = $("<div>").append($("<span>").html(json.first_name+" "+json.last_name));
        td.append(div_img);
        td.append(div_span);

        tr.append(td);
        tr.append(json.td_list);

        return tr;
    }
</script>
<style type="text/css">
    #dashboard_timetracker_div {
        max-height: 500px;
        overflow: auto;
    }
    #dashboard_timetracker_div table{
        margin-bottom: 0px;
    }
    #dashboard_timetracker_table tbody > tr > td{
        overflow: hidden;
    }
    #dashboard_timetracker_table tbody > tr > td > div{
        float: left;
    }
    #dashboard_timetracker_table tbody > tr > td > div:first-child{
        width: 30px;
    }
    #dashboard_timetracker_table tbody > tr > td > div:last-child{
        width: calc(100% - 30px);
        padding: 3px;
    }
    #dashboard_timetracker_table tbody > tr > td > div:last-child > span{
        font-weight: bold;
        font-size: 11px;
    }
    #dashboard_timetracker_table tbody > tr > td > a{
        display: block;
        padding: 7px;
        text-decoration: none;
        font-weight: bold;
        color:white;
        font-size: 11px;
        font-family: 'Roboto Condensed', sans-serif;
    }
    #dashboard_timetracker_table tbody > tr > td > a > span{
        padding: 3px 5px;
        margin-left: 10px;
        background-color: rgba(0,0,0,0.3);
        color:white;
        font-size: 9px;
        font-family: 'Roboto Condensed', sans-serif;
    }
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="panel panel-default">
            <div class="panel-heading"  style="overflow: hidden;">
                <div class="col-lg-10">
                    <strong style="line-height: 35px;" id="welcome_message"></strong>
                </div>
                <div class="col-lg-2">
                   <div class="input-group">
                        <select class="form-control" id="select_locations">
                            <option value="ALL_OUTLET">All Outlet</option>
                            <?php foreach($outlet_list as $row) : ?>
                                <option value="<?php echo $row->outlet_id; ?>"><?php echo $row->outlet_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="input-group-btn">
                            <button class="btn btn-success btn-load-data" style="margin: 0px !important;" type="button"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div id="dashboard_timetracker_div">
                <table class="table table-bordered" id="dashboard_timetracker_table">
                    <thead>
                        <tr>
                            <th width="10%">STAFF</th>
                            <th style="width: calc(90% / 24);" class="text-center">6A</th>
                            <th style="width: calc(90% / 24);" class="text-center">7A</th>
                            <th style="width: calc(90% / 24);" class="text-center">8A</th>
                            <th style="width: calc(90% / 24);" class="text-center">9A</th>
                            <th style="width: calc(90% / 24);" class="text-center">10A</th>
                            <th style="width: calc(90% / 24);" class="text-center">11A</th>
                            <th style="width: calc(90% / 24);" class="text-center">12P</th>
                            <th style="width: calc(90% / 24);" class="text-center">1P</th>
                            <th style="width: calc(90% / 24);" class="text-center">2P</th>
                            <th style="width: calc(90% / 24);" class="text-center">3P</th>
                            <th style="width: calc(90% / 24);" class="text-center">4P</th>
                            <th style="width: calc(90% / 24);" class="text-center">5P</th>
                            <th style="width: calc(90% / 24);" class="text-center">6P</th>
                            <th style="width: calc(90% / 24);" class="text-center">7P</th>
                            <th style="width: calc(90% / 24);" class="text-center">8P</th>
                            <th style="width: calc(90% / 24);" class="text-center">9P</th>
                            <th style="width: calc(90% / 24);" class="text-center">10P</th>
                            <th style="width: calc(90% / 24);" class="text-center">11P</th>
                            <th style="width: calc(90% / 24);" class="text-center">12A</th>
                            <th style="width: calc(90% / 24);" class="text-center">1A</th>
                            <th style="width: calc(90% / 24);" class="text-center">2A</th>
                            <th style="width: calc(90% / 24);" class="text-center">3A</th>
                            <th style="width: calc(90% / 24);" class="text-center">4A</th>
                            <th style="width: calc(90% / 24);" class="text-center">5A</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">THINGS NEEDING YOUR ACTION</div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">THINGS AWAITING ACTION FROM OTHERS</div>
                </div>
            </div>
        </div>
    </div>
</div>