<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container">
        	<h1>Inventory Count </h1>
        	<div class="account_container_btn">
        		<a href="<?php echo site_url("app/product/inventory-count"); ?>" class="<?php echo ($this->uri->segment(4) == "") ? "active" : "" ; ?>" >Due (<?php echo $due_count; ?>)</a>
                <a href="<?php echo site_url("app/product/inventory-count/upcoming"); ?>" class="<?php echo ($this->uri->segment(4) == "upcoming") ? "active" : ""; ?>">Upcoming (<?php echo $upcoming_count; ?>)</a>
                <a href="<?php echo site_url("app/product/inventory-count/completed"); ?>" class="<?php echo ($this->uri->segment(4) == "completed") ? "active" :"" ; ?>">Completed </a>
        		<a href="<?php echo site_url("app/product/inventory-count/cancelled"); ?>" class="<?php echo ($this->uri->segment(4) == "cancelled") ? "active" :"" ; ?>">Cancelled </a>
        	</div>
        </div>
        <div class="grey-bg margin-bottom">
            <div class="container ">
                <div class="row">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Create, schedule and complete counts to keep track of your inventory. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url("app/product/inventory-count/create"); ?>" class="btn btn-success ">Add Inventory Count</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">

            <?php if($result) : ?>

                <table class="customer-table">
                    <thead>
                        <tr>
                            <th width="50%">Name</th>
                            <th width="25%">Outlet</th>
                            <th width="25%">Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row) : ?>
                            <tr class="customer-row">
                                <td>
                                    <a href="<?php echo $row->stock_control_link; ?>"><?php echo $row->count_name; ?> <span class="label label-success"><?php echo $row->status; ?></span></a><br>
                                    <small><?php echo $row->created; ?></small>
                                </td>
                                <td><a href="javascript:void(0);"><?php echo $row->outlet_name; ?></a></td>
                                <td><?php echo $row->count_type; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            <?php else : ?>
                <div class="text-center">
                    <img src="<?php echo site_url("public/img/packing.png"); ?>" class="img">
                    <p class="help-block"><?php echo $no_result_found; ?></p>
                    <a href="<?php echo site_url("app/product/inventory-count/create"); ?>" class="btn btn-success">Add Inventory Count</a>
                </div>
            <?php endif; ?>

            

            
        </div>
    </div>
</div>