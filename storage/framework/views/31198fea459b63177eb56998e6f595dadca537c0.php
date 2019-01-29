<div class="col-lg-<?php echo e($lg ?? '6'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong><?php echo e($title); ?>:</strong></p>
    <?php if($proc['relato_file']): ?>
    <p><a href="<?php echo e(asset('storage/arquivo/'.$module.'/'.$proc)); ?>" target="_blank"><i class="fa fa-file-pdf-o"></i><?php echo e($proc); ?></a></p>
    <?php else: ?>
        <p>Não Há</p>
    <?php endif; ?>
</div>