<script type="text/javascript">
    $(document).on('change' , '#profile_image' , function(){
        readURL(this , ".image-preview" , 'background');
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container" >
        	<a href="<?php echo site_url('app/setup/users'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> Create a user</h1>
        </div>
        <div class="grey-bg ">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Create a new user and select what the user has access to. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-success btn-same-size submit-form" data-form="#form_users">Save</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container ">
            <form action="<?php echo site_url("app/setup/users/add");?>" method="post" enctype="multipart/form-data" id="form_users">
                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                <section class="sec_border_bottom">
                    <h3>Profile</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>Personal and contact information for this user.</p>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="display_name">Display Name</label>
                                <input type="text" name="display_name" id="display_name" class="form-control" placeholder="Display Name">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="name@email.com">
                            </div>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="">Profile Image</label>
                                <div class="image-preview">
                                    
                                </div>
                                <input type="file" name="file" id="profile_image" class="btn btn-default">
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sec_border_bottom">
                    <h3>Outlets</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>Outlets that this user is assigned to and can work in.</p>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="outlets">Outlets</label>
                                <select class="form-control" id="outlets" name="outlet_id">
                                    <option value="0">All Outlets</option>
                                    <option value="1">Main Outlets</option>
                                </select>
                            </div>
                            
                        </div>
                        
                    </div>
                </section>
                <section class="sec_border_bottom">
                    <h3>Role</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>A role defines what this user can see and do.</p>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <div class="form-group">
                                <label for="role">Role</label>
                                <select class="form-control" name="role">
                                    <option value="CASHIER">Cashier</option>
                                    <option value="MANAGER">Manager</option>
                                    <option value="ADMIN">Admin</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </section>
                <section class="sec_border_bottom">
                    <h3>Security</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>Have a secure password to make sure your account stay safe.</p>
                        </div>
                        <div class="col-xs-12 col-lg-8">
                            <h4 style="margin-top: 0px;">SIGN IN SECURELY</h4>
                            <span>When you need to sign in to <?php echo $application_name; ?>, you will be asked to provide your pasword.</span>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="enter_password">Enter Password</label>
                                        <input type="password" name="password" class="form-control" id="enter_password">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6">
                                    <div class="form-group">
                                        <label for="confirm_password">Repeat Password</label>
                                        <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-success btn-same-size submit-form" data-form="#form_users">Save</a>
                    </div>
                </section>
                
            </form>
        </div>
    </div>
</div>