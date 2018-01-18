<script type="text/javascript">

	$(document).ready(function(){
		getOrderNumber();
	});

	$(document).on("change" , "#deliver_to" , function(){
		getOrderNumber();
	});
	
	function getOrderNumber(){
		var outlet_id = $("#deliver_to").val();
		var order_no = $('#order_no');

		var url = '<?php echo site_url("app/product/getOrderNumber"); ?>';

		$.ajax({
			url : url ,
			method : "POST" ,
			data : {outlet_id : outlet_id , type : "return"} ,
			success : function(response){
				order_no.val(response);
			}
		});

	}
</script>
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li><a href="<?php echo site_url('app/product/consignment'); ?>">Stock Control</a></li>
    		<li class="active">Return Stock</li>
    	</ol>	
    	<h3>New Stock Return</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/product/return-stock"); ?>" method="POST">
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
	    								<input type="text" name="reference_name" value="<?php echo $name_reference; ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Deliver to</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="order_from">
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
	    								<select class="form-control" name="deliver_to" id="deliver_to">
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
	    								<input type="text" name="due_date" value="<?php echo set_value("due_date"); ?>" class="form-control datepicker">
	    							</div>
	    						</dd>
	    						<dt>Return No.</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="order_no" id="order_no" value="<?php echo set_value("order_no"); ?>" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Supplier invoice</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="supplier_invoice" value="<?php echo set_value("supplier_invoice"); ?>" class="form-control">
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