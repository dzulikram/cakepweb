<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Portal STI Kaltimra</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>asset/adminlte/dist/img/favicon.ico">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/dist/css/skins/_all-skins.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/iCheck/flat/blue.css">
        <!-- Morris chart -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/morris/morris.css">
        <!-- jvectormap -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <!-- Date Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/datepicker/datepicker3.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/daterangepicker/daterangepicker-bs3.css">
        <!-- Bootstrap time Picker -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/timepicker/bootstrap-timepicker.min.css">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap-combined.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->

            <!-- jQuery 2.1.4 -->
            <script src="<?php echo base_url(); ?>asset/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
            <!-- jQuery 2.1.4 -->
            <script src="<?php echo base_url(); ?>asset/adminlte/plugins/chartjs/Chart.min.js"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="<?php echo base_url(); ?>asset/adminlte/plugins/jQueryUI/jquery-ui.min.js"></script>
            <!-- DataTables -->
            <script src="<?php echo base_url(); ?>asset/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="<?php echo base_url(); ?>asset/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
            <style>
                div.dataTables_filter {
                    text-align: right;
                }

            </style>

        </head>
        <body class="hold-transition skin-blue sidebar-mini">
            <div class="wrapper">

                <header class="main-header">
                    <!-- Logo -->
                    <a href="<?php echo base_url(); ?>" class="logo">
                        <!-- mini logo for sidebar mini 50x50 pixels -->
                        <span class="logo-mini"><b>P</b>TI</span>
                        <!-- logo for regular state and mobile devices -->
                        <span class="logo-lg"><b>Portal</b> TI</span>
                    </a>
                    <!-- Header Navbar: style can be found in header.less -->
                    <nav class="navbar navbar-static-top" role="navigation">
                        <!-- Sidebar toggle button-->
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                        </a>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">

                                <!-- User Account: style can be found in dropdown.less -->
                                <?php
                                $pengguna = $this->session->userdata('sesi');
                                // print_r($pengguna);
                                ?>
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img src="<?php echo base_url(); ?>asset/adminlte/dist/img/propic.png" class="user-image" alt="User Image">
                                        <span class="hidden-xs">User</span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <!-- User image -->
                                        <li class="user-header">
                                            <img src="<?php echo base_url(); ?>asset/adminlte/dist/img/propic.png" class="img-circle" alt="User Image">
                                            <p>User
                                            </p>
                                            <a href="<?php echo base_url(); ?>User/changepassword/<?php echo $pengguna->user_id; ?>" class="btn btn-default btn-flat">Change Password</a>
                                        </li>
                                        <!-- Menu Footer-->
                                        <li class="user-footer">
                                            <!-- <div class="pull-left">
                                                <a href="<?php echo base_url(); ?>page/ubah_password" class="btn btn-default btn-flat">Ubah Password</a>
                                            </div> -->
                                            <div class="pull-right">
                                                <a href="<?php echo base_url(); ?>page/logout" class="btn btn-default btn-flat">Sign out</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </header>