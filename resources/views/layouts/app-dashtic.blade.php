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
        <!--Sidemenu js-->
        <script src="{{ asset('assets/dashtic-template/plugins/sidemenu/sidemenu.js') }}"></script>
        <!-- P-scroll js-->
        <script src="{{ asset('assets/dashtic-template/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/p-scrollbar/p-scroll1.js') }}"></script>
        <!-- ECharts js -->
        <script src="{{ asset('assets/dashtic-template/plugins/echarts/echarts.js') }}"></script>
        <!-- Peitychart js-->
        <script src="{{ asset('assets/dashtic-template/plugins/peitychart/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/peitychart/peitychart.init.js') }}"></script>
        <!-- Apexchart js-->
        <script src="{{ asset('assets/dashtic-template/js/apexcharts.js') }}"></script>
        <!--Moment js-->
        <script src="{{ asset('assets/dashtic-template/plugins/moment/moment.js') }}"></script>
        <!-- Daterangepicker js-->
        <script src="{{ asset('assets/dashtic-template/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/js/daterange.js') }}"></script>
        <!---jvectormap js-->
        <script src="{{ asset('assets/dashtic-template/plugins/jvectormap/jquery.vmap.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/jvectormap/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/jvectormap/jquery.vmap.sampledata.js') }}"></script>
        <!-- Index js-->
        <script src="{{ asset('assets/dashtic-template/js/index1.js') }}"></script>
        <!-- Data tables js-->
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/datatable/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/js/datatables.js') }}"></script>
        <!--Counters -->
        <script src="{{ asset('assets/dashtic-template/plugins/counters/counterup.min.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/counters/waypoints.min.js') }}"></script>
        <!--Chart js -->
        <script src="{{ asset('assets/dashtic-template/plugins/chart/chart.bundle.js') }}"></script>
        <script src="{{ asset('assets/dashtic-template/plugins/chart/utils.js') }}"></script>
        <!-- Custom js-->
        <script src="{{ asset('assets/dashtic-template/js/custom.js') }}"></script>
        

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
        <!--Sidemenu css -->
        <link id="theme" href="{{ asset('assets/dashtic-template/css/sidemenu.css') }}" rel="stylesheet">
        <!-- P-scroll bar css-->
        <link href="{{ asset('assets/dashtic-template/plugins/p-scrollbar/p-scrollbar.css') }}" rel="stylesheet" />
        <!---jvectormap css-->
        <link href="{{ asset('assets/dashtic-template/plugins/jvectormap/jqvmap.css') }}" rel="stylesheet" />
        <!-- Data table css -->
        <link href="{{ asset('assets/dashtic-template/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
        <!--Daterangepicker css-->
        <link href="{{ asset('assets/dashtic-template/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    </head>
    <body class="app sidebar-mini light-mode default-sidebar">

        <!---Global-loader-->
        <div id="global-loader" >
            <img src="{{ asset('assets/dashtic-template/images/svgs/loader.svg') }}" alt="loader">
        </div>

        <div class="">
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            @if (isset($header))
                <header class="">
                    <div class="">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- @stack('modals') --}}        
    </body>
</html>
