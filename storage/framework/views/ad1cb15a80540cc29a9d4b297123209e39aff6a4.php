<?php $__env->startSection('title', 'IPM - Rel. Sit.'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.ipm.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Abertura</th> 
                    <th class='col-xs-1 col-md-1'>Autuação</th>
                    <th class='col-xs-5 col-md-5'>Check</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_ipm']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(data_br($registro['fato_data'])); ?></td> 
                    <td><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td><?php echo e(data_br($registro['autuacao_data'])); ?></td>
                    <td>
                        <span>
                        <?php if($registro['relato_enc_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Rel. Encarregado</br>
                        <?php if($registro['relato_cmtopm_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Rel. OPM</br>
                        <?php if($registro['relato_cmtgeral_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Rel. CMT Geral</br>
                    </td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Abertura</th> 
                    <th class='col-xs-1 col-md-1'>Autuação</th>
                    <th class='col-xs-5 col-md-5'>Check</th>
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