<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container" >
        	<h1>Product Types</h1>
        </div>
        <div class="grey-bg margin-bottom"">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>A list of all of your product types. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDefault" class="btn btn-success ">Add Type</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="50%"> <a href="#">Name <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a></th>
                        <th width="20%">Number of Products</th>
                        <th width="30%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($product_type_list as $row) : ?>
                        <tr class="customer-row" style="cursor: default;">
                            <td>
                                <span><strong><a href="<?php echo site_url("app/product/?types=$row->product_type_id"); ?>" class="link-style"><?php echo $row->type_name; ?></a></strong></span>
                            </td>
                            <td>
                                <span><?php echo $row->count; ?></span>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="<?php echo site_url("app/product/type/?tags=$row->product_type_id"); ?>" class="btn btn-link">View Products</a>
                                    <a href="<?php echo site_url("app/product/type/edit/$row->product_type_id"); ?>" class="btn btn-link" title="Edit Type"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="<?php echo site_url("app/product/type/delete/$row->product_type_id"); ?>" class="btn btn-link" title="Remove Type"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </div>
                            </td>
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
                <h4 class="modal-title">Add Type</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/product/add_type"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="type_name">Name</label>
                        <input type="text" name="type_name" class="form-control" id="type_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_group_form">Add Type</button>
            </div>
        </div>
    </div>
</div>