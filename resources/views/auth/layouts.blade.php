<?php
/**
 * Created by Paul Iyaji.
 * Date: 23/11/2023
 * Time: 22:14
 * Project Name: monis-api-homebase
 */
?>
    <!DOCTYPE html>
<html lang="en">

<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_v2.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Nov 2023 18:29:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Adminpage - Responsive Bootstrap Admin Template Dashboard</title>
    <link rel="shortcut icon" href="{{ URL::asset('assets/dist/img/ico/favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js"></script>

    <script>
        WebFont.load({
            google: {
                families: ['Alegreya+Sans:100,100i,300,300i,400,400i,500,500i,700,700i,800,800i,900,900i', 'Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i', 'Open Sans']
            }
        });
    </script>
    <!-- START GLOBAL MANDATORY STYLE -->
    <link href="{{ URL::asset('assets/dist/css/base.css') }}" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap -->
    <!--<link href="assets/bootstrap-rtl/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>-->
    <!-- Pe-icon-7-stroke -->
    <link href="{{ URL::asset('assets/pe-icon-7-stroke/css/pe-icon-7-stroke.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ URL::asset('assets/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style -->
    <link href="{{ URL::asset('assets/dist/css/component_ui.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Theme style rtl -->
    <!--<link href="assets/dist/css/component_ui_rtl.css" rel="stylesheet" type="text/css"/>-->
    <!-- Custom css -->
    <link href="{{ URL::asset('assets/dist/css/custom.css') }}" rel="stylesheet" type="text/css"/>
</head>
<body>


<div class="container">

    @yield('content')
</div>

<!-- jQuery -->
<script src="{{ URL::asset('assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
<!-- bootstrap js -->
<script src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

<!-- Mirrored from thememinister.com/adminpage/theme/adminpage_v2.0/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 23 Nov 2023 18:29:54 GMT -->
</html>
