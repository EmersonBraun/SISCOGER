<!DOCTYPE html>
<html>
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
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('public/img/favicon/favicon-96x96.png')}}" />
    
    {{-- estilos compilados com webpack --}}
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">
    <link rel="stylesheet" href="node_modules/font-awesome/css/font-awesome.css" >
    <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @yield('adminlte_css')
    

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <style>
        @import url('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300');
    </style>
</head>

<body class="hold-transition @yield('body_class')">
    <div id="app" class="conteudo">
        @yield('body')
    </div>
{{-- JQuery --}}
<script src="{{ asset('public/js/jquery.min.js') }}"></script>
{{-- Bootstrap --}}
<script src="{{ asset('public/js/bootstrap.js') }}"></script>
{{-- Compilados Vue --}}
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('public/vendor/adminlte/dist/js/adminlte.js') }}"></script>
{{-- @include('vendor.adminlte.js') --}}
@include('toast::messages-jquery')
@yield('adminlte_js')

</body>
</html>
