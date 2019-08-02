<?php $__env->startSection('title_postfix', '| Permissões'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('administracao.permissoes.menu', ['title' => 'Lista','page' => 'lista'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de permissões</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col'>Permissões</th>
                            <th class='col'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="display: none"><?php echo e($permission->id); ?></td>
                            <td><?php echo e($permission->name); ?></td>
                            <td>
                                <?php if(hasPermissionTo('editar-permissoes')): ?>
                                <a href="<?php echo e(route('permission.edit',$permission->id)); ?>" class="btn btn-info pull-left"
                                    style="margin-right: 3px;">Edit</a>
                                <?php endif; ?>
                                <?php if(hasPermissionTo('apagar-permissoes')): ?>
                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['permission.destroy',
                                $permission->id] ]); ?>

                                <?php echo Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => 'return
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>