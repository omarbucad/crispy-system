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
        	<h1>Stock Control</h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>A list of all of your consignments. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url('app/product/order-stock'); ?>" class="btn btn-info ">Order Stock</a>
                        <a href="<?php echo site_url('app/product/return-stock'); ?>" class="btn btn-info ">Return Stock</a>
                        <a href="<?php echo site_url('app/product/inventory-count'); ?>" class="btn btn-info ">Inventory Count</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card margin-bottom">
            <div class="container">
                <div class="card-body no-padding-left no-padding-right">
                    <form action="#" method="POST">
                        <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                        <input type="hidden" name="_advance_search_value" id="_advance_search_value" value="false">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_name">Name / Number / Product / Supplier Invoice</label>
                                    <input type="text" name="name" class="form-control" id="s_name" placeholder="Enter Name / Number / Product / Supplier Invoice">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_roles">Show</label>
                                    <select class="form-control" id="s_roles">
                                        
                                    </select>
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
                                    <label for="s_city">Date Created</label>
                                    <input type="text" name="date_created" placeholder="Date Created" class="form-control daterange">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Due Date</label>
                                    <input type="text" name="date_created" placeholder="Date Created" class="form-control daterange">
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
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Supplier</label>
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
        </div>
        <div class="container">
            <?php if($result) : ?>
                <table class="customer-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date</th>
                            <th>Delivery Due</th>
                            <th>Number</th>
                            <th>Outlet</th>
                            <th>Source</th>
                            <th>Status</th>
                            <th>Items</th>
                            <th>Total Cost</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row) : ?>
                            <tr class="customer-row">
                                <td>
                                    <a href="<?php echo $row->edit_link; ?>" class="link-style"><?php echo $row->reference_name; ?></a>
                                </td>
                                <td><a href="<?php echo $row->edit_link; ?>"><?php echo $row->order_type; ?></a></td>
                                <td><?php echo $row->created; ?></td>
                                <td><?php echo $row->due_date; ?></td>
                                <td><?php echo $row->order_number; ?></td>
                                <td><?php echo $row->deliver_to; ?></td>
                                <td><?php echo $row->order_from; ?></td>
                                <td><?php echo $row->status; ?></td>
                                <td><?php echo $row->items_count; ?></td>
                                <td><?php echo $row->total_cost; ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="text-center">
                    <img src="<?php echo site_url("public/img/packing.png"); ?>" class="img">
                    <p class="help-block">No results found. Try a different search or filter.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>