<?php
session_start();
error_reporting(E_ALL ^ E_WARNING);
require_once './config/koneksi.php';
require_once './config/session.php';
if (isset($_SESSION['admin'])||isset($_SESSION['siswa'])||isset($_SESSION['guru'])||isset($_SESSION['ujian'])) {
    ?>
    <!DOCTYPE html>
    <!--
    Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.3.7
    Version: 4.7.1
    Author: KeenThemes
    Website: http://www.keenthemes.com/
    Contact: support@keenthemes.com
    Follow: www.twitter.com/keenthemes
    Dribbble: www.dribbble.com/keenthemes
    Like: www.facebook.com/keenthemes
    Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
    Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
    License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
    -->
    <!--[if IE 8]>
    <html lang="en" class="ie8 no-js"> <![endif]-->
    <!--[if IE 9]>
    <html lang="en" class="ie9 no-js"> <![endif]-->
    <!--[if !IE]><!-->
    <html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <meta charset="utf-8"/>
        <title>
            <?php
            if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
                echo "MBi Ujian | Dashboard";
            } elseif ($_GET['page'] == 'data_siswa') {
             echo "MBi Ujian | Data Siswa";
            } elseif ($_GET['page'] == 'data_guru') {
              echo "MBi Ujian | Data Guru";
            } elseif ($_GET['page'] == 'data_mapel') {
             echo "MBi Ujian | Mata Pelajaran";
            } elseif ($_GET['page'] == 'soal') {
                echo "MBi Ujian | Bank Soal";
            } elseif ($_GET['page'] == 'hasil') {
              echo "MBi Ujian | Hasil Ujian";
            } elseif ($_GET['page'] == 'ujian') {
                echo "MBi Ujian | Ujian";
            } elseif ($_GET['page'] == 'data_kelas') {
                echo "MBi Ujian | Data Kelas";
            }
            ?>
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="Preview page of Metronic Admin Theme #3 for managed datatable samples" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
              type="text/css"/>
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
              type="text/css"/>
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet"
              type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/css/funkyradio.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-summernote/summernote.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
              type="text/css"/>
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css"/>
        <!-- END THEME LAYOUT STYLES -->
        <link rel="shortcut icon" href="assets/images/favicon.png"/>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid">
    <div class="page-wrapper">
        <div class="page-wrapper-row">
            <div class="page-wrapper-top">
                <!-- BEGIN HEADER -->
                <div class="page-header">
                    <?php
                    include './view/header.php';
                    ?>
                </div>
                <!-- END HEADER -->
            </div>
        </div>
        <div class="page-wrapper-row full-height">
            <div class="page-wrapper-middle">
                <!-- BEGIN CONTAINER -->
                <div class="page-container">
                    <!-- BEGIN CONTENT -->
                    <div class="page-content-wrapper">
                        <!-- BEGIN CONTENT BODY -->
                        <!-- BEGIN PAGE HEAD-->
                        <div class="page-head">
                            <div class="container">
                                <!-- BEGIN PAGE TITLE -->
                                <?php
                                if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
                                    echo '<div class="page-title">
                                    <h1>Dashboard
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'data_siswa') {
                                    echo '<div class="page-title">
                                   <h1>Data Siswa
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'data_guru') {
                                    echo '<div class="page-title">
                                   <h1>Data Guru
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'data_mapel') {
                                    echo '<div class="page-title">
                                    <h1>Data Mata Pelajaran
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'soal') {
                                    echo '<div class="page-title">
                                    <h1>Bank Soal
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'hasil') {
                                    echo '<div class="page-title">
                                   <h1>Hasil Ujian
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'ujian') {
                                    echo '<div class="page-title">
                                   <h1>Ujian
                                    </h1>
                                </div>';
                                } elseif ($_GET['page'] == 'data_kelas') {
                                    echo '<div class="page-title">
                                   <h1>Data Kelas
                                    </h1>
                                </div>';
                                }
                                ?>

                                <!-- END PAGE TITLE -->
                                <!-- BEGIN PAGE TOOLBAR -->
                                <div class="page-toolbar">
                                    <!-- BEGIN THEME PANEL -->
                                    <div class="btn-group btn-theme-panel">
                                        <div class="dropdown-menu theme-panel pull-right dropdown-custom hold-on-click">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <h3>THEME COLORS</h3>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <ul class="theme-colors">
                                                                <li class="theme-color theme-color-default"
                                                                    data-theme="default">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Default</span>
                                                                </li>
                                                                <li class="theme-color theme-color-blue-hoki"
                                                                    data-theme="blue-hoki">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Blue Hoki</span>
                                                                </li>
                                                                <li class="theme-color theme-color-blue-steel"
                                                                    data-theme="blue-steel">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Blue Steel</span>
                                                                </li>
                                                                <li class="theme-color theme-color-yellow-orange"
                                                                    data-theme="yellow-orange">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Orange</span>
                                                                </li>
                                                                <li class="theme-color theme-color-yellow-crusta"
                                                                    data-theme="yellow-crusta">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Yellow Crusta</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                                            <ul class="theme-colors">
                                                                <li class="theme-color theme-color-green-haze"
                                                                    data-theme="green-haze">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Green Haze</span>
                                                                </li>
                                                                <li class="theme-color theme-color-red-sunglo"
                                                                    data-theme="red-sunglo">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Red Sunglo</span>
                                                                </li>
                                                                <li class="theme-color theme-color-red-intense"
                                                                    data-theme="red-intense">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Red Intense</span>
                                                                </li>
                                                                <li class="theme-color theme-color-purple-plum"
                                                                    data-theme="purple-plum">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Purple Plum</span>
                                                                </li>
                                                                <li class="theme-color theme-color-purple-studio"
                                                                    data-theme="purple-studio">
                                                                    <span class="theme-color-view"></span>
                                                                    <span class="theme-color-name">Purple Studio</span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 seperator">
                                                    <h3>LAYOUT</h3>
                                                    <ul class="theme-settings">
                                                        <li> Theme Style
                                                            <select class="theme-setting theme-setting-style form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Change theme style"
                                                                    data-container="body" data-placement="left">
                                                                <option value="boxed" selected="selected">Square
                                                                    corners
                                                                </option>
                                                                <option value="rounded">Rounded corners</option>
                                                            </select>
                                                        </li>
                                                        <li> Layout
                                                            <select class="theme-setting theme-setting-layout form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Change layout type"
                                                                    data-container="body" data-placement="left">
                                                                <option value="boxed" selected="selected">Boxed</option>
                                                                <option value="fluid">Fluid</option>
                                                            </select>
                                                        </li>
                                                        <li> Top Menu Style
                                                            <select class="theme-setting theme-setting-top-menu-style form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Change top menu dropdowns style"
                                                                    data-container="body"
                                                                    data-placement="left">
                                                                <option value="dark" selected="selected">Dark</option>
                                                                <option value="light">Light</option>
                                                            </select>
                                                        </li>
                                                        <li> Top Menu Mode
                                                            <select class="theme-setting theme-setting-top-menu-mode form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Enable fixed(sticky) top menu"
                                                                    data-container="body"
                                                                    data-placement="left">
                                                                <option value="fixed">Fixed</option>
                                                                <option value="not-fixed" selected="selected">Not
                                                                    Fixed
                                                                </option>
                                                            </select>
                                                        </li>
                                                        <li> Mega Menu Style
                                                            <select class="theme-setting theme-setting-mega-menu-style form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Change mega menu dropdowns style"
                                                                    data-container="body"
                                                                    data-placement="left">
                                                                <option value="dark" selected="selected">Dark</option>
                                                                <option value="light">Light</option>
                                                            </select>
                                                        </li>
                                                        <li> Mega Menu Mode
                                                            <select class="theme-setting theme-setting-mega-menu-mode form-control input-sm input-small input-inline tooltips"
                                                                    data-original-title="Enable fixed(sticky) mega menu"
                                                                    data-container="body"
                                                                    data-placement="left">
                                                                <option value="fixed" selected="selected">Fixed</option>
                                                                <option value="not-fixed">Not Fixed</option>
                                                            </select>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END THEME PANEL -->
                                </div>
                                <!-- END PAGE TOOLBAR -->
                            </div>
                        </div>
                        <!-- END PAGE HEAD-->
                        <!-- BEGIN PAGE CONTENT BODY -->
                        <div class="page-content">
                            <div class="container">
                                <!-- BEGIN PAGE BREADCRUMBS -->
                                <ul class="page-breadcrumb breadcrumb">
                                    <?php
                                    if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
                                        echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Dashboard</span>
                                        </li>';
                                    } elseif ($_GET['page'] == 'data_siswa') {
                                        echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Data Siswa</span>
                                        </li>';
                                    } elseif ($_GET['page'] == 'data_guru') {
                                         echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Data Guru</span>
                                        </li>';
                                    } elseif ($_GET['page'] == 'data_mapel') {
                                         echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Data Mata Pelajaran</span>
                                        </li>';
                                    } elseif ($_GET['page'] == 'soal') {
                                         echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Bank Soal</span>
                                        </li>';
                                    } elseif ($_GET['page'] == 'hasil') {
                                         echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Hasil Ujian</span>
                                        </li>';
                                    } elseif ($_GET['page']=='ujian'){
                                         echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Data Ujian</span>
                                        </li>';
                                    } elseif ($_GET['page']=='data_kelas'){
                                        echo '<li>
                                            <a href="index.php">Home</a>
                                            <i class="fa fa-circle"></i>
                                        </li>
                                        <li>
                                            <span>Data Kelas</span>
                                        </li>';
                                    }
                                    ?>
                                </ul>
                                <!-- END PAGE BREADCRUMBS -->
                                <!-- BEGIN PAGE CONTENT INNER -->
                                <?php
                                if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
                                    include './view/dashboard.php';
                                } elseif ($_GET['page'] == 'data_siswa') {
                                    include './view/data_siswa.php';
                                } elseif ($_GET['page'] == 'data_kelas') {
                                    include './view/data_kelas.php';
                                } elseif ($_GET['page'] == 'data_guru') {
                                    include './view/data_guru.php';
                                } elseif ($_GET['page'] == 'data_mapel') {
                                    include './view/data_mapel.php';
                                } elseif ($_GET['page'] == 'soal') {
                                    include './view/soal.php';
                                } elseif ($_GET['page'] == 'hasil') {
                                    include './view/hasil.php';
                                } elseif ($_GET['page']=='ujian'){
                                    include './view/ujian.php';
                                } elseif ($_GET['page']=='ujian' && $_GET['act']=='proses_ujian'){
                                    include './view/ikut_ujian.php';
                                }
                                ?>
                                <!-- END PAGE CONTENT INNER -->
                            </div>
                        </div>
                        <!-- END PAGE CONTENT BODY -->
                        <!-- END CONTENT BODY -->
                    </div>
                    <!-- END CONTENT -->
                    <!-- BEGIN QUICK SIDEBAR -->
                    <a href="javascript:;" class="page-quick-sidebar-toggler">
                        <i class="icon-login"></i>
                    </a>
                    <div class="page-quick-sidebar-wrapper" data-close-on-body-click="false">
                        <div class="page-quick-sidebar">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="javascript:;" data-target="#quick_sidebar_tab_1" data-toggle="tab"> Users
                                        <span class="badge badge-danger">2</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;" data-target="#quick_sidebar_tab_2" data-toggle="tab"> Alerts
                                        <span class="badge badge-success">7</span>
                                    </a>
                                </li>
                                <li class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> More
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                <i class="icon-bell"></i> Alerts </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                <i class="icon-info"></i> Notifications </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                <i class="icon-speech"></i> Activities </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="javascript:;" data-target="#quick_sidebar_tab_3" data-toggle="tab">
                                                <i class="icon-settings"></i> Settings </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active page-quick-sidebar-chat" id="quick_sidebar_tab_1">
                                    <div class="page-quick-sidebar-chat-users" data-rail-color="#ddd"
                                         data-wrapper-class="page-quick-sidebar-list">
                                        <h3 class="list-heading">Staff</h3>
                                        <ul class="media-list list-items">
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-success">8</span>
                                                </div>
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar3.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Bob Nilson</h4>
                                                    <div class="media-heading-sub"> Project Manager</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar1.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Nick Larson</h4>
                                                    <div class="media-heading-sub"> Art Director</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-danger">3</span>
                                                </div>
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar4.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Deon Hubert</h4>
                                                    <div class="media-heading-sub"> CTO</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar2.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Ella Wong</h4>
                                                    <div class="media-heading-sub"> CEO</div>
                                                </div>
                                            </li>
                                        </ul>
                                        <h3 class="list-heading">Customers</h3>
                                        <ul class="media-list list-items">
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-warning">2</span>
                                                </div>
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar6.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lara Kunis</h4>
                                                    <div class="media-heading-sub"> CEO, Loop Inc</div>
                                                    <div class="media-heading-small"> Last seen 03:10 AM</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="label label-sm label-success">new</span>
                                                </div>
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar7.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Ernie Kyllonen</h4>
                                                    <div class="media-heading-sub"> Project Manager,
                                                        <br> SmartBizz PTL
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar8.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Lisa Stone</h4>
                                                    <div class="media-heading-sub"> CTO, Keort Inc</div>
                                                    <div class="media-heading-small"> Last seen 13:10 PM</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-success">7</span>
                                                </div>
                                                <img class="media-object" src="../assets/layouts/layout/img/avatar9.jpg"
                                                     alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Deon Portalatin</h4>
                                                    <div class="media-heading-sub"> CFO, H&D LTD</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <img class="media-object"
                                                     src="../assets/layouts/layout/img/avatar10.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Irina Savikova</h4>
                                                    <div class="media-heading-sub"> CEO, Tizda Motors Inc</div>
                                                </div>
                                            </li>
                                            <li class="media">
                                                <div class="media-status">
                                                    <span class="badge badge-danger">4</span>
                                                </div>
                                                <img class="media-object"
                                                     src="../assets/layouts/layout/img/avatar11.jpg" alt="...">
                                                <div class="media-body">
                                                    <h4 class="media-heading">Maria Gomez</h4>
                                                    <div class="media-heading-sub"> Manager, Infomatic Inc</div>
                                                    <div class="media-heading-small"> Last seen 03:10 AM</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="page-quick-sidebar-item">
                                        <div class="page-quick-sidebar-chat-user">
                                            <div class="page-quick-sidebar-nav">
                                                <a href="javascript:;" class="page-quick-sidebar-back-to-list">
                                                    <i class="icon-arrow-left"></i>Back</a>
                                            </div>
                                            <div class="page-quick-sidebar-chat-user-messages">
                                                <div class="post out">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body"> When could you send me the report ? </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body"> Its almost done. I will be sending it shortly </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:15</span>
                                                        <span class="body"> Alright. Thanks! :) </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:16</span>
                                                        <span class="body"> You are most welcome. Sorry for the delay. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body"> No probs. Just take your time :) </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:40</span>
                                                        <span class="body"> Alright. I just emailed it to you. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body"> Great! Thanks. Will check it right away. </span>
                                                    </div>
                                                </div>
                                                <div class="post in">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar2.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Ella Wong</a>
                                                        <span class="datetime">20:40</span>
                                                        <span class="body"> Please let me know if you have any comment. </span>
                                                    </div>
                                                </div>
                                                <div class="post out">
                                                    <img class="avatar" alt=""
                                                         src="../assets/layouts/layout/img/avatar3.jpg"/>
                                                    <div class="message">
                                                        <span class="arrow"></span>
                                                        <a href="javascript:;" class="name">Bob Nilson</a>
                                                        <span class="datetime">20:17</span>
                                                        <span class="body"> Sure. I will check and buzz you if anything needs to be corrected. </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="page-quick-sidebar-chat-user-form">
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                           placeholder="Type a message here...">
                                                    <div class="input-group-btn">
                                                        <button type="button" class="btn green">
                                                            <i class="icon-paper-clip"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane page-quick-sidebar-alerts" id="quick_sidebar_tab_2">
                                    <div class="page-quick-sidebar-alerts-list">
                                        <h3 class="list-heading">General</h3>
                                        <ul class="feeds list-items">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 4 pending tasks.
                                                                <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> Just now</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-success">
                                                                    <i class="fa fa-bar-chart-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> Finance Report for year 2013 has been
                                                                    released.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 20 mins</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-danger">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 5 pending membership that
                                                                requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received with
                                                                <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 30 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 5 pending membership that
                                                                requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Web server hardware needs to be upgraded.
                                                                <span class="label label-sm label-warning"> Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 2 hours</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-default">
                                                                    <i class="fa fa-briefcase"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> IPO Report for year 2013 has been
                                                                    released.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 20 mins</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <h3 class="list-heading">System</h3>
                                        <ul class="feeds list-items">
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-check"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 4 pending tasks.
                                                                <span class="label label-sm label-warning "> Take action
                                                                        <i class="fa fa-share"></i>
                                                                    </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> Just now</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-danger">
                                                                    <i class="fa fa-bar-chart-o"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> Finance Report for year 2013 has been
                                                                    released.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 20 mins</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-default">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 5 pending membership that
                                                                requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-info">
                                                                <i class="fa fa-shopping-cart"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> New order received with
                                                                <span class="label label-sm label-success"> Reference Number: DR23923 </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 30 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-success">
                                                                <i class="fa fa-user"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> You have 5 pending membership that
                                                                requires a quick review.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 24 mins</div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col1">
                                                    <div class="cont">
                                                        <div class="cont-col1">
                                                            <div class="label label-sm label-warning">
                                                                <i class="fa fa-bell-o"></i>
                                                            </div>
                                                        </div>
                                                        <div class="cont-col2">
                                                            <div class="desc"> Web server hardware needs to be upgraded.
                                                                <span class="label label-sm label-default "> Overdue </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col2">
                                                    <div class="date"> 2 hours</div>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:;">
                                                    <div class="col1">
                                                        <div class="cont">
                                                            <div class="cont-col1">
                                                                <div class="label label-sm label-info">
                                                                    <i class="fa fa-briefcase"></i>
                                                                </div>
                                                            </div>
                                                            <div class="cont-col2">
                                                                <div class="desc"> IPO Report for year 2013 has been
                                                                    released.
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col2">
                                                        <div class="date"> 20 mins</div>
                                                    </div>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane page-quick-sidebar-settings" id="quick_sidebar_tab_3">
                                    <div class="page-quick-sidebar-settings-list">
                                        <h3 class="list-heading">General Settings</h3>
                                        <ul class="list-items borderless">
                                            <li> Enable Notifications
                                                <input type="checkbox" class="make-switch" checked data-size="small"
                                                       data-on-color="success" data-on-text="ON"
                                                       data-off-color="default" data-off-text="OFF"></li>
                                            <li> Allow Tracking
                                                <input type="checkbox" class="make-switch" data-size="small"
                                                       data-on-color="info" data-on-text="ON" data-off-color="default"
                                                       data-off-text="OFF"></li>
                                            <li> Log Errors
                                                <input type="checkbox" class="make-switch" checked data-size="small"
                                                       data-on-color="danger" data-on-text="ON" data-off-color="default"
                                                       data-off-text="OFF"></li>
                                            <li> Auto Sumbit Issues
                                                <input type="checkbox" class="make-switch" data-size="small"
                                                       data-on-color="warning" data-on-text="ON"
                                                       data-off-color="default" data-off-text="OFF"></li>
                                            <li> Enable SMS Alerts
                                                <input type="checkbox" class="make-switch" checked data-size="small"
                                                       data-on-color="success" data-on-text="ON"
                                                       data-off-color="default" data-off-text="OFF"></li>
                                        </ul>
                                        <h3 class="list-heading">System Settings</h3>
                                        <ul class="list-items borderless">
                                            <li> Security Level
                                                <select class="form-control input-inline input-sm input-small">
                                                    <option value="1">Normal</option>
                                                    <option value="2" selected>Medium</option>
                                                    <option value="e">High</option>
                                                </select>
                                            </li>
                                            <li> Failed Email Attempts
                                                <input class="form-control input-inline input-sm input-small"
                                                       value="5"/></li>
                                            <li> Secondary SMTP Port
                                                <input class="form-control input-inline input-sm input-small"
                                                       value="3560"/></li>
                                            <li> Notify On System Error
                                                <input type="checkbox" class="make-switch" checked data-size="small"
                                                       data-on-color="danger" data-on-text="ON" data-off-color="default"
                                                       data-off-text="OFF"></li>
                                            <li> Notify On SMTP Error
                                                <input type="checkbox" class="make-switch" checked data-size="small"
                                                       data-on-color="warning" data-on-text="ON"
                                                       data-off-color="default" data-off-text="OFF"></li>
                                        </ul>
                                        <div class="inner-content">
                                            <button class="btn btn-success">
                                                <i class="icon-settings"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END QUICK SIDEBAR -->
                </div>
                <!-- END CONTAINER -->
            </div>
        </div>
        <div class="page-wrapper-row">
            <div class="page-wrapper-bottom">
                <!-- BEGIN FOOTER -->
                <?php
                include './view/footer.php';
                ?>
                <!-- END FOOTER -->
            </div>
        </div>
    </div>
    <!-- BEGIN QUICK NAV -->

    <div class="quick-nav-overlay"></div>
    <!-- END QUICK NAV -->
    <!--[if lt IE 9]>
    <script src="assets/global/plugins/respond.min.js"></script>
    <script src="assets/global/plugins/excanvas.min.js"></script>
    <script src="assets/global/plugins/ie8.fix.min.js"></script>
    <![endif]-->
    <!-- BEGIN CORE PLUGINS -->
    <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
    <script src="assets/global/plugins/bootstrap-summernote/summernote.min.js" type="text/javascript"></script>
    <script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
    <script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
    <script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js"
            type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL SCRIPTS -->
    <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
    <!-- END THEME GLOBAL SCRIPTS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
    <script src="assets/pages/scripts/components-editors.min.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME LAYOUT SCRIPTS -->
    <script src="assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
    <script src="assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
    <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
    <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function() {
            $('#soal').summernote({
                height: "200px",
                styleWithSpan: false
            });
            $('#jawaban_a').summernote({
                height: "200px",
                styleWithSpan: false
            });
            $('#jawaban_b').summernote({
                height: "200px",
                styleWithSpan: false
            });
            $('#jawaban_c').summernote({
                height: "200px",
                styleWithSpan: false
            });
            $('#jawaban_d').summernote({
                height: "200px",
                styleWithSpan: false
            });
            $('#detail_jwbnya').summernote({
                height: "200px",
                styleWithSpan: false
            });
        });
    </script>
    </body>

    </html>
    <?php
}else{
    echo "<script>window.location='login.php'</script>";
}
?>