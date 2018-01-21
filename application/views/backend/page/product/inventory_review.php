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
                $.notify("Successfully Abandon the Stock Count" , { className:  "success" , position : "top center"});
                setTimeout(function(){
                    window.location.replace("<?php echo site_url("app/product/inventory-count"); ?>");
                },2000);
            }
        });

    });

    $(document).on("click" , ".check_me" , function(){
        var table = $(this).closest("table");
        var isInclude = $(this).hasClass("include");

        refresh_table(table , isInclude);
    });
    $(document).on("click" , ".check_all" , function(){
        var table = $(this).closest("table");
        var check_all = table.find(".check_all");
        var check_all_span = table.find(".check_all_span");
        var tr = table.find("tbody > tr:not(.excluded)").find(".check_me:checked");
        var tr_all = table.find("tbody > tr:not(.excluded)").find(".check_me");
        var isExclude = $(this).hasClass("check_all_exclude");

        if(isExclude){
            var str = "Include";
        }else{
            var str = "Exclude";
        }

        if($(this).is(":checked")){
            tr_all.prop("checked" , true);
            check_all_span.addClass("active").html(tr_all.length+' selected ( all ) <br><small><a href="javascript:void(0);" class="btn btn-success btn-xs btn-exclude">'+str+' Items from count</a></small>');
        }else{
            tr_all.prop("checked" , false);
            check_all_span.removeClass("active").html('Product');
        }
    });
    $(document).on("click" , ".btn-exclude" , function(){
        var table = $(this).closest("table");
        var tr = table.find("tbody > tr").find(".check_me:checked");
        var div_id = table.parent().parent().attr("id");

        $.each(tr , function(k , v){

            var className = "._"+$(v).closest("tr").data("id");

            if(div_id == "tab_exclude"){

               table.find(className).remove();
                $(className).removeClass("hide excluded");

                var tr = table.find("tbody > tr").find(".check_me:checked");

                if(tr.length == 0){
                    $('#tab_exclude').find(".with_result").addClass("hide");
                    $('#tab_exclude').find(".without_result").removeClass("hide");
                }

            }else{
                $(className).addClass("hide excluded");

                $('#tab_exclude').find(".with_result").removeClass("hide");
                $('#tab_exclude').find(".without_result").addClass("hide");

                var tbody =  $('#tab_exclude').find(".with_result").find("table > tbody");
                var clone = $(v).closest("tr").clone();
                clone.removeClass("hide excluded");

                clone.find("td:eq(3)").remove();
                clone.find("td:eq(3)").remove();

                clone.find("td:eq(1) > span").text("-");
                clone.find("td:eq(2) > span").text("-");

                clone.find(".check_me").addClass("include").prop("checked" , false);
                tbody.append(clone);
            }

        });

        refresh_table(table , false);
    });
    $(document).on("click" , ".complete-inventory-count" , function(){
        var id = $(this).data("id");
        var modal = $("#complete_modal").modal("show");

        var table = $("#tab_uncounted");
        var tr_all = table.find("tbody > tr:not(.excluded)").find(".check_me");

        if(tr_all.length > 0){
            modal.find(".counting_incomplete").removeClass("hide").find(".uncounted_count").text(tr_all.length);
            modal.find(".counting_complete").addClass("hide");
        }else{
            modal.find(".counting_complete").removeClass("hide");
            modal.find(".counting_incomplete").addClass("hide");
        }

        modal.find(".btn-complete").data("id" , id);
    });
    $(document).on("click" , ".btn-complete" , function(){
        var id = $(this).data("id");
        var table = $("#tab_exclude").find("table > tbody > tr:not(.excluded)");
        var product_variant_id = [];
        var url = "<?php echo site_url('app/product/complete_inventory_control'); ?>";

        $.each(table , function(k , v){
            product_variant_id.push($(v).data("stockid"));
        });

        $.ajax({
            url : url ,
            method : "POST",
            data : {stock_control_id : id , excluded_product : product_variant_id},
            success : function(response){
                var json = jQuery.parseJSON(response);

                $('#complete_modal').modal("hide");

                $.notify("Successfully Completed the Stock Take" , { className:  "success" , position : "top center"});

                setTimeout(function(){
                    window.location.replace("<?php echo site_url("app/product/inventory-count/"); ?>"+id);
                },2000);

            }
        });
    });

    $(document).ready(function(){
        var table = $('.tab-container .count-diff');

        $.each(table , function(k , v){

            var tr = $(v).find("tbody > tr:not(.excluded)");
            var unit = 0;
            var cost = 0;

            $.each(tr , function(a , b){
                unit += parseInt($(b).find(".td-unit").data("unit"));
                cost += parseFloat($(b).find(".td-cost").data("cost"));
            });

            $(v).find("tfoot > tr > td:eq(1) > span").text(unit);
            
            if(cost.toFixed(2) > 0){
                $(v).find("tfoot > tr > td:eq(2)").css("color" , "#1ABC9C").find("span").text(cost.toFixed(2));
            }else{
                $(v).find("tfoot > tr > td:eq(2)").css("color" , "red").find("span").text(cost.toFixed(2));
            }
           
        });
    });

    function refresh_table(table , isInclude){
        var check_all = table.find(".check_all");
        var check_all_span = table.find(".check_all_span");
        var tr = table.find("tbody > tr:not(.excluded)").find(".check_me:checked");
        var tr_all = table.find("tbody > tr").find(".check_me");

        if(isInclude){
            var str = "Include";
        }else{
            var str = "Exclude";
        }

        if(tr_all.length == tr.length){
            check_all_span.addClass("active").html(tr.length+' selected ( all ) <br><small><a href="javascript:void(0);" class="btn btn-success btn-xs btn-exclude">'+str+' Items from count</a></small>');
            check_all.prop("checked" , true);
        }else if(tr.length > 0){
            check_all.prop("checked" , false);
            check_all_span.addClass("active").html(tr.length+' selected <br><small><a href="javascript:void(0);" class="btn btn-success btn-xs btn-exclude">'+str+' Items from count</a></small>');
        }else{
            check_all.prop("checked" , false);
            check_all_span.removeClass("active").html('Product');
        }


        var div = $(".tab-container > div");

        $.each(div , function(k , v){
            var table = $(v).find("table");
            var tr = table.find("tbody > tr:not(.excluded)").length;

            if(tr > 0){
                table.parent().removeClass("hide").next().addClass("hide");
            }else{
                table.parent().addClass("hide").next().removeClass("hide");
            }
        });

        refresh_count();
    }

    function refresh_count(){
        var all_table = $('#tab_all').find("table > tbody > tr:not(.excluded)").length;
        var tab_uncounted = $('#tab_uncounted').find("table > tbody > tr:not(.excluded)").length;
        var tab_unmatched = $('#tab_unmatched').find("table > tbody > tr:not(.excluded)").length;
        var tab_matched = $('#tab_matched').find("table > tbody > tr:not(.excluded)").length;
        var tab_exclude = $('#tab_exclude').find("table > tbody > tr:not(.excluded)").length;

        $(".tab-parent").find(".tab-link > a:eq(0) > span").text(tab_uncounted);
        $(".tab-parent").find(".tab-link > a:eq(1) > span").text(tab_unmatched);
        $(".tab-parent").find(".tab-link > a:eq(2) > span").text(tab_matched);
        $(".tab-parent").find(".tab-link > a:eq(3) > span").text(tab_exclude);
        $(".tab-parent").find(".tab-link > a:eq(4) > span").text(all_table);


        var table = $('.tab-container .count-diff');

        $.each(table , function(k , v){

            var tr = $(v).find("tbody > tr:not(.excluded)");
            var unit = 0;
            var cost = 0;

            $.each(tr , function(a , b){
                unit += parseInt($(b).find(".td-unit").data("unit"));
                cost += parseFloat($(b).find(".td-cost").data("cost"));
            });

            $(v).find("tfoot > tr > td:eq(1) > span").text(unit);
            
            if(cost.toFixed(2) > 0){
                $(v).find("tfoot > tr > td:eq(2)").css("color" , "#1ABC9C").find("span").text(cost.toFixed(2));
            }else{
                $(v).find("tfoot > tr > td:eq(2)").css("color" , "red").find("span").text(cost.toFixed(2));
            }
        });

    }
