<?php $__env->startSection('title_postfix', '| Termos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class="fa fa-key"></i> Listagem de Termos</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item active">Termos</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
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
                <h3 class="box-title">Listagem de Termos</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th style="display: none">#</th>
                    <th class='col-md-3 clo-xs-3'>Nome</th>
                    <th class='col-md-2 clo-xs-2'>Email</th>                    
                    <th class='col-md-2 clo-xs-2'>Expresso</th>                    
                    <th class='col-md-1 clo-xs-1'>Telefone</th>                    
                    <th class='col-md-1 clo-xs-1'>Celular</th>                    
                    <th class='col-md-1 clo-xs-1'>OPM</th>                    
                    <th class='col-md-1 clo-xs-1'>IP</th>                     
                    <th class='col-md-1 clo-xs-1'>Data</th>                     
                  </tr>
                  </thead>

                  <tbody>
                    <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="display: none"><?php echo e($term->datahora); ?></td>
                        <td><?php echo e(special_ucwords($term->nome)); ?></td> 
                        <td><?php echo e($term->email); ?></td> 
                        <td><?php echo e($term->UserExpresso); ?></td>
                        <td><?php echo e($term->telefone); ?></td>  
                        <td><?php echo e($term->celular); ?></td> 
                        <td><?php echo e($term->opm); ?></td> 
                        <td><?php echo e($term->ip); ?></td> 
                        <td><?php echo e(data_br($term->datahora,1)); ?></td> 
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>

                  <tfoot>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col-md-3 clo-xs-3'>Nome</th>
                      <th class='col-md-2 clo-xs-2'>Email</th>                    
                      <th class='col-md-2 clo-xs-2'>Expresso</th>                    
                      <th class='col-md-1 clo-xs-1'>Telefone</th>                    
                      <th class='col-md-1 clo-xs-1'>Celular</th>                    
                      <th class='col-md-1 clo-xs-1'>OPM</th>                    
                      <th class='col-md-1 clo-xs-1'>IP</th>                     
                      <th class='col-md-1 clo-xs-1'>Data</th>   
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