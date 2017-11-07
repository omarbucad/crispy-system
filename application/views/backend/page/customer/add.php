
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/customer'); ?>">Customer</a></li>
    		<li class="active">New Customer</li>
    	</ol>	
    	<h3>New Customer</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/customer/add-customer"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
    		<!-- STORE SETTINGS -->
    		<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Customer Details</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Contact Name</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<div class="col-xs-6 no-padding-left">
	    									<input type="text" name="first_name" class="form-control" value="<?php echo set_value("first_name"); ?>" placeholder="First Name">
	    								</div>
	    								<div class="col-xs-6 no-padding-right">
	    									<input type="text" name="last_name" class="form-control" value="<?php echo set_value("last_name"); ?>" placeholder="Last Name">
	    								</div>
	    							</div>
	    						</dd>
	    						<dt>Company</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="company" value="<?php echo set_value("company"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Customer code</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="customer_code" value="<?php echo set_value("customer_code"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Customer Group</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="customer_group">
	    									<?php foreach($customer_group_list as $row) : ?>
	    										<option value="<?php echo $row->group_id; ?>"><?php echo $row->group_name; ?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Date of birth</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<div class="col-xs-4 no-padding-left">
	    									<input type="text" name="date_of_birth[dd]"  value="<?php echo set_value("date_of_birth[dd]"); ?>" class="form-control" placeholder="DD">
	    								</div>
	    								<div class="col-xs-4 no-padding-right">
	    									<input type="text" name="date_of_birth[mm]"  value="<?php echo set_value("date_of_birth[mm]"); ?>" class="form-control" placeholder="MM">
	    								</div>
	    								<div class="col-xs-4 no-padding-right">
	    									<input type="text" name="date_of_birth[yy]"  value="<?php echo set_value("date_of_birth[yy]"); ?>" class="form-control" placeholder="YYYY">
	    								</div>
	    							</div>
	    						</dd>
	    						<dt>Gender</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<div class="radio">
	    									<label class="radio-inline"><input type="radio" name="gender" value="FEMALE" >Female</label>
										  	<label class="radio-inline"><input type="radio" name="gender" value="MALE" >Male</label>
										</div>
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
	    				<div class="title">Contact Information</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	  
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						
	    						<dt>Email</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="email" name="email" value="<?php echo set_value("email"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Phone</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="phone" name="phone_number" value="<?php echo set_value("phone_number"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Fax</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="fax" value="<?php echo set_value("fax"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Website</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="website" value="<?php echo set_value("website"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Facebook</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field1" value="<?php echo set_value("field1"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Twitter</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field2" value="<?php echo set_value("field2"); ?>"  class="form-control">
	    							</div>
	    						</dd>
	    						<dt></dt>
	    						<dd>
	    							<div class="checkbox">
									  <label>
									    <input type="checkbox" value="1" name="direct_email">
									    This customer has opted out of direct mail communications.
									  </label>
									</div>
	    						</dd>
	    					</dl>
	    				</div>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- ADDRESS -->
	    	<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Address</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	  
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Physical Address</dt><dd><br><br><br></dd>
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
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Postal Address</dt><dd><a href="javascript:void(0);" class="text-underline" style="position: relative;top: 7px;">Same as Physical Address</a><br><br><br></dd>
	    						<dt>Street 1</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[street1]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Street 2</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[street2]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Suburb</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[suburb]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>City</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[city]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Postcode</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[postcode]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>State</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[state]" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Country</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="postal[country]">
	    									<?php foreach($countries_list as $code =>  $country) : ?>
	    										<option value="<?php echo $code; ?>" <?php echo ($session_data->country == $code) ? "selected" : "" ; ?>><?php echo $country?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						
	    					</dl>
	    				</div>
	    			</div>
	    		</div>
	    	</div>

	    	<!-- ADDITIONAL INFORMATION -->
	    	<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Addtional Information</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	  
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						
	    						<dt>Custom field 1</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field1" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Custom field 2</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field2" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Custom field 3</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field3" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Custom field 4</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="field4" class="form-control">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<textarea class="textarea" name="note"></textarea>
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