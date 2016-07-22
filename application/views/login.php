<!DOCTYPE html>
<html>

<head>
    <title>Flat Admin V.2 - Free Bootstrap Admin Templates</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/themes/flat-blue.css">
</head>

<body class="flat-blue login-page">
    <div class="container">
        <div class="login-box">
            <div>
                <div class="login-form row">
                    <div class="col-sm-12 text-center login-header">
                        <i class="login-logo fa fa-connectdevelop fa-5x"></i>
                        <h4 class="login-title">Pondok Traveler Login</h4>
                    </div>
                    <div class="col-sm-12">
                    <?php if(validation_errors()):?>
                       <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <?php echo validation_errors();?>
                        </div>
                    <?php endif;?>
                    <?php if($this->session->flashdata('sukses')):?>
                           <div class="alert fresh-color alert-success alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?= $this->session->flashdata('sukses');?>
                            </div>
                        <?php endif;?>
                        <?php if($this->session->flashdata('error')):?>
                           <div class="alert fresh-color alert-danger alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?= $this->session->flashdata('error');?>
                            </div>
                        <?php endif;?>
                        <div class="login-body">
                            <div class="progress hidden" id="login-progress">
                                <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    Register
                                </div>
                            </div>
                            <form method="post" action="<?php echo site_url('auth/login');?>">
                                
                                <div class="control">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?=set_value('email')?>"/>
                                </div>
                                
                                <div class="control">
                                    <input type="password" class="form-control" name="password" placeholder="Password" />
                                </div>
                                <div class="login-button text-center">
                                    <input type="submit" class="btn btn-primary" value="Login">
                                </div>
                            </form>
                        </div>
                        <div class="login-footer">
                        <a href="<?=site_url('auth/register');?>" class="btn btn-info">Register</a>
                            <!-- <span class="text-center"><a href="#" class="color-white">Login</a></span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Javascript Libs -->
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/Chart.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/bootstrap-switch.min.js"></script>
    
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/jquery.matchHeight-min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/ace/ace.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/ace/mode-html.js"></script>
    <script type="text/javascript" src="<?php echo asset_url();?>lib/js/ace/theme-github.js"></script>
    <!-- Javascript -->
    <script type="text/javascript" src="<?php echo asset_url();?>js/app.js"></script>
</body>

</html>