<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">
        <div class="container">
        	<h1>Account</h1>
        	<div class="account_container_btn">
        		<a href="<?php echo site_url("app/setup/account/manage"); ?>" class="<?php echo ($setup_page == "manage") ? "active" : "" ;?>" >Manage My Account</a>
        		<a href="<?php echo site_url("app/setup/account/pricing"); ?>" class="<?php echo ($setup_page == "pricing") ? "active" : "" ;?>">View Pricing Plans</a>
        	</div>
        </div>
        <?php if($setup_page == "manage") : ?>
        <div class="grey-bg margin-bottom">
        	<div class="container ">
        		<span>Manage your account plan, and payment details. <a href="#" class="text-underline">need help?</a></span>
        	</div>
        </div>
        <div class="row ">
        	<div class="container">
        		<div class="card">
        			<div class="card-body text-center">
        				<h1>You're currently on the Free Plan</h1>
        				<p>Whether you need to add a store, a register, or our most advanced features, <br>Trackerteer is on hand to upgrade your business.</p>
        				<a href="<?php echo site_url("app/setup/account/pricing"); ?>" class="btn btn-success btn-lg">View our Pricing plans</a>
        			</div>
        		</div>
        	</div>
        </div>
        <div class="container">
        	<div class="row">
        		<div class="col-xs-12">
        			<h4>What's in my plan</h4>
        		</div>
        		<div class="col-xs-12 col-lg-6">
        			<div class="row">
        				<div class="col-xs-12 col-lg-6">
        					<span>View a breakdown of your current plan. To find out what more you could get, <a href="#" class="text-underline">check out our other plans.</a></span>
        				</div>
        				<div class="col-xs-12 col-lg-6">
        					<h4 style="margin-top: 0px;">Single Outlet</h4>
        					<nav>
        						<ul>
        							<li><span>1 Register</span></li>
        							<li><span>1 User</span></li>
        							<li><span>10 Products</span></li>
        							<li><span>1000 Customer</span></li>
        						</ul>
        					</nav>
        				</div>
        			</div>
        		</div>
        		<div class="col-xs-12 col-lg-6">
                          
                </div>
                <div class="col-xs-12">
                    <a href="#" class="text-danger">Delete Account</a>
                </div>
        	</div>
        </div>
    	<?php else : ?>
        <div class="grey-bg margin-bottom">
            <div class="container ">
                <span>Select a plan to get the best out of Accounts Software. <a href="#" class="text-underline">Compare plan details.</a></span>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row no-margin no-gap">
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$10</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Basic Plan</h4>
                                    <ul class="plan-detail">
                                        <li>1 Website</li>
                                        <li>100 GB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Select Plan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table green">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$25</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Standard Plan</h4>
                                    <ul class="plan-detail">
                                        <li>5 Website</li>
                                        <li>500 GB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-success">Plan Selected</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table  dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$50</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Advanced Plan</h4>
                                    <ul class="plan-detail">
                                        <li>10 Website</li>
                                        <li>1 TB Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Select Plan</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="pricing-table dark-blue">
                                <div class="pt-header">
                                    <div class="plan-pricing">
                                        <div class="pricing">$100</div>
                                        <div class="pricing-type">per month</div>
                                    </div>
                                </div>
                                <div class="pt-body">
                                    <h4>Unlimited Plan</h4>
                                    <ul class="plan-detail">
                                        <li>Unlimited Website</li>
                                        <li>Unlimited Storage</li>
                                        <li>Unlimited Bandwidth</li>
                                    </ul>
                                </div>
                                <div class="pt-footer">
                                    <button type="button" class="btn btn-primary">Select Plan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-12 col-lg-4">
                    <h3>Billing</h3>
                </div>
                <div class="col-xs-12 col-lg-8">
                    <h3>You've selected the Starter plan.</h3>
                    <span class="help-block">How do you want to be billed?</span>
                    <hr>
                    <div class="billed_container">
                        <div class="annually active">
                            <h4 class="text-center">Annual Billing</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    Get your bill once a year.
                                </div>
                                <div class="col-xs-6"></div>
                            </div>
                        </div>
                        <div class="monthly">
                            <h4 class="text-center">Monthly Billing</h4>
                            <div class="row">
                                <div class="col-xs-6">
                                    Get your bill once a month.
                                </div>
                                <div class="col-xs-6"></div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn btn-success btn-lg">Switch Plan</a>
                </div>
            </div>

        </div>
    	<?php endif; ?>
    </div>
</div>