<?php $__env->startSection('title', 'fatd - Sobrestamentos'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Sobrestamentos</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">Fatd - Lista</a></li>
  <li><a href="<?php echo e(route('fatd.edit',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Fatd - Editar</a></li>
  <li class="active">FATD - Sobrestamentos</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="#">Editar</a>
        <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
        <a class="btn btn-success col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
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
                                    <div class="col-md-2 col-xs-2"><?php echo e(data_br($sobrestamento->inicio_data)); ?></div> 
                                    <div class="col-md-2 col-xs-2">(<?php echo e($sobrestamento->publicacao_inicio); ?>)</div>
                                    <div class="col-md-2 col-xs-2"><?php echo e(data_br($sobrestamento->termino_data)); ?></div>
                                    <div class="col-md-2 col-xs-2">(<?php echo e($sobrestamento->publicacao_termino); ?>)</div>
                                    <?php if($sobrestamento->motivo == '' || $sobrestamento->motivo == 'Outros'): ?>
                                        <div class="col-md-2 col-xs-2"><?php echo e($sobrestamento->motivo_outros); ?></div>
                                    <?php else: ?>
                                        <div class="col-md-2 col-xs-2"><?php echo e($sobrestamento->motivo); ?></div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="col-md-12">Não Há Sobrestamentos</p>
                                <?php endif; ?>
                        </div>
    
                    </div>   
                </div>
            </div>     
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                        <?php echo Form::open(['url' => route('sobrestamento.inserir',['id' => $proc['id_fatd']])]); ?>

                        
                        <div class='col-md-4 col-xs-12'>
                        <i class="fa fa-calendar"></i> <?php echo Form::label('inicio_data', 'Data de início: '); ?> <br>
                        <?php echo Form::text('inicio_data','' ,['class' => 'datepicker']); ?>

                        <?php if($errors->has('inicio_data')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('inicio_data')); ?></strong>
                            </span>
                        <?php endif; ?> 
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <?php echo Form::label('publicacao_inicio', 'Publicação de início: '); ?> <br>
                        <?php echo Form::text('publicacao_inicio','' ); ?>

                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <?php echo Form::label('doc_controle_inicio', 'N° Documento: '); ?> <br>
                        <?php echo Form::text('doc_controle_inicio','' ); ?>

                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <i class="fa fa-calendar"></i> <?php echo Form::label('termino_data', 'Data de término: '); ?> <br>
                        <?php echo Form::text('termino_data','' ,['class' => 'datepicker']); ?>

                        <?php if($errors->has('termino_data')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('termino_data')); ?></strong>
                            </span>
                        <?php endif; ?> 
                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <?php echo Form::label('publicacao_termino', 'Publicação de término: '); ?> <br>
                        <?php echo Form::text('publicacao_termino','' ); ?>

                        <br>             
                        </div>

                        <div class='col-md-4 col-xs-12'>
                        <?php echo Form::label('doc_controle_termino', 'N° Documento: '); ?> <br>
                        <?php echo Form::text('doc_controle_termino','' ); ?>

                        <br>             
                        </div>

                        <div class='col-md-12 col-xs-12'>
                        <?php echo Form::textarea('motivo','',['placeholder' => 'Motivo','class' => 'form-control ', 'rows' => '5']); ?>

                        <input type="hidden" name="proc" value="fatd">
                        <?php if($errors->has('motivo')): ?>
                            <span class="help-block">
                                <strong><i class="fa fa-times-circle-o"></i> <?php echo e($errors->first('motivo')); ?></strong>
                            </span>
                        <?php endif; ?>
                        </div>

                
                        <?php echo Form::submit('Inserir Sobrestamento',['class' => 'btn btn-primary btn-block']); ?>

                        <?php echo Form::close(); ?>

                        </div>
    
                    </div>   
                </div>
            </div>     
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
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>