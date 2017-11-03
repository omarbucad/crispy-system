<div class="container">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li class="active">General</li>
    	</ol>	
    	<h3>General Setup</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/setup/general_update"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
    		<input type="hidden" name="store_id" value="<?php echo $this->encryption->encrypt($session_data->store_id); ?>">
    		<!-- STORE SETTINGS -->
    		<div class="card margin-bottom">
	    		<div class="card-header">
	    			<div class="card-title">
	    				<div class="title">Store Settings</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Store Name</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="store_name" class="form-control" value="<?php echo $general_information->store_name; ?>">
	    							</div>
	    						</dd>
	    						<dt>Default Currency</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="default_currency">
	    									<?php foreach($world_currency as $type => $c) : ?>
	    										<optgroup label="<?php echo $type; ?>">
	    											<?php foreach($c as $code => $currency) : ?>
	    												<option value="<?php echo $code; ?>" <?php echo ($general_information->default_currency == $code) ? "selected" : "" ; ?> ><?php echo $currency; ?></option>
	    											<?php endforeach; ?>
	    										</optgroup>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Timezone</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="timezone">
	    									<?php foreach($timezone_list as $k => $v) : ?>
	    										<optgroup label="<?php echo $k; ?>">
	    											<?php foreach($v as $timezone => $offset) : ?>
	    												<option value="<?php echo $timezone; ?>" <?php echo ($general_information->timezone == $timezone) ? "selected" : "" ; ?>><?php echo $offset; ?></option>
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
	    						<dt>SKU Generation</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select name="sku_generation_type" class="form-control">
	    									<option value="GENERATE_BY_SEQUENCE_NUMBER" <?php echo ($general_information->sku_generation_type == "GENERATE_BY_SEQUENCE_NUMBER") ? "selected" : "" ; ?>>Generate By Sequence Number</option>
	    									<option value="GENERATE_BY_NAME" <?php echo ($general_information->sku_generation_type == "GENERATE_BY_NAME") ? "selected" : "" ; ?>>Generate By Name</option>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Current Sequence No.</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="current_sequence_sku" class="form-control" value="<?php echo $general_information->current_sequence_sku; ?>">
	    							</div>
	    						</dd>
	    						<dt>Display Prices</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="display_price_settings">
	    									<option value="WOT" <?php echo ($general_information->display_price_settings == "WOT") ? "selected" : "" ; ?>>Tax Exclusive</option>
	    									<option value="WT" <?php echo ($general_information->display_price_settings == "WT") ? "selected" : "" ; ?>>Tax Inclusive</option>
	    								</select>
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
	    				<input type="hidden" name="contact_id" value="<?php echo $general_information->contact_id; ?>">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Contact Name</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<div class="col-xs-6 no-padding-left">
	    									<input type="text" name="contact_first_name" class="form-control" placeholder="First Name" value="<?php echo $general_information->contact_first_name; ?>">
	    								</div>
	    								<div class="col-xs-6 no-padding-right">
	    									<input type="text" name="contact_last_name" class="form-control" placeholder="Last Name" value="<?php echo $general_information->contact_last_name; ?>">
	    								</div>
	    							</div>
	    						</dd>
	    						<dt>Email</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="email" name="contact_email" class="form-control" value="<?php echo $general_information->contact_email; ?>">
	    							</div>
	    						</dd>
	    						<dt>Phone</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="phone" name="contact_phone_number" class="form-control" value="<?php echo $general_information->contact_phone; ?>">
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Website</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_website" class="form-control" value="<?php echo $general_information->contact_website; ?>">
	    							</div>
	    						</dd>
	    						<dt>Facebook</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_field_1" class="form-control" value="<?php echo $general_information->field_1; ?>">
	    							</div>
	    						</dd>
	    						<dt>Twitter</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="contact_field_2" class="form-control" value="<?php echo $general_information->field_2; ?>">
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
	    					<input type="hidden" name="physical_address_id" value="<?php echo $general_information->physical_address; ?>">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Physical Address</dt><dd><br><br><br></dd>
	    						<dt>Street 1</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[street1]" class="form-control" value="<?php echo $general_information->physical_street1; ?>">
	    							</div>
	    						</dd>
	    						<dt>Street 2</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[street2]" class="form-control" value="<?php echo $general_information->physical_street2; ?>">
	    							</div>
	    						</dd>
	    						<dt>Suburb</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[suburb]" class="form-control" value="<?php echo $general_information->physical_suburb; ?>">
	    							</div>
	    						</dd>
	    						<dt>City</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[city]" class="form-control" value="<?php echo $general_information->physical_city; ?>">
	    							</div>
	    						</dd>
	    						<dt>Postcode</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[postcode]" class="form-control" value="<?php echo $general_information->physical_postcode; ?>">
	    							</div>
	    						</dd>
	    						<dt>State</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="physical[state]" class="form-control" value="<?php echo $general_information->physical_state; ?>">
	    							</div>
	    						</dd>
	    						<dt>Country</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="physical[country]">
	    									<?php foreach($countries_list as $code =>  $country) : ?>
	    										<option value="<?php echo $code; ?>" <?php echo ($general_information->physical_country == $code) ? "selected" : "" ; ?> ><?php echo $country?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<input type="hidden" name="postal_address_id" value="<?php echo $general_information->postal_address; ?>">
	    					<dl class="dl-horizontal">
	    						<dt>Postal Address</dt><dd><a href="javascript:void(0);" class="text-underline" style="position: relative;top: 7px;">Same as Physical Address</a><br><br><br></dd>
	    						<dt>Street 1</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[street1]" class="form-control" value="<?php echo $general_information->postal_street1; ?>">
	    							</div>
	    						</dd>
	    						<dt>Street 2</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[street2]" class="form-control" value="<?php echo $general_information->postal_street2; ?>">
	    							</div>
	    						</dd>
	    						<dt>Suburb</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[suburb]" class="form-control" value="<?php echo $general_information->postal_suburb; ?>">
	    							</div>
	    						</dd>
	    						<dt>City</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[city]" class="form-control" value="<?php echo $general_information->postal_city; ?>">
	    							</div>
	    						</dd>
	    						<dt>Postcode</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[postcode]" class="form-control" value="<?php echo $general_information->postal_postcode; ?>">
	    							</div>
	    						</dd>
	    						<dt>State</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="postal[state]" class="form-control" value="<?php echo $general_information->postal_state; ?>">
	    							</div>
	    						</dd>
	    						<dt>Country</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="postal[country]">
	    									<?php foreach($countries_list as $code =>  $country) : ?>
	    										<option value="<?php echo $code; ?>" <?php echo ($general_information->postal_country == $code) ? "selected" : "" ; ?> ><?php echo $country?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</dd>
	    						
	    					</dl>
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