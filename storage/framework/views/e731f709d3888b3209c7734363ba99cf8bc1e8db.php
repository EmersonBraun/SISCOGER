<?php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
?>
<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has($campo)): ?> has-error <?php endif; ?>">
    <i class="fa fa-calendar"></i>
    <?php echo Form::label($campo, $titulo); ?>


    <?php if(isset($btn)): ?>
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-<?php echo e($btn['color'] ?? 'info'); ?>" id='<?php echo e($btn['id'] ?? ''); ?>'><?php echo e($btn['title']); ?></button>
        </div>   
    <?php endif; ?>

    <?php echo e(Form::text($campo, null, ['class' => 'form-control datepicker date'.$class, $adc])); ?>


    <?php if(isset($btn)): ?>
    </div>
    <?php endif; ?>

    <?php if($errors->has($campo)): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first($campo)); ?></strong>
        </span>
    <?php endif; ?>
</div>
