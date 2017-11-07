<script type="text/javascript">
    $(document).on('click' , '.customer-row' , function(){
        if($(this).hasClass("active")){
            $(this).removeClass("active");
            $(this).next().addClass("hidden");
            $(this).next().removeClass("open");
        }else{
            $(this).addClass("active");
            $(this).next().removeClass("hidden");
            $(this).next().addClass("open");
        }
    });

    $(document).on('click' , '.more-filter' , function(){
        var val = $(this).data('value');

        if(val == "hidden"){
            $(this).data("value" , "show");
            $('#view_advance_search').removeClass("hide");
            $(this).text("Less Filter");
            $('#_advance_search_value').val("true");
        }else{
            $(this).data("value" , "hidden");
            $('#view_advance_search').addClass("hide");
            $(this).text("More Filter");
             $('#_advance_search_value').val("false");
        }
    });
</script>

<div class="container-fluid margin-bottom">
    <div class="side-body padding-top">

        <div class="container">
        	<h1>Customers</h1>
        </div>
        <div class="grey-bg">
            <div class="container ">
                <div class="row no-margin-bottom">
                    <div class="col-xs-12 col-lg-8 no-margin-bottom">
                        <span>Manage your customers and their balances, or segment them by demographics and spending habits. <a href="#" class="text-underline">need help?</a></span>
                    </div>
                    <div class="col-xs-12 col-lg-4 text-right no-margin-bottom">
                        <a href="<?php echo site_url('app/customer/import-customer'); ?>" class="btn btn-info ">Import Customers</a>
                        <a href="<?php echo site_url('app/customer/add-customer'); ?>" class="btn btn-success ">Add Customers</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card margin-bottom">
            <div class="container">
                <div class="card-body no-padding-left no-padding-right">
                    <form action="#" method="POST">
                        <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                        <input type="hidden" name="_advance_search_value" id="_advance_search_value" value="false">
                        <div class="row">
                            <div class="col-xs-12 col-lg-6 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_name">Search customers by name, customer code, or contact details</label>
                                    <input type="text" name="name" class="form-control" id="s_name" placeholder="Enter customers by name, customer code, or contact details">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 no-margin-bottom">
                                <div class="form-group">
                                    <label for="s_roles">Customer Group</label>
                                    <select class="form-control" id="s_roles">
                                        <?php foreach($customer_group_list as $row) : ?>
                                            <option value="<?php echo $row->group_id; ?>"><?php echo $row->group_name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3 text-right no-margin-bottom">
                                <button type="button" class="btn btn-link btn-vertical-center btn-same-size more-filter" data-value="hidden">More filter</button>
                                <input type="submit" name="submit" value="Apply Filter" class="btn btn-primary btn-vertical-center btn-same-size">
                            </div>
                        </div>
                        <div class="row hide" id="view_advance_search">
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">City</label>
                                    <input type="text" name="city" placeholder="City" class="form-control">
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Country</label>
                                    <select class="form-control" name="country">
                                        <?php foreach($countries_list as $code =>  $country) : ?>
                                            <option value="<?php echo $code; ?>"><?php echo $country?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-lg-3">
                                <div class="form-group">
                                    <label for="s_city">Date Created</label>
                                    <input type="text" name="date_created" placeholder="Date Created" class="form-control daterange">
                                </div>
                            </div>
                        </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="customer-table-showing">
                <span class="pull-left">
                    <small >Showing <?php echo count($customer_list); ?> customer</small>
                </span>
                <a href="#" class="btn btn-primary pull-right"><i class="fa fa-cloud-download" aria-hidden="true"></i> Export List</a>
            </div>
            <table class="customer-table">
                <thead>
                    <tr>
                        <th width="40%">
                            <a href="#">Customer <i class="fa fa-sort-alpha-asc" aria-hidden="true"></i></a>
                        </th>
                        <th width="25%">Location</th>
                        <th width="15%" class="text-right">Store Credit</th>
                        <th width="15%" class="text-right">Account</th>
                        <th width="5%" class="text-right"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customer_list as $key => $row) : ?>
                        <tr class="customer-row">
                            <td>
                                <div>
                                    <span class="customer-name"><?php echo ($row->company) ? $row->company.' , ' : "" ; ?><?php echo $row->display_name; ?> </span>
                                    <span class="label label-success"><?php echo $row->group_name; ?></span>
                                </div>
                                <div>
                                    <small><?php echo $row->customer_code; ?> <?php echo ($row->email) ? ' | '.$row->email : "" ; ?></small>
                                </div>
                            </td>
                            <td>
                                <span>
                                    <?php if($row->physical_suburb) : ?>
                                        <?php echo $row->physical_suburb; ?> ,
                                    <?php endif; ?>
                                    <?php if($row->physical_city) : ?>
                                        <?php echo $row->physical_city; ?> ,
                                    <?php endif; ?>
                                    <?php if($row->physical_state) : ?>
                                        <?php echo $row->physical_state; ?> ,
                                    <?php endif; ?>
                                    <?php echo $row->physical_country; ?>
                                </span>
                            </td>
                            <td class="text-right">
                                <span>0.00</span>
                            </td>
                            <td class="text-right">
                                <span>0.00</span>
                            </td>
                            <td class="text-center">
                                <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                        <tr class="customer-info hidden">
                            <td colspan="5">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-5">
                                        <legend class="text-uppercase">CUSTOMER PROFILE</legend>
                                         <dl class="dl-horizontal">
                                        <?php if($row->gender OR $row->date_of_birth ) : ?>
                                            <?php if($row->gender) : ?>
                                                <dt>Gender</dt>
                                                <dd><?php echo $row->gender; ?></dd>
                                            <?php endif; ?>

                                            <?php if($row->date_of_birth) : ?>
                                                <dt>Date of Birth</dt>
                                                <dd><?php echo $row->date_of_birth; ?></dd>
                                            <?php endif; ?>

                                            <?php if($row->field_1 OR $row->field_2 OR $row->field_3 OR $row->field_4)  : ?>
                                                <dt>Custom fields</dt>
                                                <dd>
                                                    <table class="table">
                                                        <?php if($row->field_1) : ?>
                                                            <tr>
                                                                <td><strong>1</strong></td>
                                                                <td><?php echo $row->field_1; ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php if($row->field_2) : ?>
                                                            <tr>
                                                                <td><strong>2</strong></td>
                                                                <td><?php echo $row->field_2; ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php if($row->field_3) : ?>
                                                            <tr>
                                                                <td><strong>3</strong></td>
                                                                <td><?php echo $row->field_3; ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                        <?php if($row->field_4) : ?>
                                                            <tr>
                                                                <td><strong>4</strong></td>
                                                                <td><?php echo $row->field_4; ?></td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </table>
                                                </dd>
                                            <?php endif; ?>

                                        <?php else : ?>
                                            <h5 class="text-center">You have no records to help you target this customer. <br>
                                                <small>Enter custom notes about a customer – like preferences, common requests, and important requirements – so staff can create a tailored service or shopping experience.</small>
                                            </h5>
                                        <?php endif; ?>

                                        <legend class="text-uppercase">CONTACT INFO</legend>
                                        <dl class="dl-horizontal">
                                            <?php if($row->fax) : ?>
                                                <dt>Fax</dt>
                                                <dd><?php echo $row->fax; ?></dd>
                                            <?php endif; ?>
                                            <?php if($row->phone) : ?>
                                                <dt>Phone</dt>
                                                <dd><?php echo $row->phone; ?></dd>
                                            <?php endif; ?>
                                            <?php if($row->email) : ?>
                                                <dt>Email</dt>
                                                <dd><?php echo $row->email; ?></dd>
                                            <?php endif; ?>
                                            <?php if($row->website) : ?>
                                                <dt>Website</dt>
                                                <dd><?php echo $row->website; ?></dd>
                                            <?php endif; ?>
                                            <?php if($row->twitter) : ?>
                                                <dt>Twitter</dt>
                                                <dd><?php echo $row->twitter; ?></dd>
                                            <?php endif; ?>
                                            <?php if($row->facebook) : ?>
                                                <dt>Facebook</dt>
                                                <dd><?php echo $row->facebook; ?></dd>
                                            <?php endif; ?>
                                            <dt>Postal Address</dt>
                                            <dd>
                                                <address>
                                                    <?php if($row->physical_street1) : ?>
                                                        <span><?php echo $row->physical_street1; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_street2) : ?>
                                                        <span><?php echo $row->physical_street2; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_suburb) : ?>
                                                        <span><?php echo $row->physical_suburb; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_city) : ?>
                                                        <span><?php echo $row->physical_city; ?>  </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_postcode) : ?>
                                                        <span><?php echo $row->physical_postcode; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_state) : ?>
                                                        <span><?php echo $row->physical_state; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->physical_country) : ?>
                                                        <span><?php echo $row->physical_country; ?> </span>
                                                    <?php endif; ?>
                                                </address>
                                            </dd>
                                            <dt>Physical Address</dt>
                                            <dd>
                                                <address>
                                                    <?php if($row->postal_street1) : ?>
                                                        <span><?php echo $row->postal_street1; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_street2) : ?>
                                                        <span><?php echo $row->physical_street2; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_suburb) : ?>
                                                        <span><?php echo $row->postal_suburb; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_city) : ?>
                                                        <span><?php echo $row->postal_city; ?>  </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_postcode) : ?>
                                                        <span><?php echo $row->postal_postcode; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_state) : ?>
                                                        <span><?php echo $row->postal_state; ?> , </span>
                                                    <?php endif; ?>
                                                    <?php if($row->postal_country) : ?>
                                                        <span><?php echo $row->postal_country; ?> </span>
                                                    <?php endif; ?>
                                                </address>
                                            </dd>
                                        </dl>
                                        <?php if($row->notes) : ?>
                                            <legend class="text-uppercase">NOTES</legend>
                                            <p><?php echo $row->notes; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-xs-12 col-lg-4">
                                        <legend class="text-uppercase">BALANCE</legend>
                                        <table style="width: 100%;margin-bottom: 10px;">
                                            <tr>
                                                <th>Account</th>
                                                <th class="text-right">0.00</th>
                                            </tr>
                                            <tr>
                                                <td>Total Spent</td>
                                                <td class="text-right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Last 12 Months</td>
                                                <td class="text-right">0.00</td>
                                            </tr>
                                        </table>
                                        <table style="width: 100%;margin-bottom: 10px;">
                                            <tr>
                                                <th>Store Credit</th>
                                                <th class="text-right">0.00</th>
                                            </tr>
                                            <tr>
                                                <td>Total Issued</td>
                                                <td class="text-right">0.00</td>
                                            </tr>
                                            <tr>
                                                <td>Total Redeemed</td>
                                                <td class="text-right">0.00</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-lg-3 text-left last">
                                        <a href="#"><i class="fa fa-pencil" aria-hidden="true"></i> Edit Customer</a>
                                    </div>
                                    
                                </div>
                                <div class="text-left col-xs-12 col-lg-3 col-lg-offset-9">
                                    <div class="btn-edit-container">
                                        <a href="#"><i class="fa fa-print" aria-hidden="true"></i> Print Customer</a>
                                        <a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i> View Sales History</a>
                                        <a href="#"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>    
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2" width="65%">
                            All Customers (<?php echo $config['total_rows']; ?>)
                        </th>
                        <th width="15%" class="text-right">0.00</th>
                        <th width="15%" class="text-right">0.00</th>
                        <th width="5%"></th>
                    </tr>
                </tfoot>
            </table>
            <div class="customer-table-showing margin-bottom">
                <span class="pull-left">
                    <?php 
                        $x = 1;

                        if( $this->input->get("per_page") ){
                            $x = $this->input->get("per_page") + 1;
                        }

                    ?>
                    <small>Displaying <?php echo $x; ?> – <?php echo ($x-1) + count($customer_list) ; ?> of <?php echo $config['total_rows']; ?></small>
                </span>
                <div class="pull-right">
                    <nav aria-label="Page navigation">
                      <?php echo $links; ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>