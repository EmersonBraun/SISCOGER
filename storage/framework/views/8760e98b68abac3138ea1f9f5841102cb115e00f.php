<?php $__env->startSection('title', 'ADL - Andamento'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding"> 
    <?php $__env->startComponent('components.treeview',
    [
      'title' => 'ADL - Andamento',
      'opts' => []
    ]); ?>
    <?php echo $__env->renderComponent(); ?>   
  
    <?php $__env->startComponent('components.menu',
    [
      'title' => 'ADL',
      'prop' => ['10','2'],
      'menu' => [
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.lista','name'=>'lista'],
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.andamento','name'=>'Andamento'],
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.prazos','name'=>'Prazos','type'=>'success'],
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação'],
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.julgamento','name'=>'Julgamento'],
        ['md'=> 2, 'xs'=> 2, 'route'=>'adl.apagados','name'=>'Apagados']
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
                    <th class='col-xs-1 col-md-1'>Data</th>
                    <th class='col-xs-2 col-md-2'>Presidente</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th>
                    <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                    <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                    <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                    <th class='col-xs-1 col-md-1'>Prazo</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                  <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_adl']); ?></td>
                    <td><?php echo e($registro->present()->refAno); ?></td>
                    <td><?php echo e($registro->abertura_data); ?></td>
                    <td><?php echo e($registro->present()->cargoENome); ?></td>
                    <td><?php echo e($registro->present()->andamento); ?></td>
                    <td><?php echo e($registro->present()->andamentocoger); ?></td>
                    
                    <td>
                      <?php if($registro['dusobrestado'] == '' || $registro['dusobrestado'] == NULL): ?>
                        <span class='label label-success'>0</span>
                      <?php else: ?>
                        <span class='label label-info'><?php echo e($registro['dusobrestado']); ?></span>
                      <?php endif; ?>
                    </td>

                    
                    <td>
                      <?php if( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <?php if($registro['motivo']=='' || $registro['motivo']=='outros'): ?>
                          <?php echo e($registro['motivo_outros']); ?>

                        <?php else: ?>
                          <?php echo e($registro['motivo']); ?>

                        <?php endif; ?>
                      <?php else: ?>
                        <span class='label label-success'>Não Sobrest.</span>
                      <?php endif; ?>
                    </td>
                    
                      
                    <td>
                      <?php if( sistema('andamento',$registro["id_andamento"]) == 'ANDAMENTO'): ?>
                        <?php if($registro['dutotal']): ?>
                          <?php if($registro["diasuteis"]>30): ?> 
                            <?php echo e($registro['diasuteis']); ?>

                          <?php else: ?> 
                            <?php echo e($registro['diasuteis']); ?>

                          <?php endif; ?>
                        <?php else: ?> 
                        <span class='label label-error'>S/Data abertura</span>
                        <?php endif; ?>
                      <?php elseif( sistema('andamento',$registro["id_andamento"]) == 'CONCLUÍDO'): ?>
                        <span class='label label-success'>Concluido</span>
                      <?php elseif(sistema('andamento',$registro['id_andamento']) == ''): ?> 
                        <span class='label label-danger'>S/Andamento</span>
                      <?php elseif( sistema('andamento',$registro['id_andamento']) == 'SOBRESTADO'): ?> 
                        <span class='label label-error'>Sobrestado</span>
                      <?php endif; ?> 
                    </td>
                  </tr>

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>

                  <tfoot>
                      <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-1 col-md-1'>N°/Ano</th>
                        <th class='col-xs-1 col-md-1'>Data</th>
                        <th class='col-xs-2 col-md-2'>Presidente</th>
                        <th class='col-xs-2 col-md-2'>Andamento</th>
                        <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                        <th class='col-xs-1 col-md-1'>Sobrestamento</th>
                        <th class='col-xs-2 col-md-2'>Motivo Sobrestamento</th>
                        <th class='col-xs-1 col-md-1'>Prazo</th>      
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