

<?php $__env->startSection('title', 'Deserção - Lista'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">  
    <?php $__env->startComponent('components.treeview',['title' => 'Deserção - Lista','opts' => []]); ?>
    <?php echo $__env->renderComponent(); ?>   
    
    <?php $__env->startComponent('components.menu',
    [
        'title' => 'Deserção',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.lista','name'=>'Lista','type' => 'success'],
            ['md'=> 6, 'xs'=> 6, 'route'=>'desercao.rel_situacao','name'=>'Rel. Situação']
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
                <h3 class="box-title">Listagem de Deserção</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-4 col-md-4'>Desertor</th>
                    <th class='col-xs-2 col-md-2'>RG</th>
                    <th class='col-xs-2 col-md-2'>Documento</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_desercao']); ?></td>
                    <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td><?php echo e(opm($registro['cdopm'])); ?></td>
                    <td><?php echo e($registro['nome']); ?></td> 
                    <td><a href="<?php echo e(route('fdi.show',$registro['rg'])); ?>" target="_blanck"><?php echo e($registro['rg']); ?></a></td>
                    <td><?php echo e($registro['doc_tipo']); ?> Nº <?php echo e($registro['doc_numero']); ?></td>  
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th>N°/Ano</th>
                      <th>OPM</th>
                      <th>Desertor</th>
                      <th>RG</th>
                      <th>Documento</th> 
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