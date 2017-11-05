<div class="container margin-bottom">
    <div class="side-body padding-top">
    	<ol class="breadcrumb">
    		<li><a href="<?php echo site_url('app/setup/general'); ?>">Setup</a></li>
    		<li class="active"> Outlets and Registers</li>
    	</ol>	
    	<div class="card">
    		<div class="card-body">
    			<section>
		    		<h3 class="no-margin">Outlets and Registers</h3>
			    	<div class="text-left">
			        	<a href="<?php echo site_url("app/setup/add-outlet"); ?>"  class="btn btn-primary" >Add Outlet</a>
			        	<a href="#"  class="btn btn-default disabled" >Add Receipt Template</a>
			        </div>
			        <table class="table table-bordered table-header-dark">
			        	<thead>
			        		<tr>
			        			<th width="20%">Outlet Name</th>
			        			<th width="20%">Default Tax</th>
			        			<th width="15%">Registers</th>
			        			<th width="5%">Status</th>
			        			<th width="22%">Details</th>
			        			<th width="18%"></th>
			        		</tr>
			        	</thead>
			        	<tbody>
			        		<?php foreach($outlet_list as $row) : ?>
			        			<tr>
			        				<td><a href="<?php echo site_url("app/setup/outlet/?id=$row->outlet_id"); ?>" class="link-style"><?php echo $row->outlet_name; ?></a></td>
			        				<td><?php echo $row->sales_tax_id; ?></td>
			        				<td colspan="3"></td>
			        				<td>
			        					<a href="#" class="text-underline link-style">Edit Outlet</a> | 
			        					<a href="<?php echo site_url("app/setup/add-register/?id=$row->outlet_id"); ?>" class="text-underline link-style">Add a Register</a>
			        				</td>
			        			</tr>

			        			<?php foreach($row->store_register as $key => $register) : ?>
			        				<?php if($key == 0) : ?>
			        					<tr>
				        					<td rowspan="<?php echo count($row->store_register); ?>" colspan="2"></td>
				        					<td><?php echo $register['register_name']; ?></td>
				        					<td><?php echo $register['register_open']; ?></td>
				        					<td><?php echo $register['register_details']; ?></td>
				        					<td><a href="#" class="text-underline link-style">Edit Register</a></td>
				        				</tr>
			        				<?php else : ?>
			        					<tr>
			        						<td><?php echo $register['register_name']; ?></td>
				        					<td><?php echo $register['register_open']; ?></td>
				        					<td><?php echo $register['register_details']; ?></td>
				        					<td><a href="#" class="text-underline link-style">Edit Register</a></td>
			        					</tr>
			        				<?php endif; ?>
			        			<?php endforeach; ?>

			        		<?php endforeach; ?>
			        	</tbody>
			        </table>
		    	</section>


    		</div>
    	</div>
    </div>
</div>

<script type="text/javascript">
	$(document).on('click' , '.read-more' , function(){
		if($(this).text() == "More Details"){
			$(this).text("Fewer Details");
		}else{
			$(this).text("More Details");
		}
	});
</script>