<?php $__env->startSection('title', 'ADL - Sobrestamentos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1><?php echo e(strtoupper('adl')); ?> - Sobrestamentos</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('adl.lista',['ano' => date('Y')])); ?>"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Lista</a></li>
  <li><a href="<?php echo e(route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Editar</a></li>
  <li class="active"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Sobrestamentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="#">Editar</a>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="<?php echo e(route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
        <a class="btn btn-success col-md-4 col-xs-4 "  href="<?php echo e(route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
    </div>
    <div class="form-group col-md-4"> 
        <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="expandirTudo()">Expandir tudo</a>
        <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="recolherTudo()">Recolher Tudo</a>
    </div>
  <div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="">
<section class="">
        <div class="col-md-8">
        <h3><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Nº <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?></h3>
        </div>
        
        
    <div class="row">

    <div class="col-xs-12"> 
        <div class="box">
            <div class="box-header">
                
                <h2 class="box-title">Formulário principal</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>

        <div class="box-body"> 
            <div class="col-md-4 col-xs-12">
                <p><strong>OPM/OBM:</strong></p><p> <?php echo e(opm($proc['cdopm'])); ?></p>
            </div>              
            <div class="col-md-4 col-xs-12">
                <p><strong>Andamento:</strong></p><p> <?php echo e(sistema('andamento',$proc['id_andamento'])); ?></p>
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Andamento COGER:</strong></p><p> <?php echo e(sistema('andamentocoger',$proc['id_andamentocoger'])); ?></p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Data do fato:</strong></p><p> <?php echo e($proc['fato_data']); ?></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Data de abertura:</strong></p><p> <?php echo e($proc['abertura_data']); ?></p>
            </div>

            <div class="col-md-12 col-xs-12">
                <p><strong>Sintese do fato:</strong></p><p> <?php echo e($proc['sintese_txt']); ?></p>
            </div>
        </div>
    </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Sobrestamentos</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button> 
                        </div>             
                    </div>
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                                <div class="col-md-2 col-xs-2"><strong>Início</strong></div>
                                <div class="col-md-2 col-xs-2"><strong>Doc. Início</strong></div> 
                                <div class="col-md-2 col-xs-2"><strong>Termino</strong></div>
                                <div class="col-md-2 col-xs-2"><strong>Doc. Término</strong></div>
                                <div class="col-md-4 col-xs-4"><strong>Motivo</strong></div>
                                
                                <?php $__empty_1 = true; $__currentLoopData = $sobrestamentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sobrestamento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-md-2 col-xs-2"><?php echo e($sobrestamento->inicio_data); ?></div> 
                                    <div class="col-md-2 col-xs-2">(<?php echo e($sobrestamento->publicacao_inicio); ?>)</div>
                                    <div class="col-md-2 col-xs-2"><?php echo e($sobrestamento->termino_data); ?></div>
                                    <div class="col-md-2 col-xs-2">(<?php echo e($sobrestamento->publicacao_termino); ?>)</div>
                                    <div class="col-md-4 col-xs-4">
                                        <?php if($sobrestamento->motivo == '' || $sobrestamento->motivo == 'Outros'): ?>
                                            <?php echo e($sobrestamento->motivo_outros); ?>

                                        <?php else: ?>
                                            <?php echo e($sobrestamento->motivo); ?>

                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-md-12">Não Há Sobrestamentos</div>
                                <?php endif; ?>
                        </div>
    
                    </div>   
                </div>
            </div>     
        </div>

        <?php $__env->startComponent('components.sobrestamento',['proc' => $proc, 'name' => 'adl']); ?>
        <?php echo $__env->renderComponent(); ?>
            
        
        </div>

        
        
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.pickers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    function expandirTudo(){
        $( ".box" ).removeClass( "collapsed-box" );
        $( ".box-body" ).show();
        $( ".fa-plus" ).removeClass( "fa-plus" ).addClass( "fa-minus" );
    }
    function recolherTudo(){
        $( ".box" ).addClass( "collapsed-box" );
        $( ".box-body" ).hide();
        $( ".fa-minus" ).removeClass( "fa-minus" ).addClass( "fa-plus" );
    }

    function outrosMotivos(){
        var motivo = $('.inputmotivo option:selected').text();
        if(motivo == 'Outros'){
            $( ".divmotivo" ).removeClass( "col-md-12" ).addClass( "col-md-6" );
            $( ".divoutros" ).show();
            $( ".divoutros" ).attr('required');
        }else{
            $( ".divmotivo" ).removeClass( "col-md-6" ).addClass( "col-md-12" );
            $( ".divoutros" ).hide();
            $( ".divoutros" ).removeAttr('required');
        }

    }

</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>