<script type="text/javascript">
    $(document).on("click" , "#add_count" , function(){
        var product_quantity = $(this).closest(".form-group").find('#product_quantity').val();
        var product_variant_id = $(this).closest(".row").find("#select_product").val();
        var selected_option = $(this).closest(".row").find("#select_product option:selected");
        var product_name = selected_option.text();
        var rate = parseFloat(selected_option.data("rate"));
        var stock = selected_option.data("stock");
        var order = selected_option.data("order");

        var table = $('#product_table tbody');
        var count = table.find("tr").length;
        count++;


        var total = product_quantity * rate;
        var tr = $("<tr>");

        tr.append($("<td>").text(count));
        tr.append($("<td>").text(product_name));
        tr.append($("<td>").text(stock));
        tr.append($("<td>").append("<input type='number' value='"+product_quantity+"' class='product_quantity'>"));
        tr.append($("<td>").append("<input type='number' value='"+rate+"' class='supply_price'>"));
        tr.append($("<td>").text(total));
        tr.append($("<td>").append($("<a>" , {href : "javascript:void(0);", class : "remove_order", text : "x"})));
        table.prepend(tr);
    });

    $(document).on("click" , ".remove_order" , function(){
        $(this).closest("tr").remove();
    });
</script>
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
    				<table width="100%;" >
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
	    									<?php foreach($product_list as $row) : ?>
                                                <option value="<?php echo $row->product_variant_id?>" data-order="<?php echo $row->order_quantity; ?>" data-stock="<?php echo $row->current_inventory; ?>" data-rate="<?php echo $row->supply_price; ?>"><?php echo $row->p_name; ?></option>
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
    				<table class="table" id="product_table">
    					<thead>
    						<tr>
    							<th width="10%">Order</th>
    							<th width="35%">Product</th>
    							<th width="15%">Stock on Hand</th>
    							<th width="10%">Quantity</th>
    							<th width="10%">Supply Price</th>
    							<th width="15%">Total (<?php echo $this->session->userdata("user")->currency_symbol; ?>)</th>
    							<th width="5%"></th>
    						</tr>
    					</thead>
                        <tfoot>
                            <tr>
                                <th colspan="5" class="text-right">TOTAL</th>
                                <th><?php echo $this->session->userdata("user")->currency_symbol; ?> <span><?php echo $result->total_cost; ?></span></th>
                                <th></th>
                            </tr>
                        </tfoot>
    					<tbody>
    	                   <?php foreach($result->product_list as $row) : ?>
                                <tr class="_<?php echo $row->product_variant_id; ?>">
                                    <td><?php echo $row->order_number; ?></td>
                                    <td><?php echo $row->product_name; ?></td>
                                    <td><?php echo $row->current_inventory; ?></td>
                                    <td><input type="number" name="" value="<?php echo $row->quantity; ?>"></td>
                                    <td><input type="number" name="" value="<?php echo $row->supply_price; ?>"></td>
                                    <td><?php echo $row->total_price; ?></td>
                                    <td><a href="javascript:void(0);" class="remove_order">x</a></td>
                                </tr>
                            <?php endforeach; ?>
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