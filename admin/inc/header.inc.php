<?php
session_start();
if (isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']['STATUS'] != '') {}
else { header('location:./');die(); }
include_once ('../controllers/classes/Admin.class.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mainlandsolar Admin Dashboard">
    <meta name="keywords" content="admin Dashboard, Mainlandsolar admin template, responsive Mainlandsolar admin dashboard, web app">
    <meta name="author" content="pixelstrap">
    <base href="http://localhost/mainlandsolar/admin/">
    <link rel="icon" href="./assets/img/favicon.png" type="image/x-icon" sizes="16x16">
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon" sizes="16x16">
    <title>Mainlandsolar - Admin Dashboard</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/flag-icon.css">
    <link rel="stylesheet" type="text/css" href="https://allyoucan.cloud/cdn/icofont/1.0.1/icofont.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/prism.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/vector-map.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/datatables.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/admin.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <style>
        form .error {color: #e74c3c;border-color: #e74c3c !important;}
        form label.error{font-size: 0.8rem;}
    </style>
    <style>
        .checkdate {margin: 0 auto 30px;padding: 20px 20px;border: 1px solid #ebeef1;background-color: #F6F9FC;}
        input.form-control,.custom-select,textarea{border-radius: 0 !important;}
        .custom-select:focus,
        textarea:focus,
        textarea.form-control:focus,
        input.form-control:focus,
        input[type=text]:focus,
        input[type=password]:focus,
        input[type=email]:focus,
        input[type=number]:focus,
        [type=text].form-control:focus,
        [type=password].form-control:focus,
        [type=email].form-control:focus,
        [type=tel].form-control:focus,
        select.custom-select:focus,
        [contenteditable].form-control:focus {
            box-shadow: inset 0 -1px 0 #ddd;
        }
    </style>
</head>

<body>
<!-- page-wrapper Start-->
<div class="page-wrapper">
    <!-- Page Header Start-->
    <div class="page-main-header no-print-widget">
        <div class="main-header-left">
            <div class="logo-wrapper"><a href="dashboard"><img class="blur-up lazyloaded" src="./assets/img/favicon.png" style="width: 70px; height: 70px;" alt=""></a></div>
        </div>
        <div class="main-header-right row">
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch">
                        <input id="sidebar-toggle" type="checkbox" checked="checked"><span class="switch-state"></span>
                    </label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="onhover-dropdown">
                        <i data-feather="bell"></i>
                        <?=($admin->count_new_order() > 0) ?
                            '<span class="badge badge-pill badge-primary pull-right notification-badge">'.$admin->count_new_order().'</span><span class="dot"></span>'
                            :''; ?>
                        <?php if ($admin->count_new_order() > 0) { ?>
                            <ul class="notification-dropdown onhover-show-div p-0">
                                <li>
                                    <div class="media">
                                        <div class="notification-icons bg-secondary mr-3"><i data-feather="download"></i></div>
                                        <a href="orders">
                                            <div class="media-body">
                                                <h6 class="font-secondary">View Latest Orders</h6>
                                                <p class="mb-0"> At: <?= date('j M, y H:ia', strtotime($admin->get_last_order_time()));?></p>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        <?php } ?>
                    </li>
                    <li></li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center">
                            <img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="./assets/img/dashboard/avatar.png" alt="header-user">
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><label class="text-success font-weight-bold mb-0"><?= $_SESSION['ADMIN_LOGIN']['ADMIN_USERNAME']; ?></label></li>
                            <li><a href="profile">Profile<span class="pull-right"><i data-feather="user"></i></span></a></li>
                            <li></li>
                            <li><a href="logout">Logout<span class="pull-right"><i data-feather="settings"></i></span></a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper no-print-widget">
        <!-- Page Sidebar Start-->
        <div class="page-sidebar no-printme">
            <div class="sidebar custom-scrollbar">
                <div class="sidebar-user text-center">
                    <h6 class="mt-3 f-14">Admin Menu</h6>
                    <p><?= $_SESSION['ADMIN_LOGIN']['ADMIN_USERNAME']; ?></p>
                </div>
                <ul class="sidebar-menu">
                    <li><a class="sidebar-header" href="dashboard"><i data-feather="home"></i><span>Dashboard</span></a></li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="box"></i><span>Products</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="product-category"><i class="fa fa-circle"></i>Category</a></li>
                            <li><a href="product-list"><i class="fa fa-circle"></i>Product List</a></li>
                            <li><a href="add-product"><i class="fa fa-circle"></i>Add Product</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="dollar-sign"></i><span>Sales</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="orders"><i class="fa fa-circle"></i>Orders</a></li>
                            <li><a href="transactions"><i class="fa fa-circle"></i>Transactions</a></li>
                            <li><a href="pending-transfer"><i class="fa fa-circle"></i>Pending Payment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="hash"></i><span>Solar Energy Audit</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="audit-bookings"><i class="fa fa-circle"></i>Bookings</a></li>
                            <li><a href="audit-transactions"><i class="fa fa-circle"></i>Transactions</a></li>
                            <li><a href="audit-pending-payment"><i class="fa fa-circle"></i>Pending Payment</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="message-circle"></i><span>Blog</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="blog-category"><i class="fa fa-circle"></i>Blog Category</a></li>
                            <li><a href="blog-post"><i class="fa fa-circle"></i>Blog Post</a></li>
                            <li><a href="add-blog-post"><i class="fa fa-circle"></i>Add Blog Post</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="folder-plus"></i><span>Project History</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="add-installation-history"><i class="fa fa-circle"></i>Add Installation History</a></li>
                            <li><a href="installation-histories"><i class="fa fa-circle"></i>Installation Histories</a></li>
                            <li><a href="add-maintenance-history"><i class="fa fa-circle"></i>Add Maintenance History</a></li>
                            <li><a href="maintenance-histories"><i class="fa fa-circle"></i>Maintenance Histories</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="user-plus"></i><span>Users</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="customer-list"><i class="fa fa-circle"></i>Customer List</a></li>
                            <li><a href="user-list"><i class="fa fa-circle"></i>Admin List</a></li>
                            <li><a href="create-user"><i class="fa fa-circle"></i>Add Admin User</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="settings" ></i><span>Settings</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="profile"><i class="fa fa-circle"></i>Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="sidebar-header" href="javascript:void(0)">
                            <i data-feather="mail" ></i><span>News Letter</span><i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a href="subscribers"><i class="fa fa-circle"></i>Subscribers</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Page Sidebar Ends-->