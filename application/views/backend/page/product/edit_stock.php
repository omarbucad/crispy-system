<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li><a href="<?php echo site_url('app/consignment'); ?>">Stock Control</a></li>
    		<li class="active">Edit Purchase Order</li>
    	</ol>	
    	<h3>Edit Purchase Order</h3>
    	<form class="form-horizontal" action="<?php echo $result->edit_link; ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">


    		<!-- STORE SETTINGS -->
    		<div class="card margin-bottom">
    			<div class="card-header">
    				<div class="card-title">
    					<div class="title">Details</div>
    				</div>
    			</div>
    			<div class="card-body">
    				<table width="100%;">
    					<tbody>
    						<tr>
    							<td width="15%" style="padding: 5px 0px;"><strong>Order name</strong></td>
    							<td width="35%" class="text-left"> <?php echo $result->reference_name; ?></td>
    							<td width="15%"><strong>Order No.</strong></td>
    							<td width="35%"> <?php echo $result->order_number; ?> </td>
    						</tr>
    						<tr>
    							<td width="15%" style="padding: 5px 0px;"><strong>Order from</strong></td>
    							<td width="35%"> <?php echo $result->order_from; ?> </td>
    							<td width="15%"><strong>Delivery due</strong></td>
    							<td width="35%"> <?php echo $result->due_date; ?> </td>
    						</tr>
    						<tr>
    							<td width="15%" style="padding: 5px 0px;"><strong>Deliver to</strong></td>
    							<td colspan="3"> <?php echo $result->deliver_to; ?> </td>
    						</tr>
    					</tbody>
    				</table>
    			</div>
    		</div>
    		<div class="text-right margin-bottom">
    			<a href="javascript:void(0);" class="btn btn-default">Edit Order Details</a>
    		</div>
    		<div class="card margin-bottom">
    			<div class="card-header">
    				<div class="card-title">
    					<div class="title">Order products</div>
    				</div>
    			</div>
    			<div class="card-body">
    				<div class="container-fluid margin-bottom">
    					<form action="#" method="POST">
	    					<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
	    					<div class="row">
	    						<div class="col-xs-12 col-lg-6 no-margin-bottom">
	    							<div class="form-group">
	    								<label >Search Products</label>
	    								<select class="select2 form-control" id="select_product">
	    									<option value=""></option>
	    									<?php foreach($inventory_information->products as $key => $row): ?>
	    										<option value="<?php echo $row->product_variant_id; ?>"><?php echo $row->product_name.' '.$row->variant_name; ?></option>
	    									<?php endforeach; ?>
	    								</select>
	    							</div>
	    						</div>
	    						<div class="col-xs-12 col-lg-3 col-lg-offset-3 no-margin-bottom">
	    							<div class="form-group">
	    								<label for="s_product_type">Quantity</label>
	    								<div class="input-group">
	    									<input type="number" class="form-control" value="0" id="product_quantity">
	    									<span class="input-group-btn">
	    										<a href="javascript:void(0);" class="btn btn-success" id="add_count" style="margin: 0px !important;">Add</a>
	    									</span>
	    								</div>
	    							</div>
	    						</div>
	    					</div>
	    				</form>
    				</div>
    				<table class="table">
    					<thead>
    						<tr>
    							<th width="10%">Order</th>
    							<th width="35%">Product</th>
    							<th width="15%">Stock on Hand</th>
    							<th width="10%">Quantity</th>
    							<th width="10%">Supply Price</th>
    							<th width="15%">Total</th>
    							<th width="5%"></th>
    						</tr>
    					</thead>
    					<tbody>
    						<tr>
    							<td></td>
    						</tr>
    					</tbody>
    				</table>
    			</div>
    		</div>

	    	<div class="text-right margin-bottom">
	    		<a href="javascript:void(0);" class="btn btn-default">Cancel</a>
	    		<input type="submit" name="submit" class="btn btn-success" value="Save">
	    		<input type="submit" name="submit" class="btn btn-success" value="Save and Send">
	    	</div>
    	</form>
    </div>
</div>