</script>
<style type="text/css">
    .inventory-count-table tbody > tr > td > span , .inventory-count-table thead > tr > td > span{
        line-height: 40px !important;
    }
    .inventory-count-table .check_all_span i{
        font-size: 17px;
        padding: 0px 10px;
    }
    .inventory-count-table .check_all_span.active{
        color : #1ABC9C;
    }
</style>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <form id="start_count_form" action="<?php echo site_url('app/product/inventory-count/review/'.$inventory_information->stock_control_id); ?>" method="POST">
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
                            <span>Review any discrepancies, then choose to resume your count or complete it.</span>
                        </div>
                        <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                            <a href="javascript:void(0);" class="btn btn-link btn-same-size abandon-inventory-count" data-id="<?php echo $inventory_information->stock_control_id;  ?>" style="color: red">Abandon</a>
                            <a href="<?php echo site_url('app/product/inventory-count/start/'.$inventory_information->stock_control_id); ?>" class="btn btn-info btn-same-size form-pause">Resume</a>
                            <a href="javascript:void(0);" class="btn btn-success btn-same-size complete-inventory-count" data-id="<?php echo $inventory_information->stock_control_id;  ?>">Complete</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-parent">
                            <div class="tab-link">
                                <a href="javascript:void(0);" class="active" data-tab="#tab_uncounted">Uncounted (<span><?php echo count($inventory_information->products["uncounted"]); ?></span>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_unmatched">Unmatched (<span><?php echo count($inventory_information->products["unmatched"]); ?></span>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_matched">Matched (<span><?php echo count($inventory_information->products["matched"]); ?></span>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_exclude">Excluded (<span><?php echo count($inventory_information->products["excluded"]); ?></span>)</a>
                                <a href="javascript:void(0);" data-tab="#tab_all">All (<span><?php echo count($inventory_information->products["all"]); ?></span>)</a>
                            </div>
                            <div class="tab-container">
                                <div id="tab_all">
                                    <div class="with_result">
                                        <table class="table inventory-count-table count-diff">
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
                                                                <input type="checkbox" class="check_all"> <span class="check_all_span">Product</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span>Expected</span></td>
                                                    <td class="text-right"><span>Total</span></td>
                                                    <td class="text-right border-left"><span>Unit</span></td>
                                                    <td class="text-right"><span>Cost</span></td>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td class="text-right"><span>0</span></td>
                                                    <td class="text-right"><?php echo $this->session->userdata("user")->currency_symbol;?> <span>0</span></td>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php foreach($inventory_information->products["all"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>" data-id="<?php echo $row['product_variant_id']; ?>" data-stockid="<?php echo $row['stock_count_id']; ?>">
                                                        <td>
                                                            <div class="checkbox">
                                                                <label>
                                                                  <input type="checkbox" class="check_me"> <?php echo $row["product_name"]; ?><br><small><?php echo $row['sku']; ?></small>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                        <td class="text-right border-left td-unit" data-unit="<?php echo $row["unit"]; ?>"><span><?php echo $row["unit"]; ?></span></td>
                                                        <td class="text-right td-cost" data-cost="<?php echo $row["cost"]; ?>"><span><?php echo custom_money_format($row["cost"]); ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="without_result">
                                        <p></p>
                                    </div>
                                </div>
                                <div id="tab_uncounted"  class="active">

                                    <div class="with_result <?php echo (!$inventory_information->products["uncounted"]) ? "hide" : ""; ?>">
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
                                                                <input type="checkbox" class="check_all"> <span class="check_all_span">Product</span>
                                                          </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span>Expected</span></td>
                                                    <td class="text-right"><span>Total</span></td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach($inventory_information->products["uncounted"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>"  data-id="<?php echo $row['product_variant_id']; ?>" data-stockid="<?php echo $row['stock_count_id']; ?>">
                                                        <td>
                                                           <div class="checkbox">
                                                                <label>
                                                                  <input type="checkbox" class="check_me"> <?php echo $row["product_name"]; ?><br><small><?php echo $row['sku']; ?></small>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>
       
                                    <div class="without_result <?php echo ($inventory_information->products["uncounted"]) ? "hide" : ""; ?>">
                                        <p class="help-block text-center">You have no Uncounted items.</p>
                                    </div>

                                </div>
                                <div id="tab_unmatched">

                                    <div class="with_result <?php echo (!$inventory_information->products["unmatched"]) ? "hide" : ""; ?>">
                                        <p class="help-block">The amount you counted was more or less than expected. You might like to double-check items in this list</p>
                                        <table class="table inventory-count-table count-diff">
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
                                                                <input type="checkbox" class="check_all"> <span class="check_all_span">Product</span>
                                                          </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span>Expected</span></td>
                                                    <td class="text-right"><span>Total</span></td>
                                                    <td class="text-right border-left"><span>Unit</span></td>
                                                    <td class="text-right"><span>Cost</span></td>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">Total</td>
                                                    <td class="text-right"><span>0</span></td>
                                                    <td class="text-right"><?php echo $this->session->userdata("user")->currency_symbol;?> <span>0</span></td>
                                                </tr>
                                            </tfoot>
                                            <tbody>

                                                <?php foreach($inventory_information->products["unmatched"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>"  data-id="<?php echo $row['product_variant_id']; ?>">
                                                        <td>
                                                           <div class="checkbox">
                                                                <label>
                                                                  <input type="checkbox" class="check_me"> <?php echo $row["product_name"]; ?><br><small><?php echo $row['sku']; ?></small>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                        <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                                        <td class="text-right border-left td-unit" data-unit="<?php echo $row["unit"]; ?>"><span><?php echo $row["unit"]; ?></span></td>
                                                        <td class="text-right td-cost" data-cost="<?php echo $row["cost"]; ?>"><span><?php echo custom_money_format($row["cost"]); ?></span></td> 
                                                    </tr>
                                                <?php endforeach; ?>
                                                
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="without_result <?php echo ($inventory_information->products["unmatched"]) ? "hide" : ""; ?>">
                                        <p class="help-block text-center">You have no Unmatched items.</p>
                                    </div>
          
                                </div>
                                <div id="tab_exclude">
                                    <div class="with_result hide">
                                        <p class="help-block">You've chosen to leave these items out of your count. The totals for these will not be updated.</p>
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
                                                                <input type="checkbox" class="check_all check_all_exclude"> <span class="check_all_span">Product</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span>Expected</span></td>
                                                    <td class="text-right"><span>Total</span></td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="without_result">
                                        <p class="help-block text-center">You have no Excluded items.</p>
                                    </div>
                                </div>
                                <div id="tab_matched">
                                    <div class="with_result <?php echo (!$inventory_information->products["matched"]) ? "hide" : ""; ?>">
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
                                                                <input type="checkbox" class="check_all"> <span class="check_all_span">Product</span>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-right border-left"><span>Expected</span></td>
                                                    <td class="text-right"><span>Total</span></td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php foreach($inventory_information->products["matched"] as $row) : ?>
                                                    <tr class="_<?php echo $row['product_variant_id']; ?>"  data-id="<?php echo $row['product_variant_id']; ?>">
                                                        <td>
                                                         <div class="checkbox">
                                                            <label>
                                                              <input type="checkbox" class="check_me"> <?php echo $row["product_name"]; ?><br><small><?php echo $row['sku']; ?></small>
                                                          </label>
                                                      </div>
                                                  </td>
                                                  <td class="text-right border-left"><span><?php echo $row["expected"]; ?></span></td>
                                                  <td class="text-right"><span><?php echo $row["total"]; ?></span></td>
                                              </tr>
                                              <?php endforeach; ?>
                                          </tbody>
                                      </table>
                                    </div>
                                    <div class="without_result <?php echo ($inventory_information->products["matched"]) ? "hide" : ""; ?>">
                                        <p class="help-block text-center">You have no Matched items.</p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="abandon_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Are you sure you want to abandon count?</h4>
            </div>
            <div class="modal-body">
                <p>Your inventory levels will not be updated. A record of this inventory will be saved but you will no longer be able to edit it.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-abandon">Abandon</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="complete_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Complete Stocktake</h4>
            </div>
            <div class="modal-body">
                <div class="counting_incomplete hide">
                    <p class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> There are <span class="uncounted_count">2</span> uncounted items in this inventory count.</p>
                    <p>We will reset the inventory count for these items to zero, or you can choose to exclude these items from the count on the review page. We will begin updating your inventory levels when you click submit.</p>
                </div>
                <div class="counting_complete">
                    <p>Awesome! You've finished counting. When you click submit, we'll begin updating your inventory levels.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success btn-complete">Submit</button>
            </div>
        </div>
    </div>
</div>