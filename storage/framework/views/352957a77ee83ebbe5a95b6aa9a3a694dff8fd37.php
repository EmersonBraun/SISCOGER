<?php $__env->startSection('title', 'BD'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>BD - Lista</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">BD - Lista</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
</section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <div class='btn-group col-md-4 col-xs-12 ' style='padding-left: 0px'>  
 
        <select name="meta4">
            <?php $__currentLoopData = $meta4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'meta4','nome' => $m, 'limite' => 10])); ?>'"> <?php echo e($m); ?> </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="rhparana">
            <?php $__currentLoopData = $rhparana; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'rhparana','nome' => $r, 'limite' => 10])); ?>'"> <?php echo e($r); ?> </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <select name="pass">
            <?php $__currentLoopData = $pass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'pass','nome' => $p, 'limite' => 10])); ?>'"> <?php echo e($p); ?> </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>