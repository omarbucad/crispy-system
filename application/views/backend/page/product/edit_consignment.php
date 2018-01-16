<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li><a href="<?php echo site_url('app/product/consignment'); ?>">Stock Control</a></li>
    		<li class="active">Update Order</li>
    	</ol>	
    	<h3>Update Order</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/product/edit-consignment/$result->inventory_order_id"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
            <input type="hidden" name="inventory_order_id" value="<?php echo $result->inventory_order_id?>">

    		<!-- STORE SETTINGS -->
    		<div class="card margin-bottom">
    			<div class="card-header">
    				<div class="card-title">
    					<div class="title">Details</div>
    				</div>
    			</div>
    			<div class="card-body">
    				<div class="row no-margin-bottom">
                        <div class="col-xs-12 col-lg-6">
                            <dl class="dl-horizontal text-left">
                                <dt>Order name</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="order_name" class="form-control" value="<?php echo $result->reference_name; ?>">
                                    </div>
                                </dd>
                                <dt>Supplier</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $result->order_from; ?>" readonly>
                                    </div>
                                </dd>
                                <dt>Deliver to</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" class="form-control" value="<?php echo $result->deliver_to; ?>" readonly>
                                    </div>
                                </dd>

                            </dl>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <dl class="dl-horizontal">
                                <dt>Delivery due</dt>
                                <dd>
                                    <div class="form-group">
                                       <input type="text" class="form-control datepicker" name="due_date" value="<?php echo $result->due_date; ?>">
                                    </div>
                                </dd>
                                <dt>Order No.</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="order_number" class="form-control" value="<?php echo $result->order_number; ?>">
                                    </div>
                                </dd>
                                <dt>Supplier invoice</dt>
                                <dd>
                                    <div class="form-group">
                                       <input type="text" class="form-control" name="supplier_invoice" value="<?php echo $result->supplier_invoice; ?>">
                                    </div>
                                </dd>
                            </dl>
                        </div>
                    </div>
    			</div>
    		</div>


            <div class="row margin-bottom">
                <div class="col-lg-6 text-left">
                    <a href="<?php echo site_url("app/product/consignment"); ?>" class="btn btn-default">Cancel</a>
                    <input type="submit" value="Save" name="submit" class="btn btn-success">
                </div>
                <div class="col-lg-6 text-right">
                    <button type="button" class="btn btn-danger">Delete</button>
                </div>
            </div>
    	</form>
    </div>
</div>