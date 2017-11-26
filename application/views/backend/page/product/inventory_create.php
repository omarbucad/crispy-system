<script type="text/javascript">
	$(document).on("click" , '.product_container .count_type' , function(){
		var type = $(this).data("type");

		$('#count_type').val(type);
		$(".product_container .count_type").removeClass("active");
		$(this).addClass("active");

		if(type == "partial"){
			$('#product_search_container').removeClass("hidden");
			$("#product_count").html("0");
		}else{
			$('#product_search_container').addClass("hidden");
			$("#product_count").html("All");
		}
	});

	$(document).ready(function(){
		$(".include_inactive").bootstrapSwitch({
			size: "mini" ,
			onSwitchChange : function(event , state){
				if(state){
					$("#product_inactive").html("including");
				}else{
					$("#product_inactive").html("excluding");
				}
			}
		});
		
		autocomplete_field();

	});

	function autocomplete_field(){
		var start_time = moment().add(30, 'minutes').format("h:mm a");
		$("#start_time").val(start_time);
		var start_date = $("#start_date").val();
		var outlet_name = $('#outlet option:selected').text();
		$("#count_name").val(outlet_name+" - "+start_date+" "+start_time);
	}
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container" >
        	<a href="<?php echo site_url('app/product/inventory-count'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> Add Inventory Count</h1>
        </div>
        <div class="grey-bg ">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Schedule a full or partial inventory count to maintain accurate inventory levels. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-info btn-same-size" >Save & Exit</a>
                        <a href="javascript:void(0);" class="btn btn-success btn-same-size" >Start Count</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container ">
            <form action="<?php echo site_url("app/setup/users/add");?>" method="post" enctype="multipart/form-data" id="form_users">
                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                <section class="sec_border_bottom">
                    <h3>General</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>Start an inventory count now or schedule one for the future.</p>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="text" name="start_date" id="start_date" class="form-control datepicker">
                            </div>
                            <div class="form-group">
                                <label for="outlet">Outlet</label>
                                <select class="form-control" name="outlet" id="outlet">
                                	<?php foreach($outlet_list as $outlet) : ?>
                                		<option value="<?php echo $outlet->outlet_id; ?>"><?php echo $outlet->outlet_name; ?></option>
                                	<?php endforeach; ?>
                                </select>
                            </div>
                            
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="text" name="start_time" id="start_time" class="form-control ">
                            </div>
                            <div class="form-group">
                                <label for="count_name">Count Name</label>
                                <input type="text" name="count_name" id="count_name" class="form-control" >
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sec_border_bottom">
                	<input type="hidden" id="count_type" name="count_type" value="partial">
                    <h3>Choose Products to Count</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>You can include inactive products, which are not available for sale but may still be in stock.</p>
                        </div>
                        <div class="col-xs-12 col-lg-8">
                            <div class="row">

                            	<div class="container-fluid margin-bottom">
                            		<div class="product_container">
		                            	<div class="count_type active" data-type="partial">
		                            		<h3 class="text-center">Partial Count</h3>
		                            		<div class="row">
		                            			<div class="col-xs-12 text-center">
		                            				<p class="help-block">Specify the products to include in this inventory count.</p>
		                            			</div>
		                            		</div>
		                            	</div>
		                            	<div class="count_type" data-type="full">
		                            		<h3 class="text-center">Full Count</h3>
		                            		<div class="row">
		                            			<div class="col-xs-12 text-center">
		                            				<p class="help-block">Include all the products in this inventory count.</p>
		                            			</div>
		                            		</div>
		                            	</div>
		                            </div>
                            	</div>
                            	<div class="container-fluid margin-bottom">
                            		<h4 class="margin-bottom"><span id="product_count">All</span> products will be counted, <span id="product_inactive">including</span> inactive products.</h4>
                            		<div>
                            			<input type="checkbox" class="include_inactive" name="include_inactive" checked>
                            			<span class="help-block-inline">Include inactive products</span>
                            		</div>
                            		
                            	</div>

                            	<div id="product_search_container" class="container-fluid">
                            		<label>Filter Products</label>
                            		<div class="input-group">
                            			<select class="form-control select2" name="product">
                                            <?php foreach($product_list as $product) : ?>
                                                <option value="<?php echo $product->product_variant_id; ?>"><?php echo $product->p_name; ?></option>
                                            <?php endforeach ; ?>
                            			</select>
                            			<span class="input-group-btn">
                            				<button class="btn btn-link" style="margin: 0px !important;" type="button">Add Product</button>
                            			</span>
                            		</div>

                            		<br>

                            		<div class="product-list">
                            			<div class="text-center">
                            				<img src="<?php echo site_url("public/img/packing.png"); ?>" class="img" width="100px;">
                							<p class="help-block">Use filters to include products in this count.</p>
                            			</div>
                            		</div>
                            	</div>

                            </div>
                        </div>
                    </div>
                    <div class="text-right margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-success btn-same-size submit-form" data-form="#form_users">Save</a>
                    </div>
                </section> 
            </form>
        </div>
    </div>
</div>