<!DOCTYPE html>
<html>

<head>
    <title><?php echo $website_title; ?></title>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->

    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/font-awesome.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/animate.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/bootstrap-switch.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/checkbox3.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/lib/css/select2.min.css') ?>">

    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/style.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo site_url('public/css/themes/flat-blue.css') ?>">

</head>

<body class="flat-blue">
    <div class="app-container">
        <div class="row content-container">
            <?php $this->load->view("common/header"); ?>
            <?php $this->load->view("common/side"); ?>
            <!-- Main Content -->

            <?php $this->load->view($main_page); ?>
        </div>
        <?php $this->load->view("common/footer"); ?>
    <div>
    <!-- Javascript Libs -->

    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap-switch.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.matchHeight-min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/select2.full.min.js') ?>"></script>

    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo site_url('public/js/app.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/js/index.js') ?>"></script>

</body>

</html>
