<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?> form-group <?php if($errors->has($campo)): ?> has-error <?php endif; ?>">
    <?php if(isset($icon)): ?>
        <i class="<?php echo e($icon); ?>"></i>
    <?php endif; ?>
    <?php echo Form::label($campo, $titulo); ?>


    <?php
        $class = (!isset($class)) ?  '' : $class;
        $opt = (!isset($opt)) ?  [] : $opt;
        $adc = (!isset($adc)) ?  '' : $adc;
    ?>

    <?php if(isset($btn)): ?>
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-<?php echo e($btn['color'] ?? 'info'); ?>"><?php echo e($btn['title']); ?></button>
        </div>   
    <?php endif; ?>

    <?php echo Form::select($campo,$opt,null, ['class' => 'form-control typeahead '.$class, $adc]); ?>


    <?php if(isset($btn)): ?>
    </div>
    <?php endif; ?>

    <?php if($errors->has($campo)): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first($campo)); ?></strong>
        </span>
    <?php endif; ?>
</div>