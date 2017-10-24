<div class="container-fluid">
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
                        <a href="javascript:void(0);" class="btn btn-success ">Add User</a>
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
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-xs-4">
                                    <img src="<?php echo site_url("public/img/profile/profile-1.jpg"); ?>" width="80px">
                                </div>
                                <div class="col-xs-8">
                                    <a href="#">Star Bucks<br>(Chillax Cafe)</a><br>
                                    <small class="help-block">marusaki123@gmail.com</small>
                                </div>
                            </div>
                        </td>
                        <td><span>Admin</span></td>
                        <td><span>All Outlets</span></td>
                        <td>
                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1">₱</span>
                              <input type="text" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1">₱</span>
                              <input type="text" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1">
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                              <span class="input-group-addon" id="sizing-addon1">₱</span>
                              <input type="text" class="form-control" placeholder="0.00" aria-describedby="sizing-addon1">
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>