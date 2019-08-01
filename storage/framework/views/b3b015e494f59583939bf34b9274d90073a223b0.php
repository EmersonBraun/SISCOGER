<?php $__env->startSection('title_postfix', '| regras'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <h1><i class="fa fa-key"></i> Gerenciamento de papéis</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gerenciamento de papéis</li>
    </ol>
    <br>
    <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('user.index')); ?>" class="btn btn-default btn-block">Usuários</a>
        </div>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('role.create')); ?>" class="btn btn-success btn-block">
                <i class="fa fa-plus "></i> Adicionar papeis</a>
        </div>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('permission.index')); ?>" class="btn btn-default btn-block">Permissões</a>
        </div>
        <div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <div class="box-header">
                    <h3 class="box-title">Listagem de papeis</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">

                        <thead>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col-xs-2'>Papel</th>
                                <th class='col-xs-6'>Permissões</th>
                                <th class='col-xs-4'>Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="display: none"><?php echo e($role->id); ?></td>
                                <td><?php echo e($role->name); ?></td>
                                <td><?php echo e(str_replace(array('[',']','"'),'', $role->permissions()->pluck('name'))); ?></td>
                                <td>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('editar-papeis')): ?> 
                                    <a href="<?php echo e(route('role.edit',$role->id)); ?>" class="btn btn-info"
                                        style="margin-right: 3px;">Editar</i></a>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('apagar-papeis')): ?> 
                                    <form method="POST" action="route('role.destroy',$role->id)" accept-charset="UTF-8" style="display: inline">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>">
                                        <a class="btn btn-danger" type="submit" onclick="return confirm('Tem certeza que quer apagar?')">
                                            <i class="fa fa-fw fa-trash-o "></i>
                                        </a>
                                    </form>
                                    
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