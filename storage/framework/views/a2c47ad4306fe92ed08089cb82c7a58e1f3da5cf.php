<?php $__env->startSection('title_postfix', '| Criar papéis'); ?>

<?php $__env->startSection('content_header'); ?>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class='col-lg-12'>
    <h1><i class='fa fa-key'></i> Criar papéis</h1>
    <hr>
    <?php echo e(Form::open(array('url' => 'roles'))); ?>


    <div class="form-group">
        <?php echo e(Form::label('name', 'Nome')); ?>

        <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?>

    </div>

    <h5><b>Atribuir Permissões</b></h5>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
            </tr>
        </thead>
        <tbody>
           <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e(Form::checkbox('permissions[]',  $permission->id )); ?></td>
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
    <?php echo e($permissions->links()); ?>

    <?php echo e(Form::submit('Save', array('class' => 'btn btn-primary'))); ?>

    <?php echo e(Form::close()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <?php echo $__env->make('vendor.adminlte.includes.tabelas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>