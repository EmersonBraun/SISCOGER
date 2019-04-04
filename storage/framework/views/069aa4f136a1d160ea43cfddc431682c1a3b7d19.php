<?php $__env->startSection('adminlte_css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/vendor/adminlte/css/auth.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('body_class', 'login-page'); ?>

<?php $__env->startSection('body'); ?>
    <div class="login-box" id="app">
        <div class="login-logo">
            <a href="<?php echo e(url(config('adminlte.dashboard_url', 'home'))); ?>"><?php echo config('adminlte.logo', 'SISCOGER'); ?></a><br>
            <h4>Controle Processual da PMPR</h4>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg"><?php echo e(config('adminlte.login_message')); ?></p>
            <?php echo Form::open(['url' => url(config('adminlte.login_url', 'login'))]); ?>


                <div class="form-group has-feedback <?php echo e($errors->has('rg') ? 'has-error' : ''); ?>">
                    <?php echo e(Form::text('rg', null, ['class' => 'form-control ','id' => 'rg', 'placegolder' => 'RG'])); ?>

                    <span class="fa fa-user form-control-feedback"></span>
                    <?php if($errors->has('rg')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('rg')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="form-group has-feedback <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                    <input type="password" name="password" class="form-control" placeholder="<?php echo e(config('adminlte.password')); ?>">
                    <span class="fa fa-lock form-control-feedback"></span>
                    <?php if($errors->has('password')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('password')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class="col-xs-7">
                       <a href="<?php echo e(url(config('adminlte.password_reset_url', 'password/reset'))); ?>" class="btn btn-default btn-block btn-flat">
                        <?php echo e(config('adminlte.i_forgot_my_password')); ?>

                        </a>
                    </div>
                    <div class="col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            <?php echo e(config('adminlte.sign_in')); ?>

                        </button>
                    </div>
                </div>
                <?php echo Form::close(); ?>

                 
                
            </div>

        <div >
            <br><br>
            <p class="text-uppercase texto-branco">Não tem acesso ao sistema?</p>
            <p class="texto-branco"> Solicite sua senha junto à Corregedoria-Geral</p>
            <p class="texto-branco">Email: coger-adm@pm.pr.gov.br</p>
            <br>
        </div>

    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('adminlte_js'); ?>
<?php echo $__env->yieldContent('js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>