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
		<!-- Google Font: Source Sans Pro -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/fontawesome-free/css/all.min.css') }}">
		<!-- icheck bootstrap -->
		<link rel="stylesheet" href="{{ asset('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
		<!-- Theme style -->
		<link rel="stylesheet" href="{{ asset('assets/adminlte/dist/css/adminlte.min.css') }}">
    </head>
    <body class="hold-transition login-page">

		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Admin</b>LTE</a>
			</div>
			<!-- /.login-logo -->
			@yield('content')
		</div>
    
    </body>
</html>
