<?php $__env->startSection('title', 'fatd - Visualizar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Visualizar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">Fatd - Lista</a></li>
  <li class="active">FATD - Visualizar</li>
  </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="">
<section class="">
        <div class="col-md-8">
        <h3>Formulário de Transgressão Disciplinar - Nº <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?></h3>
        </div>
        <div class="form-group col-md-4"> 
            <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="expandirTudo()">Expandir tudo</a>
            <a class="btn btn-default col-md-6 col-xs-6"  href="#" onclick="recolherTudo()">Recolher Tudo</a>
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

            <div class="col-md-6 col-xs-12">
                <p><strong>Nº do despacho que designa o Encarregado:</strong></p><p> <?php echo e($proc['despacho_numero']); ?></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Data do despacho:</strong></p><p> <?php echo e(date('d/m/Y',strtotime($proc['portaria_data']))); ?></p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Boletim de publicação do despacho:</strong></p><p> <?php echo e(sistema('tipoBoletim',$proc['doc_tipo'])); ?>: <?php echo e($proc['doc_numero']); ?></p>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Data da abertura:</strong></p><p> <?php echo e(date('d/m/Y',strtotime($proc['abertura_data']))); ?></p>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Relato do fato imputado:</strong></p>
                <?php if($proc['relato_file']): ?>
            <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['relato_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['relato_file']); ?></a></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Relatório: </strong></p>
                <?php if($proc['relatorio_file']): ?>
            <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['relatorio_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['relatorio_file']); ?></a></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Solução do Comandante:</strong></p>
                <?php if($proc['sol_cmt_file']): ?>
                    <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['sol_cmt_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['sol_cmt_file']); ?></a></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Solução do Cmt Geral:</strong></p>
                <?php if($proc['sol_cg_file']): ?>
                    <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['sol_cg_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['sol_cg_file']); ?></a></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>

            <div class="col-md-6 col-xs-12">
                <p><strong>Nota de punição:</strong></p>
                <?php if($proc['notapunicao_file']): ?>
                    <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['notapunicao_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['notapunicao_file']); ?></a></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <p><strong>Publicação da nota de punição</strong></p>
                <?php if($proc['publicacaonp']): ?>
                    <p><?php echo e($proc['publicacaonp']); ?></p>
                <?php else: ?>
                    <p>Não Há</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="row">

            <div class="col-xs-12">
                <div class="box collapsed-box">
                    <div class="box-header">
                        <h2 class="box-title">Origem procedimento</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
                            </button> 
                        </div>             
                    </div>
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                            <p class="col-md-4"><strong>Processo/Procedimento</strong></p>
                            <p class="col-md-4"><strong>N°/Ano</strong></p> 
                            <p class="col-md-4"><strong>OPM/OBM</strong></p>

                            <?php if($ligacao): ?>
                            <p class="col-md-4"><?php echo e(strtoupper($ligacao->origem_proc)); ?></p>
                            <p class="col-md-4"><?php echo e($ligacao->destino_sjd_ref); ?> / <?php echo e($ligacao->destino_sjd_ref_ano); ?></p> 
                            <p class="col-md-4">
                                <?php if($ligacao->origem_opm != '' && $ligacao->origem_opm != 'NAO ENCONTRA'): ?>
                                    <?php echo e(opm($ligacao->origem_opm)); ?>

                                <?php else: ?>
                                    Não encontrada
                                <?php endif; ?>
                            </p>
                            <?php else: ?>
                                <p class="col-md-4">Não há</p>
                                <p class="col-md-4">Não há</p>
                                <p class="col-md-4">Não há</p>
                            <?php endif; ?>

                        </div>
                    </div>   
                </div>
            </div>     
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box collapsed-box">
                <div class="box-header">
                    <h2 class="box-title">Recursos</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button> 
                    </div>             
                </div>
    
                <div class="box-body">

                    <div class="col-md-6 col-xs-12">
                        <p><strong>Reconsideração de ato (solução):</strong></p>
                        <?php if($proc['rec_ato_file']): ?>
                        <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['rec_ato_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['notapunicao_file']); ?></a></p>
                    <?php else: ?>
                        <p>Não Há</p>
                    <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p><strong>Recurso Cmt OPM: </strong></p>
                        <?php if($proc['rec_cmt_file']): ?>
                        <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['rec_cmt_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['notapunicao_file']); ?></a></p>
                    <?php else: ?>
                        <p>Não Há</p>
                    <?php endif; ?>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <p><strong>Recurso Cmt CRPM:</strong></p>
                        <?php if($proc['rec_crpm_file']): ?>
                        <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['rec_crpm_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['notapunicao_file']); ?></a></p>
                    <?php else: ?>
                        <p>Não Há</p>
                    <?php endif; ?>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <p><strong>Recurso Cmt Geral:</strong></p>
                        <?php if($proc['rec_cg_file']): ?>
                        <p><a href="<?php echo e(asset('storage/arquivo/fatd/'.$proc['rec_cg_file'])); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc['notapunicao_file']); ?></a></p>
                    <?php else: ?>
                        <p>Não Há</p>
                    <?php endif; ?>
                </div>

                </div>   
            </div>
        </div>     
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box collapsed-box">
                <div class="box-header">
                    <h2 class="box-title">Membros</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse">
                            <i class="fa fa-plus"></i>
                        </button> 
                    </div>             
                </div>
    
                <div class="box-body">

                    <div class="col-md-12 col-xs-12">
                            <p class="col-md-12"><strong>Encarregado:</strong></p>
                        <?php if($encarregado != NULL && $encarregado != ''): ?>
                            <p class="col-md-6"><?php echo e($encarregado->cargo); ?> <?php echo e(special_ucwords($encarregado->nome)); ?></p> 
                            <p class="col-md-6"><strong>RG:</strong> <?php echo e($encarregado->rg); ?></p>
                        <?php else: ?>
                            <p class="col-md-12">Não Há</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-12 col-xs-12">
                            <p class="col-md-12"><strong>Acusador:</strong></p>
                        <?php if($acusador != NULL && $acusador != ''): ?>
                            <p class="col-md-6"><?php echo e($acusador->cargo); ?> <?php echo e(special_ucwords($acusador->nome)); ?></p> 
                            <p class="col-md-6"><strong>RG:</strong> <?php echo e($acusador->rg); ?></p>
                        <?php else: ?>
                            <p class="col-md-12">Não Há</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-12 col-xs-12">
                            <p class="col-md-12"><strong>Defensor:</strong></p>
                        <?php if($defensor != NULL && $defensor != ''): ?>
                            <p class="col-md-6"><?php echo e($defensor->cargo); ?> <?php echo e(special_ucwords($defensor->nome)); ?></p> 
                            <p class="col-md-6"><strong>RG:</strong> <?php echo e($defensor->rg); ?></p>
                        <?php else: ?>
                            <p class="col-md-12">Não Há</p>
                        <?php endif; ?>
                    </div>

                    </div>   
                </div>
            </div>     
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h2 class="box-title">Acusado</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-minus"></i>
                            </button> 
                        </div>             
                    </div>
        
                    <div class="box-body">
    
                        <div class="col-md-12 col-xs-12">
                            <p class="col-md-4"><strong>Posto/Grad. Nome</strong></p>
                            <p class="col-md-4"><strong>RG</strong></p> 
                            <p class="col-md-4"><strong>Situação</strong></p>

                            <p class="col-md-4"><?php echo e($envolvido->cargo); ?> <?php echo e(special_ucwords($envolvido->nome)); ?></p> 
                            <p class="col-md-4"><?php echo e($envolvido->rg); ?></p>
                            <p class="col-md-4"><?php echo e($envolvido->situacao); ?></p>
                        </div>
    
                    </div>   
                </div>
            </div>     
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="box collapsed-box">
                    <div class="box-header">
                        <h2 class="box-title">Movimentos</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
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
            <div class="col-xs-12">
                <div class="box collapsed-box">
                    <div class="box-header">
                        <h2 class="box-title">Sobrestamentos</h2>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                                <i class="fa fa-plus"></i>
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

        
        
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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