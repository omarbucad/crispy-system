<script type="text/javascript">

    $(document).on('click' , '.more-filter' , function(){
        var val = $(this).data('value');

        if(val == "hidden"){
            $(this).data("value" , "show");
            $('#view_advance_search').removeClass("hide");
            $(this).text("Less Filter");
            $('#_advance_search_value').val("true");
        }else{
            $(this).data("value" , "hidden");
            $('#view_advance_search').addClass("hide");
            $(this).text("More Filter");
            $('#_advance_search_value').val("false");
        }
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
        	<h1><?php echo $product_information->product_name; ?></h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-success ">Edit Product</a>
                        <a href="javascript:void(0);" class="btn btn-success ">Add Variant</a>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        
                        <a href="javascript:void(0);" class="btn btn-danger ">Delete Product</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row" style="margin-top: 20px;">
                <div class="col-xs-12 col-lg-9">
                    <div class="help-block"><?php echo $product_information->description; ?></div>
                    <?php echo $product_information->tags; ?>
                    <hr>
                    <table style="width: 100%;">
                        <tr>
                            <td><strong>Type</strong></td>
                            <td class="text-left"><?php echo $product_information->type_name; ?></td>
                            <td><strong>Average Cost</strong></td>
                            <td class="text-left"><?php echo $product_information->retail_price_wot; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Handle</strong></td>
                            <td class="text-left"><?php echo $product_information->product_handle; ?></td>
                            <td><strong>Supply Price</strong></td>
                            <td class="text-left"><?php echo $product_information->supply_price; ?></td>
                        </tr>
                        <tr>
                            <td><strong>Supplier</strong></td>
                            <td class="text-left"><?php echo $product_information->supplier_name; ?></td>
                            <td><strong>Brand</strong></td>
                            <td class="text-left"><?php echo $product_information->brand_name; ?></td>
                        </tr>
                        <tr>
                            <td><strong>SKU</strong></td>
                            <td class="text-left"><?php echo $product_information->sku; ?></td>
                        </tr>
                    </table>

                    <hr>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Outlet</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($product_information->outlet as $outlet) : ?>
                                <tr>
                                    <td><?php echo $outlet['outlet_name']; ?></td>
                                    <td><?php echo $outlet['stock']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-xs-12 col-lg-3">
                    <img src="https://www.lowrance.com/assets/img/default-product-img.png" class="img img-responsive thumbnail">
                </div>
            </div>
            <div class="row">
                <div class="card-body container-fluid">
                    <h4>Product History</h4>
                    <form action="#" method="POST">
                        <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                        <input type="hidden" name="_advance_search_value" id="_advance_search_value" value="false">
                        <div class="row">
                            <div class="col-xs-12 col-lg-9 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_city">Date Period</label>
                                    <input type="text" name="date_created" placeholder="Date Created" class="form-control daterange">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 text-right no-margin-bottom">
                                <button type="button" class="btn btn-link btn-vertical-center btn-same-size more-filter" data-value="hidden">More filter</button>
                                <input type="submit" name="submit" value="Apply Filter" class="btn btn-primary btn-vertical-center btn-same-size">
                            </div>
                        </div>
                        <div class="row hide" id="view_advance_search">
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Action Type</label>
                                    <select class="form-control" name="action_type">

                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">User</label>
                                    <select class="form-control" name="user">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Outlet</label>
                                    <select class="form-control" name="outlet">
                                        <option value="">-</option>
                                        <?php foreach($outlet_list as $outlet) : ?>
                                            <option value="<?php echo $outlet->outlet_id; ?>"><?php echo $outlet->outlet_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="container-fluid">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Outlet</th>
                                <th>Quantity</th>
                                <th>Outlet Quantity</th>
                                <th>Change</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="help-block">No product history recorded.</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>