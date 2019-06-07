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
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success btn-block">
          <i class="fa fa-plus "></i> Adicionar Usuários</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="<?php echo e(route('roles.index')); ?>" class="btn btn-default btn-block">
          Papéis</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-default btn-block">
          Permissões</a>
    </div>
  <div>
</section>  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section>

  <div class="col-md-12">

    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Listagem de Usuários</h3>
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table id="datable" class="table table-bordered table-striped">

          <thead>
              <tr>
                  <th class='col-xs-1 col-md-1'>#</th>
                  <th class='col-xs-1 col-md-1'>RG</th>
                  <th class='col-xs-2 col-md-2'>Email</th>
                  <th class='col-xs-2 col-md-2'>Unidade</th>
                  <th class='col-xs-2 col-md-2'>Papéis</th>
                  <th class='col-xs-4 col-md-4'>Ações</th>
              </tr>
          </thead>

          <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                  <td><?php echo e($user->id); ?></td>
                  <td><?php echo e($user->rg); ?></td>
                  <td><?php echo e($user->email); ?></td>
                  <td><?php echo e($user->opm_descricao); ?></td>
                  <td><?php echo e($user->roles()->pluck('name')->implode('/')); ?></td>
                  <td>
                    <div class="btn-group">
                      <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="btn btn-info pull-left" style="margin-right: 3px;">Editar</a>
                      <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id],'style' => 'display: inline' ]); ?>

                      <?php echo Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Você tem certeza?");','style' => 'display: inline']); ?>

                      <?php echo Form::close(); ?>

                  <?php if($user->block == '0'): ?>
                    <a href="<?php echo e(route('users.block', $user->id)); ?>" class="btn btn-warning" style="">Bloquear</a>
                  <?php else: ?>
                    <a href="<?php echo e(route('users.unblock', $user->id)); ?>" class="btn btn-success" style="">Desbloquear</a>
                  <?php endif; ?>
                    </div>
                  </td>
                  
                  
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>

          <tfoot>
            <tr>
                <th class='col-xs-1 col-md-1'>#</th>
                  <th class='col-xs-1 col-md-1'>RG</th>
                  <th class='col-xs-2 col-md-2'>Email</th>
                  <th class='col-xs-2 col-md-2'>Unidade</th>
                  <th class='col-xs-2 col-md-2'>Papéis</th>
                  <th class='col-xs-4 col-md-4'>Ações</th>
            </tr>
          </tfoot>

        </table>
        
      </div>
      <!-- /.box-body -->
    </div>

  </div>

</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <?php echo $__env->make('vendor.adminlte.includes.tabelas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>