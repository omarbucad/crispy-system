<div class="container">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li class="active"> Sales Taxes</li>
    	</ol>	
    	<section>
    		<h3>Sales Tax</h3>
	    	<div class="text-left">
	        	<a href="<?php echo site_url("app/setup/account/manage"); ?>" class="btn btn-primary" >Add Sales Tax</a>
	        	<a href="<?php echo site_url("app/setup/account/pricing"); ?>" class="btn btn-default disabled" >Combine Taxed into a Group</a>
	        </div>
	        <table class="table table-bordered">
	        	<thead>
	        		<tr>
	        			<th width="60%">Name</th>
	        			<th width="20%" class="text-right">Rate</th>
	        			<th width="20%"></th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr>
	        			<td>No Tax</td>
	        			<td>0%</td>
	        			<td></td>
	        		</tr>
	        		<tr>
	        			<td>TAX 30</td>
	        			<td>30%</td>
	        			<td>
	        				<a href="#" class="text-underline text-info">Edit</a> | 
	        				<a href="#" class="text-underline text-danger">Delete</a>
	        			</td>
	        		</tr>
	        	</tbody>
	        </table>
    	</section>
    	<section>
    		<h3>Default Outlet Taxes</h3>
	        <table class="table table-bordered">
	        	<thead class="bg-red">
	        		<tr>
	        			<th width="40%">Outlet Name</th>
	        			<th width="40%">Default Sales Tax</th>
	        			<th width="20%"></th>
	        		</tr>
	        	</thead>
	        	<tbody>
	        		<tr>
	        			<td><a href="#">Main Outlet</a></td>
	        			<td>No Tax (0%)</td>
	        			<td>
	        				<a href="#" class="text-underline text-info">Edit Outlet</a>
	        			</td>
	        		</tr>
	        	</tbody>
	        </table>
    	</section>
    </div>
</div>