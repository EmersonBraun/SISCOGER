<?php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
    $id = (!isset($id)) ?  $campo : $id;
    $value = (!isset($value)) ?  null : $value;
    //específico do numerador
    if($campo == 'responsavel') $value = session('cargo')." ".special_ucwords(session('nome'));
?>
<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has($campo)): ?> has-error <?php endif; ?>">
    <?php if(isset($icon)): ?>
        <i class="<?php echo e($icon); ?>"></i>
    <?php endif; ?>

    <?php echo Form::label($campo, $titulo); ?>


    <?php if(isset($btn)): ?>
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-<?php echo e($btn['color'] ?? 'info'); ?>"><?php echo e($btn['title']); ?></button>
        </div>   
    <?php endif; ?>

    <?php echo e(Form::text($campo, $value, 
    [
        'class' => 'form-control '.$class,
        'id' => $id, 
        $adc
        ]
    )); ?>


    <?php if(isset($btn)): ?>
    </div>
    <?php endif; ?>

    <?php if($errors->has($campo)): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first($campo)); ?></strong>
        </span>
    <?php endif; ?>
</div>