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
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/animate.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/sweetalert2.min.css') ?>">

    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />

    
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/my-style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/themes/flat-green.css') ?>">



    <!-- Javascript Libs -->

    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/sweetalert2.all.min.js') ?>"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo site_url('public/js/app.js') ?>"></script>
</head>

<body class="flat-green">
    <div class="app-container">
        <div class="row content-container">
            <?php $this->load->view("backend/common/header"); ?>
            <?php $this->load->view("backend/common/side"); ?>
            <!-- Main Content -->
            <?php if(validation_errors()) : ?>
                <div class="container-fluid" id="alert_container_remove">
                    <div class="side-body padding-top">
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="closed_alert"><span aria-hidden="true">×</span></button>
                            <?php echo validation_errors(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php $this->load->view($main_page); ?>
        </div>
        <?php $this->load->view("backend/common/footer"); ?>
    <div>
    
</body>

</html>
