<?php $__env->startSection('title_postfix', '| Alterar senha'); ?>

<div class="text-center">
  <h1>BEM VINDO(A) AO SISCOGER!</h1>
  <h2>Altere a senha padrão para ter acesso ao sistema!</h2>
</div>
<div class='col-md-10 col-md-offset-1'>
    <?php echo e(Form::model($user, array('route' => array('users.passupdate', $user->id), 'method' => 'PUT'))); ?>

    <div class="form-group col-lg-12 <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
        <?php echo e(Form::label('password', 'Senha')); ?><br>
        <?php echo e(Form::password('password', array('class' => 'form-control'))); ?>

        <?php if($errors->has('password')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
    <div class="form-group col-lg-12 <?php if($errors->has('password')): ?> has-error <?php endif; ?>">
        <?php echo e(Form::label('password', 'Confirme a Senha')); ?><br>
        <?php echo e(Form::password('password_confirmation', array('class' => 'form-control'))); ?>

        <?php if($errors->has('password_confirmation')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
      <?php echo e(Form::submit('Atualizar', array('class' => 'btn btn-primary btn-lg btn-block'))); ?>

      <?php echo e(Form::close()); ?>

</div>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>