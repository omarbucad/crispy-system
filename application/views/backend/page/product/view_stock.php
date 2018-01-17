<script type="text/javascript">
    $(document).on("click" , '.submit-form-ajax' , function(){
        var $me = $(this);
        var form = $me.closest(".modal").find("form");
        var action = form.attr("action");

        $.ajax({
            url : action ,
            method : "POST" ,
            data : form.serialize(),
            success : function(response){
                //var json = jQuery.parseJSON(response);

                console.log(response);
            }
        });
    });

</script>

<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('app/product'); ?>">Product</a></li>
                <li><a href="<?php echo site_url('app/product/consignment'); ?>">Stock Control</a></li>
                <li class="active"><?php echo $result->reference_name; ?></li>
            </ol>   
            <h3><?php echo $result->reference_name; ?> <small>(<?php echo $result->status; ?>)</small></h3>
        </div>
    	<div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <a href="<?php echo $result->edit_link; ?>" class="btn btn-success ">Edit Product</a>
                        <a href="<?php echo site_url("app/product/edit-consignment/$result->inventory_order_id "); ?>" class="btn btn-success ">Edit Details</a>
                        <button type="button" class="btn btn-success " data-toggle="modal" data-target="#send_order_modal">Send Order</button>
                        <a href="javascript:void(0);" class="btn btn-success ">Export CSV</a>
                        <div class="btn-group">
                          <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            More <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li><a href="#">Import Products</a></li>
                            <li><a href="#">Mark as Sent</a></li>
                            <li><a href="#">Print Label</a></li>
                          </ul>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-danger ">Cancel Order</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- STORE SETTINGS -->
        <div class="card margin-bottom">
            <div class="card-body">
                <div class="container margin-bottom">
                    <table width="100%;" >
                        <tbody>
                            <tr>
                                <td width="15%" style="padding: 5px 0px;"><strong>Delivery To</strong></td>
                                <td width="35%" class="text-left"> <?php echo $result->deliver_to; ?></td>
                                <td width="15%"><strong>Created</strong></td>
                                <td width="35%"> <?php echo $result->created; ?> </td>
                            </tr>
                            <tr>
                                <td width="15%" style="padding: 5px 0px;"><strong>Supplier Invoice</strong></td>
                                <td width="35%" class="text-left"> <?php echo $result->supplier_invoice; ?> </td>
                                <td width="15%" style="padding: 5px 0px;"><strong>Created By</strong></td>
                                <td width="35%"> <?php echo $result->display_name; ?> </td>
                            </tr>
                            <tr>
                                <td width="15%" ></td>
                                <td width="35%"> &nbsp;</td>
                                <td width="15%" style="padding: 5px 0px;"><strong>Delivery Due</strong></td>
                                <td width="35%"> <?php echo $result->due_date; ?> </td>
                            </tr>
                            <tr>
                                <td width="15%" style="padding: 5px 0px;"></td>
                                <td width="35%"> &nbsp;</td>
                                <td width="15%" style="padding: 5px 0px;"><strong>Order No.</strong></td>
                                <td width="35%"> <?php echo $result->order_number; ?> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                 <div class="container">
                    <table class="customer-table">
                        <thead>
                            <tr>
                                <th width="5%">Order</th>
                                <th width="10%">Product</th>
                                <th width="10%">SKU</th>
                                <th width="10%">Supplier Code</th>
                                <th width="5%">Stock</th>
                                <th width="10%">Ordered</th>
                                <th width="10%">Received</th>
                                <th width="10%">Supply Cost</th>
                                <th width="10%">Total Supply Cost</th>
                                <th width="10%">Retail Price</th>
                                <th width="10%">Total Retail Price</th>  
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Total</th>
                                <th colspan="3"></th>
                                <th><?php echo $result->total_inventory; ?></th>
                                <th><?php echo $result->total_ordered; ?></th>
                                <th><?php echo $result->total_recieved; ?></th>
                                <th></th>
                                <th><?php echo custom_money_format($result->total_price); ?></th>
                                <th></th>
                                <th><?php echo custom_money_format($result->total_retail_price); ?></th>
                            </tr>
                        </tfoot>

                        <?php foreach($result->product_list as $key => $row) : ?>
                            <tr class="customer-row" style="cursor: default;">
                                <td><?php echo $row->order_number; ?></td>
                                <td><?php echo $row->product_name.' '.$row->variant_name; ?></td>
                                <td><?php echo $row->sku; ?></td>
                                <td><?php echo $row->supplier_code; ?></td>
                                <td><?php echo $row->current_stock; ?></td>
                                <td><?php echo $row->quantity; ?></td>
                                <td>0</td>
                                <td><?php echo custom_money_format($row->supply_price ); ?></td>
                                <td><?php echo custom_money_format($row->total_price); ?></td>
                                <td><?php echo custom_money_format($row->retail_price_wot); ?></td>
                                <td><?php echo custom_money_format($row->total_retail_price); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
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
