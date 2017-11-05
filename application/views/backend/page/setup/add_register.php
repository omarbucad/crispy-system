
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li><a href="<?php echo site_url('app/setup/outlets-and-registers'); ?>">Outlets and Registers</a></li>
    		<li class="active">Add Register</li>
    	</ol>	
    	<h3>Add Register to <?php echo $outlet_name; ?></h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/setup/add-register/?id=".$this->input->get("id")); ?>" method="POST">
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
	    						<dt>Register name</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<input type="text" name="register_name" class="form-control">
	    							</div>
	    						</dd>
	    						
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Cash Management</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="cash_management">
	    									<option value="CASH">Cash</option>
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
	    				<div class="title">Receipt</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Receipt template</dt>
	    						<dd class="form-horizontale">
	    							<div class="form-group">
	    								<select class="form-control">
	    									<option>Standard Reciept</option>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Number</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="number" name="number" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Prefix</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="prefix" class="form-control">
	    								<p class="help-block">Maximum 10 characters</p>
	    							</div>
	    						</dd>
	    						<dt>Suffix</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="suffix" class="form-control">
	    								<p class="help-block">Maximum 10 characters</p>
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
	    				<div class="title">At End of Sale</div>
	    			</div>
	    		</div>
	    		<div class="card-body">
	    			<div class="row no-margin-bottom">
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal text-left">
	    						<dt>Select user for next sale</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div>
	    									<label class="radio-inline">
	    										<input type="radio" name="select_user_for_next_sale" value="1" checked=""> Yes
	    									</label>
	    									<label class="radio-inline">
	    										<input type="radio" name="select_user_for_next_sale" value="0"> No
	    									</label>
										</div>
	    							</div>
	    						</dd>
	    						<dt>Email receipt</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div>
	    									<label class="radio-inline">
	    										<input type="radio" name="email_receipt" value="1" checked=""> Yes
	    									</label>
	    									<label class="radio-inline">
	    										<input type="radio" name="email_receipt" value="0"> No
	    									</label>
										</div>
	    							</div>
	    						</dd>
	    						<dt>Print receipt</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div>
	    									<label class="radio-inline">
	    										<input type="radio" name="print_receipt" value="1" checked=""> Yes
	    									</label>
	    									<label class="radio-inline">
	    										<input type="radio" name="print_receipt" value="0"> No
	    									</label>
										</div>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<dl class="dl-horizontal">
	    						<dt>Ask for a note</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="ask_for_a_note">
	    									<option value="0">Never</option>
	    									<option value="1">On Save</option>
	    									<option value="2">On all Sales</option>
	    								</select>
	    							</div>
	    						</dd>
	    						<dt>Print note on receipt</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div>
	    									<label class="radio-inline">
	    										<input type="radio" name="print_note_on_receipt" value="1" checked=""> Yes
	    									</label>
	    									<label class="radio-inline">
	    										<input type="radio" name="print_note_on_receipt" value="0"> No
	    									</label>
										</div>
	    							</div>
	    						</dd>
	    						<dt>Show discounts on receipts</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div>
	    									<label class="radio-inline">
	    										<input type="radio" name="show_discount_on_receipt" value="1" checked=""> Yes
	    									</label>
	    									<label class="radio-inline">
	    										<input type="radio" name="show_discount_on_receipt" value="0"> No
	    									</label>
										</div>
	    							</div>
	    						</dd>
	    					</dl>
	    				</div>
	    			</div>
	    		</div>
	    	</div>


	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" value="Add Register" class="btn btn-success">
	    	</div>
    	</form>
    </div>
</div>