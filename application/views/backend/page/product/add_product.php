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

	$(document).on("click" , '.view-outlet' , function(){
		var $me = $(this);

		if($me.find("span").text() == "View taxes by outlet"){
			$me.find("span").text("Hide taxes by outlet");
			$me.find("i").removeClass("fa-caret-down").addClass("fa-caret-up");
			$("#outlet-table").removeClass("hide");
		}else{
			$me.find("span").text("View taxes by outlet");
			$me.find("i").removeClass("fa-caret-up").addClass("fa-caret-down");
			$("#outlet-table").addClass("hide");
		}
	});

	$(document).on('change' , '.compute-sales-tax-wot' , function(){

		if($(this).val() == "DEFAULT"){
			var rate = parseFloat($(this).data("default"));
			$(this).closest(".row").find(".sales-tax-span").fadeIn();
		}else{
			var rate = parseFloat($(this).find(":selected").data("rate"));
			$(this).closest(".row").find(".sales-tax-span").fadeOut();
		}

		var retail_price = parseFloat($(".retail_price_1").val());

		var tax_amount = parseFloat(retail_price * (rate / 100));
		var retail_price_with_tax = parseFloat(retail_price + tax_amount).toFixed(2);

		$(this).closest("tr").find(".tax_amount").text(tax_amount.toFixed(2));
		$(this).closest("tr").find(".retail_price").text(retail_price_with_tax);

	});

	$(document).on('change' , '.compute-sales-tax-wt' , computeSales);

	$(document).on('keyup' , '.supply-price , .supply-markup' , function(){
		var supply_price = parseFloat($(".supply-price").val());
		var markup = parseFloat($(".supply-markup").val());

		var markup_price = parseFloat(supply_price * (markup / 100));
		var retail_price = parseFloat(supply_price + markup_price).toFixed(2);
		$(".retail_price_1").val(retail_price);

		<?php if($store_settings->display_price_settings == "WT") : ?>
			computeSales();
		<?php else : ?>
			computeSales2();
		<?php endif; ?>
		
	});

	function computeSales2(){
		$.each( $(".compute-sales-tax-wot") , function(k , v){

			if($(v).val() == "DEFAULT"){
				var rate = parseFloat($(v).data("default"));
				$(v).closest(".row").find(".sales-tax-span").fadeIn();
			}else{
				var rate = parseFloat($(v).find(":selected").data("rate"));
				$(v).closest(".row").find(".sales-tax-span").fadeOut();
			}

			var retail_price = parseFloat($(".retail_price_1").val());

			var tax_amount = parseFloat(retail_price * (rate / 100));
			var retail_price_with_tax = parseFloat(retail_price + tax_amount).toFixed(2);

			$(v).closest("tr").find(".tax_amount").text(tax_amount.toFixed(2));
			$(v).closest("tr").find(".retail_price").text(retail_price_with_tax);
		});
	}

	function computeSales(){

		if($(".compute-sales-tax-wt").val() == "DEFAULT"){
			var rate = parseFloat($(".compute-sales-tax-wt").data("default"));
			$(".sales-tax-span").fadeIn();
		}else{
			var rate = parseFloat($(".compute-sales-tax-wt").find(":selected").data("rate"));
			$(".sales-tax-span").fadeOut();
		}

		var retail_price = parseFloat($(".retail_price_1").val());
		var tax_amount = parseFloat(retail_price * (rate / 100));

		$(".compute-sales-tax-wt").parent().find("span").text(tax_amount.toFixed(2));
		$(".retail_price_2").val(parseFloat(retail_price + tax_amount).toFixed(2));
	}

	$(document).on('click' , '.apply-all' , function(){
		var className = $(this).data("class");
		$(className).val($(this).closest("td").find("input").val());
	});

	$(document).on('click' , '.add-attribute' , function(){
		var table = $(this).parent().find("table");
		var clone = table.find("tbody > tr:first-child").clone();

		clone.find(".input-group-btn").css("visibility" , "visible");

		if(table.find("tbody > tr").length == 2){
			$(this).addClass("hide");
			table.find("tbody").append(clone);
		}else{
			table.find("tbody").append(clone);
		}
	});

	$(document).on("click" , '.remove-attribute' , function(){
		$(this).closest("tr").fadeOut("slow").remove();
		$(".add-attribute").removeClass("hide");
	});

	$(document).on("click" , '.product-type-btn' , function(){
		$(".product-type-btn").removeClass("active");
		$(this).addClass("active");

		$("#product_type").val($(this).data("type"));

		if($(this).data("type") == "STANDARD"){
			$(".standard_product").fadeIn();
			$(".composite_product").fadeOut();

		}else{
			$(".standard_product").fadeOut();
			$(".composite_product").fadeIn();
		}
	});

	$(document).ready(function(){
		$("#product_variant").hide();
		$(".composite_product").hide();

		$(".track_inventory").bootstrapSwitch({
		    size: "mini" ,
		    onSwitchChange : function(event , state){
		    	if(state){
		    		if($(".has_variant").is(":checked")){
		    			$("#product_inventory_table").fadeOut();
		    		}else{
		    			$("#product_inventory_table").fadeIn();
		    		}
		    	}else{
		    		$("#product_inventory_table").fadeOut();
		    	}
		    }
		});
		$(".has_variant").bootstrapSwitch({
		    size: "mini" ,
		    onSwitchChange : function(event , state){
		    	if(state){
		    		if($(".track_inventory").is(":checked")){
		    			$("#product_inventory_table").fadeOut();
		    		}

		    		$("#product_variant").fadeIn();
		    	}else{
		    		if($(".track_inventory").is(":checked")){
		    			$("#product_inventory_table").fadeIn();
		    		}
		    		$("#product_variant").fadeOut();
		    	}
		    }
		});
	});
