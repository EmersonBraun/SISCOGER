<div class="col-lg-<?php echo e($lg ?? '6'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong>Andamento:</strong></p><p> <?php echo e(sistema('andamento'.strtoupper($module),$proc['id_andamento'])); ?></p>
</div>