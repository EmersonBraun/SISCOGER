<?php $__env->startSection('title', 'APFD - Rel. Sit.'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding"> 
  <?php $__env->startComponent('components.treeview',
  [
      'title' => 'APFD - Relatório de Situação',
      'opts' => []
  ]); ?>
  <?php echo $__env->renderComponent(); ?>   
  
  <?php $__env->startComponent('components.menu',
  [
      'title' => 'APFD',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.lista','name'=>'lista'],
          ['md'=> 6, 'xs'=> 6, 'route'=>'apfd.rel_situacao','name'=>'Rel. Situação','type' => 'success']
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
                <h3 class="box-title">Listagem de Autos de prisão em flagrante delito</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Policial</th>
                    <th class='col-xs-1 col-md-1'>Fato</th>
                    <th class='col-xs-1 col-md-1'>Crime</th>  
                    <th class='col-xs-2 col-md-2'>Especificar</th>
                    <th class='col-xs-2 col-md-2'>Publicação</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                  </tr>
                  </thead>
  
                  <tbody>
                    <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_apfd']); ?></td> 
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e($registro['cargo']); ?> <?php echo e(special_ucwords($registro['nome'])); ?></td>
                    <td><?php echo e(data_br($registro['fato_data'])); ?></td> 
                    <td><?php echo e($registro['tipo']); ?></td> 
                    <?php if($registro["tipo_penal_novo"]=="Outros"): ?>
                    <td><?php echo e($registro['especificar']); ?></td>
                    <?php else: ?>
                    <td><?php echo e($registro['tipo_penal_novo']); ?></td> 
                    <?php endif; ?>
                    <td><?php echo e($registro['doc_tipo']); ?> 
                        <?php if($registro['doc_numero'] != ''): ?> nº:<?php echo e($registro['doc_numero']); ?> <?php else: ?> s/nº <?php endif; ?>
                    </td> 
                    <td><?php echo e(sistema('andamentocoger',$registro['id_andamentocoger'])); ?></td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-1 col-md-1'>N°</th>
                      <th class='col-xs-1 col-md-1'>OPM</th>
                      <th class='col-xs-2 col-md-2'>Policial</th>
                      <th class='col-xs-1 col-md-1'>Fato</th>
                      <th class='col-xs-1 col-md-1'>Crime</th>  
                      <th class='col-xs-2 col-md-2'>Especificar</th>
                      <th class='col-xs-2 col-md-2'>Publicação</th>
                      <th class='col-xs-2 col-md-2'>Andamento</th>
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