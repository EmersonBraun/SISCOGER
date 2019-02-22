<?php $__env->startSection('title_postfix', '| Dasboard'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
        <?php if($nome_unidade != ''): ?>OPM/OBM:  <?php echo e($nome_unidade); ?> <?php endif; ?>
    <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content nopadding">
    <?php echo $__env->make('home.infoboxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="row">
        <?php echo $__env->make('home.transferencias', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.comportamento', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.fatd_punicao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.fatd_prazos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.fatd_abertura', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_prazos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_instauracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.sindicancia_abertura', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.sindicancia_prazos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.cd_abertura', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_instauracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_instauracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_instauracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->make('home.ipm_instauracao', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Efetivo OPM/OBM</h3>
            </div>
            <div class="box-body" style="width:75%;">
                
                <?php echo $efetivo_chartjs->render(); ?>

                <div class="d-flex flex-row">
                    <div class="p-6"><strong>Total efetivo: <?php echo e($total_efetivo->qtd); ?></strong></div>
                    <div class="p-6">Fonte: RHPARANA - data <?php echo e(date('d/m/Y')); ?></div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
    
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Quantitativo procedimetos por ano</h3>
            </div>
            <div class="box-body" style="width:75%;">
                
                <?php echo $chartjs->render(); ?>

                <div class="d-flex flex-row">
                    <div class="p-6">Fonte: Banco de dados SISCOGER - data <?php echo e(date('d/m/Y')); ?></div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>