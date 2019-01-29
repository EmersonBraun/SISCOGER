

<?php $__env->startSection('title', 'CJ - Lista'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">  
  <?php $__env->startComponent('components.treeview',
  [
      'title' => 'CJ - Lista',
      'opts' => []
  ]); ?>
  <?php echo $__env->renderComponent(); ?>   
  
  <?php $__env->startComponent('components.menu',
  [
      'title' => 'CJ',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.lista','name'=>'Lista','type' => 'success'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.andamento','name'=>'Andamento'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'cj.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'cj.julgamento','name'=>'Julgamento']
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
                <h3 class="box-title">Listagem de Conselhos de Justificação</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Motivo</th>
                    <th class='col-xs-6 col-md-6'>Sintese</th>
                    <th class='col-xs-2 col-md-2'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td  style="display: none"><?php echo e($registro['id_cj']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                    <?php if($registro['id_decorrenciaconselho'] == 13): ?>
                    <td>Outros (<?php echo e($registro['outromotivo']); ?>)</td>
                    <?php else: ?>
                    <td><?php echo e($registro['decorrenciaconselho']); ?></td>
                    <?php endif; ?>
                    <td class='col-xs-6 col-md-6'><?php echo e($registro['sintese_txt']); ?></td>
                    <td class='col-xs-3 col-md-3'>
                        <span>
                        <a class="btn btn-default" href="<?php echo e(route('cj.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('cj.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('cj.destroy',$registro['id_cj'])); ?>" onclick="confirmApagar('cj',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>Motivo</th>
                    <th class='col-xs-6 col-md-6'>Sintese</th>
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