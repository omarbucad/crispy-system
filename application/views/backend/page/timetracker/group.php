<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container" >
        	<h1>Staff Position</h1>
        </div>
        <div class="grey-bg margin-bottom"">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Group Staff for reporting and manage it using timetracker. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDefault" class="btn btn-success ">Add Position</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="50%"><a href="javascript:void(0);">Name <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a></th>
                        <th width="20%">Date created</th>
                        <th width="30%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($staff_group_list as $row) : ?>
                        <tr class="customer-row" style="cursor: default;">
                            <td><div  class="pull-left" style="margin-top:5px;background-color: <?php echo $row->group_color; ?>;width: 10px;height: 10px;-moz-border-radius: 50px;-webkit-border-radius: 50px;border-radius: 50px;">&nbsp;</div> <span style="padding-left: 10px;"><?php echo $row->group_name; ?></span></td>
                            <td><?php echo $row->created; ?></td>
                            <td><a href="<?php echo site_url("app/timetracker/?staff_group=$row->group_id&submit=submit"); ?>" class="text-underline link-style">View Staff</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Position</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/timetracker/position"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="group_name">Name</label>
                        <input type="text" name="group_name" class="form-control" id="group_name">
                    </div>
                     <div class="form-group">
                        <label for="group_name">Color</label>
                        <input type="color" name="group_color" class="form-control" id="group_color" style="width:70px">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_group_form">Add Position</button>
            </div>
        </div>
    </div>
</div>