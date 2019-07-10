<?php $__env->startSection('title', 'fatd'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.fatd.list.menu', ['title' => 'Rel. Situação','page' => 'rel_situacao'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <h3 class="box-title">Listagem de Formulários de Transgração Disciplinar</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Despacho</th>  
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Check</th>
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_fatd']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['sjd_ref']); ?> / <?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(data_br($registro['fato_data'])); ?></td> 
                    <td class='col-xs-2 col-md-2'>
                        <?php echo e(data_br($registro['portaria_data'])); ?>

                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        <?php echo e(data_br($registro['abertura_data'])); ?>

                    </td> 
                    <td class='col-xs-2 col-md-2'>
                        <span>
                        <?php if($registro['fato_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Imputação</br>
                        <?php if($registro['relatorio_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Relatório</br>
                        <?php if($registro['sol_cmt_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            Solução</br>
                        <?php if($registro['notapunicao_file']): ?>
                            <i class="fa fa-check" style='color: green'></i>
                        <?php else: ?>
                            <i class="fa fa-times" style='color: red'></i>
                        <?php endif; ?>
                            N° Punição</br>
                    </td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Fato</th>
                      <th class='col-xs-2 col-md-2'>Despacho</th>  
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Check</th>
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