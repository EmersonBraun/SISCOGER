<?php $__env->startSection('title', 'CJ - Prazos'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.cj.list.menu', ['title' => 'Prazos','page' => 'prazos'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <h3 class="box-title">Listagem de Conselhos de Justificação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-2 col-md-2'>Presidente</th>
                    <th class='col-xs-1 col-md-1'>Andamento</th>
                    <th class='col-xs-1 col-md-1'>Andamento COGER</th>
                    <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Prazo</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td  style="display: none"><?php echo e($registro['id_cj']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td><?php echo e($registro['cargo']); ?> <?php echo e(special_ucwords($registro['nome'])); ?></td>
                    <td><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                    <td><?php echo e(sistema('andamentocoger',$registro['id_andamentocoger'])); ?></td>
                    <td>
                    <?php if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL): ?>
                      <span class='label label-success'>0</span>
                    <?php else: ?>
                      <span class='label label-info'><?php echo e($registro['dusobrestado']); ?></span>
                    <?php endif; ?>
                    </td>
                    
                      <?php if(sistema('andamentocj',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <?php if($registro['motivo']=='' || $registro['motivo']=='outros'): ?>
                          <td><?php echo e($registro['motivo_outros']); ?></td>
                        <?php else: ?>
                          <td><?php echo e($registro['motivo']); ?></td>
                        <?php endif; ?>
                      <?php else: ?>
                        <td>
                          <span class='label label-success'>Não Sobrest.</span>
                        </td>
                      <?php endif; ?>
                      
                      <?php if( sistema('andamentocj',$registro["id_andamento"]) == 'ANDAMENTO'): ?>
                        <?php if($registro['dutotal']): ?>
                          <?php if($registro["diasuteis"]>30): ?> 
                          <td><?php echo e($registro['diasuteis']); ?></td>
                          <?php else: ?> 
                          <td><?php echo e($registro['diasuteis']); ?></td>
                          <?php endif; ?>
                        <?php else: ?> 
                        <td>
                          <span class='label label-error'>S/Data abertura</span>
                        </td>
                        <?php endif; ?>
                      <?php elseif( sistema('andamentocj',$registro["id_andamento"]) == 'CONCLUÍDO'): ?>
                        <td>
                          <span class='label label-success'>Concluido</span>
                        </td>
                      <?php elseif(sistema('andamentocj',$registro['id_andamento']) == ''): ?> 
                        <td>
                          <span class='label label-danger'>S/Andamento</span>
                        </td>
                      <?php elseif( sistema('andamentocj',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
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
                    <th>N°/Ano</th>
                    <th>Fato</th>
                    <th>Presidente</th>
                    <th>Andamento</th>
                    <th>Andamento COGER</th>
                    <th>Sobrestamento</th>
                    <th>Motivo Sobrestamento</th>
                    <th>Prazo</th>      
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