<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('adm/top')?>
    <style>
        .click {
            cursor:pointer;
        }

    </style>
</head>
<body>
<!-- Navigation Bar-->
<header id="topnav">

    <div class="topbar-main">
        <div class="container">


            <!-- Logo container-->
            <div class="logo">
                <!-- Text Logo -->
                <!--<a href="index.html" class="logo">-->
                <!--Zircos-->
                <!--</a>-->
                <!-- Image Logo -->
                <a href="<?php print site_url()?>" class="logo">
                    <img src="<?php print site_url('assets/images/logo_dark.png') ?>" alt="" height="24">
                </a>

            </div>
            <!-- End Logo container-->


            <div class="menu-extras">

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="navbar-c-items">
                        <form role="search" class="navbar-left app-search pull-left hidden-xs">
                            <input type="text" placeholder="Search..." class="form-control">
                            <a href=""><i class="fa fa-search"></i></a>
                        </form>
                    </li>

                    <li class="dropdown navbar-c-items">
                        <span class="badge badge-topbar badge-success">4</span>
                        <a href="#" class="right-menu-item dropdown-toggle waves-effect" data-toggle="dropdown">
                            <i class="mdi mdi-bell"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                            <li class="text-center">
                                <h5>Notifications</h5>
                            </li>
                            <li>
                                <a href="#" class="user-list-item">
                                    <div class="icon bg-info">
                                        <i class="mdi mdi-account"></i>
                                    </div>
                                    <div class="user-desc">
                                        <span class="name">New Signup</span>
                                        <span class="time">5 hours ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="user-list-item">
                                    <div class="icon bg-danger">
                                        <i class="mdi mdi-comment"></i>
                                    </div>
                                    <div class="user-desc">
                                        <span class="name">New Message received</span>
                                        <span class="time">1 day ago</span>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="user-list-item">
                                    <div class="icon bg-warning">
                                        <i class="mdi mdi-settings"></i>
                                    </div>
                                    <div class="user-desc">
                                        <span class="name">Settings</span>
                                        <span class="time">1 day ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="all-msgs text-center">
                                <p class="m-0"><a href="#">See all Notification</a></p>
                            </li>
                        </ul>
                    </li>

                    <li class="dropdown navbar-c-items">
                        <a href="" class="dropdown-toggle waves-effect profile" data-toggle="dropdown" aria-expanded="true"><img src="<?php print site_url('assets/images/users/avatar-1.jpg') ?>" alt="user-img" class="img-circle"> </a>
                        <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                            <li class="text-center">
                                <h5>Hi, John</h5>
                            </li>
                            <li><a href="javascript:void(0)"><i class="dripicons-user m-r-10"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="dripicons-mail m-r-10"></i> <span class="badge badge-success pull-right">5</span> Messages</a></li>
                            <li><a href="javascript:void(0)"><i class="dripicons-gear m-r-10"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="dripicons-lock m-r-10"></i> Lock screen</a></li>
                            <li><a href="javascript:void(0)"><i class="dripicons-power m-r-10"></i> Logout</a></li>
                        </ul>

                    </li>
                </ul>
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>
            <!-- end menu-extras -->

        </div> <!-- end container -->
    </div>
    <!-- end topbar-main -->

    <div class="navbar-custom">
        <div class="container">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">

                    <li class="has-submenu">
                        <a href="#"><i class="fi-air-play"></i>Visão Geral</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="fi-briefcase"></i>Projetos</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="fi-box"></i>Fotos Selecionadas</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="fi-paper"></i>Albuns</a>
                    </li>

                    <li class="has-submenu">
                        <a href="#"><i class="fi-paper-stack"></i>Galerias</a>
                    </li>
                </ul>
                <!-- End navigation menu -->
            </div> <!-- end #navigation -->
        </div> <!-- end container -->
    </div> <!-- end navbar-custom -->
</header>
<!-- End Navigation Bar-->


<div class="wrapper">
    <div class="container">
