<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
if (isset($_SESSION['userid'])) {
    $userid = $_SESSION['userid'];
    $user_id = $_SESSION['userid'];
    $authority = $_SESSION['admin_type'];
    $admin_name = $_SESSION['admin_name'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta
            content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
            name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"
              type="text/css" />
        <!-- Font Awesome -->
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet"
              href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
               folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->


    </head>
    <body class="sidebar-mini  skin-black">

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="index.php" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>T</b>Bd</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>Time</b>Bound</span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                </nav>
            </header> 

            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <!-- <div class="user-panel">
                       <div class="pull-left image">
                         <img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                       </div>
                     </div> -->
                    <!-- search form -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">

                        <li>
                            <a href="city.php">
                                <i class="fa fa-location-arrow"></i> <span>Sector</span> 
                            </a></li>

                            <li>
                                <a href="servicetax.php">
                                <i class="fa fa-inr"></i> <span>Service Tax</span> 
                            </a></li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-user"></i>
                                <span>Customer</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="customer_add.php"><i class="fa fa-circle-o"></i> Customer Add</a></li>
                                <li><a href="customer_list.php"><i class="fa fa-circle-o"></i> Customer</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-inr"></i>
                                <span>Service Tax</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="servicetax_add.php"><i class="fa fa-circle-o"></i> Service Tax Add</a></li>
                                <li><a href="servicetax_list.php"><i class="fa fa-circle-o"></i> Service Tax</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-inr"></i>
                                <span>Customer Rate</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="customer_rate_add.php"><i class="fa fa-circle-o"></i> Rate Add</a></li>
                                <li><a href="customer_rate_list.php"><i class="fa fa-circle-o"></i> Rate</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-inr"></i>
                                <span>CD Entry</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="cdentry_add.php"><i class="fa fa-circle-o"></i>CD Entry Add</a></li>
                                <li><a href="cdentry_list.php"><i class="fa fa-circle-o"></i>CD Entry</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-inr"></i>
                                <span>Invoice</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="invoice_add.php"><i class="fa fa-circle-o"></i> Invoice Add</a></li>
                                <li><a href="invoice_list.php"><i class="fa fa-circle-o"></i>Invoice </a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-inr"></i>
                                <span>Payment</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="payment_add.php"><i class="fa fa-circle-o"></i> Payment Add</a></li>
                                <li><a href="payment_list.php"><i class="fa fa-circle-o"></i>Payment</a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-building"></i>
                                <span>Company Profile</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="company_profile_add.php"><i class="fa fa-circle-o"></i> Company Profile Add</a></li>
                                <li><a href="company_profile_list.php"><i class="fa fa-circle-o"></i> Company Profile </a></li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="upload_new.php">
                                <i class="fa fa-upload"></i> <span>Upload</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="send_mail.php">
                                <i class="fa fa-envelope-o"></i> <span>Send Mail</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="db_backup.php">
                                <i class="fa fa-database"></i> <span>DB Backup</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
        </div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">