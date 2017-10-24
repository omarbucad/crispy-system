<div class="container-fluid">
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
        					<h4>Single Outlet</h4>
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
        		<div class="col-xs-12 col-lg-6"></div>
        	</div>
        </div>
    	<?php else : ?>

    	<?php endif; ?>
    </div>
</div>