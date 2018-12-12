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
        <style type="text/css">
            .skin-blue .sidebar-menu>li:hover>a, .skin-blue .sidebar-menu>li.active>a {
                color: #fff;
                background: #11a7db !important;
                border-left-color: #11a7db;
                border-top: 1px solid white;
                border-bottom: 1px solid white;
            }
            .skin-blue .main-header .logo{
                display: none;
            }
            .main-sidebar{
                padding-top: 10px !important;
            }
        </style>

    </head>
    <body class="sidebar-mini  skin-blue">

        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo" style="background-color: #ECF0F5"> <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="logo2.png" style="height: 40px;"
                                                 alt="" /></span> <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b></b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top">
                    <!-- Sidebar toggle button-->

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- Messages: style can be found in dropdown.less-->

                            <!-- Notifications: style can be found in dropdown.less -->

                            <!-- Tasks: style can be found in dropdown.less -->

                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu"><a href="#" class="toggle"
                                                                   data-toggle="dropdown"> <span class="hidden-xs">Welcome <?php echo $admin_name; ?></span>

                                </a></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out"></i><span> Logout</span>
                                </a></li>
                            <!-- Control Sidebar Toggle Button -->
                        </ul>
                    </div>

                </nav>

            </header>
            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- <div class="pull-left image">
<img src="logo2.png" class="img-circle" alt="User Image" height="45px" width="45px">
</div>
<br/>-->
                    <!-- search form -->

                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu tree">

                        <img src="logo2.png" style="height: 200px;    margin-left: 50px;"
                             alt="" />
                             <?php if ($authority == "admin") { ?>

                            <li <?php if (preg_match('/dashboard.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="dashboard.php"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a></li>

         <!--<li <?php if (preg_match('/doctor.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="doctor.php"><i class="fa fa-user-md"></i><span>
                                                                        Doctor</span></a></li>-->
                            <li <?php if (preg_match('/patient.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="patient.php"><i class="fa fa-user"></i><span>
                                        Patient</span></a></li>



                            <li <?php if (preg_match('/appointment.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="appointment.php"><i class="fa fa-sticky-note"></i><span>
                                        Add Appointment</span></a></li>
                            <li <?php if (preg_match('/listappoinments.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="listappoinments.php"><i class="fa fa-sticky-note"></i><span>
                                        Appointment Lists</span></a></li>
                            <li <?php if (preg_match('/calendar.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="calendar.php"><i class="fa fa-calendar"></i><span>
                                        Calendar</span></a></li>
                            <li <?php if (preg_match('/tariff.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="tariff.php"><i class="fa fa-dollar"></i><span>
                                        Tariff</span></a></li>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i>
                                    <span>Reports</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu" style="display: none;">
                                    <li <?php if (preg_match('/totaltff.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="totaltff.php"><i class="fa fa-sticky-note"></i><span>
                                                Total Tariff</span></a></li>
                                                  <li <?php if (preg_match('/todaysapp.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="todaysapp.php"><i class="fa fa-sticky-note"></i><span>
                                                Todays Appointment List</span></a></li>
                                    <li <?php if (preg_match('/totalapp.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="totalapp.php"><i class="fa fa-sticky-note"></i><span>
                                                Appointment List</span></a></li>
                                                 <li <?php if (preg_match('/procedureslist.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="procedureslist.php"><i class="fa fa-sticky-note"></i><span>
                                                Procedures List</span></a></li>
                                </ul>
                            </li>
                            <li
                            <?php if (preg_match('/logout.php/i', $_SERVER['SCRIPT_NAME'])) { ?>
                                    class="active" <?php } ?>><a href="logout.php"><i
                                        class="fa fa-sign-out"></i><span>Logout</span> </a></li>
                            <?php } ?>
                            <?php if ($authority == "doctor") { ?>                                                      
                            <li <?php if (preg_match('/dashboard.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="dashboard.php"><i class="fa fa-dashboard"></i><span>Dashboard</span> </a></li>
                            <li <?php if (preg_match('/patient.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="patient.php"><i class="fa fa-user"></i><span>
                                        Patient</span></a></li>

                            <li <?php if (preg_match('/doc_calendar.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="doc_calendar.php"><i class="fa fa-calendar"></i><span>
                                        Today's Appointment</span></a></li>
                                      <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-pie-chart"></i>
                                    <span>Reports</span>
                                    <span class="pull-right-container">
                                        <i class="fa fa-angle-left pull-right"></i>
                                    </span>
                                </a>
                                <ul class="treeview-menu" style="display: none;">
                                    <li <?php if (preg_match('/totaltff.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="totaltff.php"><i class="fa fa-sticky-note"></i><span>
                                                Total Tariff</span></a></li>
                                                  <li <?php if (preg_match('/todaysapp.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="todaysapp.php"><i class="fa fa-sticky-note"></i><span>
                                                Todays Appointment List</span></a></li>
                                    <li <?php if (preg_match('/totalapp.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="totalapp.php"><i class="fa fa-sticky-note"></i><span>
                                                Appointment List</span></a></li>
                                                 <li <?php if (preg_match('/procedureslist.php/i', $_SERVER['SCRIPT_NAME'])) { ?> class="active" <?php } ?>><a href="procedureslist.php"><i class="fa fa-sticky-note"></i><span>
                                                Procedures List</span></a></li>
                                </ul>
                            </li>      
                        <?php } ?>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
        </div>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- Main content -->
            <section class="content">