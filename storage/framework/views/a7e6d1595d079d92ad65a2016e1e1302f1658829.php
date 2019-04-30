<?php $__env->startSection('title', 'IT - Prazos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>IT - Prazos</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IT - Prazos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.lista')); ?>">Lista</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.andamento')); ?>">Andamento</a>
      <a class="btn btn-success col-md-2 col-xs-4 "  href="<?php echo e(route('it.prazos')); ?>">Prazos</a>  
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.rel_valores')); ?>">Rel. Valores</a> 
    </div>
    <div class='col-md-4 col-xs-6 '>
        <a class="btn btn-block btn-primary"  href="<?php echo e(route('it.create')); ?>">
        <i class="fa fa-plus "></i> Adicionar IT</a>
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
                <h3 class="box-title">Listagem de Inquérito Técnico</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Prazo</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_it']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e($registro['cargo']); ?> <?php echo e(special_ucwords($registro['nome'])); ?></td>
                    <td><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td>
                    <?php if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL): ?>
                      <span class='label label-success'>0</span>
                    <?php else: ?>
                      <span class='label label-info'><?php echo e($registro['dusobrestado']); ?></span>
                    <?php endif; ?>
                    </td>
                    
                      <?php if( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <?php if($registro['motivo']=='' || $registro['motivo']=='outros'): ?>
                          <td class='col-xs-2 col-md-2'><?php echo e($registro['motivo_outros']); ?></td>
                        <?php else: ?>
                          <td class='col-xs-2 col-md-2'><?php echo e($registro['motivo']); ?></td>
                        <?php endif; ?>
                      <?php else: ?>
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-success'>Não Sobrest.</span>
                        </td>
                      <?php endif; ?>
                      
                      <?php if( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO'): ?>
                        <?php if($registro['dutotal']): ?>
                          <?php if($registro["diasuteis"]>30): ?> 
                          <td class='col-xs-2 col-md-2'><?php echo e($registro['diasuteis']); ?></td>
                          <?php else: ?> 
                          <td class='col-xs-2 col-md-2'><?php echo e($registro['diasuteis']); ?></td>
                          <?php endif; ?>
                        <?php else: ?> 
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-error'>S/Data abertura</span>
                        </td>
                        <?php endif; ?>
                      <?php elseif( sistema('andamentocd',$registro["id_andamento"]) == 'CONCLUÍDO'): ?>
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-success'>Concluido</span>
                        </td>
                      <?php elseif(sistema('andamentocd',$registro['id_andamento']) == ''): ?> 
                        <td class='col-xs-2 col-md-2'>
                          <span class='label label-danger'>S/Andamento</span>
                        </td>
                      <?php elseif( sistema('andamentocd',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <td class='col-xs-2 col-md-2'>
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
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Sobrestamento</th>
                      <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                      <th class='col-xs-2 col-md-2'>Prazo</th>     
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