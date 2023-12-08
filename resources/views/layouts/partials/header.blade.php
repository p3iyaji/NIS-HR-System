<?php
/**
 * Created by Paul Iyaji.
 * Date: 24/11/2023
 * Time: 09:25
 * Project Name: monis-api-homebase
 */
?>
    <!DOCTYPE html>
<html lang=en>

<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_v2.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Nov 2023 18:28:18 GMT -->
<head>
    <meta charset=utf-8>
    <meta http-equiv=X-UA-Compatible content="IE=edge">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <meta name=description content="">
    <meta name=author content="">
    <title>Adminpage - Responsive Bootstrap Admin Template Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
            }
        });
    </script>
    <link href="{{ URL::asset('assets/dist/css/base.css') }}" rel=stylesheet type="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/toastr/toastr.min.css') }}" rel=stylesheet type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/emojionearea/emojionearea.min.css') }}" rel=stylesheet type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/monthly/monthly.min.css') }}" rel=stylesheet type="text/css"/>
    <link href="{{ URL::asset('assets/plugins/amcharts/export.css') }}" rel=stylesheet type="text/css"/>
    <link href="{{ URL::asset('assets/dist/css/component_ui.min.css') }}" rel=stylesheet type="text/css"/>
    <link id=defaultTheme href="{{ URL::asset('assets/dist/css/skins/skin-dark-1.min.css') }}" rel=stylesheet type="text/css"/>
    <link href="{{ URL::asset('assets/dist/css/custom.css') }}" rel=stylesheet type="text/css"/>
    <!--[if lt IE 9]>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ URL::asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/metisMenu/metisMenu.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/lobipanel/lobipanel.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/sparkline/sparkline.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/counterup/waypoints.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/emojionearea/emojionearea.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/monthly/monthly.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/amcharts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/ammap.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/worldLow.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/serial.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/export.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/light.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/amcharts/pie.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/page/dashboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/jQuery.style.switcher.min.js') }}"></script>

    <script src="{{ URL::asset('assets/plugins/datatables/dataTables.min.js') }}" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <style>
        .dropdown-menu > li > a:hover {
            color: #ffffff;
            background-image: none;
            background-color: rgba(180, 137, 107, 0.94);
        }
    </style>
</head>
<body>
<div id=wrapper class="wrapper animsition">
    <!-- Navigation -->
    <nav class="navbar navbar-fixed-top">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <i class="material-icons">apps</i>
            </button>
            <a class="navbar-brand" href="{{ url('dashboard') }}">
                <img class="main-logo p-0 m-0 hidden-xs" src="{{ URL::asset('assets/imgs/nis_logo2.jpeg') }}" id="bg" alt="logo" width="100%" height="200px;">
                <!--<span>AdminPage</span>-->
            </a>
        </div>
        <div class="nav-container">
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav hidden-xs">
                <li><a id="fullscreen" href="#"><i class="material-icons">fullscreen</i> </a></li>
                <!-- /.Fullscreen -->
                <li><a id="menu-toggle" href="#"><i class="material-icons">apps</i></a></li>
                <!-- /.Sidebar menu toggle icon -->
                <!--Start dropdown menu-->

            </ul>
            <ul class="nav navbar-top-links navbar-right">


                <!-- /.Dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="material-icons">person_add</i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="ti-user"></i>&nbsp; Profile</a></li>
                        <li><a href="#"><i class="ti-email"></i>&nbsp; My Messages</a></li>
                        <li><a href="#"><i class="ti-lock"></i>&nbsp; Lock Screen</a></li>
                        <li><a href="#"><i class="ti-settings"></i>&nbsp; Settings</a></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                            ><i class="ti-layout-sidebar-left"></i>&nbsp;Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </li>
                    </ul><!-- /.dropdown-user -->
                </li><!-- /.Dropdown -->
                <li class="log_out">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"
                    ><i class="material-icons">power_settings_new</i></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>

                </li><!-- /.Log out -->
            </ul> <!-- /.navbar-top-links -->
        </div>
    </nav>
