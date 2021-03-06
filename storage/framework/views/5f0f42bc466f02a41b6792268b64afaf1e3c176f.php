<?php $__env->startSection('adminlte_css'); ?>
<link rel="stylesheet"
    href="<?php echo e(asset('public/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')); ?> ">
<?php echo $__env->yieldPushContent('css'); ?>
<?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ?
['boxed' => 'layout-boxed','fixed' => 'fixed','top-nav' => 'layout-top-nav'][config('adminlte.layout')] : '') .
(config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : '')); ?>

<?php $__env->startSection('body'); ?>
<div class="wrapper" id="app">
    <v-app></v-app>
    <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><?php echo config('adminlte.logo_mini', 'SJD'); ?></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><?php echo config('adminlte.logo', 'SISCOGER'); ?></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only"><?php echo e(config('adminlte.toggle_navigation')); ?></span>
            </a>
            <div class="navbar-custom-menu">

                <ul class="nav navbar-nav">
                    <!-- Menú superior -->
                    <?php echo $__env->make('menu.menu-superior', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <!-- /Menú superior -->
                </ul>
            </div>
        </nav>
    </header>

    <?php if(config('adminlte.layout') != 'top-nav'): ?>
    <aside class="main-sidebar">
        <section class="sidebar">
            <?php echo $__env->make('menu.perfil-menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Menu lateral -->
            <ul class="sidebar-menu" data-widget="tree">
                <?php echo $__env->make('menu.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            </ul>
            <!-- /.Menu lateral -->
        </section>
    </aside>
    <?php endif; ?>
    <div class="content-wrapper">
        <section class="content-header">
            <?php echo $__env->yieldContent('content_header'); ?>
        </section>
        <section class="content litlepadding">
            <?php echo $__env->yieldContent('content'); ?>
        </section>
    </div>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Versão</b> <?php echo e(config('sistema.versao')); ?>

        </div>
        <strong>SISCOGER - 2008-<?php echo e(date('Y')); ?>.</strong>
    </footer>
    
</div>
<!-- ./wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('adminlte_js'); ?>

<script src="<?php echo e(asset('public/js/adminlte.min.js')); ?>"></script>
<?php echo $__env->yieldPushContent('js'); ?>
<?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>