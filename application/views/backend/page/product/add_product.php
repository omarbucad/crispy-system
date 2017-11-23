<script type="text/javascript">
	var outlet_list_json = <?php echo $outlet_list_json; ?>;
	var default_sales_tax_list = <?php echo $default_sales_tax_list_json; ?>;
	var sku_generation = "<?php echo $store_settings->sku_generation_type; ?>";
</script>
<script type="text/javascript" src="<?php echo site_url('public/js/product.js?version='.$version) ?>"></script>
<script type="text/javascript">
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

</script>
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li class="active">New Product</li>
    	</ol>	
    	<h3>New Product</h3>
    	<form class="form-horizontal" action="<?php echo site_url("app/product/add"); ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
    		<input type="hidden" name="price_settings" value="<?php echo $store_settings->display_price_settings; ?>">
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
	    								<input type="text" name="product_name" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Product handle</dt>
	    						<dd>
	    							<div class="form-group">
	    								<input type="text" name="product_handle" class="form-control">
	    							</div>
	    						</dd>
	    						<dt>Description</dt>
	    						<dd>
	    							<div class="form-group">
	    								<textarea class="textarea" name="description"></textarea>
	    							</div>
	    						</dd>
	    						<dt>Product Tags</dt>
	    						<dd>
	    							<div class="form-group">
	    								<div class="input-group">
										  <select class="form-control select2" name="tags[]" id="select_tags" multiple="">
										  	<?php foreach($product_tag_list as $row) : ?>
										  		<option value="<?php echo $row->product_tag_id; ?>"><?php echo $row->tag_name; ?></option>
										  	<?php endforeach; ?>
										  </select>
										  <span class="input-group-btn">
										  	<button class="btn btn-link add-tag-btn" style="margin: 0px !important;" type="button">Add Tags</button>
										  </span>
										</div>
										<p class="help-block">Describe the product using relevant keywords for easy filtering.</p>
	    							</div>
	    						</dd>

	    						<dt>Product Type</dt>
	    						<dd>
	    							<div class="form-group">
	    								<select class="form-control" name="type">
	    									<option value=""></option>
	    									<?php foreach($product_type_list as $row) : ?>
	    										<option value="<?php echo $row->product_type_id; ?>"><?php echo $row->type_name; ?></option>
	    									<?php endforeach; ?>
	    								</select>
	    								<p class="help-block">Categorise your products with types that can be used to filter sales and inventory reports.</p>
	    							</div>
	    						</dd>
	    					</dl>
	    					<hr>
	    					<div class="row">
	    						<div class="col-xs-12 col-lg-6">
	    							<dl class="dl-horizontal text-left">

			    						<dt>Supplier</dt>
	    								<dd>
			    							<div class="form-group">
			    								<select class="form-control" name="supplier">
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
			    								<input type="text" name="supplier_code" class="form-control">
			    							</div>
			    						</dd>
			    						<dt>Product brand</dt>
	    								<dd>
			    							<div class="form-group">
			    								<select class="form-control" name="brand">
			    									<option value=""></option>
			    									<?php foreach($product_brand_list as $row) : ?>
			                                            <option value="<?php echo $row->product_brand_id; ?>"><?php echo $row->brand_name; ?></option>
			                                        <?php endforeach; ?>
			    								</select>
			    							</div>
			    						</dd>
	    							</dl>
	    						</div>
	    						<div class="col-xs-12 col-lg-6">
	    							<dl class="dl-horizontal text-left">
	    								
			    						<dt>Sales account code</dt>
	    								<dd>
			    							<div class="form-group">
			    								<input type="text" name="sales_account_code" class="form-control">
			    							</div>
			    						</dd>
			    						<dt>Purchase account code</dt>
	    								<dd>
			    							<div class="form-group">
			    								<input type="text" name="purchase_account_code" class="form-control">
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
	    							<input type="number" class="form-control supply-markup" name="markup_price" value="0.00" step="0.01">
	    						</td>
	    						<td>
	    							<input type="number" class="form-control retail_price_1" name="retail_price_wot"  value="0.00" step="0.01" readonly="">
	    							<span class="help-block">Excluding tax</span>
	    						</td>
	    						<?php if($store_settings->display_price_settings == "WT") : ?>
	    						<td>
	    							<div class="input-group">
								    	<select class="form-control compute-sales-tax-wt" data-default="<?php echo $store_settings->tax_rate; ?>" name="sales_tax">
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
	    							<input type="number" class="form-control retail_price_2" name="retail_price_wt" value="0.00" step="0.01" readonly="">
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
	    							<input type="hidden" name="outlet_tax[<?php echo $outlet->outlet_id?>][default_tax]" value="<?php echo $outlet->tax_rate; ?>">
	    							<input type="hidden" name="outlet_tax[<?php echo $outlet->outlet_id?>][default_tax_id]" value="<?php echo $outlet->sales_tax_id; ?>">
	    							<tr class="customer-row" style="cursor: default;">
		    							<td><span><?php echo $outlet->outlet_name?></span></td>
		    							<td>
		    								<div class="row">
		    									<div class="col-xs-6 col-lg-6 no-margin-bottom">
		    										<div class="form-group no-margin-bottom">
			    										<select class="form-control compute-sales-tax-wot" name="outlet_tax[<?php echo $outlet->outlet_id?>][sales_tax]" data-default="<?php echo $outlet->tax_rate; ?>">
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
		    							<td class="text-right">
		    								<input type="hidden" name="outlet_tax[<?php echo $outlet->outlet_id?>][retail_price]" class="retail_price">
		    								<strong><span class="retail_price">0.00</span></strong>
		    							</td>
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
	    				<div class="product_inventory_table">
			    			<div class="row">
			    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
			    					<h4>Stock keeping unit (SKU)</h4>
			    				</div>
			    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
			    					<input type="text" name="sku" placeholder="Stock keeping unit (SKU)" class="form-control">
			    				</div>
			    			</div>
			   				<hr>
		    			</div>

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
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][current_inventory]" class="form-control current_inventory" value="0">
			    							</td>
			    							<td>
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][reorder_point]" class="form-control reorder_point" value="0">
			    							</td>
			    							<td>
			    								<input type="number" name="inventory[<?php echo $outlet->outlet_id; ?>][reorder_amount]" class="form-control reorder_amount" value="0">
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
			    							<select class="form-control select-attribute" name="attribute[product_attribute][]">
			    								<option value="">Please select an option</option>
			    								<option value="ADD_ATTRIBUTE">+ Add Variant Attribute</option>
			    								<?php foreach($attribute_list as $row) : ?>
			    									<option value="<?php echo $row->attribute_name; ?>"><?php echo $row->attribute_name; ?></option>
			    								<?php endforeach; ?>
			    							</select>
			    						</td>
			    						<td>
			    							<div class="input-group">
											  <input type="text" name="attribute[product_attribute_value][]" class="form-control tags-input" placeholder="Separate by comma" data-width="100%">
											  <span class="input-group-btn" id="basic-addon2" style="visibility: hidden;">
											  		<a href="javascript:void(0);" class="btn btn-link remove-attribute" style="margin: 0px;"><i class="fa fa-trash" aria-hidden="true"></i></a>
											  </span>
											</div>
			    						</td>
			    					</tr>
			    				</tbody>
			    			</table>
			    			<a href="javascript:void(0);" class="link-style add-attribute">+ Add Attribute</a>

			    			<section id="product_variant_section" class="hidden" style="margin-top: 20px;">
			    				<table class="customer-table" id="variant_table">
			    					<thead>
			    						<tr>
			    							
			    							<?php if($store_settings->sku_generation_type == "GENERATE_BY_NAME") : ?>
			    								<th width="30%">Variant Name</th>
			    								<th width="15%">SKU</th>
			    							<?php else : ?>
			    								<th width="45%">Variant Name</th>
			    							<?php endif; ?>
			    							
			    							<th width="15%">Supplier Code</th>
			    							<th width="15%">Supply Price</th>
			    							<th width="15%">Retail Price <br> <small>Excluding Tax</small></th>
			    							<th width="10%">Enabled</th>
			    						</tr>
			    					</thead>
			    					<tbody>
			    						
			    					</tbody>
			    				</table>
			    			</section>
		    			</div>


	    			</section>
	    			<section class="composite_product">
	    				<div class="row">
		    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
		    					<h4>Stock keeping unit (SKU)</h4>
		    				</div>
		    				<div class="col-xs-12 col-lg-6 no-margin-bottom">
		    					<input type="text" name="composite_sku" placeholder="Stock keeping unit (SKU)" class="form-control">
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
		    								<input type="text" name="composite[product_id][]" class="form-control">
		    							</td>
		    							<td>
		    								<label>Quantity : </label>
		    								<input type="number" name="composite[quantity][]" value="0" class="form-control">
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


<div class="modal fade" id="add_attribute_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Variant Attribute</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/product/add_attribute"); ?>"  method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="attribute_name">Name</label>
                        <input type="text" name="attribute_name" class="form-control" id="attribute_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form-ajax" >Add Attribute</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="add_tags_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Product Tags</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/product/add_tag"); ?>"  method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <input type="hidden" name="ajax" value="true">
                    <div class="form-group">
                        <label for="tag_name">Name</label>
                        <input type="text" name="tag_name" class="form-control" id="tag_name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form-ajax-tags" >Add Tag</button>
            </div>
        </div>
    </div>
</div>