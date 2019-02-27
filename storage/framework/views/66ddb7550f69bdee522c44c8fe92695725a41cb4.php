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
                    <div class="col-lg-12 col-md-12 col-xs-12 form-group <?php if($errors->has('opm')): ?> has-error <?php endif; ?>">
                        <?php echo Form::label('opm', 'OPM'); ?>

                        <?php echo e(Form::select('opm', $opms, session('cdopm'), ['class'=>'form-control select2 ', 'id' => 'opm'])); ?>

                        
                        <?php if($errors->has('opm')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('opm')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <v-select options="[
                        [val: 0, label: 'Cat'],
                        [val: 1, label: 'Cow'],
                        [val: 2, label: 'Dog'],
                        [val: 3, label: 'Elephant'],
                        [val: 4, label: 'Fish'],
                        [val: 5, label: 'Lion'],
                        [val: 6, label: 'Tiger'],
                        [val: 7, label: 'Turtle']
                      ]" options-value="val"
                        multiple name="select[]" limit="3"
                        placeholder="Using placeholder"
                        search justified required
                        clear-button close-on-select
                    ></v-select>
 
                
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
$(document).ready( function() {
    $('opm').on('click',function () {
        var codigo = $(this).val();
        console.log(codigo);
        
        //$(location).attr("href", url);
    });
});
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>