<?php $__env->startSection('title', 'IPM - Prazos'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.ipm.list.menu', ['title' => 'Prazos','page' => 'prazos'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="registro">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de Inquérito Policial Militar</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Instauração</th>
                    <th class='col-xs-2 col-md-2'>Encarregado</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th> 
                    <th class='col-xs-2 col-md-2'>Prazo decorrido</th>    
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_ipm']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(data_br($registro['autuacao_data'])); ?></td>
                    <td><?php echo e($registro['cargo']); ?> <?php echo e(special_ucwords($registro['nome'])); ?></td>
                    <td><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                    <?php if( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO'): ?>
                        <?php if($registro['diasuteis']): ?>
                          <?php if($registro["diasuteis"]>60): ?> 
                          <td><span class='label label-danger'><?php echo e($registro['diasuteis']); ?></span></td>
                          <?php else: ?> 
                          <td><?php echo e($registro['diasuteis']); ?></td>
                          <?php endif; ?>
                        <?php else: ?> 
                        <td>
                          <span class='label label-error'>S/Data abertura</span>
                        </td>
                        <?php endif; ?>
                      <?php elseif( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO'): ?>
                        <td>
                          <span class='label label-success'>Concluido</span>
                        </td>
                      <?php elseif(sistema('andamento',$registro['id_andamento']) == ''): ?> 
                        <td>
                          <span class='label label-danger'>S/Andamento</span>
                        </td>
                      <?php elseif( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <td>
                          <span class='label label-error'>Sobrestado</span>
                        </td>
                      <?php endif; ?> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>

                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Instauração</th>
                      <th class='col-xs-2 col-md-2'>Encarregado</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th> 
                      <th class='col-xs-2 col-md-2'>Prazo decorrido</th>    
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
        <!-- /.registro -->
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