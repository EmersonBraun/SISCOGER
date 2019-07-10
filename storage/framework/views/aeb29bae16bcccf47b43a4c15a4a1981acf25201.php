<?php $__env->startSection('title', 'Deserção'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.desercao.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <h3 class="box-title">Listagem de Deserção</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Termo 1</th>  
                    <th class='col-xs-2 col-md-2'>Termo captura</th>
                    <th class='col-xs-2 col-md-2'>Perícia</th>
                    <th class='col-xs-2 col-md-2'>Inclusão/Reversão</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_desercao']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(data_br($registro['fato_data'])); ?></td>   
                    <td><?php echo e($registro['termo_exclusao']); ?></td>  
                    <td><?php echo e($registro['termo_captura']); ?></td>  
                    <td><?php echo e($registro['pericia']); ?></td>
                    <td><?php echo e($registro['termo_inclusao']); ?></td>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <th style="display: none">#</th>
                    <th>N°/Ano</th>
                    <th>OPM</th>
                    <th>Fato</th>
                    <th>Termo 1</th>  
                    <th>Termo captura</th>
                    <th>Perícia</th>
                    <th>Inclusão/Reversão</th>
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