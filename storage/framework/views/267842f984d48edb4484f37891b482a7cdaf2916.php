<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong><?php echo e($title); ?>:</strong></p>
    <?php if($proc != ''): ?>
        <p> <?php echo e($proc); ?></p>
    <?php else: ?>
        <p>Não há</p>
    <?php endif; ?>
</div>