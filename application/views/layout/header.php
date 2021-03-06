<!DOCTYPE html>
<html>

<head>
    <title>Pondok Traveler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <!-- CSS Libs -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/bootstrap-switch.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/bootstrap-datepicker3.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/checkbox3.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>lib/css/select2.min.css">
    <!-- CSS App -->
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo asset_url();?>css/themes/flat-green.css">
</head>

<body class="flat-green">
    <div class="app-container">
        <div class="row content-container">
            <nav class="navbar navbar-default navbar-fixed-top navbar-top navbar-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-expand-toggle">
                            <i class="fa fa-bars icon"></i>
                        </button>
                        <ol class="breadcrumb navbar-breadcrumb">
                            <li class="active">Dashboard</li>
                        </ol>
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-th icon"></i>
                        </button>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                            <i class="fa fa-times icon"></i>
                        </button>
                       <!--  <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="title">
                                    Notification <span class="badge pull-right">0</span>
                                </li>
                                <li class="message">
                                    No new notification
                                </li>
                            </ul>
                        </li> -->
                        <!-- <li class="dropdown danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                            <ul class="dropdown-menu danger  animated fadeInDown">
                                <li class="title">
                                    Notification <span class="badge pull-right">4</span>
                                </li>
                                <li>
                                    <ul class="list-group notifications">
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item">
                                                <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                            </li>
                                        </a>
                                        <a href="#">
                                            <li class="list-group-item message">
                                                view all
                                            </li>
                                        </a>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        <li class="dropdown profile danger">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=$this->session->userdata('data')['nama'];?> <span class="caret"></span></a>
                            <ul class="dropdown-menu animated fadeInDown">
                                <li class="profile-img">
                                    <!-- <img src="../img/profile/picjumbo.com_HNCK4153_resize.jpg" class="profile-img"> -->
                                </li>
                                <li>
                                    <div class="profile-info">
                                        <h4 class="username"><?=$this->session->userdata('data')['nama'];?></h4>
                                        <p><?=$this->session->userdata('data')['email'];?></p>
                                        <div class="btn-group margin-bottom-2x" role="group">
                                            <!-- <button type="button" class="btn btn-default"><i class="fa fa-user"></i> Profile</button> -->
                                            <a href="<?=site_url('auth/logout');?>" class="btn btn-default"><i class="fa fa-sign-out"></i> Logout</a>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="side-menu sidebar-inverse">
                <nav class="navbar navbar-default" role="navigation">
                    <div class="side-menu-container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="#">
                                <div class="icon fa fa-paper-plane"></div>
                                <div class="title">Pondok Traveler</div>
                            </a>
                            <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                                <i class="fa fa-times icon"></i>
                            </button>
                        </div>
                        <ul class="nav navbar-nav" id="menu-siderbar">
                            <li>
                                <a href="<?=site_url('home');?>">
                                    <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>

                                </a>
                            </li>
                            <?php if(($this->session->userdata('jabatan') == 1)): ?>
                            <li>
                                <a href="<?= site_url('alat')?>">
                                    <span class="icon fa fa-desktop"></span><span class="title">Data Alat</span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('customer')?>">
                                    <span class="icon fa fa-users"></span><span class="title">Data Customer</span>
                                    <span class="label label-primary pull-right datacustomer-admin"></span>
                                </a>
                            </li>

                            <li>
                                <a href="<?= site_url('employees')?>">
                                    <span class="icon fa fa-user"></span><span class="title">Data Pegawai</span>
                                </a>
                            </li>
                        <?php endif;?>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-element">
                                    <span class="icon fa fa-shopping-cart"></span><span class="title">Sewa</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-element" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                        <?php if(($this->session->userdata('status') == 'user') || ($this->session->userdata('data')['jabatan'] == '3')):?>
                                            <li><a href="<?= site_url('sewa/add')?>">List Alat</a>
                                            </li>
                                        <?php endif;?>
                                            <li><a href="<?= site_url('sewa/lists')?>">List Sewa</a>
                                            <?php if($this->session->userdata('data')['jabatan'] == '1'):?>
                                            <span class="label label-primary pull-right data-sewa-to-admin"></span>
                                        <?php endif;?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <?php if(($this->session->userdata('jabatan') == 1) || ($this->session->userdata('jabatan') == 2) || $this->session->userdata('status') == 'user'): ?>
                            <li class="panel panel-default dropdown">
                                <a data-toggle="collapse" href="#dropdown-element-bayar">
                                    <span class="icon fa fa-archive"></span><span class="title">Pembayaran</span>
                                </a>
                                <!-- Dropdown level 1 -->
                                <div id="dropdown-element-bayar" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul class="nav navbar-nav">
                                        <?php if($this->session->userdata('status') == 'user'):?>
                                            <li><a href="<?= site_url('payment/add')?>">Input Bukti Pembayaran</a>
                                            </li>
                                        <?php endif;?>
                                            <li><a href="<?= site_url('payment/lists')?>">List Pembayaran</a>
                                            <span class="label label-primary pull-right"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        <?php endif;?>
                        <?php if($this->session->userdata('data')['jabatan'] == '3'):?>
                            <li>
                                <a href="<?= site_url('payment/pelunasan')?>">
                                    <span class="icon fa fa-archive"></span><span class="title">Input Bukti Pelunasan</span>
                                </a>
                            </li>
                        <?php endif;?>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </nav>
            </div>
            <!--UNTUK KONTEN-->