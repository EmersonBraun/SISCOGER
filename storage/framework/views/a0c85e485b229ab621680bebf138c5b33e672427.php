<div class="col-lg-<?php echo e($lg ?? '12'); ?> col-md-<?php echo e($col ?? '12'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong><?php echo e($title ?? 'Sintese do fato'); ?>:</strong></p>
    <?php if($proc != ''): ?>
        <p> <?php echo e($proc); ?></p>
    <?php else: ?>
        <p>Não há</p>
    <?php endif; ?>
</div>