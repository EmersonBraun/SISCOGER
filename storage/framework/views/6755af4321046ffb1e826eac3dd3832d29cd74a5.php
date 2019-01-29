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
      <a href="<?php echo e(route('users.index')); ?>" class="btn btn-default btn-block">Usuários</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="<?php echo e(route('roles.create')); ?>" class="btn btn-success btn-block">
        <i class="fa fa-plus "></i> Adicionar papeis</a>
    </div>
    <div class='btn-group col-md-4 col-xs-12 '>
      <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-default btn-block">Permissões</a>
    </div>
  <div>
</section>
 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de papeis</h3>
              </div>
              <!-- /.box-header -->
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
                    <a href="<?php echo e(route('roles.edit',$role->id)); ?>" class="btn btn-info" style="margin-right: 3px;">Editar</i></a>
                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id] ]); ?>

                    <?php echo Form::submit('Apagar', ['class' => 'btn btn-danger', 'onclick' => 'return confirm("Você tem certeza?");']); ?>

                    <?php echo Form::close(); ?>

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
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <?php echo $__env->make('vendor.adminlte.includes.tabelas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>