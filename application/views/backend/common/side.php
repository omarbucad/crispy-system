<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    <div class="icon fa fa-paper-plane"></div>
                    <div class="title"><?php echo $application_name; ?></div>
                </a>
                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                    <i class="fa fa-times icon"></i>
                </button>
            </div>
            <ul class="nav navbar-nav">
                <li class="<?php echo ($this->uri->segment(2) == 'welcome' OR $this->uri->segment(2) == '') ? "active" : "" ;?>">
                    <a href="<?php echo site_url('app/welcome'); ?>">
                        <span class="icon fa fa-home"></span><span class="title">Home</span>
                    </a>
                </li>
                <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'pos') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#dropdown-element-sell">
                        <span class="icon fa fa-keyboard-o"></span><span class="title">Sell</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-sell" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/pos/sell"); ?>">Sell</a></li>
                                <li><a href="<?php echo site_url("app/pos/z-report"); ?>">Open / Close</a></li>
                                <li><a href="<?php echo site_url("app/pos/sales-report"); ?>">Sales Report</a></li>
                                <li><a href="<?php echo site_url("app/pos/cash-management"); ?>">Cash Management</a></li>
                                <li><a href="<?php echo site_url("app/pos/status"); ?>">Status</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="">
                        <span class="icon fa fa-money"></span><span class="title">Sales Ledger</span>
                    </a>
                </li>
                <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'reporting') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#dropdown-element-reporting">
                        <span class="icon fa fa-area-chart"></span><span class="title">Reporting</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-reporting" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/reporting/retail-dashboard"); ?>">Retail Dashboard</a></li>
                                <li><a href="<?php echo site_url("app/reporting/sales-report"); ?>">Sales Report</a></li>
                                <li><a href="<?php echo site_url("app/reporting/inventory-reports"); ?>">Inventory Reports</a></li>
                                <li><a href="<?php echo site_url("app/reporting/payment-reports"); ?>">Payment Reports</a></li>
                                <li><a href="<?php echo site_url("app/reporting/register-closures"); ?>">Register Closures</a></li>
                                <li><a href="<?php echo site_url("app/reporting/tax-reports"); ?>">Tax Reports</a></li>
                                <li><a href="<?php echo site_url("app/reporting/employee-reports"); ?>">Employee Reports</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'products') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#dropdown-element-products">
                        <span class="icon fa fa-tags"></span><span class="title">Products</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-products" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/products"); ?>">Products</a></li>
                                <li><a href="<?php echo site_url("app/products/stock-control"); ?>">Stock Control</a></li>
                                <li><a href="<?php echo site_url("app/products/price-books"); ?>">Price Books</a></li>
                                <li><a href="<?php echo site_url("app/products/types"); ?>">Product Types</a></li>
                                <li><a href="<?php echo site_url("app/products/supplier"); ?>">Supplier</a></li>
                                <li><a href="<?php echo site_url("app/products/brands"); ?>">Brands</a></li>
                                <li><a href="<?php echo site_url("app/products/tags"); ?>">Product Tags</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- Dropdown-->
                <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'customer') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#component-element-customer">
                        <span class="icon fa fa-users"></span><span class="title">Customer</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="component-element-customer" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/customer"); ?>">Customer</a>
                                </li>
                                <li><a href="<?php echo site_url("app/customer/groups"); ?>">Groups</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                 <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'timetracker') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#dropdown-element-timetracker">
                        <span class="icon fa fa-clock-o"></span><span class="title">Timetracker</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-timetracker" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/timetracker"); ?>">Dashboard</a></li>
                                <li><a href="<?php echo site_url("app/timetracker/shift-management"); ?>">Shift Management</a></li>
                                <li><a href="<?php echo site_url("app/timetracker/employee"); ?>">Employee</a></li>
                                <li><a href="<?php echo site_url("app/timetracker/payslip"); ?>">Payslip</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- Dropdown-->
                <li class="panel panel-default dropdown <?php echo ($this->uri->segment(2) == 'setup') ? "active" : "" ;?>">
                    <a data-toggle="collapse" href="#dropdown-element-setup">
                        <span class="icon fa fa-slack"></span><span class="title">Setup</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-element-setup" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="<?php echo site_url("app/setup/general"); ?>">General</a></li>
                                <li><a href="<?php echo site_url("app/setup/account/manage"); ?>">Account</a></li>
                                <li><a href="<?php echo site_url("app/setup/outlets-and-registers"); ?>">Outlets And Registers</a></li>
                                <li><a href="<?php echo site_url("app/setup/sales-taxes"); ?>">Sales Taxes</a></li>
                                <li><a href="<?php echo site_url("app/setup/users"); ?>">Users</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>