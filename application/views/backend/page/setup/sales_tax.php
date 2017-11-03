<div class="container">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li class="active"> Sales Taxes</li>
    	</ol>	
    	<div class="card">
    		<div class="card-body">
    			<section>
		    		<h3>Sales Tax</h3>
			    	<div class="text-left">
			        	<a href="#" data-toggle="modal" data-target="#modalDefault" class="btn btn-primary" >Add Sales Tax</a>
			        	<a href="#" data-toggle="modal" data-target="#group_tax" class="btn btn-default <?php echo (count($sales_tax_list) > 2) ? "" : "disabled"; ?>" >Combine Taxed into a Group</a>
			        </div>
			        <table class="table table-bordered table-header-dark">
			        	<thead>
			        		<tr>
			        			<th width="60%">Name</th>
			        			<th width="20%" class="text-right">Rate</th>
			        			<th width="20%"></th>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		<?php foreach($sales_tax_list as $row) : ?>
			        			<tr>
			        				<td><?php echo $row->tax_name; ?></td>
			        				<td class="text-right"><?php echo $row->tax_rate; ?>%</td>
			        				<td>
			        					<?php if($row->deletable == "YES") : ?>
			        						<a href="<?php echo site_url("app/setup/sales-taxes/edit/?id=").$row->sales_tax_id; ?>" class="text-underline text-info">Edit</a> | 
			        						<a href="<?php echo site_url("app/setup/sales-taxes/edit/?id=").$row->sales_tax_id; ?>"  class="text-underline text-danger">Delete</a>
			        					<?php endif; ?>
			        				</td>
			        			</tr>
			        		<?php endforeach; ?>
			        	</tbody>
			        </table>
		    	</section>

		    	<?php if($group_sales_tax_list) : ?>
		    	<section>
		    		<h3>Tax Groups</h3>
			        <table class="table table-bordered table-header-dark">
			        	<thead>
			        		<tr>
			        			<th width="30%">Tax Group Name</th>
			        			<th width="30%">Sales Taxes</th>
			        			<th width="20%" class="text-right">Rate</th>
			        			<th width="20%"></th>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		<?php foreach($group_sales_tax_list as $key => $row) : ?>
			        			<tr>
			        				<td><strong><?php echo $row->tax_sales_group_name; ?></strong></td>
			        				<td><strong><?php echo $row->sales_tax_count; ?> taxes</strong></td>
			        				<td class="text-right"><strong><?php echo $row->sales_tax_group_rate;?>%</strong></td>
			        				<td>
			        					<a href="<?php echo site_url("app/setup/sales-taxes/edit/?id=").$row->sales_tax_group_id; ?>" class="text-underline text-info">Edit</a> | 
			        					<a href="<?php echo site_url("app/setup/sales-taxes/edit/?id=").$row->sales_tax_group_id; ?>"  class="text-underline text-danger">Delete</a>
			        				</td>
			        			</tr>
			        			<?php foreach($row->tax_sales as $k => $tax) : ?>
			        				<tr class="table-odd">
			        				<?php if($k == 0) : ?>
			        					<td rowspan="<?php echo $row->sales_tax_count; ?>"></td>
			        					<td><?php echo $tax->tax_name; ?></td>
			        					<td class="text-right"><?php echo $tax->tax_rate; ?></td>
			        					<td rowspan="<?php echo $row->sales_tax_count; ?>"></td>
			        				<?php else : ?>
			        					<td><?php echo $tax->tax_name; ?></td>
			        					<td class="text-right"><?php echo $tax->tax_rate; ?></td>
			        				<?php endif; ?>
			        				</tr>

			        			<?php endforeach; ?>
			        		<?php endforeach; ?>
			        	</tbody>
			        </table>
		    	</section>
		    	<?php endif; ?>

		    	<section>
		    		<h3>Default Outlet Taxes</h3>
			        <table class="table table-bordered table-header-dark">
			        	<thead class="bg-red">
			        		<tr>
			        			<th width="40%">Outlet Name</th>
			        			<th width="40%">Default Sales Tax</th>
			        			<th width="20%"></th>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		<?php foreach($outlet_list as $row) : ?>
			        			<tr>
			        				<td><a href="<?php echo site_url("app/setup/outlet/?id=$row->outlet_id"); ?>"><?php echo $row->outlet_name; ?></a></td>
			        				<td><?php echo $row->tax_name; ?></td>
			        				<td>
				        				<a href="<?php echo site_url("app/setup/edit-outlet/?id=$row->outlet_id"); ?>" class="text-underline text-info">Edit Outlet</a>
				        			</td>
			        			</tr>
			        		<?php endforeach; ?>
			        	</tbody>
			        </table>
		    	</section>
    		</div>
    	</div>
    </div>
</div>


<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Sales Tax</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/setup/add_sales_tax"); ?>" id="add_tax_form" method="POST">
                    <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                    <div class="form-group">
                        <label for="tax_name">Tax Name</label>
                        <input type="text" name="tax_name" class="form-control" id="tax_name">
                    </div>
                    <div class="form-group">
                        <label for="tax_rate">Tax Rate (%)</label>
                        <input type="number" name="tax_rate" class="form-control" id="tax_rate">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_tax_form">Save</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="group_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Group Sales Tax</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo site_url("app/setup/add_group_sales_tax"); ?>" id="add_tax_group_form" method="POST">
                	<input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                	<div class="form-group">
                		<label for="tax_group_name">Tax Group Name</label>
                		<input type="text" name="tax_group_name" class="form-control" id="tax_group_name" required="">
                	</div>
                	<div class="form-group">
                		<label for="tax_rate">Tax Rate (%)</label>
                		<select class="multi-select form-control" id="mselect" name="sales_tax_id[]" multiple="multiple">
                			<?php foreach($sales_tax_list as $row) : ?>
                				<?php if($row->deletable == "YES") : ?>
                					<option value="<?php echo $this->encryption->decrypt(urldecode($row->sales_tax_id)); ?>"><?php echo $row->tax_name." ($row->tax_rate%)"; ?></option>
                				<?php endif; ?>	
                			<?php endforeach; ?>
                		</select>
                	</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary submit-form" data-form="#add_tax_group_form">Save</button>
            </div>
        </div>
    </div>
</div>