<?php $__env->startSection('title_postfix', '| Busca PM/BM'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <h1><i class='fa fa-user'></i> Busca PM/BM</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
        <li class="breadcrumb-item active"><a href="#">Busca PM/BM</a></li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box">
        <div class="box-body">
            <vue-simple-suggest mode="select"></vue-simple-suggest> 
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>