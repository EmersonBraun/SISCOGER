<?php $__env->startSection('title', 'PROC. OUTROS'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>PROC. OUTROS - Andamento</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">PROC. OUTROS - Andamento</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-default col-md-4 col-xs-4 "  href="<?php echo e(route('procoutros.lista')); ?>">Lista</a>
      <a class="btn btn-success col-md-4 col-xs-4 "  href="<?php echo e(route('procoutros.andamento')); ?>">Andamento</a>
      <a class="btn btn-default col-md-4 col-xs-4 "  href="<?php echo e(route('procoutros.prazos')); ?>">Prazos</a>  
    </div>
    <div class='col-md-4 col-xs-6 '>
        <a class="btn btn-block btn-primary"  href="<?php echo e(route('procoutros.create')); ?>">
        <i class="fa fa-plus "></i> Adicionar PROC. OUTROS</a>
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
                <h3 class="box-title">Listagem de Procedimentos Outros</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                    <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                    <th class='col-xs-1 col-md-1'>Data do fato</th>
                    <th class='col-xs-1 col-md-1'>Data do recebimento</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-3 col-md-3'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_proc_outros']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(opm($registro['cdopm_apuracao'])); ?></td>
                    <td><?php echo e(data_br($registro['data'])); ?></td>
                    <td><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td><?php echo e($registro['andamento']); ?></td>
                    <td><?php echo e($registro['andamentocoger']); ?></td>
                    <td>
                         <span>
                        <a class="btn btn-default" href="<?php echo e(route('procoutros.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('procoutros.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('procoutros.destroy',$registro['id_proc_outros'])); ?>"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM (Abertura)</th>
                    <th class='col-xs-1 col-md-1'>OPM (Apuração)</th>
                    <th class='col-xs-1 col-md-1'>Data do fato</th>
                    <th class='col-xs-1 col-md-1'>Data do recebimento</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-3 col-md-3'>Ações</th>
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