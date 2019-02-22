<div class='form-group col-md-12 col-xs-12 nopadding'>
    
    <?php if($prop['0'] != 0): ?>
    <div class='btn-group col-md-<?php echo e($prop['0']); ?> col-xs-12 nopadding'>
        <?php $__empty_1 = true; $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a class="btn btn-<?php echo e($m['type'] ?? 'default'); ?> col-md-<?php echo e($m['md'] ?? '12'); ?> col-xs-<?php echo e($m['xs'] ?? '12'); ?>"  href="<?php echo e(route($m['route'])); ?>">
                <?php echo e($m['name']); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <a class="btn btn-success col-md-12 col-xs-12 "  href="<?php echo e(route($title.'.lista')); ?>">Lista</a>  
        <?php endif; ?>
    <?php endif; ?>
    </div>
    
    <?php if($prop['1'] != 0): ?>
        <div class='col-md-<?php echo e($prop['1']); ?> col-xs-12 litlepadding'>
            <a class="btn btn-block btn-primary"  href="<?php echo e(route(strtolower(tira_acentos($title)).'.create')); ?>">
            <i class="fa fa-plus"></i> Adicionar <?php echo e($title); ?></a>
        </div>
    <?php endif; ?>
    
    
<div>

        