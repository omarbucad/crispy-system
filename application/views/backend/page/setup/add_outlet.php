
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li><a href="<?php echo site_url('app/setup/outlets-and-registers'); ?>">Outlets and Registers</a></li>
    		<li class="active">Add Outlet</li>
    	</ol>	
    	<h3>Add Outlet</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/setup/add-outlet"); ?>" method="POST">
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
	    						<dt>Outlet Name</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<input type="text" name="outlet_name" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Default sales tax</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div class="input-group">
	    									<select class="form-control" name="sales_tax">
	    										<optgroup label="Select Sales Tax">
	    											<?php foreach($default_sales_tax_list["sales_tax"] as $row) : ?>
		    											<option value="<?php echo $row->sales_tax_id; ?>"><?php echo $row->tax_name; ?></option>
		    										<?php endforeach; ?>
	    										</optgroup>
	    										<optgroup label="----">
		    										<?php foreach($default_sales_tax_list["group_sales_tax"] as $row) : ?>
		    											<option value="<?php echo $row->sales_tax_group_id; ?>"><?php echo $row->tax_sales_group_name; ?></option>
		    										<?php endforeach; ?>
	    										</optgroup>
	    									</select>
	    									<span class="input-group-btn">
	    										<button class="btn btn-link" style="margin: 0px !important;" type="button">Add sales tax</button>
	    									</span>
	    								</div>
	    								<p class="help-block">The default sales tax will be applied to products sold at this outlet. You can override the default sales tax when editing a product.</p>
	    							</div>
	    						</dd>
	    						<dt>Order number prefix</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="order_number_prefix" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Order number</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="number" name="order_number"  class="form-control" placeholder="1">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Supplier return prefix</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="supplier_return_prefix" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Supplier return number</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="number" name="supplier_return_number" placeholder="1" class="form-control">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- CONTACT INFORMATION -->
	    	<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Sell Screen Prompts</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="container-fluid no-margin-bottom">
	    				<dl class="dl-horizontal text-left">
	    					<dt>Negative inventory</dt>
	    					<dd>
	    						<div class="form-group">
	    							<div class="checkbox">
								        <label>
								          <input type="checkbox" value="1" name="negative_inventory"> Warn sell screen users when they are about to sell more inventory than is available.
								        </label>
								      </div>
	    						</div>
	    					</dd>
	    				</dl>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- ADDRESS -->
	    	<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Physical Address and Contact Details</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Street 1</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[street1]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Street 2</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[street2]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Suburb</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[suburb]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>City</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[city]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Postcode</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[postcode]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>State</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[state]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Country</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="physical[country]">
	    									<?php foreach($countries_list as $code =>  $country) : ?>
	    										<option value="<?php echo $code; ?>"><?php echo $country?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Timezone</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="physical[timezone]">
	    									<?php foreach($timezone_list as $k => $v) : ?>
	    										<optgroup label="<?php echo $k; ?>">
	    											<?php foreach($v as $timezone => $offset) : ?>
	    												<option value="<?php echo $timezone; ?>"><?php echo $offset; ?></option>
	    											<?php endforeach; ?>
	    										</optgroup>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Email</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_email_address" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Phone</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_phone_number" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Twitter</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_field_1" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Facebook</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_field_2" class="form-control">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    			</div>
	    		</div>
	    	</div>


	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" value="Add Outlet" class="btn btn-success">
	    	</div>
    	</form>
    </div>
</div>