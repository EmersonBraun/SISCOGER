<!DOCTYPE html>
<html>
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
    
    
    <?php echo $__env->make('vendor.adminlte.css', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('adminlte_css'); ?>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition <?php echo $__env->yieldContent('body_class'); ?>">
    <div class="conteudo">
        <?php echo $__env->yieldContent('body'); ?>
    </div>

<?php echo $__env->make('vendor.adminlte.js', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('toast::messages-jquery', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('adminlte_js'); ?>
<script src="<?php echo e(asset('js/main.css')); ?>"></script>

</body>
</html>
