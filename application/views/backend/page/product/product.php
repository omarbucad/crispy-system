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

    $(document).on('click' , '.view-variant' , function(){
        $me = $(this);
        var className = $(this).data("id");

        if($me.closest("tr").hasClass("active")){
            $me.closest("tr").removeClass("active");
            $("."+className).removeClass("open").addClass("hidden");
            $me.find("i").removeClass("fa-caret-up").addClass("fa-caret-down");
        }else{
            $me.closest("tr").addClass("active");
            $("."+className).removeClass("hidden").addClass("open");
             $me.find("i").removeClass("fa-caret-down").addClass("fa-caret-up");
        }
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
        	<h1>Products</h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Add, view and edit your products all in one place.  <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url('app/product/import'); ?>" class="btn btn-info ">Import</a>
                        <a href="<?php echo site_url('app/product/add'); ?>" class="btn btn-success ">Add Product</a>
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
                                    <label for="s_name">Search products by name, SKU, handle, or supplier code</label>
                                    <input type="text" name="name" class="form-control" id="s_name" placeholder="Enter name , SKU , handle or supplier code">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_product_type">Product type</label>
                                    <select class="form-control" name="product_type" id="s_product_type">
                                        <option value="ALL_TYPE">All Type</option>
                                        <?php foreach($product_type_list as $row) : ?>
                                            <option value="<?php echo $row->product_type_id; ?>"><?php echo $row->type_name; ?></option>
                                        <?php endforeach; ?>
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
                                    <label for="s_brand">Brand</label>
                                     <select class="form-control" name="brands" id="s_brand">
                                        <option value="ALL_BRAND">All Brand</option>
                                        <?php foreach($product_brand_list as $row) : ?>
                                            <option value="<?php echo $row->product_brand_id; ?>"><?php echo $row->brand_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_supplier">Supplier</label>
                                    <select class="form-control" name="supplier" id="s_supplier">
                                        <option value="ALL_SUPPLIER">All Supplier</option>
                                        <?php foreach($supplier_list as $row) : ?>
                                            <option value="<?php echo $row->supplier_id; ?>"><?php echo $row->supplier_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_tags">Tags</label>
                                     <select class="form-control" name="tags" id="s_tags">
                                        <option value="ALL_TAGS">All Tags</option>
                                        <?php foreach($product_tag_list as $row) : ?>
                                            <option value="<?php echo $row->product_tag_id; ?>"><?php echo $row->tag_name; ?></option>
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
            <div class="customer-table-showing">
                <span class="pull-left">
                    <a href="#" class="btn btn-link">Active (1)</a>
                    <a href="#" class="btn btn-link">Inactive (0)</a>
                    <a href="#" class="btn btn-link">All (1)</a>
                </span>
                <a href="#" class="btn btn-primary pull-right"><i class="fa fa-cloud-download" aria-hidden="true"></i> Export List</a>
            </div>
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="20%">
                            <a href="#">Product <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
                        </th>
                        <th width="10%">Created</th>
                        <th width="10%">Tags</th>
                        <th width="10%">Brand</th>
                        <th width="15%">Supplier</th>
                        <th width="10%">Variants</th>
                        <th width="10%">Price</th>
                        <th width="5%">Count</th>
                        <th width="10%" colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="customer-row" style="cursor: default;">
                        <td>
                            <div class="with-img">
                                <span><a href="#">My Girl Sunglasses </a> <br><small>10001</small></span>
                                <img src="http://192.168.1.147/crispy-system/thumbs/users/2017/11/80/80/14947775_1805564653049469_4850385028197505507_n.jpg" class="img img-responsive">
                            </div>
                        </td>
                        <td>
                            <span>04 Nov 2017</span>
                        </td>
                        <td>
                            <a href="#" class="link-style"><span>watch</span></a>
                        </td>
                        <td>
                            <a href="#" class="link-style"><span>Cluse</span></a>
                        </td>
                        <td>
                            <a href="#" class="link-style"><span>Flo & Frankie</span></a>
                        </td>
                        <td>
                            <a href="#" class="link-style view-variant" data-id="_1000"><span>3 Variants <i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
                        </td>
                        <td>
                           <span>198.80</span>
                        </td>
                        <td>
                            <span>15</span>
                        </td>
                        <td>
                            <a href="<?php echo site_url("app/product/edit/"); ?>" class="btn btn-link" title="Edit Product"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
                        </td>
                    </tr>
                    <tr class="customer-info hidden _1000 product-variant">
                        <td colspan="6">
                            <a href="#"><span>LaBoheme Mesh Strap Watch / Rose Gold</span></a>
                        </td>
                        <td><span>198.90</span></td>
                        <td><span>5</span></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="customer-info hidden _1000 product-variant">
                        <td colspan="6">
                            <a href="#"><span>LaBoheme Mesh Strap Watch / Rose Gold</span></a>
                        </td>
                        <td><span>198.90</span></td>
                        <td><span>5</span></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="customer-info hidden _1000 product-variant">
                        <td colspan="6">
                            <a href="#"><span>LaBoheme Mesh Strap Watch / Rose Gold</span></a>
                        </td>
                        <td><span>198.90</span></td>
                        <td><span>5</span></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr class="customer-row" style="cursor: default;">
                        <td>
                            <div class="with-img">
                                <span><a href="#">My Girl Sunglasses</a> <br><small>10003</small></span>
                                <img src="http://192.168.1.147/crispy-system/thumbs/users/2017/11/80/80/14947775_1805564653049469_4850385028197505507_n.jpg" class="img img-responsive">
                            </div>
                        </td>
                        <td>
                            <span>04 Nov 2017</span>
                        </td>
                        <td>
                            <span>-</span>
                        </td>
                        <td>
                            <span>-</span>
                        </td>
                        <td>
                            <span>-</span>
                        </td>
                        <td>
                            <a href="#" class="link-style view-variant" data-id="_1001"><span>1 Variants <i class="fa fa-caret-down" aria-hidden="true"></i></span></a>
                        </td>
                        <td>
                           <span>198.80</span>
                        </td>
                        <td>
                            <span>15</span>
                        </td>
                        <td>
                            <a href="<?php echo site_url("app/product/edit/"); ?>" class="btn btn-link" title="Edit Product"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                        </td>
                        <td>
                            <input type="checkbox" class="toggle-checkbox" name="my-checkbox" checked>
                        </td>
                    </tr>
                    <tr class="customer-info hidden _1001 product-variant">
                        <td colspan="6">
                            <a href="#"><span>LaBoheme Mesh Strap Watch / Rose Gold</span></a>
                        </td>
                        <td><span>198.90</span></td>
                        <td><span>5</span></td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
            <div class="customer-table-showing margin-bottom">
                <div class="pull-right">
                    <nav aria-label="Page navigation">
                      <?php echo @$links; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>