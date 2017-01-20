<?php
/**
 * Created by PhpStorm.
 * User: tan
 * Date: 2016/5/16
 * Time: 16:14
 */

use admin\assets\AppAsset;

$this->title = '后台首页';

//只在该视图中使用非全局的jui
$this->registerJs('
$(document).ready(function() {
        App.init();
        Dashboard.init();
    });
    ',\yii\web\View::POS_END);
AppAsset::addScript($this,'@web/plugins/pace/pace.min.js');
AppAsset::addScript($this,'@web/plugins/jquery/jquery-1.9.1.min.js');
AppAsset::addScript($this,'@web/plugins/jquery/jquery-migrate-1.1.0.min.js');
AppAsset::addScript($this,'@web/plugins/jquery-ui/ui/minified/jquery-ui.min.js');
AppAsset::addScript($this,'@web/plugins/bootstrap/js/bootstrap.min.js');
AppAsset::addScript($this,'@web/plugins/slimscroll/jquery.slimscroll.min.js');
AppAsset::addScript($this,'@web/plugins/jquery-cookie/jquery.cookie.js');
AppAsset::addScript($this,'@web/plugins/gritter/js/jquery.gritter.js');
AppAsset::addScript($this,'@web/plugins/flot/jquery.flot.min.js');
AppAsset::addScript($this,'@web/plugins/flot/jquery.flot.time.min.js');
AppAsset::addScript($this,'@web/plugins/flot/jquery.flot.resize.min.js');
AppAsset::addScript($this,'@web/plugins/flot/jquery.flot.pie.min.js');
AppAsset::addScript($this,'@web/plugins/sparkline/jquery.sparkline.js');
AppAsset::addScript($this,'@web/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js');
AppAsset::addScript($this,'@web/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js');
AppAsset::addScript($this,'@web/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js');
//AppAsset::addScript($this,'@web/js/dashboard.min.js');
AppAsset::addScript($this,'@web/js/apps.min.js');
AppAsset::addCss($this,'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
AppAsset::addCss($this,'@web/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css');
AppAsset::addCss($this,'@web/plugins/bootstrap/css/bootstrap.min.css');
AppAsset::addCss($this,'@web/plugins/font-awesome/css/font-awesome.min.css');
AppAsset::addCss($this,'@web/css/animate.min.css');
AppAsset::addCss($this,'@web/css/style.min.css');
AppAsset::addCss($this,'@web/css/style-responsive.min.css');
AppAsset::addCss($this,'@web/css/theme/default.css');
AppAsset::addCss($this,'@web/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.css');
AppAsset::addCss($this,'@web/plugins/bootstrap-datepicker/css/datepicker.css');
AppAsset::addCss($this,'@web/plugins/bootstrap-datepicker/css/datepicker3.css');
AppAsset::addCss($this,'@web/plugins/gritter/css/jquery.gritter.css');
?>
<!-- begin #page-loader -->
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<!-- end #page-loader -->

<!-- begin #page-container -->
<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
    <!-- begin #header -->
    <div id="header" class="header navbar navbar-default navbar-fixed-top">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin mobile sidebar expand / collapse button -->
            <div class="navbar-header">
                <a href="javascript:;" class="navbar-brand"><span class="navbar-logo"></span> Color Admin</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- end mobile sidebar expand / collapse button -->

            <!-- begin header navigation right -->
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown navbar-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="assets/img/user-11.jpg" alt="" />
                        <span class="hidden-xs">Adam Schwartz</span> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu animated fadeInLeft">
                        <li class="arrow"></li>
                        <li><a href="javascript:;">Edit Profile</a></li>
                        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
                        <li><a href="javascript:;">Calendar</a></li>
                        <li><a href="javascript:;">Setting</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:;">Log Out</a></li>
                    </ul>
                </li>
            </ul>
            <!-- end header navigation right -->
        </div>
        <!-- end container-fluid -->
    </div>
    <!-- end #header -->

    <!-- begin #sidebar -->
    <div id="sidebar" class="sidebar">
        <!-- begin sidebar scrollbar -->
        <div data-scrollbar="true" data-height="100%">
            <!-- begin sidebar user -->
            <ul class="nav">
                <li class="nav-profile">
                    <div class="image">
                        <a href="javascript:;"><img src="assets/img/user-11.jpg" alt="" /></a>
                    </div>
                    <div class="info">
                        Sean Ngu
                        <small>Front end developer</small>
                    </div>
                </li>
            </ul>
            <!-- end sidebar user -->
            <!-- begin sidebar nav -->
            <ul class="nav">
                <li class="nav-header">导航</li>
                <li>
                    <a href="index.html"><i class="fa fa-laptop"></i> <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="inbox.html">
                        <span class="badge pull-right">10</span>
                        <i class="fa fa-inbox"></i> <span>Inbox</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-suitcase"></i>
                        <b class="caret pull-right"></b>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="ui_general.html">General</a></li>
                        <li><a href="ui_typography.html">Typography</a></li>
                        <li><a href="ui_tabs_accordions.html">Tabs & Accordions</a></li>
                        <li><a href="ui_modal_notification.html">Modal & Notification</a></li>
                        <li><a href="ui_widget_boxes.html">Widget Boxes</a></li>
                        <li><a href="ui_media_object.html">Media Object</a></li>
                        <li><a href="ui_buttons.html">Buttons</a></li>
                        <li><a href="ui_icons.html">Icons</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-file-o"></i>
                        <b class="caret pull-right"></b>
                        <span>Form Stuff</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="form_elements.html">Form Elements</a></li>
                        <li><a href="form_plugins.html">Form Plugins</a></li>
                        <li><a href="form_validation.html">Form Validation</a></li>
                        <li><a href="form_wizards.html">Wizards</a></li>
                        <li><a href="form_wysiwyg.html">WYSIWYG</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <b class="caret pull-right"></b>
                        <i class="fa fa-th"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="table_basic.html">Basic Tables</a></li>
                        <li><a href="table_manage.html">Managed Tables</a></li>
                    </ul>
                </li>
                <li><a href="charts.html"><i class="fa fa-signal"></i> <span>Charts</span></a></li>
                <li><a href="calendar.html"><i class="fa fa-calendar"></i> <span>Calendar</span></a></li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-map-marker"></i>
                        <b class="caret pull-right"></b>
                        <span>Map</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="map_vector.html">Vector Map</a></li>
                        <li><a href="map_google.html">Google Map</a></li>
                    </ul>
                </li>
                <li><a href="gallery.html"><i class="fa fa-camera"></i> <span>Gallery</span></a></li>
                <li class="has-sub active">
                    <a href="javascript:;">
                        <i class="fa fa-cogs"></i>
                        <b class="caret pull-right"></b>
                        <span>Page Options</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="active"><a href="page_blank.html">Blank Page</a></li>
                        <li><a href="page_with_footer.html">Page with Footer</a></li>
                        <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                        <li><a href="page_with_right_sidebar.html">Page with Right Sidebar</a></li>
                        <li><a href="page_with_minified_sidebar.html">Page with Minified Sidebar</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-gift"></i>
                        <b class="caret pull-right"></b>
                        <span>Extra</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="extra_search_results.html">Search Results</a></li>
                        <li><a href="extra_invoice.html">Invoice</a></li>
                        <li><a href="extra_404_error.html">404 Error Page</a></li>
                        <li><a href="extra_login.html">Login</a></li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="javascript:;">
                        <i class="fa fa-align-left"></i>
                        <b class="caret pull-right"></b>
                        <span>Menu Level</span>
                    </a>
                    <ul class="sub-menu">
                        <li class="has-sub">
                            <a href="javascript:;">
                                <b class="caret pull-right"></b>
                                Menu 1.1
                            </a>
                            <ul class="sub-menu">
                                <li class="has-sub">
                                    <a href="javascript:;">
                                        <b class="caret pull-right"></b>
                                        Menu 2.1
                                    </a>
                                    <ul class="sub-menu">
                                        <li><a href="javascript:;">Menu 3.1</a></li>
                                        <li><a href="javascript:;">Menu 3.2</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:;">Menu 2.2</a></li>
                                <li><a href="javascript:;">Menu 2.3</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:;">Menu 1.2</a></li>
                        <li><a href="javascript:;">Menu 1.3</a></li>
                    </ul>
                </li>
                <!-- begin sidebar minify button -->
                <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
                <!-- end sidebar minify button -->
            </ul>
            <!-- end sidebar nav -->
        </div>
        <!-- end sidebar scrollbar -->
    </div>
    <div class="sidebar-bg"></div>
    <!-- end #sidebar -->

    <!-- begin #content -->
    <div id="content" class="content">
        <!-- begin page-header -->
        <h1 class="page-header">Blank Page <small>header small text goes here...</small></h1>
        <!-- end page-header -->

        <!-- Page Content Here -->
    </div>
    <!-- end #content -->

    <!-- begin #footer -->
    <div id="footer" class="footer">
        <!-- Footer Here -->
    </div>
    <!-- end #footer -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->
