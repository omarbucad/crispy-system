<script type="text/javascript">
    var site_url = "<?php echo site_url('thumbs/images/staff/'); ?>";
    var today_url = "<?php echo site_url('app/timetracker/get_shift_information_today'); ?>";

    $(document).ready(function(){
        $.ajax({
            url : today_url ,
            data : {outlet_id : 1} ,
            method : "POST" ,
            success : function(response){
                var json = jQuery.parseJSON(response);
                var table = $("#dashboard_timetracker_table > tbody");

                $.each(json , function(k , v){
                    table.append(build_td(v));
                });

            }
        });
    });

    function build_td(json){
        var tr = $("<tr>");

        var td = $("<td>");
        var div_img = $("<div>").append($("<img>" , {style : "width:20px;" , src : site_url+json.image_path+"/60/60/"+json.image_name}));
        var div_span = $("<div>").append($("<span>").html(json.first_name+" "+json.last_name));
        td.append(div_img);
        td.append(div_span);

        tr.append(td);

        return tr;

    }
</script>
<style type="text/css">
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
    }
    #dashboard_timetracker_table tbody > tr > td > a > span{
        padding: 3px 5px;
        margin-left: 10px;
        background-color: rgba(0,0,0,0.2);
    }
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="panel panel-default">

            <div class="panel-heading"  style="overflow: hidden;">
                <div class="col-lg-10">
                    <strong style="line-height: 35px;">HI MHAR TODAY'S SCHEDULE FOR ABC COMPANY</strong>
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
                            <button class="btn btn-success" style="margin: 0px !important;" type="button"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                        </span>
                    </div>
                </div>
            </div>
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
                    <tr>
                        <td>
                            <div><img src="http://192.168.1.147/crispy-system/thumbs/images/staff/2018/01/60/60/Satou.jpg" style="width:20px;"></div>
                            <div><span>Satou Pendragon</span></div>
                        </td>
                        <td colspan="2"></td>

                        <td colspan="20">
                            <a href="javascript:void(0);" style="background-color: #f1f1f1;">
                                8a - 3a <i><small>at Main outlet</small></i> <span> Position</span>
                            </a>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>          
                    <tr>
                        <td>
                            <div><img src="http://192.168.1.147/crispy-system/thumbs/images/staff/2018/01/60/60/Pochi.jpg" style="width:20px;"></div>
                            <div><span>Pochi Kishresgalza</span></div>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td colspan="16">
                            <a href="javascript:void(0);" style="background-color: #78c1ff;">
                                8a - 3a <i><small>at Main outlet</small></i> <span> Position</span>
                            </a>
                        </td>
                        <td></td>
                    </tr>                    
                </tbody>
            </table>
        </div>
    </div>
</div>