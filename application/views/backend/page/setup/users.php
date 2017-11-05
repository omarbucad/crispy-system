<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
        	<h1>Users</h1>
        	<div class="account_container_btn">
                <a href="<?php echo site_url("app/setup/users"); ?>" class="active" >Users</a>
                <a href="<?php echo site_url("app/setup/roles"); ?>">Roles</a>
            </div>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-8 col-lg-6 no-margin-bottom">
                        <span>Manage users and their sales targets. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-4 col-lg-6 text-right no-margin-bottom">
                        <a href="<?php echo site_url("app/setup/users/add"); ?>" class="btn btn-success ">Add User</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card margin-bottom">
            <div class="container">
                <div class="card-body no-padding-left no-padding-right">
                    <form action="#" method="POST">
                        <div class="row">
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_name">Name</label>
                                    <input type="text" name="name" class="form-control" id="s_name" placeholder="Search by username or name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_roles">Roles</label>
                                    <select class="form-control" id="s_roles">
                                        <option>All Roles</option>
                                        <option>Cashier</option>
                                        <option>Manager</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_outlet">Outlet</label>
                                    <select class="form-control" id="s_outlet">
                                        <option>All Outlet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 text-right">
                                <input type="submit" name="submit" value="Search" class="btn btn-primary btn-vertical-center btn-same-size">
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="container ">
            <table class="table my-table">
                <thead>
                    <tr>
                        <th width="25%">Name</th>
                        <th width="10%">Role</th>
                        <th width="20%">Outlet</th>
                        <th width="15%">Daily Target</th>
                        <th width="15%">Weekly Target</th>
                        <th width="15%">Monthly Target</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user_list as $key => $row) : ?>
                        <tr data-value="<?php echo $row->user_id?>">
                            <td>
                                <div class="row">
                                    <div class="col-xs-6 col-lg-4 no-margin-bottom">
                                        <img src="<?php echo site_url("thumbs/users/$row->image_path/80/80/$row->image_name"); ?>" class="img img-responsive thumbnail no-margin-bottom">
                                    </div>
                                    <div class="col-xs-6 col-lg-8 no-margin-bottom">
                                        <a href="<?php echo site_url("app/setup/users/view/?id=$row->user_id"); ?>"><?php echo $row->username; ?> (<?php echo $row->display_name; ?>)</a><br>
                                        <small class="help-block"><?php echo $row->email_address; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td ><span ><?php echo $row->role; ?></span></td>
                            <td><span>All Outlets</span></td>
                            <td>
                                <div class="input-group">
                                  <span class="input-group-addon" id="sizing-addon1">₱</span>
                                  <input type="number" step="0.01" class="form-control update-target" placeholder="0.00" aria-describedby="sizing-addon1" data-type="daily_target" value="<?php echo $row->daily_target; ?>">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                  <span class="input-group-addon" id="sizing-addon1">₱</span>
                                  <input type="number" step="0.01" class="form-control update-target" placeholder="0.00" aria-describedby="sizing-addon1" data-type="weekly_target" value="<?php echo $row->weekly_target; ?>">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                  <span class="input-group-addon" id="sizing-addon1">₱</span>
                                  <input type="number" step="0.01" class="form-control update-target" placeholder="0.00" aria-describedby="sizing-addon1" data-type="monthly_target" value="<?php echo $row->monthly_target; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).on('focusout' , '.update-target' , function(){
        var $target = $(this);
        var id = $target.closest("tr").data("value");
        var url = "<?php echo site_url("app/setup/update_target"); ?>";
        var value = $target.val();
        var type = $target.data("type");
        var token_hash = "<?php echo $csrf_hash; ?>";
        $.ajax({
            url : url ,
            method : "post" ,
            data : {
                id : id ,
                value : value ,
                type : type ,
                "<?php echo $csrf_token_name; ?>" : token_hash,
            } ,
            beforeSend : function(){
                $target.addClass("input_loader");
            },
            success : function(e){
                $target.removeClass("input_loader");
                console.log(e);
            }
        });
    });
</script>