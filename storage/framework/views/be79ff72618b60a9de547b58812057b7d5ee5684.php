<?php $__env->startSection('title', 'Sindicância - resultado'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">  
  <?php $__env->startComponent('components.treeview',
  [
      'title' => 'Sindicância - resultado',
      'opts' => []
  ]); ?>
  <?php echo $__env->renderComponent(); ?>   
  
  <?php $__env->startComponent('components.menu',
  [
      'title' => 'Sindicância',
      'prop' => ['8','4'],
      'menu' => [
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.lista','name'=>'Lista'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.andamento','name'=>'Andamento'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.prazos','name'=>'Prazos'],
          ['md'=> 3, 'xs'=> 4, 'route'=>'sindicancia.rel_situacao','name'=>'Rel. Situação'],
          ['md'=> 2, 'xs'=> 4, 'route'=>'sindicancia.resultado','name'=>'resultado','type' => 'success']
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
                    <th class='col-xs-2 col-md-2'>#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Acusado</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th> 
                    <th class='col-xs-2 col-md-2'>Resultado</th>  
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['id_SINDICÂNCIA']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['sjd_ref']); ?> / <?php echo e($registro['sjd_ref_ano']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(opm($registro['SINDICÂNCIAopm'])); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e($registro['cargo']); ?> <?php echo e($registro['nome']); ?></td>
                    <td class='col-xs-2 col-md-2'><?php echo e(sistema('andamentoSINDICÂNCIA',$registro['id_andamento'])); ?></td> 
                    <td class='col-xs-2 col-md-2'>
                    <?php if($registro['resultado'] == "Punido"): ?>
                        <?php if(!$registro['id_punicao']): ?>
                            Cadastrar
                        <?php else: ?>
                            <strong>
                            Punição: <?php echo e(sistema('classPunicao',$registro['id_classpunicao'])); ?>

                            </strong></br>
                            
                            <?php if($registro['id_gradacao'] != 1 && $registro['id_gradacao'] != 3): ?>
                                <?php echo e($registro['dias']); ?> dia(s) -  
                            <?php endif; ?>
                            <?php echo e(sistema('gradacao',$registro['id_gradacao'])); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                    </td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th class='col-xs-2 col-md-2'>#</th>
                    <th class='col-xs-2 col-md-2'>N°/Ano</th>
                    <th class='col-xs-2 col-md-2'>OPM</th>
                    <th class='col-xs-2 col-md-2'>Acusado</th>
                    <th class='col-xs-2 col-md-2'>Andamento</th> 
                    <th class='col-xs-2 col-md-2'>Resultado</th>
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