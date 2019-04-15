

<?php $__env->startSection('title', 'PAD'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header"> 
  <?php $__env->startComponent('components.treeview',
  [
    'title' => 'PAD - Lista',
    'opts' => []
  ]); ?>
  <?php echo $__env->renderComponent(); ?>  

  <?php $__env->startComponent('components.menu',
  [
    'title' => 'pad',
    'prop' => ['8','4'],
    'menu' => []
  ]); ?>   
  <?php echo $__env->renderComponent(); ?>
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
                <h3 class="box-title">Listagem de PAD</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped table-hover">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col'>N°/Ano</th>
                    <th class='col'>OPM</th>
                    <th class='col'>Abertura</th>
                    <th class='col'>Andamento</th>
                    <th class='col'>Andamento COGER</th>
                    <th class='col'>Sintese</th>
                    <th class='col'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_pad']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                    <td><?php echo e(sistema('andamentocoger',$registro['id_andamentocoger'])); ?></td>
                    <td><?php echo e($registro['sintese_txt']); ?></td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="<?php echo e(route('pad.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('pad.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('pad.destroy',$registro['id_pad'])); ?>" onclick="confirmApagar('pad',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col'>N°/Ano</th>
                      <th class='col'>OPM</th>
                      <th class='col'>Abertura</th>
                      <th class='col'>Andamento</th>
                      <th class='col'>Andamento COGER</th>
                      <th class='col'>Sintese</th>
                      <th class='col'>Ações</th>    
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