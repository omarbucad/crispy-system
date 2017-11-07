<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container" >
        	<h1>Suppliers</h1>
        </div>
        <div class="grey-bg margin-bottom"">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>View and manage your suppliers. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url("app/product/supplier/add"); ?>" class="btn btn-success ">Add Supplier</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="30%"><a href="#">Name <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a></th>
                        <th width="30%">Description</th>
                        <th width="10%">Default Markup</th>
                        <th width="15%">Number of Products</th>
                        <th width="15%"></th>
                    </tr>
                </thead>
                <tbody>
                   <?php foreach($supplier_list as $row) : ?>
                        <tr class="customer-row" style="cursor: default;">
                            <td>
                                <span><a href="<?php echo site_url("app/product/supplier/view/$row->supplier_id ") ?>" class="link-style"><?php echo $row->supplier_name; ?></a></span>
                            </td>
                            <td><span><?php echo $row->description; ?></span></td>
                            <td><span><?php echo $row->default_markup; ?></span></td>
                            <td><span>0</span></td>
                            <td>
                               <div class="btn-group" role="group" aria-label="...">
                                    <a href="<?php echo site_url("app/product/?supplier=$row->supplier_id ") ?>" class="btn btn-link">View Products</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
