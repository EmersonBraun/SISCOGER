<?php $__env->startSection('title_postfix', '| FDI'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header noppading">   
<h1><i class='fa fa-user'></i> Ficha Individual:</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('busca.pm')); ?>">Busca PM/BM</a></li>
    <li class="breadcrumb-item active">FDI - Visualizar</li>
</ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="noppading">
    <div class="row">
        <div class="col-xs-12">
            <v-principal rg="<?php echo e($rg); ?>"></v-principal>
        </div>     
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <v-tabs nav-style="pills" justified>
                        <?php if(hasPermissionTo('ver-denuncias')): ?>
                            <v-denuncias rg="<?php echo e($rg); ?>"></v-denuncias>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-outras-denuncias')): ?>
                            <v-outras-denuncias rg="<?php echo e($rg); ?>"></v-outras-denuncias>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-prisoes')): ?>
                            <v-prisoes rg="<?php echo e($rg); ?>"></v-prisoes>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-restricoes')): ?>
                            <v-restricoes rg="<?php echo e($rg); ?>"></v-restricoes>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('listar-sai')): ?>
                            <v-sai rg="<?php echo e($rg); ?>"></v-sai>
                        <?php endif; ?>
                        <?php if(hasAnyPermission(['ver-mudanca-comportamento','ver-elogios'])): ?>
                            <v-fdi rg="<?php echo e($rg); ?>"></v-fdi>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-objetos')): ?>
                            <v-objeto rg="<?php echo e($rg); ?>"></v-objeto>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-membros')): ?>
                            <v-membro rg="<?php echo e($rg); ?>"></v-membro>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-aprestacoes')): ?>
                            <v-apresentacoes rg="<?php echo e($rg); ?>"></v-apresentacoes>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-proc-outros')): ?>
                            <v-proc-outros rg="<?php echo e($rg); ?>"></v-proc-outros>
                        <?php endif; ?>
                        <?php if(hasPermissionTo('ver-cautelas')): ?>
                            <v-cautelas rg="<?php echo e($rg); ?>"></v-cautelas>
                        <?php endif; ?>
                    </v-tabs>
                </div>   
            </div>
        </div>     
    </div>      

    <?php if(hasPermissionTo('ver-afastamentos')): ?>
        <v-afastamentos rg="<?php echo e($rg); ?>"></v-afastamentos>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-dependentes')): ?>
        <v-dependentes rg="<?php echo e($rg); ?>"></v-dependentes>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-tramite-coger')): ?>
        <v-tramite-coger rg="<?php echo e($rg); ?>"></v-tramite-coger>
    <?php endif; ?>
    <?php if(hasPermissionTo('ver-tramite-opm')): ?>
        <v-tramite-opm rg="<?php echo e($rg); ?>"></v-tramite-opm>
    <?php endif; ?>
    <?php if(session('is_admin')): ?>
        <v-log-fdi rg="<?php echo e($rg); ?>"></v-log-fdi>
    <?php endif; ?>
    
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>