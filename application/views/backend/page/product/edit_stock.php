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
        var count = table.find("tr:first-child > td:first-child > span").text();
        count++;
   
        var total = product_quantity * rate;
        var tr = $("<tr>" , {class : "_"+product_variant_id});

        if(product_quantity < 1){
            $.notify("Product Quantity Must be greater than 0" , { className:  "error" , position : "top center"});
        }else if(!product_variant_id){
            $.notify("Please Select a Product" , { className:  "error" , position : "top center"});
        }else{

            tr.append($("<td>").append($("<span>" , {text : count})).append("<input type='hidden' value='"+count+"' name='product_variant[order_number][]'>").append("<input type='hidden' value='"+product_variant_id+"' name='product_variant[product_variant_id][]'>"));
            tr.append($("<td>").text(product_name));
            tr.append($("<td>").append($("<span>" , {text : stock})).append('<input type="hidden" name="product_variant[current_stock][]" value="'+stock+'">'));
            tr.append($("<td>").append("<input type='number' value='"+product_quantity+"' class='compute_quantity' name='product_variant[quantity][]'>"));
            tr.append($("<td>").append("<input type='number' value='"+rate+"' class='compute_supply_price' name='product_variant[supply_price][]'>"));
            tr.append($("<td>").append($("<span>" , {text : total , class : "total_price_span"})).append('<input type="hidden" name="product_variant[total_price][]" class="compute_total_price" value="'+total+'">'));
            tr.append($("<td>").append($("<a>" , {href : "javascript:void(0);", class : "remove_order", text : "x"})));

            if(!table.find("._"+product_variant_id).length){
                table.prepend(tr);

                compute();
            }else{
                var a = table.find("._"+product_variant_id);

                $('html,body').animate({ scrollTop: a.offset().top },'slow');

                a.addClass("active");

                setTimeout(function(){
                    a.removeClass("active");
                } , 2000);
            }
        }
    });



    $(document).on("click" , ".remove_order" , function(){
        $(this).closest("tr").remove();

        compute();
    });

    $(document).on("change" , ".compute_quantity , .compute_supply_price" , function(){
        compute();
    });

    $(document).on("click" , ".save" , function(){
        var send = $(this).data("send");
        var data = $("#product_variant_form").serialize();
        var url = $("#product_variant_form").attr("action");

        $(".save").prop("disabled" , true);

        $.ajax({
            url : url ,
            method : "POST" ,
            data : data , 
            success : function(response){
                var json = jQuery.parseJSON(response);

                if(json){
                    if(send){
                        $("#send_order_modal").modal("show");

                    }else{
                        $.notify(json.message+"\n You will be redirected in 3 seconds" , { className:  "success" , position : "top center"});

                        setTimeout(function(){
                            window.location.replace("<?php echo site_url("app/product/consignment/$result->inventory_order_id"); ?>");
                        } , 3000);
                    }
                }else{
                    $.notify("Please Try Again" , { className:  "error" , position : "top center"});
                    $(".save").prop("disabled" , false);
                }

            } 
        });
    });

    $(document).on("click" , '.submit-form-ajax' , function(){
        var $me = $(this);
        var form = $me.closest(".modal").find("form");
        var action = form.attr("action");

        $.ajax({
            url : action ,
            method : "POST" ,
            data : form.serialize(),
            success : function(response){
                var json = jQuery.parseJSON(response);

                if(json.status){
                    $.notify(json.message+"\n You will be redirected in 3 seconds" , { className:  "success" , position : "top center"});

                    setTimeout(function(){
                        window.location.replace("<?php echo site_url("app/product/consignment"); ?>");
                    } , 3000);
                }
            }
        });
    });

    $(document).ready(function(){
        compute();
    });
    function compute(){
        var table = $("#product_table > tbody > tr");
        var total_cost = 0;

        $.each(table , function(k , v){
            var quantity = $(v).find(".compute_quantity");
            var supply_price = $(v).find(".compute_supply_price");
            var total_price = $(v).find(".compute_total_price");
            var total_price_span = $(v).find(".total_price_span");


            total = quantity.val() * supply_price.val();

            total_price.val(parseFloat(total).toFixed(2));
            total_price_span.text(parseFloat(total).toFixed(2));

            total_cost += total;
        });


        $(".total_cost_span").text(parseFloat(total_cost).toFixed(2));
    }

