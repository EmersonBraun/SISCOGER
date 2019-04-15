<?php $__env->startSection('title', 'ADL - Movimentos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1><?php echo e(strtoupper('adl')); ?> - Movimentos</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('adl.lista',['ano' => date('Y')])); ?>"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Lista</a></li>
  <li><a href="<?php echo e(route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Editar</a></li>
  <li class="active"><?php echo e(sistema('procedimentosTipos',strtoupper('adl'))); ?> - Movimentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="<?php echo e(route('adl.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Editar</a>
        <a class="btn btn-success col-md-4 col-xs-4 "  href="<?php echo e(route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
        <a class="btn btn-default col-md-4 col-xs-4 "  href="<?php echo e(route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
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
        <h3><?php echo e(nome_ext('adl')); ?> - Nº <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?></h3>
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
                <p><strong>OM de origem:</strong></p><p> <?php echo e(OPM($proc['cdopm'])); ?></p>
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
                    <h2 class="box-title">Movimentos</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button> 
                    </div>             
                </div>
    
                <div class="box-body">
    
                    <div class="col-md-12 col-xs-12">
    
                        <div class="col-md-2 col-xs-2"><strong>Data</strong></div>
                        <div class="col-md-6 col-xs-6"><strong>Descrição</strong></div> 
                        <div class="col-md-2 col-xs-2"><strong>RG</strong></div>
                        <div class="col-md-2 col-xs-2"><strong>Nome</strong></div>
                        
                        <?php $__empty_1 = true; $__currentLoopData = $movimentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movimento): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-12">
                            <div class="col-md-2 col-xs-2"><?php echo e($movimento->data); ?></div> 
                            <div class="col-md-6 col-xs-6"><?php echo e($movimento->descricao); ?></div>
                            <?php if($movimento->rg != '' && $movimento->rg != NULL): ?>
                                <div class="col-md-2 col-xs-2"><?php echo e($movimento->rg); ?></div>
                                <div class="col-md-2 col-xs-2"><?php echo e(special_ucwords(pm('nome',$movimento->rg))); ?></div>  
                            <?php else: ?>
                                <div class="col-md-2 col-xs-2">Não há</div>
                                <div class="col-md-2 col-xs-2">Não há</div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-md-12">Não Há Movimentos</div>
                        <?php endif; ?>
                    </div>
                
                </div>   
            </div>
        </div>     
    </div>

    <?php $__env->startComponent('components.movimento',['proc' => $proc, 'name' => 'adl']); ?>
    <?php echo $__env->renderComponent(); ?>

    <?php $__env->startComponent('components.listaenvolvidos',['envolvidos' => $envolvidos]); ?>
    <?php echo $__env->renderComponent(); ?>

    </div>
       
        
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>