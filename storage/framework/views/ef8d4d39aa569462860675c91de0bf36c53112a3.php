<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?php echo $__env->yieldContent('title_prefix', config('adminlte.title_prefix', '')); ?>
        <?php echo $__env->yieldContent('title', config('adminlte.title', 'SISCOGER')); ?>
        <?php echo $__env->yieldContent('title_postfix', config('adminlte.title_postfix', '')); ?>
    </title>
    
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo e(asset('public/img/favicon/favicon-96x96.png')); ?>" />
    
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('public/vendor/adminlte/vendor/font-awesome/css/font-awesome.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('public/vendor/adminlte/vendor/Ionicons/css/ionicons.min.css')); ?>">
    
    <link href="<?php echo e(asset('public/css/app.css')); ?>" rel="stylesheet">
   
    <style>
        
    .navbar-static-top {
        max-height: 0px !important;
    }
    </style>
    
    <?php echo $__env->yieldContent('adminlte_css'); ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    
    
</head>
<body class="hold-transition <?php echo $__env->yieldContent('body_class'); ?>">
<?php echo $__env->yieldContent('body'); ?>
<?php echo $__env->make('vendor.adminlte.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php if(Session::has('toasts')): ?>
<!-- Messenger http://github.hubspot.com/messenger/ -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

<script type="text/javascript">
		toastr.options = {
            "closeButton": true,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-top-right"
		};
        
		<?php $__currentLoopData = Session::get('toasts'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toast): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        toastr["<?php echo e($toast['level']); ?>"]("<?php echo e($toast['message']); ?>","<?php echo e($toast['title']); ?>");
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </script>
<?php endif; ?>
<?php echo $__env->yieldContent('adminlte_js'); ?>


</body>
</html>
