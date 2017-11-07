<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container" >
        	<a href="<?php echo site_url('app/product/supplier'); ?>" style="display:inline-block;position: relative;left: -10px;"><i class="fa fa-arrow-left fa-3x"  aria-hidden="true"></i> </a> <h1 style="display:inline-block;"> <?php echo $supplier_information->supplier_name; ?></h1>
        </div>
        <div class="grey-bg margin-bottom">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>View and edit your supplier.</span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="javascript:void(0);" class="btn btn-info btn-same-size" >Delete</a>
                        <a href="javascript:void(0);" class="btn btn-success btn-same-size">Edit</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="container-fluid">
                    <p><?php echo $supplier_information->description; ?></p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-lg-6">
                    <dl class="dl-horizontal text-left">
                        <dt>Default Markup</dt>
                        <dd><h5><?php echo $supplier_information->default_markup; ?>%</h5></dd>
                        <?php if($supplier_information->company) : ?>
                        <dt>Company</dt>
                        <dd><h5><?php echo $supplier_information->company; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->display_name) : ?>
                        <dt>Contact</dt>
                        <dd><h5><?php echo $supplier_information->display_name; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->phone) : ?>
                        <dt>Phone</dt>
                        <dd><h5><?php echo $supplier_information->phone; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->mobile) : ?>
                        <dt>Mobile</dt>
                        <dd><h5><?php echo $supplier_information->mobile; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->fax) : ?>
                        <dt>Fax</dt>
                        <dd><h5><?php echo $supplier_information->fax; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->email) : ?>
                        <dt>Email</dt>
                        <dd><h5><a href="mailto:<?php echo $supplier_information->email; ?>" class="link-style"><?php echo $supplier_information->email; ?></a></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->website) : ?>
                        <dt>Website</dt>
                        <dd><h5><a href="<?php echo $supplier_information->website; ?>" target="_blank" class="link-style"><?php echo $supplier_information->website; ?></a></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->field_1) : ?>
                        <dt>Twitter</dt>
                        <dd><h5><?php echo $supplier_information->field_1; ?></h5></dd>
                        <?php endif; ?>
                        <?php if($supplier_information->field_2) : ?>
                        <dt>Facebook</dt>
                        <dd><h5><?php echo $supplier_information->field_2; ?></h5></dd>
                        <?php endif; ?>
                    </dl>
                </div>
                <div class="col-xs-12 col-lg-6">
                    <dl class="dl-horizontal text-left">
                        <dt>Physical Address</dt>
                        <dd>
                            <address style="padding-top: 10px;">
                                <?php if($supplier_information->physical_street1) : ?>
                                <span><?php echo $supplier_information->physical_street1;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->physical_street2) : ?>
                                <span><?php echo $supplier_information->physical_street2;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->physical_suburb) : ?>
                                <span><?php echo $supplier_information->physical_suburb;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->physical_postcode) : ?>
                                <span><?php echo $supplier_information->physical_postcode;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->physical_state) : ?>
                                <span><?php echo $supplier_information->physical_state;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->physical_country) : ?>
                                <span><?php echo $supplier_information->physical_country;?></span>
                                <?php endif; ?>
                            </address>
                        </dd>
                        <dt>Postal Address</dt>
                        <dd>
                            <address style="padding-top: 10px;">
                                <?php if($supplier_information->postal_street1) : ?>
                                <span><?php echo $supplier_information->postal_street1;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->postal_street2) : ?>
                                <span><?php echo $supplier_information->postal_street2;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->postal_suburb) : ?>
                                <span><?php echo $supplier_information->postal_suburb;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->postal_postcode) : ?>
                                <span><?php echo $supplier_information->postal_postcode;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->postal_state) : ?>
                                <span><?php echo $supplier_information->postal_state;?></span><br>
                                <?php endif; ?>
                                <?php if($supplier_information->postal_country) : ?>
                                <span><?php echo $supplier_information->postal_country;?></span>
                                <?php endif; ?>
                            </address>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>