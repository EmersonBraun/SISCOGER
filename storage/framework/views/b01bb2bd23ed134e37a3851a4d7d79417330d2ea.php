<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Novo Movimento</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>
            <div class="box-body">
                <?php echo Form::open(['url' => route('movimento.inserir',['id' => $proc['id_'.$name]] ) ]); ?>

                <input type="hidden" name="proc" value="<?php echo e(strtoupper($name)); ?>">

                <div class='col-lg-12 col-md-12 col-xs-12 form-group <?php if($errors->has('descricao')): ?> has-error <?php endif; ?>'>
                    <?php echo Form::textarea('descricao','',
                    ['placeholder' => 'Descrição',
                    'class' => 'form-control ', 
                    'rows' => '5']); ?>

                    <?php if($errors->has('descricao')): ?>
                        <span class="help-block">
                            <strong><i class="fa fa-times-circle-o"></i> <?php echo e($errors->first('descricao')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12 form-group">
                    <?php echo Form::submit('Inserir Movimento',['class' => 'btn btn-primary btn-block']); ?>

                </div>
                
                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>
</div>