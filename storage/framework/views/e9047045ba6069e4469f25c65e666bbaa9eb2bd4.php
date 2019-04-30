<?php $__env->startSection('title', 'IT - Rel. Val.'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>IT - Relatório Valores</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">IT - Relatório Valores</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.lista')); ?>">Lista</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.andamento')); ?>">Andamento</a>
      <a class="btn btn-default col-md-2 col-xs-4 "  href="<?php echo e(route('it.prazos')); ?>">Prazos</a>  
      <a class="btn btn-success col-md-2 col-xs-4 "  href="<?php echo e(route('it.rel_valores')); ?>">Rel. Valores</a> 
    </div>
    <div class='col-md-2 col-xs-6 '>
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