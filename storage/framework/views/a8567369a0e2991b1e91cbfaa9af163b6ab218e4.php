<?php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
    $id = (!isset($id)) ?  $campo : $id;
?>
<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has($campo)): ?> has-error <?php endif; ?>">
    <?php echo Form::label($campo, $titulo); ?>

    <?php echo e(Form::select($campo, $opms, session('cdopm'), ['class'=>'form-control select2 '.$class, 'id' => $id, $adc])); ?>

    
    <?php if($errors->has($campo)): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first($campo)); ?></strong>
        </span>
    <?php endif; ?>
</div>

