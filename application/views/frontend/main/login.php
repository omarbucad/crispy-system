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
    <style type="text/css">
        body.login-page {
            background: url("<?php echo site_url('public/img/app-header-bg.jpg') ?>") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                        <i class="login-logo fa fa-connectdevelop fa-5x"></i>
                        <h4 class="login-title"><?php echo $application_name; ?></h4>
                    </div>
                    <div class="col-sm-12">
                        <div class="login-body">
                            <div class="progress" id="login-progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    Log In...
                                </div>
                            </div>
                            <form action="<?php echo site_url("login/do_login"); ?>" method="POST">
                                <input type="hidden" name="<?php echo $csrf_token_name; ?>" value="<?php echo $csrf_hash; ?>">
                                <div class="control">
                                    <input type="text" name="username" class="form-control" value="admin@gmail.com" />
                                </div>
                                <div class="control">
                                    <input type="password" name="password" class="form-control" value="123456" />
                                </div>
                                <div class="login-button text-center">
                                    <input type="submit" class="btn btn-primary" value="Login">
                                </div>
                            </form>
                        </div>
                        <div class="login-footer">
                            <span class="text-right"><a href="<?php echo site_url("login/forgot-password"); ?>" class="color-white">Forgot password?</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Libs -->

    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/Chart.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/bootstrap-switch.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/jquery.matchHeight-min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('public/lib/js/select2.full.min.js') ?>"></script>

    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo site_url('public/js/app.js') ?>"></script>

</body>

</html>
