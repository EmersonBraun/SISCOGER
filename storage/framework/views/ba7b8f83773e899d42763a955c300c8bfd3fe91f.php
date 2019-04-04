<?php $__env->startSection('adminlte_css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/adminlte/css/auth.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>"><?php echo config('adminlte.logo', '<b>Admin</b>LTE'); ?></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo e(config('adminlte.password_reset_message')); ?></p>
            <form action="<?php echo e(url(config('adminlte.password_reset_url', 'password/reset'))); ?>" method="post">
                <?php echo csrf_field(); ?>


                <input type="hidden" name="token" value="<?php echo e($token); ?>">

                <div class="form-group has-feedback <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                    <input type="email" name="email" class="form-control" value="<?php echo e(isset($email) ? $email : old('email')); ?>"
                           placeholder="<?php echo e(config('adminlte.email')); ?>">
                    <span class="fa fa-envelope form-control-feedback"></span>
                    <?php if($errors->has('email')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                    <input type="password" name="password" class="form-control"
                           placeholder="<?php echo e(config('adminlte.password')); ?>">
                    <span class="fa fa-lock form-control-feedback"></span>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password_confirmation') ? 'has-error' : ''); ?>">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="<?php echo e(config('adminlte.retype_password')); ?>">
                    <span class="fa fa-log-in form-control-feedback"></span>
                    <?php if($errors->has('password_confirmation')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <button type="submit"
                        class="btn btn-primary btn-block btn-flat"
                ><?php echo e(config('adminlte.reset_password')); ?></button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
    <?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>