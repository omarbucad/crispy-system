<div class="container-fluid">
    <div class="side-body padding-top">

        <div class="container">
        	<h1>Users</h1>
        	<div class="account_container_btn">
                <a href="<?php echo site_url("app/setup/users"); ?>"  >Users</a>
                <a href="<?php echo site_url("app/setup/roles"); ?>" class="active">Roles</a>
            </div>
        </div>
        <div class="grey-bg margin-bottom">
            <div class="container ">
                <span>Manage what each role can see and do.</span>
            </div>
        </div>
        <div class="container ">
            <table class="table my-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Last Saved</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span><a href="#" class="text-underline">Admin</a></span></td>
                        <td><span>1 day ago</span></td>
                    </tr>
                    <tr>
                        <td><span><a href="#" class="text-underline">Cashier</a></span></td>
                        <td><span>2 day ago</span></td>
                    </tr>
                    <tr>
                        <td><span><a href="#" class="text-underline">Manager</a></span></td>
                        <td><span>2 day ago</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>