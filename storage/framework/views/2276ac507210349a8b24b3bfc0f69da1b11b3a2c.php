<?php $__env->startSection('title_postfix', '| LOG Acessos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fa fa-bug"> LOG Acessos</i></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="home">Home</a></li>
            <li class="breadcrumb-item active">LOG Acessos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="col-lg-12 ">
    <div class="table-responsive">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>IP</th>
                    <th>Data/hora</th>
                </tr>
            </thead>
            <tbody>
               <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($log->id_log_acessos); ?></td>
                    <td><?php echo e($log->rg); ?></td>        
                    <td><?php echo e($log->nome); ?></td>        
                    <td><?php echo e($log->ip); ?></td>          
                    <td><?php echo e(date( 'd/m/Y-h:i:s' , strtotime($log->created_at))); ?></td>                                     
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                  <td>Não há registros ainda</td>
                </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
              <tr>
                  <th>#</th>
                  <th>RG</th>
                  <th>Nome</th>
                  <th>IP</th>
                  <th>Data/hora</th>
              </tr>
            </tfoot>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <?php echo $__env->make('vendor.adminlte.includes.tabelas', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>