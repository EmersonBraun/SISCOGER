<?php $__env->startSection('title_postfix', '| Termo de compromisso'); ?>

<?php echo $__env->make('administracao.usuarios.termo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo e(Form::open(array('route' => array('users.termosalvar',$user->id), 'method' => 'POST'))); ?>


<div class="form-group">
<div class='col-md-3 <?php if($errors->has('termos')): ?> has-error <?php endif; ?>'>
    <br>
   <?php echo e(Form::checkbox('termos',  '1' )); ?> 
   <?php echo e(Form::label('termos', 'Concordo com os termos')); ?>

   <?php if($errors->has('termos')): ?>
	    <span class="help-block">
	        <strong><?php echo e($errors->first('termos')); ?></strong>
	    </span>
	<?php endif; ?>
</div>
<div class='col-md-9'>
    <br>
    <?php echo e(Form::submit('Inserir', array('class' => ' form-control btn btn-primary'))); ?>

</div> 

</div>   

<?php echo e(Form::close()); ?>


<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
$('body').scrollspy({ target: '#list-example' })
    $('[data-spy="scroll"]').each(function () {
  var $spy = $(this).scrollspy('refresh')
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>