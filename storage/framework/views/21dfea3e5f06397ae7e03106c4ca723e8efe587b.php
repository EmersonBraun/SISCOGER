<?php $__env->startSection('title_postfix', '| Criar permissões'); ?>

<?php $__env->startSection('content_header'); ?>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class='col-md-12'>
    <h1><i class='fa fa-key'></i> Editar <?php echo e($permission->name); ?></h1>
    <br>
    <?php echo e(Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT'))); ?>

    

    <div class="form-group">
        <?php echo e(Form::label('name', 'Permission Name')); ?>

        <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?>

    </div>
    <br>
    <?php echo e(Form::submit('Editar', array('class' => 'btn btn-primary'))); ?>


    <?php echo e(Form::close()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>