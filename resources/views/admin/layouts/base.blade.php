<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- BEGIN: Head -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ config('app.name') }}">
    <meta name="author" content="{{ config('app.name') }}">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('admin/img/favicon.ico') }}" type="image/x-icon">

    <!-- Fonts -->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    @yield('head')

    <!-- BEGIN: CSS Assets-->    
    <link href="{{ asset('admin/vendor/jquery-treetable/jquery.treetable.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/jquery-treetable/jquery.treetable.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/select2-to-tree/select2totree.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/froala-editor/css/froala_editor.pkgd.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/vendor/alertify/alertify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/common.css') }}" rel="stylesheet">
    @yield('css')
    <!-- END: CSS Assets-->
    <!-- BEGIN: JS Assets-->
    <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-treetable/jquery.treetable.js') }}"></script>
    <script src="{{ asset('admin/vendor/jquery-number/jquery.number.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/select2-to-tree/select2totree.js') }}"></script>
    <script src="{{ asset('admin/vendor/moment.js/moment-with-locales.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/froala-editor/js/froala_editor.pkgd.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/alertify/alertify.min.js') }}"></script>
    <!-- END: JS Assets-->
</head>
<!-- END: Head -->

@yield('body')

<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>
<script src="{{ asset('admin/js/common.js') }}"></script>
@yield('script')
</html>