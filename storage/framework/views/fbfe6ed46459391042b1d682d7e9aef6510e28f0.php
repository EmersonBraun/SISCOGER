<div class="col-lg-12 col-md-12 col-xs-12 form-group">
    <h5><b><?php echo e($title); ?></b></h5>

    <?php if(!$unico): ?>
        <a name="doc_origem" class="noprint btn btn-success btn-block" onclick="addObjectForm('<?php echo e($arquivo); ?>','<?php echo e($proc); ?>',<?php echo e($unico); ?>);"><i class="fa fa-plus"></i><?php echo e($btn); ?></a>
    <?php endif; ?>
    <div class="col-md-<?php echo e($tam ?? '12'); ?> bordaform" id="<?php echo e($arquivo); ?>Form">
        <?php if(!is_null($relacao)): ?>
            <?php $__currentLoopData = $relacao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relacao): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('subform.'.$arquivo, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>      
    </div>
</div>