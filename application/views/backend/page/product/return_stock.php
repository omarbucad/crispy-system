
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li><a href="<?php echo site_url('app/product/consignment'); ?>">Stock Control</a></li>
    		<li class="active">Return Stock</li>
    	</ol>	
    	<h3>New Stock Return</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/product/order-stock"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
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
	    						<dt>Name / Reference</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="company"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Deliver to</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control">
	    									<option value="ANY">Any</option>
	    									<?php foreach($supplier_list as $supplier) : ?>
	    										<option value="<?php echo $supplier->supplier_id; ?>"><?php echo $supplier->supplier_name; ?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Return from</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control">
	    									<?php foreach($outlet_list as $outlet) : ?>
	    										<option value="<?php echo $outlet->outlet_id; ?>"><?php echo $outlet->outlet_name; ?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Delivery Due</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="company" value="<?php echo set_value("company"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Return No.</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="company" value="<?php echo set_value("company"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Supplier invoice</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="company" value="<?php echo set_value("company"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    			</div>
	    			<hr>
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Import stock return</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="file" name="file">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>

	    			</div>
	    		</div>
	    	</div>



	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" class="btn btn-success" value="Save">
	    	</div>
    	</form>
    </div>
</div>