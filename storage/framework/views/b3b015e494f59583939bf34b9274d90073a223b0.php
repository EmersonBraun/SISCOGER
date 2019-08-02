<?php $__env->startSection('title_postfix', '| regras'); ?>

<?php $__env->startSection('content_header'); ?>
<?php echo $__env->make('administracao.papeis.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title">Listagem de papeis</h3>
                </div>
                <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col'>Papel</th>
                                <th class='col'>Permissões</th>
                                <th class='col'>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="display: none"><?php echo e($role->id); ?></td>
                                <td><?php echo e($role->name); ?></td>
                                <td><?php echo e(str_replace(array('[',']','"'),'', $role->permissions()->pluck('name'))); ?></td>
                                <td>
                                    <?php if(hasPermissionTo('editar-papeis')): ?> 
                                    <a href="<?php echo e(route('role.edit',$role->id)); ?>" class="btn btn-info"
                                        style="margin-right: 3px;">Editar</i></a>
                                    <?php endif; ?>
                                    <?php if(hasPermissionTo('apagar-papeis')): ?>
                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['role.destroy', $role->id] ]); ?>

                                    <?php echo Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return
                                    confirm("Você tem certeza?");']); ?>

                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col'>Papel</th>
                                <th class='col'>Permissões</th>
                                <th class='col'>Ações</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>