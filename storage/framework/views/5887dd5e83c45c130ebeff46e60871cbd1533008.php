<?php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
?>
<div class="col-lg-<?php echo e($lg ?? '12'); ?> col-md-<?php echo e($col ?? '12'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has('sintese_txt')): ?> has-error <?php endif; ?>">
    
    <?php if(isset($icon)): ?>
        <i class="<?php echo e($icon); ?>"></i>
    <?php endif; ?>

    <?php echo Form::label('sintese_txt', 'Síntese do fato'); ?> <br>
    <?php echo Form::textarea('sintese_txt','',['class' => 'form-control '.$class, $adc, 'rows' => '5']); ?>


    <?php if($errors->has('sintese_txt')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('sintese_txt')); ?></strong>
        </span>
    <?php endif; ?>

</div>
