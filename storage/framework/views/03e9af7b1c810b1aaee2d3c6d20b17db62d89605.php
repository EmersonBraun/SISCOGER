<?php $__env->startSection('title_postfix', '| FDI'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
<h1><i class='fa fa-user'></i> Ficha Individual:</h1>
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('busca.pm')); ?>">Busca PM/BM</a></li>
    <li class="breadcrumb-item active">FDI - Visualizar</li>
</ol>
</section>
<div class="form-group col-md-4"> 
    <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="expandirTudo()">Expandir tudo</a>
    <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="recolherTudo()">Recolher Tudo</a>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-xs-12">
        <?php echo $__env->make('FDI.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="nav-tabs-custom">
        <?php echo $__env->make('FDI.tabs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <div class="tab-content">
                <?php echo $__env->make('FDI.denuncias', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.outras_denuncias', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.prisoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.restricoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.sai', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.fdi', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.objeto', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.membro', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.apresentacoes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('FDI.proc_outros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="tab-pane" id="cautelas">
                    <v-cautelas rg="<?php echo e($pm->RG); ?>"></v-cautelas>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-afastamentos')): ?>
            <?php echo $__env->make('FDI.afastamentos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-dependentes')): ?>
            <?php echo $__env->make('FDI.dependentes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-tramite-coger')): ?>
            <?php echo $__env->make('FDI.tramitecoger', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ver-tramite-opm')): ?>
            <?php echo $__env->make('FDI.tramiteopm', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    <div>
        <input type="button" onclick="cont();" value="Imprimir">
    </div>


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