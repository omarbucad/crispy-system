<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container">
        	<h1>Inventory Count </h1>
        	<div class="account_container_btn">
        		<a href="<?php echo site_url("app/product/inventory-count"); ?>" class="<?php echo ($this->uri->segment(4) == "") ? "active" : "" ; ?>" >Due (0)</a>
                <a href="<?php echo site_url("app/product/inventory-count/upcoming"); ?>" class="<?php echo ($this->uri->segment(4) == "upcoming") ? "active" : ""; ?>">Upcoming (0)</a>
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
            <div class="text-center">
                <img src="<?php echo site_url("public/img/packing.png"); ?>" class="img">
                <p class="help-block"><?php echo $no_result_found; ?></p>
                <a href="<?php echo site_url("app/product/inventory-count/create"); ?>" class="btn btn-success">Add Inventory Count</a>
            </div>
        </div>
    </div>
</div>