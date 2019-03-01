<?php $__env->startSection('title', 'adl'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">  
    <?php $__env->startComponent('components.treeview',
    [
      'title' => 'ADL - Lista',
      'opts' => []
    ]); ?>
    <?php echo $__env->renderComponent(); ?>   
  
    <?php $__env->startComponent('components.menu',
    [
      'title' => 'ADL',
      'prop' => ['8','4'],
      'menu' => [
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.lista','name'=>'lista','type'=>'success'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.andamento','name'=>'Andamento'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.prazos','name'=>'Prazos'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação'],
        ['md'=> 2, 'xs'=> 4, 'route'=>'adl.julgamento','name'=>'Julgamento']
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
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                      <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>N°/Ano</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-8 col-md-8'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                  <?php $__currentLoopData = json_decode($registros); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro->id_adl); ?></td>
                    <?php if($registro->sjd_ref != ''): ?>
                    <td><?php echo e($registro->sjd_ref); ?>/<?php echo e($registro->sjd_ref_ano); ?></td>
                    <?php else: ?>
                    <td><?php echo e($registro->id_adl); ?></td>
                    <?php endif; ?>
                    <td><?php echo e($registro->presenter()->opm); ?></td>
                    <td><?php echo e($registro->sintese_txt); ?></td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="<?php echo e(route('adl.show',['ref' => $registro['sjd_ref'], 'ano' => $registro->sjd_ref])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('adl.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro->sjd_ref])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('adl.destroy',$registro['id_adl'])); ?>" onclick="confirmApagar('adl',$registro['sjd_ref'],$registro->sjd_ref)"><i class="fa fa-fw fa-trash-o "></i></a>
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
                    <th>Sintese</th>
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