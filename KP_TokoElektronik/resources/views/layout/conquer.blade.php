<!DOCTYPE html>
<!--
Template Name: Conquer - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 2.0
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/conquer-responsive-admin-dashboard-template/3716838?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>Conquer | Admin Dashboard Template</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <meta name="MobileOptimized" content="320">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('conquer/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('conquer/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/plugins/uniform/css/uniform.default.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
    <link href="{{ asset('conquer/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('conquer/plugins/fullcalendar/fullcalendar/fullcalendar.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('conquer/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGIN STYLES -->
    <!-- BEGIN THEME STYLES -->
    <link href="{{ asset('conquer/css/style-conquer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/css/style-responsive.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/css/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/css/pages/tasks.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('conquer/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('conquer/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    @yield('head')
    @yield('js')

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">

    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <div class="page-sidebar navbar-collapse collapse">
                <div class="sidebar-title">
                    <h3 style="color: white; text-align: center;">TOKO AMIN ELEKTRONIK</h3>
                </div>
                <!-- BEGIN SIDEBAR MENU -->
                <!-- DOC: for circle icon style menu apply page-sidebar-menu-circle-icons class right after sidebar-toggler-wrapper -->
                <ul class="page-sidebar-menu">  
                    <li class="sidebar-toggler-wrapper">  
                        <div class="sidebar-toggler"></div>  
                        <div class="clearfix"></div>  
                    </li>  
                    <li class="sidebar-search-wrapper">  
                        <form class="search-form" role="form" action="index.html" method="get">  
                            <div class="input-icon right">  
                                <i class="icon-magnifier"></i>  
                                <input type="text" class="form-control" name="query" placeholder="Search...">  
                            </div>  
                        </form>  
                    </li>  
                  
                    @if(auth()->user()->role === 'admin')  
                        <li>  
                            <a href="product">  
                                <i class="icon-star"></i>  
                                <span class="title">Manajemen Produk</span>  
                                <span class="selected"></span>  
                            </a>  
                        </li>  
                  
                        <li>  
                            <a href="restock">  
                                <i class="icon-star"></i>  
                                <span class="title">Restock Produk</span>  
                                <span class="selected"></span>  
                            </a>  
                        </li>  
                    @endif  
                  
                    <li>  
                        <a href="transaction">  
                            <i class="icon-star"></i>  
                            <span class="title">Transaksi Penjualan</span>  
                            <span class="selected"></span>  
                        </a>  
                    </li>  
                  
                    @if(auth()->user()->role === 'admin')  
                        <li>  
                            <a href="laporan">  
                                <i class="icon-star"></i>  
                                <span class="title">Laporan Penjualan</span>  
                                <span class="selected"></span>  
                            </a>  
                        </li>  
                    @endif  
                  
                    <li>  
                        <form action="{{ route('logout') }}" method="post">  
                            @csrf  
                            <input type="submit" value="Logout" class="btn btn-danger btn-sm" />  
                        </form>  
                    </li>  
                </ul>  
                
                <!-- END SIDEBAR MENU -->
            </div>
        </div>
        <!-- END SIDEBAR -->
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">
                @yield('content')
            </div>
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <div class="footer">
        <div class="footer-inner">
            2013 &copy; Conquer by keenthemes.
        </div>
        <div class="footer-tools">
            <span class="go-top">
                <i class="fa fa-angle-up"></i>
            </span>
        </div>
    </div>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('conquer/plugins/jquery-1.11.0.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jquery-migrate-1.2.1.min.js') }}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{ asset('conquer/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('conquer/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/uniform/jquery.uniform.min.js') }}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('conquer/plugins/jquery.peity.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jquery.pulsate.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/jquery-knob/js/jquery.knob.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/flot/jquery.flot.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/flot/jquery.flot.resize.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/bootstrap-daterangepicker/moment.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/plugins/bootstrap-daterangepicker/daterangepicker.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('conquer/plugins/gritter/js/jquery.gritter.js') }}" type="text/javascript"></script>
    <!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
    <script src="{{ asset('conquer/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('conquer/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('conquer/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('conquer/scripts/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/scripts/index.js') }}" type="text/javascript"></script>
    <script src="{{ asset('conquer/scripts/tasks.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
    <script>
        jQuery(document).ready(function() {
            App.init(); // initlayout and core plugins
            Index.init();
            Index.initJQVMAP(); // init index page's custom scripts
            Index.initCalendar(); // init index page's custom scripts
            Index.initCharts(); // init index page's custom scripts
            Index.initChat();
            Index.initMiniCharts();
            Index.initPeityElements();
            Index.initKnowElements();
            Index.initDashboardDaterange();
            Tasks.initDashboardWidget();
        });
    </script>
    @yield('js')
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->

</html>
