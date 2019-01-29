<div class="col-lg-<?php echo e($lg ?? '4'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><i class="fa fa-calendar"></i> <strong><?php echo e($title ?? 'Data'); ?>:</strong></p><p> <?php echo e(date('d/m/Y',strtotime($proc)) ?? ''); ?></p>
</div>