</script>
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li class="active">Add Product</li>
    	</ol>	
    	<h3>Add Product</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/setup/general_update"); ?>" method="POST">
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
	    				<table class="table no-margin-bottom">
	    					<tr>
	    						<th>Supply price</th>
	    						<th>x Markup (%)</th>
	    						<th>= Retail Price</th>
	    						<?php if($store_settings->display_price_settings == "WT") : ?>
	    						<th>+ Sales tax</th>
	    						<th>= Retail Price</th>
	    						<?php endif; ?>
	    					</tr>
	    					<tr>
	    						<td>
	    							<input type="number" class="form-control supply-price" name="supply_price" value="0.00" step="0.01">
	    							<span class="help-block">Excluding tax</span>
	    						</td>
	    						<td>
	    							<input type="number" class="form-control supply-markup" name="supply_price" value="0.00" step="0.01">
	    						</td>
	    						<td>
	    							<input type="number" class="form-control retail_price_1" name="supply_price"  value="0.00" step="0.01" readonly="">
	    							<span class="help-block">Excluding tax</span>
	    						</td>
	    						<?php if($store_settings->display_price_settings == "WT") : ?>
	    						<td>
	    							<div class="input-group">
								    	<select class="form-control compute-sales-tax-wt" data-default="<?php echo $store_settings->tax_rate; ?>">
								    		<option value="DEFAULT" selected="">Default tax for this outlet</option>
								    		<option disabled="">-------------</option>
								    		<?php foreach($default_sales_tax_list["sales_tax"] as $row) : ?>
								    			<option value="<?php echo $row->sales_tax_id; ?>" data-rate="<?php echo $row->tax_rate; ?>"><?php echo $row->tax_name; ?></option>
								    		<?php endforeach; ?>
								    		<option disabled="">-------------</option>
								    		<?php foreach($default_sales_tax_list["group_sales_tax"] as $row) : ?>
								    			<option value="<?php echo $row->sales_tax_group_id; ?>" data-rate="<?php echo $row->sales_tax_group_rate; ?>"><?php echo $row->tax_sales_group_name; ?></option>
								    		<?php endforeach; ?>
								    	</select>
									    <span class="input-group-addon">
									        0.00
									    </span>
								    </div>
	    							<span class="help-block sales-tax-span">Currently, <?php echo $store_settings->tax_name; ?></span>
	    						</td>
	    						<td>
	    							<input type="number" class="form-control retail_price_2" name="supply_price" value="0.00" step="0.01" readonly="">
	    							<span class="help-block">Including tax</span>
	    						</td>
	    						<?php endif; ?>
	    					</tr>
	    				</table>
	    			</div>

	    			<?php if($store_settings->display_price_settings == "WOT") : ?>
	    				<div class="text-center margin-bottom">
	    					<a href="javascript:void(0);" class="link-style view-outlet"><i class="fa fa-caret-down" aria-hidden="true"></i> <span>View taxes by outlet</span> </a>
	    				</div>
	    				<table class="customer-table hide" id="outlet-table">
	    					<thead>
	    						<tr>
	    							<th width="20%">Outlet</th>
	    							<th width="60%">Sales tax</th>
	    							<th width="10%" class="text-right">Tax amount</th>
	    							<th width="10%" class="text-right">Retail price <small>Including Tax</small></th>
	    						</tr>
	    					</thead>
	    					<tbody>
	    						<?php foreach($outlet_list as $outlet) : ?>
	    							<tr class="customer-row" style="cursor: default;">
		    							<td><span><?php echo $outlet->outlet_name?></span></td>
		    							<td>
		    								<div class="row">
		    									<div class="col-xs-6 col-lg-6 no-margin-bottom">
		    										<div class="form-group no-margin-bottom">
			    										<select class="form-control compute-sales-tax-wot" name="outlet_tax[<?php echo $outlet->outlet_id?>]" data-default="<?php echo $outlet->tax_rate; ?>">
			    											<option value="DEFAULT">Default tax for this outlet</option>
			    											<option disabled="">-------------</option>
			    											<?php foreach($default_sales_tax_list["sales_tax"] as $row) : ?>
			    												<option value="<?php echo $row->sales_tax_id; ?>" data-rate="<?php echo $row->tax_rate; ?>"><?php echo $row->tax_name; ?></option>
			    											<?php endforeach; ?>
															<option disabled="">-------------</option>
			    											<?php foreach($default_sales_tax_list["group_sales_tax"] as $row) : ?>
			    												<option value="<?php echo $row->sales_tax_group_id; ?>" data-rate="<?php echo $row->sales_tax_group_rate; ?>"><?php echo $row->tax_sales_group_name; ?></option>
			    											<?php endforeach; ?>
				    									</select>
		    										</div>
		    									</div>
		    									<div class="col-xs-6 col-lg-6 no-margin-bottom">
		    										<span class="help-block sales-tax-span"><?php echo $outlet->tax_name; ?></span>
		    									</div>
		    								</div>
		    							</td>
		    							<td class="text-right"><span class="tax_amount">0.00</span></td>
		    							<td class="text-right"><strong><span class="retail_price">0.00</span></strong></td>
		    						</tr>
	    						<?php endforeach; ?>
	    					</tbody>
	    				</table>
	    			<?php endif; ?>
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
	    			<input type="hidden" name="product_type" id="product_type" value="STANDARD">
	    			<div class="row">
	    				<div class="col-xs-12 col-lg-6">
	    					<a href="javascript:void(0);" class="product-type-btn active" data-type="STANDARD">
	    						<img src="<?php echo site_url("public/img/price-tag.png"); ?>">
	    						<span>Standard</span>
	    					</a>
	    				</div>
	    				<div class="col-xs-12 col-lg-6">
	    					<a href="javascript:void(0);" class="product-type-btn" data-type="COMPOSITE">
	    						<img src="<?php echo site_url("public/img/tag.png"); ?>">
	    						<span>Composite</span>
	    					</a>
	    				</div>
	    			</div>
	    			<hr>

	    			<section class="standard_product">
		    			<div class="row">
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>Variant Products<br>
		    						<small>These are products that have different versions, like size or color. Turn this on to specify up to three attributes (like color), and unlimited values for each attribute (like green, blue, black).</small>
		    					</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>This product has variants</h4>
		    					<input type="checkbox" class="has_variant" name="has_variant" value="1">
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
		    					<input type="checkbox" class="track_inventory" name="track_inventory" value="1" checked>
		    				</div>
		    			</div>
		    			<table class="customer-table" id="product_inventory_table">
		    				<thead>
		    					<tr>
		    						<th width="40%">Outlet</th>
		    						<th width="20%">Currently Inventory</th>
		    						<th width="20%">Reorder point</th>
		    						<th width="20%">Reorder amount</th>
		    					</tr>
		    				</thead>
		    				<tbody>
		    					<?php foreach($outlet_list as $key => $outlet) : ?>
		    						<?php if($key == 0) : ?>
		    							<tr class="customer-row" style="cursor: default;">
			    							<td><span><?php echo $outlet->outlet_name?></span></td>
			    							<td>
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][current_inventory]" class="form-control" value="0">
			    								<div class="text-right">
			    									<a href="javascript:void(0);" class="link-style apply-all" data-class=".current_inventory">Apply to all</a>
			    								</div>
			    							</td>
			    							<td>
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][reorder_point]" class="form-control" value="0">
			    								<div class="text-right">
			    									<a href="javascript:void(0);" class="link-style apply-all" data-class=".reorder_point">Apply to all</a>
			    								</div>
			    							</td>
			    							<td>
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][reorder_amount]" class="form-control" value="0">
			    								<div class="text-right">
			    									<a href="javascript:void(0);" class="link-style apply-all" data-class=".reorder_amount">Apply to all</a>
			    								</div>
			    							</td>
			    						</tr>
		    						<?php else : ?>
		    							<tr class="customer-row" style="cursor: default;">
			    							<td><span><?php echo $outlet->outlet_name?></span></td>
			    							<td>
			    								<input type="number" name="current_inventory[<?php echo $outlet->outlet_id; ?>]" class="form-control current_inventory" value="0">
			    							</td>
			    							<td>
			    								<input type="number" name="reorder_point[<?php echo $outlet->outlet_id; ?>]" class="form-control reorder_point" value="0">
			    							</td>
			    							<td>
			    								<input type="number" name="reorder_amount[<?php echo $outlet->outlet_id; ?>]" class="form-control reorder_amount" value="0">
			    							</td>
			    						</tr>
		    						<?php endif; ?>
		    					<?php endforeach; ?>
		    				</tbody>
		    			</table>
		    			<div id="product_variant">
		    				<table class="customer-table" id="product_variant">
			    				<thead>
			    					<tr>
			    						<th width="50%">Attribute (e.g. Colour)</th>
			    						<th width="50%">Value (e.g. Red , Blue , Green)</th>
			    					</tr>
			    				</thead>
			    				<tbody>
			    					<tr class="customer-row" style="cursor: default;">
			    						<td>
			    							<select class="form-control">
			    								<option>Attribute 1</option>
			    								<option>Attribute 2</option>
			    								<option>Attribute 3</option>
			    							</select>
			    						</td>
			    						<td>
			    							<div class="input-group">
											  <input type="text" name="" class="form-control" placeholder="Separate by comma">
											  <span class="input-group-btn" id="basic-addon2" style="visibility: hidden;">
											  		<a href="javascript:void(0);" class="btn btn-link remove-attribute" style="margin: 0px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
											  </span>
											</div>
			    						</td>
			    					</tr>
			    				</tbody>
			    			</table>
			    			<a href="javascript:void(0);" class="link-style add-attribute">+ Add Attribute</a>
		    			</div>
	    			</section>
	    			<section class="composite_product">
	    				<div class="row">
		    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
		    					<h4>Stock keeping unit (SKU)</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
		    					<input type="text" name="sku" placeholder="Stock keeping unit (SKU)" class="form-control">
		    				</div>
		    			</div>
		    			<hr>
		    			<div class="row">
		    				<div class="col-xs-12 col-lg-6">
		    					<h4>Included Products<br>
		    						<small>Composite products contain specified quantities of one or more standard products.</small>
		    					</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6">
		    					<table class="table">
		    						<tr>
		    							<td>
		    								<label>Product : </label>
		    								<input type="text" name="" class="form-control">
		    							</td>
		    							<td>
		    								<label>Quantity : </label>
		    								<input type="number" name="" value="0" class="form-control">
		    							</td>
		    							<td>
		    			
		    								<a href="javascript:void(0);" class="btn btn-primary" style="margin-top: 24px;">Add</a>
		    							</td>
		    						</tr>
		    						<tr>
		    							<td colspan="3" class="text-center"><span class="help-block">Tip: Product quantities can be less than 1.</span></td>
		    						</tr>
		    					</table>
		    				</div>
		    			</div>
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