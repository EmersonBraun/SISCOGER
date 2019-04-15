<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Novo Sobrestamento</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

                <div class="col-md-12 col-xs-12">
                    <?php echo Form::open(['url' => route('sobrestamento.inserir',['id' => $proc['id_'.$name]] ) ]); ?>

                
                    <input type="hidden" name="proc" value="<?php echo e(strtoupper($name)); ?>">
                    <input type="hidden" name="rg" value="<?php echo e(session('rg')); ?>">

                <div class='divmotivo col-md-12 col-xs-12 form-group <?php if($errors->has('motivo')): ?> has-error <?php endif; ?>'>
                    <?php echo Form::label('motivo', 'Motivo: '); ?>

                    <?php echo Form::select('motivo', config('sistema.motivoSobrestamento'),null, ['class' => 'form-control  inputmotivo','required','onchange' => 'outrosMotivos()']); ?>

                    <?php if($errors->has('motivo')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('motivo')); ?></strong>
                        </span>
                    <?php endif; ?> 
                </div>
                <div class='divoutros col-md-6 col-xs-12 form-group' style="display:none">
                    <?php echo Form::label('motivo_outros', 'Descrição: '); ?>

                    <?php echo Form::text('motivo_outros','' ,['class' => 'form-control inputoutros']); ?>

                </div>
                
                <div class='col-md-4 col-xs-12 form-group <?php if($errors->has('inicio_data')): ?> has-error <?php endif; ?>'>
                    <i class="fa fa-calendar"></i> <?php echo Form::label('inicio_data', 'Data de início: '); ?>

                    <?php echo Form::text('inicio_data','' ,['class' => 'form-control datepicker']); ?>

                    <?php if($errors->has('inicio_data')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('inicio_data')); ?></strong>
                        </span>
                    <?php endif; ?> 
                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <?php echo Form::label('publicacao_inicio', 'Publicação de início: '); ?>

                    <?php echo Form::text('publicacao_inicio','' ,['class' => 'form-control']); ?>

                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <?php echo Form::label('doc_controle_inicio', 'N° Documento: '); ?>

                    <?php echo Form::text('doc_controle_inicio','' ,['class' => 'form-control']); ?>

                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <i class="fa fa-calendar"></i> <?php echo Form::label('termino_data', 'Data de término: '); ?>

                    <?php echo Form::text('termino_data','' ,['class' => 'form-control datepicker']); ?>

                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <?php echo Form::label('publicacao_termino', 'Publicação de término: '); ?>

                    <?php echo Form::text('publicacao_termino','' ,['class' => 'form-control']); ?>

                </div>

                <div class='col-md-4 col-xs-12 form-group'>
                    <?php echo Form::label('doc_controle_termino', 'N° Documento: '); ?>

                    <?php echo Form::text('doc_controle_termino','' ,['class' => 'form-control']); ?>

                </div>
        
                <?php echo Form::submit('Inserir Sobrestamento',['class' => 'btn btn-primary btn-block']); ?>

                <?php echo Form::close(); ?>

                </div>
  
            </div>
        </div>
    </div>
</div>
