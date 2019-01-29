<?php 
    $rows = (!isset($rows)) ?  '5' : $rows;
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
?>
<div class="col-lg-<?php echo e($lg ?? '12'); ?> col-md-<?php echo e($col ?? '12'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has($campo)): ?> has-error <?php endif; ?>">
    
    <?php if(isset($icon)): ?>
        <i class="<?php echo e($icon); ?>"></i>
    <?php endif; ?>

    <?php echo Form::label($campo, $titulo); ?>

    <?php echo Form::textarea($campo,NULL,['class' => 'form-control '.$class, $adc, 'rows' => $rows]); ?>


    <?php if($errors->has($campo)): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first($campo)); ?></strong>
        </span>
    <?php endif; ?>

</div>