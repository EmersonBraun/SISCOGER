<?php $__env->startSection('title_postfix', '| Editar papéis'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
<h1><i class='fa fa-key'></i> Atualizar papel: <?php echo e($role->name); ?></h1>
<ol class="breadcrumb">
<li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Editar papéis</li>
</ol>
<br>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="content"> 
    <div class="box">
        <div class="box-header">
            <h2 class="box-title">Atualizar papel: <?php echo e($role->name); ?></h2>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button> 
            </div>             
        </div>
        <?php echo e(Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT'))); ?>


        <?php echo e(Form::label('name', 'Papel nome')); ?>

        <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?>

        <?php if($errors->has('name')): ?>
            <span class="help-block">
                <strong><i class="fa fa-times-circle-o"></i> <?php echo e($errors->first('name')); ?></strong>
            </span>
        <?php endif; ?>

        <div class="box-body">               
            <div class="col-md-12 col-xs-12">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                
                        <tbody>
                            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e(Form::checkbox('permissions[]',  $permission->id, $role->permissions )); ?></td>
                                <td><?php echo e(Form::label($permission->name, ucfirst($permission->name))); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                            </tr>
                        </tfoot>
                    </table>
                    <?php echo e(Form::submit('Editar', array('class' => 'btn btn-primary btn-block'))); ?>

                    <?php echo e(Form::close()); ?>   
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('vendor.adminlte.includes.tabelas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>