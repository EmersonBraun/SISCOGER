<?php $__env->startSection('adminlte_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/vendor/adminlte/css/auth.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>"><?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?></a><br>
            <h4>Controle Processual da PMPR</h4>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo e(config('adminlte.password_reset_message')); ?></p>
            <?php if(session('status')): ?>
                <div class="alert alert-success">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            <form action="<?php echo e(url(config('adminlte.password_email_url', 'password/email'))); ?>" method="post">
                <?php echo csrf_field(); ?>


                <div class="form-group has-feedback <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                    <input type="email" name="email" class="form-control" value="<?php echo e(isset($email) ? $email : old('email')); ?>"
                           placeholder="<?php echo e(config('adminlte.email')); ?>">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                ><?php echo e(config('adminlte.send_password_reset_link')); ?></button>
            </form>
        </div>
        <div class="login-box">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>" class="btn btn-primary btn-block btn-flat">
            <i class="fa fa-fw fa-arrow-left"></i>Voltar para tela de login
            </a>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>