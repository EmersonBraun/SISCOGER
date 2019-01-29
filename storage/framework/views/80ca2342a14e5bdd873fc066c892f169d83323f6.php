<div class="col-lg-<?php echo e($lg ?? '6'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong><?php echo e($title ?? 'OPM/OBM'); ?>:</strong></p><p> <?php echo e(opm($proc[$campo ?? 'cdopm'])); ?></p>
</div>