</script>
<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
    		<li><a href="<?php echo site_url('app/product/consignment'); ?>">Stock Control</a></li>
    		<li class="active">Edit Purchase Order</li>
    	</ol>	
    	<h3>Edit Purchase Order</h3>
    	<form class="form-horizontal" id="product_variant_form" action="<?php echo $result->edit_link; ?>" method="POST">
    		<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
            <input type="hidden" name="inventory_order_id" value="<?php echo $result->inventory_order_id?>">

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
    			<a href="<?php echo site_url("app/product/edit-consignment/$result->inventory_order_id "); ?>" class="btn btn-default">Edit Order Details</a>
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
                                <th><?php echo $this->session->userdata("user")->currency_symbol; ?> <span class="total_cost_span"><?php echo $result->total_cost; ?></span></th>
                                <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                        <?php foreach($result->product_list as $row) : ?>
                            <tr class="_<?php echo $row->product_variant_id; ?>">
                                <td>
                                    <span><?php echo $row->order_number; ?></span>
                                    <input type="hidden" name="product_variant[product_variant_id][]" value="<?php echo $row->product_variant_id; ?>">
                                    <input type="hidden" name="product_variant[order_number][]" value="<?php echo $row->order_number; ?>">
                                </td>
                                <td><?php echo $row->product_name; ?></td>
                                <td>
                                    <span><?php echo $row->current_inventory; ?></span>
                                    <input type="hidden" name="product_variant[current_stock][]" value="<?php echo $row->current_inventory; ?>">
                                </td>
                                <td><input type="number" name="product_variant[quantity][]" class="compute_quantity" value="<?php echo $row->quantity; ?>"></td>
                                <td><input type="number" name="product_variant[supply_price][]" class="compute_supply_price" value="<?php echo $row->supply_price; ?>"></td>
                                <td>
                                    <span class="total_price_span"><?php echo $row->total_price; ?></span>
                                    <input type="hidden" name="product_variant[total_price][]" class="compute_total_price" value="<?php echo $row->total_price; ?>">
                                </td>
                                <td><a href="javascript:void(0);" class="remove_order">x</a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>        
    			</div>
    		</div>

	    	<div class="text-right margin-bottom">
                <a href="<?php echo site_url("app/product/"); ?>" class="btn btn-default">Cancel</a>
                <button type="button" class="btn btn-success save" data-send="false">Save</button>
	    		<button type="button" class="btn btn-success save" data-send="true">Save and Send</button>
	    	</div>
    	</form>
    </div>
</div>


<div class="modal fade" id="send_order_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Send Order</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/product/send_message"); ?>"  method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <input type="hidden" name="inventory_order_id" value="<?php echo $result->inventory_order_id; ?>">
                    <dl class="dl-horizontal text-left">
                        <dt>Recipient name</dt>
                        <dd>
                            <div class="form-group">
                                <input type="text" name="recipient_name" class="form-control">
                            </div>
                        </dd>
                        <dt>Email</dt>
                        <dd>
                            <div class="form-group">
                                <input type="email" name="email"  class="form-control">
                            </div>
                        </dd>
                        <dt>CC</dt>
                        <dd>
                            <div class="form-group">
                                <input type="email" name="cc"  class="form-control">
                            </div>
                        </dd>
                        <dt>Subject</dt>
                        <dd>
                            <div class="form-group">
                                <input type="text" name="subject"  class="form-control">
                            </div>
                        </dd>
                        <dt>Message</dt>
                        <dd>
                            <div class="form-group">
                                <textarea class="form-control"  name="message" rows="5" cols="10" style="max-width: 100%;max-height: 250px;min-height: 100px;min-width: 100%;"></textarea>
                            </div>
                        </dd>
                    </dl>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form-ajax" >Send Order</button>
            </div>
        </div>
    </div>
</div>