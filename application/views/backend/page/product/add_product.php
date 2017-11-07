<script type="text/javascript">
	
	$(document).on("click" , '.add-tag-btn' , function(){
		var newStateVal = "MHAR";
	      // Set the value, creating a new option if necessary
	      if ($("#select_tags").find("option[value=" + newStateVal + "]").length) {
	        $("#select_tags").val(newStateVal).trigger("change");
	      } else { 
	        // Create the DOM option that is pre-selected by default
	        var newState = new Option(newStateVal, newStateVal, true, true);
	        // Append it to the select
	        $("#select_tags").append(newState).trigger('change');
	      } 
	});
</script>
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
										  <select class="form-control select2" name="tags" id="select_tags" multiple="">
										  	<?php foreach($product_tag_list as $row) : ?>
										  		<option value="<?php echo $row->product_tag_id; ?>"><?php echo $row->tag_name; ?></option>
										  	<?php endforeach; ?>
										  </select>
										  <span class="input-group-btn">
										  	<button class="btn btn-link add-tag-btn" style="margin: 0px !important;" type="button">Add Tags</button>
										  </span>
										</div>
	    							</div>
	    						</dd>
	    					</dl>
	    					<hr>
	    					<div class="row">
	    						<div class="col-xs-12 col-lg-6">
	    							<dl class="dl-horizontal text-left">
	    								<dt>Product Type</dt>
	    								<dd>
			    							<div class="form-group">
			    								<select class="form-control">
			    									<option value=""></option>
			    									<?php foreach($product_type_list as $row) : ?>
			                                            <option value="<?php echo $row->product_type_id; ?>"><?php echo $row->type_name; ?></option>
			                                        <?php endforeach; ?>
			    								</select>
			    							</div>
			    						</dd>
			    						<dt>Supplier</dt>
	    								<dd>
			    							<div class="form-group">
			    								<select class="form-control">
			    									<option value=""></option>
			    									<?php foreach($supplier_list as $row) : ?>
			                                            <option value="<?php echo $row->supplier_id; ?>"><?php echo $row->supplier_name; ?></option>
			                                        <?php endforeach; ?>
			    								</select>
			    							</div>
			    						</dd>
			    						<dt>Supplier Code</dt>
	    								<dd>
			    							<div class="form-group">
			    								<input type="text" name="store_name" class="form-control">
			    							</div>
			    						</dd>
	    							</dl>
	    						</div>
	    						<div class="col-xs-12 col-lg-6">
	    							<dl class="dl-horizontal text-left">
	    								<dt>Product brand</dt>
	    								<dd>
			    							<div class="form-group">
			    								<select class="form-control">
			    									<option value=""></option>
			    									<?php foreach($product_brand_list as $row) : ?>
			                                            <option value="<?php echo $row->product_brand_id; ?>"><?php echo $row->brand_name; ?></option>
			                                        <?php endforeach; ?>
			    								</select>
			    							</div>
			    						</dd>
			    						<dt>Sales account code</dt>
	    								<dd>
			    							<div class="form-group">
			    								<input type="text" name="store_name" class="form-control">
			    							</div>
			    						</dd>
			    						<dt>Purchase account code</dt>
	    								<dd>
			    							<div class="form-group">
			    								<input type="text" name="store_name" class="form-control">
			    							</div>
			    						</dd>
	    							</dl>
	    						</div>

	    					</div>
	    				</div>
	    				<div class="col-xs-12 col-lg-3">
	    					<table style="width: 100%">
	    						<tr>
	    							<td>Images</td>
	    							<td class="text-right"><a href="#" class="btn btn-xs btn-success">Set Main Image</a></td>
	    						</tr>
	    					</table>
	    					<div class="dragdropimg text-center">
	    						<h5>Upload images<br><small>Drag and drop images here or click to select files</small></h5>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- PRICING -->
    		<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Pricing</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="well">
	    				<table class="table">
	    					<tr>
	    						<th>Supply price</th>
	    						<th>x Markup (%)</th>
	    						<th>= Retail Price</th>
	    						<th>+ Sales tax</th>
	    						<th>= Retail Price</th>
	    					</tr>
	    					<tr>
	    						<td>
	    							<input type="number" class="form-control" name="supply_price" value="0.00" step="0.01">
	    							<span class="help-block">Excluding tax</span>
	    						</td>
	    						<td>
	    							<input type="number" class="form-control" name="supply_price" value="0.00" step="0.01">
	    						</td>
	    						<td>
	    							<input type="number" class="form-control" name="supply_price" value="0.00" step="0.01">
	    							<span class="help-block">Excluding tax</span>
	    						</td>
	    						<td>
	    							
	    							<div class="input-group">
								    	<select class="form-control">
								    		<?php foreach($sales_tax_list as $row) : ?>
								    			<option value="<?php echo $row->sales_tax_id; ?>"><?php echo $row->tax_name.' ('.$row->tax_rate.'%)';?></option>
								    		<?php endforeach; ?>
								    	</select>
									    <span class="input-group-addon">
									        0.00
									    </span>
								    </div>

	    							<span class="help-block">Currently, tax 1 (10%)</span>
	    						</td>
	    						<td>
	    							<input type="number" class="form-control" name="supply_price" value="0.00" step="0.01">
	    							<span class="help-block">Including tax</span>
	    						</td>
	    					</tr>
	    				</table>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- PRICING -->
    		<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Product Type & Inventory</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<section class="stardard_product">
	    				<hr>
		    			<div class="row">
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>Variant Products<br>
		    						<small>These are products that have different versions, like size or color. Turn this on to specify up to three attributes (like color), and unlimited values for each attribute (like green, blue, black).</small>
		    					</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>This product has variants</h4>
		    					<input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
		    				</div>
		    			</div>
		    			<hr>
		    			<div class="row">
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>Tracking Inventory<br>
		    						<small>Leave this on if you want to keep track of your inventory quantities. You'll be able to report on cost of goods sold, product performance, and projected weeks cover, as well as manage your store using inventory orders, transfers and rolling inventory counts.</small>
		    					</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>Track inventory with <?php echo $application_name; ?></h4>
		    					<input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
		    				</div>
		    			</div>
		    			<hr>
	    			</section>
	    		</div>
	    	</div>

	   

	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" value="Save" class="btn btn-success">
	    	</div>
    	</form>
    </div>
</div>