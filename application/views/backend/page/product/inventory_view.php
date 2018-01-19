<script type="text/javascript">
    $(document).on("click" , ".show-details" , function(){
        if($("#show-details").hasClass("hide")){
            $("#show-details").removeClass("hide");
        }else{
            $("#show-details").addClass("hide");
        }
    });

    $(document).on("click" , ".tab-parent .tab-link > a" , function(){
        $(".tab-parent .tab-link > a").removeClass("active");
        $(this).addClass("active");

        var tabId = $(this).data("tab");

        $(".tab-parent .tab-container > div").removeClass("active");
        $(".tab-parent .tab-container").find(tabId).addClass("active");

    });

    $(document).on("click" , ".abandon-inventory-count" , function(){
        var id = $(this).data("id");

        var modal = $("#abandon_modal").modal("show");

        modal.find(".btn-abandon").data("id" , id);
    });

    $(document).on("click" , ".btn-abandon" , function(){
        var id = $(this).data("id");
        var url = "<?php echo site_url('app/product/abandon_inventory_control/'); ?>";

        $.ajax({
            url : url ,
            data : {id : id},
            method : "POST" ,
            success : function(response){
                $('#abandon_modal').modal("hide");
                window.location.replace("<?php echo site_url("app/product/inventory-count"); ?>");
            }
        });

        
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <form>
            <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
            <input type="hidden" name="stock_control_id" value="<?php echo $inventory_information->stock_control_id;?>">
            <div class="container" >
                <a href="<?php echo site_url('app/product/inventory-count'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> <?php echo $inventory_information->count_name; ?> </h1><a href="javascript:void(0);" class="text-underline show-details"><small class="help-block-inline">Show Details</small></a>
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
                <div class="container">
                    <div class="row no-margin-bottom">
                        <div class="col-xs-12 col-lg-8 no-margin-bottom">
                            <span>View and export your count as a report.</span>
                        </div>
                        <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                            <a href="javascript:void(0);" data-id="<?php echo $inventory_information->stock_control_id; ?>" class="btn btn-primary btn-same-size">Generate PDF Report</a>
                            <a href="javascript:void(0);" data-id="<?php echo $inventory_information->stock_control_id; ?>" class="btn btn-primary btn-same-size">Generate CSV Report</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-parent">
                            <div class="tab-link">
                                <a href="javascript:void(0);" data-tab="#tab_uncounted">Uncounted (<?php echo count($inventory_information->products["uncounted"]); ?>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_unmatched">Unmatched (<?php echo count($inventory_information->products["unmatched"]); ?>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_matched">Matched (<?php echo count($inventory_information->products["matched"]); ?>)</a>
                                <a href="javascript:void(0);" class="active" data-tab="#tab_all">All (<?php echo count($inventory_information->products["all"]); ?>)</a>
                            </div>
                            <div class="tab-container">
                                <div id="tab_all" class="active">
                                    <table class="table inventory-count-table">
                                        <thead>
                                            <tr>
                                                <th class="text-center" width="50%"><small>COUNT LIST</small></th>
                                                <th class="text-center border-left"  width="25%" colspan="2"><small>INVENTORY COUNT</small></th>
                                                <th class="text-center border-left"  width="25%"colspan="2"><small>DIFFERENCES</small></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="checkbox">
                                                        <label>
                                                            Product
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="text-right border-left">Expected</td>
                                                <td class="text-right">Total</td>
                                                <td class="text-right border-left">Unit</td>
                                                <td class="text-right">Cost</td>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total</td>
                                                <td class="text-right">0</td>
                                                <td class="text-right">0</td>
                                            </tr>
                                        </tfoot>
                                        <tbody>

                                            <?php foreach($inventory_information->products["all"] as $row) : ?>
                                                <tr class="_<?php echo $row['product_variant_id']; ?>">
                                                    <td>
                                                        <div class="checkbox">
                                                            <label>
                                                              <?php echo $row["product_name"]; ?>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                    <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                    <td class="text-right border-left"><span><?php echo $row["unit"]; ?></span></td>
                                                    <td class="text-right"><span><?php echo custom_money_format($row["cost"]); ?></span></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div id="tab_uncounted">
                                    <?php if($inventory_information->products["uncounted"]) : ?>
                                        <p class="help-block">Nothing has been counted for the items in this list. <strong>These items' inventory will be reset to 0, unless you choose to exclude them.</strong></p>
                                        <table class="table inventory-count-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="50%"><small>COUNT LIST</small></th>
                                                    <th class="text-center border-left"  width="25%" colspan="2"><small>INVENTORY COUNT</small></th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox">
                                                            <label>
                                                                Product
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left">Expected</td>
                                                    <td class="text-right">Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach($inventory_information->products["uncounted"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>">
                                                        <td>
                                                           <div class="checkbox">
                                                                <label>
                                                                   <?php echo $row["product_name"]; ?>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    <?php else : ?>
                                        <p class="help-block text-center">You have no Uncounted items.</p>
                                    <?php endif; ?>
                                </div>
                                <div id="tab_unmatched">

                                    <?php if($inventory_information->products["unmatched"]) : ?>
                                        <p class="help-block">The amount you counted was more or less than expected. You might like to double-check items in this list</p>
                                        <table class="table inventory-count-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="50%"><small>COUNT LIST</small></th>
                                                    <th class="text-center border-left"  width="25%" colspan="2"><small>INVENTORY COUNT</small></th>
                                                    <th class="text-center border-left"  width="25%"colspan="2"><small>DIFFERENCES</small></th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox">
                                                            <label>
                                                                Product
                                                          </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left">Expected</td>
                                                    <td class="text-right">Total</td>
                                                    <td class="text-right border-left">Unit</td>
                                                    <td class="text-right">Cost</td>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td class="text-right">0</td>
                                                    <td class="text-right">0</td>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php foreach($inventory_information->products["unmatched"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>">
                                                        <td>
                                                           <div class="checkbox">
                                                                <label>
                                                                   <?php echo $row["product_name"]; ?>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                        <td class="text-right border-left"><span><?php echo $row["unit"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo custom_money_format($row["cost"]); ?></span></td> 
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    <?php else : ?>
                                        <p class="help-block text-center">You have no Unmatched items.</p>
                                    <?php endif; ?>            
                                </div>
                                <div id="tab_matched">
                                    <?php if($inventory_information->products["matched"]) : ?>
                                        <p class="help-block">Great work! The count for these matched perfectly.</p>
                                        <table class="table inventory-count-table">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" width="50%"><small>COUNT LIST</small></th>
                                                    <th class="text-center border-left"  width="25%" colspan="2"><small>INVENTORY COUNT</small></th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="checkbox">
                                                            <label>
                                                                Product
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left">Expected</td>
                                                    <td class="text-right">Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach($inventory_information->products["matched"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>">
                                                        <td>
                                                           <div class="checkbox">
                                                                <label>
                                                                   <?php echo $row["product_name"]; ?>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php else : ?>
                                        <p class="help-block text-center">You have no Matched items.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
