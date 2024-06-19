<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Meta data -->
		{{-- <meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta content="Dashtic - Bootstrap Webapp Responsive Dashboard Simple Admin Panel Premium HTML5 Template" name="description">
		<meta content="Spruko Technologies Private Limited" name="author">
		<meta name="keywords" content="Admin, Admin Template, Dashboard, Responsive, Admin Dashboard, Bootstrap, Bootstrap 4, Clean, Backend, Jquery, Modern, Web App, Admin Panel, Ui, Premium Admin Templates, Flat, Admin Theme, Ui Kit, Bootstrap Admin, Responsive Admin, Application, Template, Admin Themes, Dashboard Template"/> --}}

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <!--Favicon -->
		<link rel="icon" href="{{ asset('assets/dashtic-template/images/brand/favicon.ico') }}" type="image/x-icon"/>

        <!-- Scripts -->        
        <!-- Jquery js-->
        {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}        
		<script src="{{ asset('assets/dashtic-template/js/vendors/jquery-3.5.1.min.js') }}"></script>
		<!-- Bootstrap4 js-->
		<script src="{{ asset('assets/dashtic-template/plugins/bootstrap/popper.min.js') }}"></script>
		<script src="{{ asset('assets/dashtic-template/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
		<!--Othercharts js-->
		<script src="{{ asset('assets/dashtic-template/plugins/othercharts/jquery.sparkline.min.js') }}"></script>
		<!-- Circle-progress js-->
		<script src="{{ asset('assets/dashtic-template/js/vendors/circle-progress.min.js') }}"></script>
		<!-- Jquery-rating js-->
		<script src="{{ asset('assets/dashtic-template/plugins/rating/jquery.rating-stars.js') }}"></script>
        

        <!-- Styles -->
        {{-- <link rel="stylesheet" href="{{ asset('css/alertify.min.css') }}"> --}}
		<!-- Bootstrap css -->
		<link href="{{ asset('assets/dashtic-template/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet" />
		<!-- Style css -->
		<link href="{{ asset('assets/dashtic-template/css/style.css') }}" rel="stylesheet" />
		<!-- Dark css -->
		<link href="{{ asset('assets/dashtic-template/css/dark.css') }}" rel="stylesheet" />
		<!-- Skins css -->
		<link href="{{ asset('assets/dashtic-template/css/skins.css') }}" rel="stylesheet" />
		<!-- Animate css -->
		<link href="{{ asset('assets/dashtic-template/css/animated.css') }}" rel="stylesheet" />
		<!---Icons css-->
		<link href="{{ asset('assets/dashtic-template/plugins/web-fonts/icons.css') }}" rel="stylesheet" />
		<link href="{{ asset('assets/dashtic-template/plugins/web-fonts/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/dashtic-template/plugins/web-fonts/plugin.css') }}" rel="stylesheet" />
    </head>
    <body class="h-100vh page-style1 light-mode default-sidebar">

        <div class="page">
            <div class="page-single">
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        </div>
    
    </body>
</html>
