<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'SISCOGER'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- Icon for aplications --}}
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('public/img/favicon/favicon-96x96.png')}}" />
    {{-- token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/vendor/font-awesome/css/font-awesome.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/fonts/font-awesome/css/font-awesome.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('public/fonts/material/css/material.css') }}"> --}}
    <!-- Ionicons -->
    {{-- <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('public/fonts/Ionicons/css/ionicons.min.css') }}">
    {{-- Compilados --}}
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">

    {{-- datatables --}}
    <link rel="stylesheet" href="{{ asset('public/css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/dataTables.searchHighlight.css') }}">

    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.10.19/features/searchHighlight/dataTables.searchHighlight.css"> --}}

    <style>
        
    .navbar-static-top {
        max-height: 0px !important;
    }
    </style>
    {{-- @include('vendor.adminlte.css') --}}
    @yield('adminlte_css')

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}
    
</head>
<body class="hold-transition @yield('body_class')">
@yield('body')
@include('vendor.adminlte.js')
@if(Session::has('toasts'))
<!-- Messenger http://github.hubspot.com/messenger/ -->
<link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
{{-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css"> --}}
<script src="{{ asset('public/js/toastr.min.js') }}"></script>
{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

<script type="text/javascript">
		toastr.options = {
            "closeButton": true,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right"
		};
        
		@foreach(Session::get('toasts') as $toast)
        toastr["{{ $toast['level'] }}"]("{{ $toast['message'] }}","{{ $toast['title'] }}");
		@endforeach
        </script>
@endif
@yield('adminlte_js')

</body>
</html>
