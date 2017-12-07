<script type="text/javascript">
    $(document).on("click" , ".show-details" , function(){
        if($("#show-details").hasClass("hide")){
            $("#show-details").removeClass("hide");
        }else{
            $("#show-details").addClass("hide");
        }
    });
    $(document).on("click" , ".select-product" , function(){
        var variant_id = $(this).data("id");

        $("#select_product").val(variant_id).trigger("change");
        $('#product_quantity').focus();
    });

    $(document).on("click" , "#add_count" , function(){
        var product_variant_id = $('#select_product').val();
        var product_quantity = parseInt($('#product_quantity').val());
        var product_name = $('#_'+product_variant_id).data("name");

        if(!product_variant_id){
            alert("Please Select a product");
        }else if(product_quantity <= 0){
            alert("Product Quantity must be greater than 0");
        }else{
            var li = $("<li>" , { text : product_quantity+" "+product_name , class : "list-li _li_"+product_variant_id} );
            var a = $("<a>" , { href : "javascript:void(0);" , class : "pull-right remove-li" , style : "padding-left : 20px;" , "data-count" : product_quantity , "data-id" : product_variant_id});
            a.html('<i class="fa fa-trash" aria-hidden="true"></i>');
            li.append(a);

            $(".product-count-li").find(".li-head").after(li);
            var counted = parseInt($('#_'+product_variant_id).find(".counted").text());

            counted = counted + product_quantity;

            $('#_'+product_variant_id).find(".counted").html(counted);
            $('#_'+product_variant_id).removeClass("uncounted").addClass("counted");
            $(".no-li-data").addClass("hide");
        }
     
    });

    $(document).on("click" , ".remove-li" , function(){
        var product_variant_id = $(this).data("id");
        var product_count = parseInt($(this).data("count"));

        var counted = parseInt($('#_'+product_variant_id).find(".counted").text());
        counted = counted - product_count;

        $('#_'+product_variant_id).find(".counted").html(counted);

        $(this).closest("li").remove();

        var c = $(".product-count-li").find(".list-li").length;

        if( !$("_li_"+product_variant_id).length ){
            $('#_'+product_variant_id).removeClass("counted").addClass("uncounted");
        }

        if(c == 0){
            $(".no-li-data").removeClass("hide");
        }
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="row" id="inventory_count_page">
            <div class="col-xs-12 col-lg-9 col-md-8 col-sm-7">
                <div class="container-fluid" >
                    <a href="<?php echo site_url('app/setup/users'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> <?php echo $inventory_information->count_name; ?> </h1><a href="javascript:void(0);" class="text-underline show-details"><small class="help-block-inline">Show Details</small></a>
                    <div class="row hide" style="margin:10px 0px;" id="show-details">
                        <table>
                            <tr>
                                <td style="padding-right: 50px;"><i class="fa fa-calendar" aria-hidden="true"></i> Start: <?php echo $inventory_information->schedule_time;?></td>
                                <td><i class="fa fa-home" aria-hidden="true"></i> <?php echo $inventory_information->outlet_name;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="grey-bg ">
                    <div class="container-fluid">
                        <div class="row no-margin-bottom">
                            <div class="col-xs-12 col-lg-8 no-margin-bottom">
                                <span>Count your inventory in this outlet to ensure your inventory is correct. <a href="#" class="text-underline">need help?</a></span>
                            </div>
                            <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                                <a href="javascript:void(0);" class="btn btn-success btn-same-size">Pause</a>
                                <a href="javascript:void(0);" class="btn btn-success btn-same-size">Review</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card margin-bottom">
                    <div class="container-fluid">
                        <div class="card-body no-padding-left no-padding-right">
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
                                    <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                        <div class="form-group">
                                            <label for="s_product_type">Quantity</label>
                                            <div class="input-group">
                                              <input type="number" class="form-control" value="0" id="product_quantity">
                                              <span class="input-group-btn">
                                                <a href="javascript:void(0);" class="btn btn-success" id="add_count" style="margin: 0px !important;">Count</a>
                                              </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="customer-table-showing">
                        <span class="pull-left">
                            <a href="javascript:void(0);" class="btn btn-link">All (0)</a>
                            <a href="javascript:void(0);" class="btn btn-link">Counted (0)</a>
                            <a href="javascript:void(0);" class="btn btn-link">Uncounted (0)</a>
                        </span>
                    </div>
                    <table class="customer-table">
                        <thead>
                            <tr>
                                <th width="10%"></th>
                                <th width="50%">
                                    Product
                                </th>
                                <th width="20%">Expected</th>
                                <th width="20%">Counted</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($inventory_information->products as $key => $row): ?>
                                <tr class="customer-row select-product <?php echo $row->status; ?>" id="_<?php echo $row->product_variant_id; ?>" style="cursor: pointer;" data-id="<?php echo $row->product_variant_id; ?>" data-name="<?php echo $row->product_name.' '.$row->variant_name; ?>">
                                    <td></td>
                                    <td><?php echo $row->product_name.' '.$row->variant_name; ?></td>
                                    <td><?php echo $row->expected; ?></td>
                                    <td class="counted"><?php echo $row->counted; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-12 col-lg-3 col-md-4 col-sm-5">
                <nav class="product-count-li">
                    <ul>
                        <li class="li-head"><strong>Your last counted items</strong></li>
                        <li class="no-li-data  text-center">
                            <img src="<?php echo site_url("public/img/packing.png"); ?>" class="img" width="100px;">
                            <p class="help-block">Items that you count will appear here one-by-one <br>to help you keep track.</p>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>