<?php $__env->startSection('title_postfix', '| Criar usuarios'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Criar usuário</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item"><a href="usuarios">usuarios</a></li>
            <li class="breadcrumb-item active">criar</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class=''>
    <?php echo Form::open(array('url' => '/usuarios/salvar')); ?>

    <div class="col-md-6 form-group <?php if($errors->has('rg')): ?> has-error <?php endif; ?>">
        <?php echo Form::label('rg', 'RG'); ?>

        <?php echo Form::text('rg', '', array('class' => 'form-control','placeholder' => 'Busca por rg' , 'onfocusout' => 'completarnome($(this).val())' )); ?>

        <?php if($errors->has('rg')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('rg')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="col-md-6 form-group">
        <?php echo Form::label('nome', 'Nome'); ?>

        <?php echo Form::text('nome', null, array('class' => 'form-control typeahead','placeholder' => 'Busca por nome', 'onfocusout' => 'completarg($(this).val())')); ?>

        <?php if($errors->has('nome')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('nome')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="col-md-12 form-group <?php if($errors->has('roles')): ?> has-error <?php endif; ?>">
    <h3>Permissões</h3><br>
        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo Form::checkbox('roles[]',  $role->id ); ?>

            <?php echo Form::label($role->name, ucfirst($role->name)); ?><br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($errors->has('roles')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('roles')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
    </div>
    <?php echo Form::submit('Salvar', array('class' => 'btn btn-block btn-primary')); ?>

    <?php echo Form::close(); ?>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('vendor.adminlte.includes.nome_rg', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>