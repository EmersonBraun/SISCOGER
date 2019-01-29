<?php $__env->startSection('title', 'CJ - Rel. Sit.'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding"> 
    <?php $__env->startComponent('components.treeview',
    [
        'title' => 'CJ - Relatório de Situação',
        'opts' => []
    ]); ?>
    <?php echo $__env->renderComponent(); ?>   
    
    <?php $__env->startComponent('components.menu',
    [
        'title' => 'CJ',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 2, 'xs'=> 4, 'route'=>'cj.lista','name'=>'Lista'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'cj.andamento','name'=>'Andamento'],
            ['md'=> 2, 'xs'=> 4, 'route'=>'cj.prazos','name'=>'Prazos'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'cj.rel_situacao','name'=>'Rel. Situação','type' => 'success'],
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
                            <th class='col-xs-2 col-md-2'>Fato</th>
                            <th class='col-xs-2 col-md-2'>Portaria</th>
                            <th class='col-xs-2 col-md-2'>Parecer</th>  
                            <th class='col-xs-4 col-md-4'>Check</th>
                            </tr>
                        </thead>
        
                        <tbody>
                            <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td  style="display: none"><?php echo e($registro['id_cj']); ?></td>
                            <?php if($registro['sjd_ref'] != ''): ?>
                            <td><?php echo e($registro['sjd_ref']); ?>/<?php echo e($registro['sjd_ref_ano']); ?></td>
                            <?php else: ?>
                            <td><?php echo e($registro['id_cj']); ?></td>
                            <?php endif; ?>
                            <td><?php echo e(data_br($registro['fato_data'])); ?></td> 
                            <td>
                                <?php echo e(data_br($registro['portaria_data'])); ?>

                            </td> 
                            <td>
                                <?php echo e(data_br($registro['prescricao_data'])); ?>

                            </td> 
                            <td>
                                <span>
                                <?php if($registro['libelo_file']): ?>
                                    <i class="fa fa-check" style='color: green'></i>
                                <?php else: ?>
                                    <i class="fa fa-times" style='color: red'></i>
                                <?php endif; ?>
                                    Libelo</br>
                                <?php if($registro['parecer_file']): ?>
                                    <i class="fa fa-check" style='color: green'></i>
                                <?php else: ?>
                                    <i class="fa fa-times" style='color: red'></i>
                                <?php endif; ?>
                                    Parecer</br>
                                <?php if($registro['decisao_file']): ?>
                                    <i class="fa fa-check" style='color: green'></i>
                                <?php else: ?>
                                    <i class="fa fa-times" style='color: red'></i>
                                <?php endif; ?>
                                    Decisão</br>
                                <?php if($registro['rec_ato_file']): ?>
                                    <i class="fa fa-check" style='color: green'></i>
                                <?php else: ?>
                                    <i class="fa fa-times" style='color: red'></i>
                                <?php endif; ?>
                                    Rec. Ato</br>
                            </td> 
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th>N°/Ano</th>
                                <th>Fato</th>
                                <th>Portaria</th>
                                <th>Parecer</th>  
                                <th>Check</th>
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