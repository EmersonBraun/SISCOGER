<?php $__env->startSection('title', 'adl - Criar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>ADL - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('adl.lista')); ?>">ADL - Lista</a></li>
  <li class="active">ADL - Criar</li>
  </ol>
</section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="row">

        <div class="col-xs-12">

        <div class="box">
            <div class="box-header">
                
                <h4 class="box-title">N° * / <?php echo e(date('Y')); ?> - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            <?php echo Form::open(['url' => route('adl.store')]); ?>

            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('prioritario', 'Processo prioritário'); ?>

            <?php echo Form::checkbox('prioritario', '1'); ?>

            </div>

            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('id_andamento', 'Andamento'); ?> <br>
            <?php echo Form::select('id_andamento', config('sistema.andamentoADL')); ?>

            <?php if($errors->has('id_andamento')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_andamento')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('andamentocoger', 'Andamento COGER'); ?> <br>
            <?php echo Form::select('id_andamentocoger', config('sistema.andamentocogerADL')); ?>

            <?php if($errors->has('id_andamentocoger')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_andamentocoger')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('id_motivoconselho', 'Motivo ADL'); ?> <br>
            <?php echo Form::select('id_motivoconselho', config('sistema.motivoConselho'),'', ['class' => 'select2', 'id' => 'descricao']); ?>

            <?php if($errors->has('id_motivoconselho')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_motivoconselho')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('outromotivo', 'Especificar (no caso de outros motivos)'); ?> <br>
            <?php echo Form::text('outromotivo', ''); ?>

            <?php if($errors->has('outromotivo')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('outromotivo')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('id_situacaoconselho', 'Situação'); ?> <br>
            <?php echo Form::select('id_situacaoconselho', config('sistema.situacaoConselho'),'', ['class' => 'select2', 'id' => 'descricao']); ?>

            <?php if($errors->has('id_situacaoconselho')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_situacaoconselho')); ?></strong>
                </span>
            <?php endif; ?>
            </div>
            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('id_decorrenciaconselho', 'Em decorrência de'); ?> <br>
            <?php echo Form::select('id_decorrenciaconselho', config('sistema.decorrenciaConselho')); ?>

            <?php if($errors->has('id_decorrenciaconselho')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_decorrenciaconselho')); ?></strong>
                </span>
            <?php endif; ?>
            </div>
            
            <div class='col-md-3 col-xs-12'>
            <?php echo Form::label('portaria_numero', 'N° Portaria'); ?> <br>
            <?php echo Form::text('portaria_numero', ''); ?>

            <?php if($errors->has('portaria_numero')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('portaria_numero')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-3 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('portaria_data', 'Data da portaria: '); ?> <br>
            <?php echo Form::text('portaria_data','' ,['class' => 'datepicker']); ?>

            <?php if($errors->has('portaria_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('portaria_data')); ?></strong>
                </span>
            <?php endif; ?>              
            </div>

            <div class='col-md-3 col-xs-12'>
            <?php echo Form::label('doc_tipo', 'Tipo de boletim'); ?> <br>
            <?php echo Form::select('doc_tipo', config('sistema.tipoBoletim')); ?>

            <?php if($errors->has('doc_tipo')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('doc_tipo')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-3 col-xs-12'>
            <?php echo Form::label('doc_numero', 'N° Boletim'); ?> <br>
            <?php echo Form::text('doc_numero', ''); ?>

            <?php if($errors->has('doc_numero')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('doc_numero')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('fato_data', 'Data da fato: '); ?> <br>
            <?php echo Form::text('fato_data','' ,['class' => 'datepicker']); ?>

            <?php if($errors->has('fato_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('fato_data')); ?></strong>
                </span>
            <?php endif; ?>              
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('abertura_data', 'Data da abertura: '); ?> <br>
            <?php echo Form::text('abertura_data','' ,['class' => 'datepicker']); ?>

            <?php if($errors->has('abertura_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('abertura_data')); ?></strong>
                </span>
            <?php endif; ?>              
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('prescricao_data', 'Data da prescricao: '); ?> <br>
            <?php echo Form::text('prescricao_data','' ,['class' => 'datepicker']); ?>

            <?php if($errors->has('prescricao_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('prescricao_data')); ?></strong>
                </span>
            <?php endif; ?>              
            </div>

            
            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('sintese_txt', 'Síntese do fato'); ?> <br>
            <?php echo Form::textarea('sintese_txt','',['class' => 'form-control', 'rows' => '5']); ?>

            <?php if($errors->has('sintese_txt')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('sintese_txt')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-12 col-xs-12'>
            <br>
            <?php echo Form::submit('Inserir adl',['class' => 'btn btn-primary btn-block']); ?>

            <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

    </div>
  
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <?php echo $__env->make('vendor.adminlte.includes.pickers', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('vendor.adminlte.includes.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>

    $("#descricao").on('load, change',function ()
    {
        var campo = $("#descricao").val();
        console.log(campo);
        if (campo == 'Outro') 
        {
            $(".descricao_outros").show();
        }
        else
        {
            $(".descricao_outros").hide();
        }
    });
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>