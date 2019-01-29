<?php $__env->startSection('title_postfix', '| Editar usuarios'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h2><i class='fa fa-user-plus'></i> Atualizar RG:<?php echo e($user->rg); ?></h2>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="/home">Home</a></li>
            <li class="breadcrumb-item"><a href="usuarios">usuarios</a></li>
            <li class="breadcrumb-item active">atualizar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class='col-lg-12'>
    <?php echo e(Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT'))); ?>

    <div class="form-group col-lg-12 <?php if($errors->has('rg')): ?> has-error <?php endif; ?>">
        <?php echo e(Form::label('rg', 'rg')); ?>

        <?php echo e(Form::text('rg', null, array('class' => 'form-control'))); ?>

    </div>
    <div class="form-group col-lg-12 <?php if($errors->has('email')): ?> has-error <?php endif; ?>">
        <?php echo e(Form::label('email', 'Email')); ?>

        <?php echo e(Form::email('email', null, array('class' => 'form-control'))); ?>

    </div>
    <h5><b>Permissões</b></h5>
    <div class="form-group col-lg-12 <?php if($errors->has('roles')): ?> has-error <?php endif; ?>">
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo e(Form::checkbox('roles[]',  $role->id, $user->roles )); ?>

            <?php echo e(Form::label($role->name, ucfirst($role->name))); ?><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php echo e(Form::submit('Atualizar', array('class' => 'btn btn-primary'))); ?>

    <?php echo e(Form::close()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>