<?php $__env->startSection('title', 'Sindicância - andamento'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding"> 
  <?php $__env->startComponent('components.treeview',
  [
      'title' => 'Sindicância - andamento',
      'opts' => []
  ]); ?>
  <?php echo $__env->renderComponent(); ?>   
  
  <?php $__env->startComponent('components.menu',
  [
      'title' => 'Sindicância',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.lista','name'=>'Lista'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.andamento','name'=>'Andamento','type' => 'success'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.resultado','name'=>'Resultado']
      ]
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
                <h3 class="box-title">Listagem de SINDICÂNCIA</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Abertura</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['sjd_ref']); ?> / <?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(data_br($registro['abertura_data'])); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(sistema('andamento',$registro['id_andamento'])); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(sistema('andamentocoger',$registro['id_andamentocoger'])); ?></td>
                    <td class='col-xs-3 col-md-3'>
                         <span>
                        <a class="btn btn-default" href="<?php echo e(route('sindicancia.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('sindicancia.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('sindicancia.destroy',$registro['id_sindicancia'])); ?>"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th class='col-xs-1 col-md-1'>N°/Ano</th>
                      <th class='col-xs-1 col-md-1'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Abertura</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th>
                      <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                      <th class='col-xs-2 col-md-2'>Ações</th>   
                    
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