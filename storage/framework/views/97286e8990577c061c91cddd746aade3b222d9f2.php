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
    <?php echo $__env->make('home.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
   
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>