

<?php $__env->startSection('title', 'Exclusão - Lista'); ?>

<?php $__env->startSection('content_header'); ?>
    <?php echo $__env->make('procedimentos.exclusao.list.menu', ['title' => 'Consulta','page' => 'lista'], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
                <h3 class="box-title">Listagem de Exclusão</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-xs-1 col-md-1'>RG</th>
                    <th class='col-xs-2 col-md-2'>Nome</th>
                    <th class='col-xs-1 col-md-1'>OPM</th>
                    <th class='col-xs-1 col-md-1'>Data Sentença</th>
                    <th class='col-xs-1 col-md-1'>Data Exclusão</th>
                    <th class='col-xs-2 col-md-2'>Artigos</th>
                    <th class='col-xs-1 col-md-1'>Portaria CG</th>  
                    <th class='col-xs-1 col-md-1'>Boletim Geral</th>   
                    <th class='col-xs-2 col-md-2'>Ações</th> 
                  </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro->id_exclusaojudicial); ?></td>
                    <td><a href="<?php echo e(route('fdi.show',$registro->rg)); ?>" target="_blanck"><?php echo e($registro->rg); ?></a></td>
                    <td><?php echo e($registro->cargo); ?> <?php echo e(special_ucwords($registro->nome)); ?></td>
                    <td><?php echo e($registro->present()->opm); ?></td>
                    <td><?php echo e(data_br($registro->data)); ?></td>  
                    <td><?php echo e(data_br($registro->exclusao_data)); ?></td>  
                    <td><?php echo e($registro->complemento); ?></td> 
                    <td><?php echo e($registro->portaria_numero); ?></td> 
                    <td><?php echo e($registro->bg_numero); ?>/<?php echo e($registro->bg_ano); ?></td>  
                    <td>
                        <span>
                        <a class="btn btn-default" href="<?php echo e(route('exclusao.show',$registro->id_exclusaojudicialjudicial)); ?>"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="<?php echo e(route('exclusao.edit',$registro->id_exclusaojudicial)); ?>"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="<?php echo e(route('exclusao.destroy',$registro->id_exclusaojudicial)); ?>" onclick="confirmApagar('exclusao',$registro->id_exclusaojudicial)"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>  
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th style="display: none">#</th>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>OPM</th>
                    <th>Data Sentença</th>
                    <th>Data Exclusão</th>
                    <th>Artigos</th>
                    <th>Portaria CG</th>  
                    <th>Boletim Geral</th>  
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