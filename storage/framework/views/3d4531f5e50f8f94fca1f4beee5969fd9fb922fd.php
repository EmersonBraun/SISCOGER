<h1><?php echo e($title); ?></h1>
<ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>

  <?php $__empty_1 = true; $__currentLoopData = $opts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <li class="<?php echo e($o['type'] ?? ''); ?>">
        <a href="<?php echo e(route($o['route'])); ?>">
            <?php echo e($o['name']); ?>

        </a>
    </li>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <li class="active"><?php echo e($title); ?></li>
  <?php endif; ?>

</ol>
<br>