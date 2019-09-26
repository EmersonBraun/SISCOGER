<?php $__env->startSection('title_postfix', '| usuários'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <h1><i class="fa fa-key"></i> Gerenciamento de Usuários</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Gerenciamento de Usuários</li>
    </ol>
    <br>
    <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
        <?php if(hasPermissionTo('listar-papeis')): ?>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('role.index')); ?>" class="btn btn-default btn-block">
                Listar Papéis</a>
        </div>  
        <?php endif; ?>
        <?php if(hasPermissionTo('listar-permissoes')): ?>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('permission.index')); ?>" class="btn btn-default btn-block">
                Listar Permissões</a>
        </div>
        <?php endif; ?>
        <?php if(hasPermissionTo('criar-usuarios')): ?>
        <div class='btn-group col-md-4 col-xs-12 '>
            <a href="<?php echo e(route('user.create')); ?>" class="btn btn-success btn-block">
                <i class="fa fa-plus "></i> Adicionar Usuários</a>
        </div>
        <?php endif; ?>
    <div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Usuários</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Posto/Grad</th>
                            <th class='col-xs-1'>Quadro</th>
                            <th class='col-xs-1'>Email</th>
                            <th class='col-xs-2'>Unidade</th>
                            <th class='col-xs-2'>Papéis</th>
                            <th class='col-xs-2'>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->rg); ?></td>
                            <td><?php echo e($user->nome); ?></td>
                            <td><?php echo e($user->cargo); ?></td>
                            <td><?php echo e($user->quadro); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->opm_descricao); ?></td>
                            <td><?php echo e($user->roles()->pluck('name')->implode('/')); ?></td>
                            <td>
                                <div class="btn-group">
                                    <?php if(hasPermissionTo('editar-usuarios')): ?>
                                        <a href="<?php echo e(route('user.edit', $user->id)); ?>" class="btn btn-info">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    <?php endif; ?>
                                    <?php if(hasPermissionTo('apagar-usuarios')): ?>
                                        <a href="<?php echo e(route('user.destroy', $user->id)); ?>" class="btn btn-danger" onclick='return confirm("Você tem certeza?");'>
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                   
                                    <?php if($user->block == 0): ?>
                                        <?php if(hasPermissionTo('bloquear-usuarios')): ?>     
                                        <a href="<?php echo e(route('user.block', $user->id)); ?>" class="btn btn-warning">
                                            <i class="fa fa-lock"></i>
                                        </a>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php if(hasPermissionTo('desbloquear-usuarios')): ?>
                                        <a href="<?php echo e(route('user.unblock', $user->id)); ?>" class="btn btn-secondary">
                                            <i class="fa fa-unlock"></i>
                                        </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                        <a href="<?php echo e(route('user.sendMail', ['id' =>$user->id, 'resend' => true])); ?>" class="btn btn-success">
                                            <i class="fa fa-envelope"></i>
                                        </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class='col-xs-1'>RG</th>
                            <th class='col-xs-2'>Nome</th>
                            <th class='col-xs-1'>Posto/Grad</th>
                            <th class='col-xs-1'>Quadro</th>
                            <th class='col-xs-1'>Email</th>
                            <th class='col-xs-2'>Unidade</th>
                            <th class='col-xs-2'>Papéis</th>
                            <th class='col-xs-2'>Ações</th>
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