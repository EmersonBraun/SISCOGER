<div class="col-lg-<?php echo e($lg ?? '6'); ?> col-md-<?php echo e($col ?? '6'); ?> col-xs-<?php echo e($xs ?? '12'); ?>">
    <p><strong>Andamento COGER:</strong></p><p> <?php echo e(sistema('andamentocoger'.strtoupper($module),$proc['id_andamentocoger'])); ?></p>
</div>