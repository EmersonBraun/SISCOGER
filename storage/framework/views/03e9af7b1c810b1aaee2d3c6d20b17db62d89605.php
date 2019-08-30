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
                        <v-denuncias rg="<?php echo e($rg); ?>"></v-denuncias>
                        <v-tab header="outras_denuncias">
                            <?php echo $__env->make('FDI.outras_denuncias', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="prisoes">
                            <?php echo $__env->make('FDI.prisoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="restricoes">
                            <?php echo $__env->make('FDI.restricoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="sai">
                            <?php echo $__env->make('FDI.sai', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="fdi">
                            <?php echo $__env->make('FDI.fdi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="objeto">
                            <?php echo $__env->make('FDI.objeto', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="membro">
                            <?php echo $__env->make('FDI.membro', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-apresentacoes rg="<?php echo e($rg); ?>"></v-apresentacoes>
                        <v-tab header="proc_outros">
                            <?php echo $__env->make('FDI.proc_outros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </v-tab>
                        <v-tab header="cautelas">
                            <v-cautelas rg="<?php echo e($rg); ?>"></v-cautelas>
                        </v-tab>
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
    <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$( document ).ready(function() {
    $('.a').first().addClass('active');
});

function mudaTab(id)
{
    $('.a').removeClass('active');
    $('.'+id).addClass('active');
    $('.tab-pane').removeClass('show');
    $('.tab-pane').removeClass('active');
    $('#'+id).addClass('active');
    $('#'+id).addClass('show');
}
</script>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>