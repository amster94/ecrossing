<?php
require_once "../includes/service/appvars.php";
$page_title = basename($_SERVER['PHP_SELF']);
$page_title = str_replace(".php","",$page_title);
$page_title = str_replace("-"," ",$page_title);
$page_title = ucwords($page_title);

//----------------- START THE SESSION --------------------------------------//
if(!isset($_SESSION)) {
        session_start();
}
if(!isset($_SESSION['ecrossing_admin_email'])) {
    header('Location: '.SITE_BASE_URL.'admin-login.php');
} else {
    $page_title = basename($_SERVER['PHP_SELF']);
    $page_title = str_replace(".php","",$page_title);
    $page_title = str_replace("-"," ",$page_title);
    $page_title = ucwords($page_title);
}
// $_SESSION['greetstore_affiliate_name']="User";
// $_SESSION['greetstore_affiliate_email']="user@email.com";
// if(!isset($_SESSION['greetstore_affiliate_email']) || !isset($_SESSION['greetstore_affiliate_email'])) {
//     $home = SITE_BASE_URL."index";
//     header("Location:".$home);
// }

?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../images/site-images/favicon.ico">
<link rel="icon" type="image/png" sizes="96x96" href="../images/site-images/favicon.ico">
<link rel="shortcut icon" type="image/x-icon" href="../images/site-images/favicon.jpg" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Employee Crossing Admin Panel</title>
    <meta name="robots" content="noindex,nofollow" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Animation library for notifications   -->
    <link href="<?php echo SITE_BASE_URL; ?>css/animate.min.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link rel="stylesheet " type="text/css" href="<?php echo SITE_BASE_URL; ?>css/font-awesome.min.css" />
    <link rel="stylesheet " type="text/css" href="<?php echo SITE_BASE_URL; ?>css/bootstrap-3.3.7.min.css">
    <!--  Paper Dashboard core CSS    -->
    <link href="<?php echo SITE_BASE_URL; ?>css/paper-dashboard.css" rel="stylesheet"/>
    <link rel="stylesheet " type="text/css" href="<?php echo SITE_BASE_URL; ?>css/custom.css">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo SITE_BASE_URL; ?>css/datatables/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo SITE_BASE_URL; ?>css/datatables/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <!-- <link href="<?php echo SITE_BASE_URL; ?>css/datatables/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet"> -->
    <link href="<?php echo SITE_BASE_URL; ?>css/datatables/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- Scripts -->
    <script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>js/jquery-ui.min.js" ></script>
    <script type="text/javascript" src="<?php echo SITE_BASE_URL; ?>js/bootstrap-3.3.7.min.js" ></script>

</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
    <!--
        Tip 1: you can change the color of the sidebar's background using: data-background-color="white | black"
        Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://www.ecrossings.in" class="simple-text">
                     <img src="<?php echo SITE_BASE_URL; ?>images/logo.png" class="img-responsive" alt="Ecrossing Logo"> 
                </a>
            </div>
            <ul class="nav">
                <li class="active">
                    <a href="<?php echo SITE_BASE_URL; ?>admin-panel/dashboard.php">
                        <i class="ti-panel"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SITE_BASE_URL; ?>admin-panel/update-bgv-request.php">
                        <i class="ti-panel"></i>
                        <p>Update BGV Request</p>
                    </a>
                </li>
                <li>
                    <a href="<?php echo SITE_BASE_URL; ?>admin-panel/add-new-client.php">
                        <i class="ti-panel"></i>
                        <p>Add New Client</p>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo SITE_BASE_URL; ?>admin-panel/upload-employee-report.php">
                        <i class="ti-user"></i>
                        <p>Upload Employee Report</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="<?php echo SITE_BASE_URL; ?>admin-panel/raise-query.php">
                        <i class="ti-view-list-alt"></i>
                        <p>Raise Query</p>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="affiliates.php">
                        <i class="ti-text"></i>
                        <p>Other Affiliates</p>
                    </a>
                </li>
                <li>
                    <a href="custom-order.php">
                        <i class="ti-map"></i>
                        <p>Custom Order</p>
                    </a>
                </li>
                <li>
                    <a href="affiliates-terms.php">
                        <i class="ti-map"></i>
                        <p>Affiliates Terms</p>
                    </a>
                </li>
                <li class="active-pro">
                    <a href="utility/Logout.php">
                        <i class="ti-export"></i>
                        <p>Logout</p>
                    </a>
                </li> -->
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid" style="background-color : #ffa600;color:#FFF;">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle pull-left">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="color:#FFF;"><?php echo $page_title;  ?></a>
                </div>
                <div class="collapse navbar-collapse" >
                    <ul class="nav navbar-nav navbar-right" >
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:#FFF;">
                                    <i class="ti-bell"></i>
                                    <p class="notification">Hi</p>
                                    <p><?php echo $_SESSION['ecrossing_admin_name']; ?></p>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu" style="color:#FFF;">
                                <!-- <li><a href="dashboard">Dashboard</a></li>
                                <li><a href="verify-account">Verify Account</a></li>
                                <li><a href="affiliates">Other Affiliates</a></li>
                                <li><a href="coupon">Assigned Coupons</a></li> -->
                                <li><a href="<?php echo SITE_BASE_URL."admin-panel/logout.php" ?>">Logout</a></li>
                              </ul>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
