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

    
    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('libelo','Libelo:','adl',$proc['libelo'], ['class' => 'form-control']); ?>

        <?php if($errors->has('libelo')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('libelo')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    <?php echo Form::label('parecer_comissao', 'Parecer comissão'); ?> <br>
    <?php echo Form::text('parecer_comissao', $proc['parecer_comissao'], ['class' => 'form-control']); ?>

    <?php if($errors->has('parecer_comissao')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('parecer_comissao')); ?></strong>
        </span>
    <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('parecer_file','Parecer:','adl',$proc['parecer_file'], ['class' => 'form-control']); ?>

        <?php if($errors->has('parecer_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('parecer_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
    

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    <?php echo Form::label('parecer_cmtgeral', 'Parecer CMT Geral'); ?> <br>
    <?php echo Form::text('parecer_cmtgeral', $proc['parecer_cmtgeral'], ['class' => 'form-control']); ?>

    <?php if($errors->has('parecer_cmtgeral')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('parecer_cmtgeral')); ?></strong>
        </span>
    <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('decisao_file','Parecer CMT Geral:','adl',$proc['decisao_file'], ['class' => 'form-control']); ?>

        <?php if($errors->has('decisao_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('decisao_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-lg-12 col-md-12 col-xs-12 form-group'>
        <h5>Arquivos excluídos</h5>
        <?php $__empty_1 = true; $__currentLoopData = $arquivos_apagados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class='col-lg-12 col-md-12 col-xs-12 form-group'>
                <a href="<?php echo e(asset('public/storage/arquivo/adl/'.$proc['id_adl'].'/'.$aa->objeto.'')); ?>" target='_blank'>
                    <i class='fa fa-file-pdf-o'></i><?php echo e($aa->objeto); ?>

                </a>&emsp;Excluído por <?php echo e(special_ucwords($aa->nome)); ?>, RG:<?php echo e($aa->rg); ?>, em: <?php echo e($aa->created_at); ?>

            </div>   
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <h6>Nenhum arquivo</h6>
        <?php endif; ?>
    </div>

    </div>
</div>

