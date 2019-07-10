<?php $__env->startSection('title', 'IT - Rel. Val.'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.it.list.menu', ['title' => 'Rel. Valores','page' => 'rel_valores'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
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
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class="col-md-2 col-xs-2">N°/Ano</th>
                    <th class="col-md-2 col-xs-2">OPM</th>
                    <th class="col-md-2 col-xs-2">Viatura</th>
                    <th class="col-md-3 col-xs-3">Dano estimado</th>
                    <th class="col-md-3 col-xs-3">Dano real</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_it']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e($registro['vtr_prefixo']); ?>, (placa <?php echo e($registro['vtr_placa']); ?>)</td>
                    <td><?php if($registro['danoestimado_rs'] != ''): ?> R$ <?php echo e($registro['danoestimado_rs']); ?><?php endif; ?></td>
                    <td><?php if($registro['danoreal_rs'] != ''): ?> R$ <?php echo e($registro['danoreal_rs']); ?><?php endif; ?></td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th style="display: none">#</th>
                        <th class="col-md-2 col-xs-2">N°/Ano</th>
                        <th class="col-md-2 col-xs-2">OPM</th>
                        <th class="col-md-2 col-xs-2">Viatura</th>
                        <th class="col-md-3 col-xs-3">Dano estimado</th>
                        <th class="col-md-3 col-xs-3">Dano real</th>
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