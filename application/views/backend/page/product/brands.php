<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container" >
        	<h1>Brands</h1>
        </div>
        <div class="grey-bg margin-bottom"">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>A list of all of your brands. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modalDefault" class="btn btn-success ">Add Brand</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="table my-table">
                <thead>
                    <tr>
                        <th width="30%">Name</th>
                        <th width="30%">Description</th>
                        <th width="20%">Number of Products</th>
                        <th width="20%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($product_brand_list as $row) : ?>
                        <tr>
                            <td><strong><a href="#" class="link-style"><?php echo $row->brand_name; ?></a></strong></td>
                            <td><?php echo $row->description; ?></td>
                            <td>0</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="...">
                                    <a href="#" class="btn btn-link">View Products</a>
                                    <a href="#" class="btn btn-link" title="Edit Brand"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a href="#" class="btn btn-link" title="Remove Brand"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                  
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
                <h4 class="modal-title">Add Brand</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/product/add_brand"); ?>" id="add_group_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="brand_name">Name</label>
                        <input type="text" name="brand_name" class="form-control" id="brand_name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" rows="3" name="description" id="description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_group_form">Add Brand</button>
            </div>
        </div>
    </div>
</div>