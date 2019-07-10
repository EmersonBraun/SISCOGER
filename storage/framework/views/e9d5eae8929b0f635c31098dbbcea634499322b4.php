<?php $__env->startSection('title', 'FATD - Andamento'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.fatd.list.menu', ['title' => 'Andamento','page' => 'andamento'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_fatd']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?> / <?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                    <td><?php echo e(sistema('andamentocoger',$registro['id_andamentocoger'])); ?></td>
                    <td>
                         <span>
                        <a class="btn btn-default" href="<?php echo e(route('fatd.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('fatd.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('fatd.destroy',$registro['id_fatd'])); ?>"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th>N°/Ano</th>
                    <th>OPM</th>
                    <th>Andamento</th>
                    <th>Andamento COGER</th>
                    <th>Ações</th>  
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