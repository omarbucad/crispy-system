<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container" >
        	<h1>Customer Groups</h1>
        </div>
        <div class="grey-bg margin-bottom"">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Group customers for reporting and promotional pricing using Price Books. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDefault" class="btn btn-success ">Add Group</a>
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
                    <?php foreach($customer_group_list as $row) : ?>
                        <tr class="customer-row" style="cursor: default;">
                            <td><?php echo $row->group_name; ?></td>
                            <td><?php echo $row->created; ?></td>
                            <td><a href="<?php echo site_url("app/customer/?customer_group=$row->group_id&submit=submit"); ?>" class="text-underline link-style">View Customers</a></td>
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
                <h4 class="modal-title">Add Group</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/customer/groups"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="group_name">Name</label>
                        <input type="text" name="group_name" class="form-control" id="group_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_group_form">Add Group</button>
            </div>
        </div>
    </div>
</div>