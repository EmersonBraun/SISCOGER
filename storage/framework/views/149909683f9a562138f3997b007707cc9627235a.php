<?php $__env->startSection('title', 'CD - Julgamento'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.cd.list.menu', ['title' => 'Julgamento','page' => 'julgamento'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <h3 class="box-title">Listagem de Conselhos de Disciplina</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table id="datable" class="table table-bordered table-striped">
  
                      <thead>
                      <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-2 col-md-2'>N°/Ano</th>
                        <th class='col-xs-2 col-md-2'>Acusado</th>
                        <th class='col-xs-2 col-md-2'>Andamento</th> 
                        <th class='col-xs-2 col-md-2'>Comissão</th> 
                        <th class='col-xs-2 col-md-2'>CMT Geral</th>  
                        <th class='col-xs-2 col-md-2'>Julgamento</th>
                      </tr>
                      </thead>
      
                      <tbody>
                         <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td  style="display: none"><?php echo e($registro['id_cd']); ?></td>
                        <?php if($registro['sjd_ref'] != ''): ?>
                        <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                        <?php else: ?>
                        <td><?php echo e($registro['id_cd']); ?></td>
                        <?php endif; ?>
                        <td><?php echo e($registro['cargo']); ?> <?php echo e($registro['nome']); ?></td>
                        <td><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                        <td><?php echo e($registro['parecer_comissao']); ?></td>
                        <td><?php echo e($registro['parecer_cmtgeral']); ?></td>
                        <td><?php echo e($registro['resultado']); ?></td>
                      </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th style="display: none">#</th>
                        <th>N°/Ano</th>
                        <th>Acusado</th>
                        <th>Andamento</th> 
                        <th>Comissão</th> 
                        <th>CMT Geral</th>  
                        <th>Julgamento</th> 
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