<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li class="active">Add Product</li>
    	</ol>	
    	<h3>Details</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/setup/general_update"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
    		<!-- STORE SETTINGS -->
    		<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Store Settings</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-9">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Product Name</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="store_name" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Product handle</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="store_name" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Description</dt>
	    						<dd>
	    							<div class="form-group">
	    								<textarea class="textarea" name="note"></textarea>
	    							</div>
	    						</dd>
	    						<dt>Product Tags</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div class="input-group">
										  <input type="text" class="form-control"  aria-describedby="basic-addon2">
										 	<span class="input-group-btn">
	    										<button class="btn btn-link" style="margin: 0px !important;" type="button">Add Tags</button>
	    									</span>
										</div>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-4">
	    					
	    				</div>
	    			</div>
	    		</div>
	    	</div>



	   

	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" value="Save" class="btn btn-success">
	    	</div>
    	</form>
    </div>
</div>