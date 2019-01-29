<?php $__env->startSection('title', 'fatd - Criar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>Mudar OPM - Dashboard</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Mudar OPM - Dashboard</li>
  </ol>
</section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <!-- /.box-header -->

                <div class='col-md-12 col-xs-12'>
                <?php echo Form::label('cdopm', 'OPM'); ?> <br>
                <select class="select2" name="opm">
                <option value=''>Todas as OPM</option>
                <?php $__currentLoopData = $opms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php if(trim($opm['CODIGOBASE'])==""): ?> <?php echo e($opm['CODIGOBASE']="0"); ?> <?php endif; ?>

                    <?php if($opm['TITULO']=="COMANDO" || $opm['TITULO']=="COMANDO GERAL"): ?> 

                        <?php if($firstGroup == "false"): ?>

                            <?php echo e("</optgroup>"); ?>


                    <?php endif; ?>

                            <?php echo e($firstGroup = "true"); ?>

                            <optgroup LABEL='<?php echo e($opm['ABREVIATURA']); ?>'>
                            <option value='<?php echo e($opm['CODIGOBASE']); ?>' ><?php echo e($opm['ABREVIATURA']); ?> (sede)</option>
                    
                    <?php endif; ?>

                        <?php if((isset($cdopm_selected)) && ($opm['CODIGOBASE']==$cdopm_selected)): ?> <?php echo e($selected="selected"); ?>


                        <?php else: ?> <?php echo e($selected=""); ?>


                            <option <?php echo e($selected); ?> value='<?php echo e(corta_zeros($opm['CODIGO'])); ?>' onclick="javascript:location.href='<?php echo e(route('home.opm',corta_zeros($opm['CODIGO']))); ?>'"><?php echo e($opm['ABREVIATURA']); ?></option>

                        <?php endif; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                </select>
                </div>

              
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  
<script>
;(function($)
{
    'use strict';
    $(document).ready(function()
    {
    var $fileupload     = $('#fileupload'),
        $upload_success = $('#upload-success');
    $fileupload.fileupload({
        url: '/upload',
        formData: {_token: $fileupload.data('token'), userId: $fileupload.data('userId')},
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        },
        done: function (e, data) {
            $upload_success.removeClass('hide').hide().slideDown('fast');
            setTimeout(function(){
                location.reload();
            }, 2000);
        }
    });
    });
})(window.jQuery);
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>