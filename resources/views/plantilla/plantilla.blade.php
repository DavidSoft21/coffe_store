<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> Coffe Store </title>
    <!-- Tell the browser to be responsive to screen width -->
    <link rel="stylesheet" href="{{ asset ('bower_components/bootstrap/dist/css/bootstrap.min.css') }} ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset ('bower_components/font-awesome/css/font-awesome.min.css') }} ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset ('bower_components/Ionicons/css/ionicons.min.css') }} ">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset ('/bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}">
    <!-- Google Font -->
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> {{--YA:public/css/familySourceSansPro.css --}}
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset ('/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    {{-- global css --}}
    <link rel="stylesheet" href="{{ asset ('/css/global.css') }}">
    <!-- jQuery 3 -->
    <script src="{{ asset ('bower_components/jquery/dist/jquery.min.js') }} "></script>
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('/bower_components/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset ('/dist/css/skins/_all-skins.min.css') }}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">
            <!-- Navbar -->
            @include('plantilla/header')
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            @include('plantilla/sidebar')
        </aside>
        <!-- /.sidebar -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    COFFEE STORE
                    <small>By Emer Riascos</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
            <!--------------------------
            | Your Page Content Here |
            -------------------------->
            @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <!-- Footer -->
        <footer class="main-footer">
            @include('plantilla/footer')
        </footer>
        <!-- Add the sidebar's background. This div must be placed
        immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset ('bower_components/bootstrap/dist/js/bootstrap.min.js') }} "></script>
    <!-- DataTables -->
    <script src="{{ asset ('bower_components/datatables.net/js/jquery.dataTables.min.js') }} "></script>
    <script src="{{ asset ('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }} "></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('/bower_components/admin-lte/dist/js/adminlte.min.js') }}"></script>
    <!--js -->
    <script src="{{ asset('/js/global.js') }}"></script>
    {{-- select2 --}}
    <script src="{{ asset ('bower_components/select2/dist/js/select2.full.min.js') }} "></script>
    {{-- vue --}}
    <script src="{{ asset ('/js/vue.js') }}"></script>
    <!-- SweetAlert js -->
    <script src="{{ asset ('/js/SweetAlert.js') }}"></script>
    <!-- App scripts -->
    @stack('scripts')
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
    Both of these plugins are recommended to enhance the
    user experience. -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>