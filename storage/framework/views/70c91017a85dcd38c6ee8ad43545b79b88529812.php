<?php $__env->startSection('title', 'fatd - Movimentos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Movimentos</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">Fatd - Lista</a></li>
  <li><a href="<?php echo e(route('fatd.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Fatd - Editar</a></li>
  <li class="active">FATD - Movimentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Editar</a>
        <a class="btn btn-success col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
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
        <h3>Formulário de Transgressão Disciplinar - Nº <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?></h3>
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
            <div class="col-md-6 col-xs-12">
                <p><strong>Andamento:</strong></p><p> <?php echo e(sistema('andamentoFATD',$proc['id_andamento'])); ?></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Andamento COGER:</strong></p><p> <?php echo e(sistema('andamentocogerFATD',$proc['id_andamentocoger'])); ?></p>
            </div>

            <div class="col-md-12 col-xs-12">
                <p><strong>Documentos de origem:</strong></p><p> <?php echo e($proc['doc_origem_txt']); ?></p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Data do fato:</strong></p><p> <?php echo e(date('d/m/Y',strtotime($proc['fato_data']))); ?></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>OPM/OBM:</strong></p><p> <?php echo e(opm($proc['cdopm'])); ?></p>
            </div>

            <div class="col-md-4 col-xs-12">
                <p><strong>Motivo:</strong></p><p> <?php echo e(sistema('motivoFATD',$proc['motivo_fatd'])); ?></p>
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Outros Motivos:</strong></p>
                <?php if($proc['motivo_outros'] != ''): ?>
                    <p> <?php echo e($proc['motivo_outros']); ?></p>
                <?php else: ?>
                    <p>Não há</p>
                <?php endif; ?>
            </div>
            <div class="col-md-4 col-xs-12">
                <p><strong>Situação:</strong></p><p> <?php echo e(sistema('situacaoOCOR',$proc['situacao_fatd'])); ?></p>
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
                                <div class="col-md-2 col-xs-2"><?php echo e(date('d/m/Y',strtotime($movimento->data))); ?></div> 
                                <div class="col-md-6 col-xs-6"><?php echo e($movimento->descricao); ?></div>
                                <?php if($movimento->rg != '' && $movimento->rg != NULL): ?>
                                    <div class="col-md-2 col-xs-2"><?php echo e($movimento->rg); ?></div>
                                    <div class="col-md-2 col-xs-2"><?php echo e(special_ucwords(pm('nome',$movimento->rg))); ?></div>  
                                <?php else: ?>
                                    <div class="col-md-2 col-xs-2">Não há</div>
                                    <div class="col-md-2 col-xs-2">Não há</div>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="col-md-12">Não Há Movimentos</p>
                            <?php endif; ?>
                        </div>
                    
                    </div>   
                </div>
            </div>     
        </div>

    <div class="row">
        <br>
        <?php echo Form::open(['url' => route('movimento.inserir',['id' => $proc['id_fatd']])]); ?>

        <div class='col-md-12 col-xs-12 <?php if($errors->has('descricao')): ?> has-error <?php endif; ?>'>
        <?php echo Form::textarea('descricao','',
        ['placeholder' => 'Descrição',
        'class' => 'form-control ', 
        'rows' => '5']); ?>

        <input type="hidden" name="proc" value="fatd">
        <?php if($errors->has('descricao')): ?>
            <span class="help-block">
                <strong><i class="fa fa-times-circle-o"></i> <?php echo e($errors->first('descricao')); ?></strong>
            </span>
        <?php endif; ?>

        <?php echo Form::submit('Inserir Movimento',['class' => 'btn btn-primary btn-block']); ?>

        </div>
        <?php echo Form::close(); ?>

        <br>
    </div>
    <br>
       
        
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>