<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Documentos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-md-4 col-xs-12'>
        <?php echo Form::sfile('fato_file','Relato do fato imputado:','fatd',$proc['fato_file']); ?>

        <?php if($errors->has('fato_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('fato_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::sfile('relatorio_file','Relatório:','fatd',$proc['relatorio_file']); ?>

        <?php if($errors->has('relatorio_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('relatorio_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::sfile('sol_cmt_file','Solução do Comandante:','fatd',$proc['sol_cmt_file']); ?>

        <?php if($errors->has('sol_cmt_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('sol_cmt_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    
    <div class='col-md-4 col-xs-12'>
        <?php echo Form::sfile('sol_cg_file','Solução do Cmt. Geral:','fatd',$proc['sol_cg_file']); ?>

        <?php if($errors->has('sol_cg_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('sol_cg_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::sfile('notapunicao_file','Nota de punição:','fatd',$proc['notapunicao_file']); ?>

        <?php if($errors->has('notapunicao_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('notapunicao_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-md-4 col-xs-12'>
        <?php echo Form::label('publicacaonp', 'Publicação da nota de punição: '); ?> <br>
        <?php echo Form::text('publicacaonp',$proc['publicacaonp'],['placeholder' => '(Ex: BI nº 12/2011)']); ?>

    </div>

    <div class='col-md-12 col-xs-12'>
        <h5>Arquivos excluídos</h5>
        <?php $__empty_1 = true; $__currentLoopData = $arquivos_apagados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class='col-md-12 col-xs-12'>
                <a href="<?php echo e(asset('public/storage/arquivo/fatd/'.$proc['id_fatd'].'/'.$aa->objeto.'')); ?>" target='_blank'>
                    <i class='fa fa-file-pdf-o'></i><?php echo e($aa->objeto); ?>

                </a>&emsp;Excluído por <?php echo e(special_ucwords($aa->nome)); ?>, RG:<?php echo e($aa->rg); ?>, em: <?php echo e($aa->created_at); ?>

            </div>   
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <h6>Nenhum arquivo</h6>
        <?php endif; ?>
    </div>

    </div>
</div>

