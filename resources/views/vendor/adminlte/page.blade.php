@extends('adminlte::master')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('public/vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? 
['boxed' => 'layout-boxed','fixed' => 'fixed','top-nav' => 'layout-top-nav'][config('adminlte.layout')] : '') . 
(config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
    <div class="wrapper" id="app">

        <!-- Main Header -->
        <header class="main-header">
            <!-- parte 1  top-nav-->
            <!-- Logo -->
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">{!! config('adminlte.logo_mini', 'SJD') !!}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{!! config('adminlte.logo', 'SISCOGER') !!}</span>
                </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">{{ config('adminlte.toggle_navigation') }}</span>
                </a>
            <!-- endif-->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <!-- Menú superior -->
                        @include('menu.menu-superior') 
                        <!-- /Menú superior -->
                    </ul>
                </div>
                <!-- parte 2  top-nav-->
            </nav>
        </header>

        <!--@if(config('adminlte.layout') != 'top-nav')-->
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                @include('menu.perfil-menu')
                

                <!-- Menu lateral -->
                <ul class="sidebar-menu" data-widget="tree">
                    @include('menu.menu')             
                </ul>
                <!-- /.Menu lateral -->
            </section>
            <!-- /.sidebar -->
        </aside>
        <!--@endif-->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- parte 3  top-nav-->

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content litlepadding">
                
                @yield('content')
            </section>
            <!-- /.content -->
            <!-- parte 4  top-nav-->
            
        </div>
        <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="pull-right hidden-xs">
        <b>Versão</b> {{config('sistema.versao')}}
        </div>
        <strong>SISCOGER - 2008-{{date('Y')}}.</strong>
    </footer>
</div>
    <!-- ./wrapper -->

@stop
@section('adminlte_js')
    
    <script src="{{ asset('public/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop
