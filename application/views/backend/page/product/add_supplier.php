<script type="text/javascript">
    $(document).on('change' , '#profile_image' , function(){
        readURL(this , ".image-preview" , 'background');
    });
</script>
<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container" >
        	<a href="<?php echo site_url('app/setup/users'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> Add a Supplier</h1>
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
            <form action="<?php echo site_url("app/product/supplier/add");?>" method="post" enctype="multipart/form-data" id="form_users">
                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                <section class="sec_border_bottom">
                    <h3>Details</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>How your supplier is identified and described in <?php echo $application_name; ?>. You can also choose to set a default markup, making setting up products easier.</p>
                        </div>
                        <div class="col-xs-12 col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="supplier_name">Supplier Name</label>
                                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" placeholder="Supplier Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="default_markup">Default Markup</label>
                                        <input type="number" step="0" name="default_markup" id="default_markup" class="form-control" placeholder="Default Markup">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" rows="5"></textarea>
                            </div>
                        </div>
                        
                    </div>
                </section>
                <section class="sec_border_bottom">
                    <h3>Contact Info</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4">
                            <p>The official name and contact details for your supplier.</p>
                        </div>
                        <div class="col-xs-12 col-lg-8">
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="company">Company</label>
                                        <input type="text" name="company" id="company" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" id="mobile" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="fax">Fax</label>
                                        <input type="text" name="fax" id="fax" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="field1">Twitter</label>
                                        <input type="text" name="field1" id="field1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label for="field1">Facebook</label>
                                        <input type="text" name="field2" id="field1" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="sec_border_bottom">
                    <h3>Address</h3>
                    <div class="row">
                        <div class="col-xs-12 col-lg-4"></div>
                        <div class="col-xs-12 col-lg-4">
                            <dl class="dl-horizontal text-left">
                                <dt>Physical Address</dt><dd><br><br><br></dd>
                                <dt>Street 1</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[street1]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Street 2</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[street2]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Suburb</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[suburb]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>City</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[city]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Postcode</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[postcode]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>State</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="physical[state]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Country</dt>
                                <dd>
                                    <div class="form-group">
                                        <select class="form-control" name="physical[country]">
                                            <?php foreach($countries_list as $code =>  $country) : ?>
                                                <option value="<?php echo $code; ?>" ><?php echo $country?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </dd>
                            </dl>
                        </div>
                        <div class="col-xs-12 col-lg-4">
                            <input type="hidden" name="postal_address_id">
                            <dl class="dl-horizontal">
                                <dt>Postal Address</dt><dd><a href="javascript:void(0);" class="text-underline" style="position: relative;top: 7px;">Same as Physical Address</a><br><br><br></dd>
                                <dt>Street 1</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[street1]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Street 2</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[street2]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Suburb</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[suburb]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>City</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[city]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Postcode</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[postcode]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>State</dt>
                                <dd>
                                    <div class="form-group">
                                        <input type="text" name="postal[state]" class="form-control" >
                                    </div>
                                </dd>
                                <dt>Country</dt>
                                <dd>
                                    <div class="form-group">
                                        <select class="form-control" name="postal[country]">
                                            <?php foreach($countries_list as $code =>  $country) : ?>
                                                <option value="<?php echo $code; ?>" ><?php echo $country?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </dd>
                                
                            </dl>
                            
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