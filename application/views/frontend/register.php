<!DOCTYPE html>
<html>

<head>
    <title><?php echo $website_title; ?></title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Favicon-->
    <link rel="icon" href="<?php echo site_url('public/img/favicon.png') ?>" type="image/x-icon">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/font-awesome.min.css') ?>">

    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/my-style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/themes/flat-green.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/progress-wizard.min.css') ?>">

</head>

<body class="flat-green landing-page">
    
    <nav class="navbar navbar-inverse navbar-fixed-top  navbar-affix" role="navigation" data-spy="affix" data-offset-top="60">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo site_url("welcome");?>">
                    <div class="icon fa fa-paper-plane"></div>
                    <div class="title"><?php echo $application_name; ?></div>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse " aria-expanded="true">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#">Help</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="<?php echo site_url("login"); ?>">Login</a></li>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </nav>

    <div class="jumbotron app-header">
        <div class="container">
            <h2 class="text-center"><div class="color-white">Start your free 30 day trial now.</div></h2>
            <p class="text-center color-white app-description">No credit card. No commitment. Just a few quick questions to set up your trial.</p>
        </div>
    </div>
    <div class="container card">
        <div class="margin-top-bottom">
            <?php if(validation_errors()) : ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <?php echo validation_errors(); ?>
                </div>
            <?php endif; ?>
            
            <div class="row text-center margin-top-bottom" id="step_1">
                <hr>
                <div class="step-indicator">
                   <ul class="progress-indicator">
                      <li class="completed"> <span class="bubble"></span> Step 1. </li>
                      <li > <span class="bubble"></span> Step 2. </li>
                      <li> <span class="bubble"></span> Step 3. </li>
                    </ul>
                </div>
                <h2>What type of retailer are you?</h2>
                <div class="retailer-container text-center">
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="Fashion & Apparel">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/clothing.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Fashion & Apparel</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="Home , Lifestyle & Gifts">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/lifestyle.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Home , Lifestyle & Gifts</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="Sports, Hobbies & Toys">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/sports.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Sports, Hobbies & Toys</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                       <div class="click-me" data-value="Health & Beauty Retail">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/healthcare.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Health & Beauty Retail</span>
                            </div>
                       </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                       <div class="click-me" data-value="Food & Drink Retail">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/food.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Food & Drink Retail</span>
                            </div>
                       </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                       <div class="click-me" data-value="Cafe & Restaurants">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/coffee.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Cafe & Restaurants</span>
                            </div>
                       </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="Other">
                            <div class="title-img">
                                <img src="<?php echo site_url("public/img/retailer/other.png"); ?>">
                            </div>
                            <div class="title-desc">
                                <span>Other</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center margin-top-bottom hide" id="step_2">
                <hr>
                <div class="step-indicator">
                   <ul class="progress-indicator">
                      <li class="completed"> <span class="bubble"></span> Step 1. </li>
                      <li class="completed"> <span class="bubble"></span> Step 2. </li>
                      <li> <span class="bubble"></span> Step 3. </li>
                    </ul>
                </div>
                <h2>How many stores do you have?</h2>
                <div class="retailer-container text-center">
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="1">
                            <div class="store-number">
                                <span>1</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="2-5">
                            <div class="store-number">
                                <span>2-5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="6-14">
                            <div class="store-number">
                                <span>6-14</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-4 col-sm-4">
                        <div class="click-me" data-value="15+">
                            <div class="store-number">
                                <span>15+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row text-center margin-top-bottom hide" id="step_3">
                <hr>
                <div class="step-indicator">
                   <ul class="progress-indicator">
                      <li class="completed"> <span class="bubble"></span> Step 1. </li>
                      <li class="completed"> <span class="bubble"></span> Step 2. </li>
                      <li class="completed"> <span class="bubble"></span> Step 3. </li>
                    </ul>
                </div>
                <h2>Nearly there!<br>A few last details to set up your store.</h2>
                <div class="text-left form-container">
                    <form action="<?php echo site_url("welcome/register"); ?>" method="POST">
                        <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                        <input type="hidden" name="retail_type" id="_retail_type">
                        <input type="hidden" name="store_quantity" id="_store_quantity">
                        <div class="form-group">
                            <label for="_store_name">Store Name</label>
                            <input type="text" name="store_name" id="_store_name" class="form-control" value="<?php echo set_value('store_name'); ?>">
                        </div>
                        <div class="form-group no-margin-bottom">
                            <div class="row">
                                <div class="col-xs-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" name="first_name" class="form-control" value="<?php echo set_value('first_name'); ?>">
                                    </div>
                                </div>
                                <div class="col-xs-6 no-margin-bottom">
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="last_name" class="form-control" value="<?php echo set_value('last_name'); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="_email_address">Email address</label>
                            <input type="email" name="email_address" id="_email_address" class="form-control" value="<?php echo set_value('email_address'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="_username">Username</label>
                            <input type="text" name="username" id="_username" class="form-control" value="<?php echo set_value('username'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="_password">Password</label>
                            <input type="password" name="password" id="_password" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="_city">City</label>
                            <input type="text" name="city" id="_city" class="form-control" value="<?php echo set_value('city'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="_phone">Phone</label>
                            <input type="text" name="phone" id="_phone" class="form-control" value="<?php echo set_value('phone'); ?>">
                        </div>
                        <div class="form-group">
                            <label for="_currency">Currency</label>
                            <select class="form-control" id="_currency" name="currency">
                                <?php foreach($world_currency as $type => $c) : ?>
                                    <optgroup label="<?php echo $type; ?>">
                                        <?php foreach($c as $code => $currency) : ?>
                                            <option value="<?php echo $code; ?>" <?php echo ($code == $this->input->post("currency")) ? "selected" : "" ; ?> ><?php echo $currency; ?></option>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="submit" name="submit" value="Start Selling with <?php echo $application_name; ?>" class="btn btn-primary btn-block text-uppercase">
                        <div class="text-center agree_terms">
                            <p>By creating your account you agree to the <br><a href="#">terms of use</a> and <a href="#">privacy policy</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /END THE FEATURETTES -->
    <!-- FOOTER -->
    <?php $this->load->view("frontend/common/footer"); ?>
    <!-- Javascript Libs -->

    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).on('click' , '#step_1 .click-me' , function(){
            $("#step_1 .click-me").removeClass("active");
            $(this).addClass("active");
            $("#step_2").removeClass("hide");
            $('#_retail_type').val($(this).data("value"));
            window.location.hash = '#step_2';
        });

        $(document).on('click' , '#step_2 .click-me' , function(){
            $("#step_2 .click-me").removeClass("active");
            $(this).addClass("active");
            $("#step_3").removeClass("hide");
            $('#_store_quantity').val($(this).data("value"));
            window.location.hash = '#step_3';
        });
    </script>
</body>

</html>
