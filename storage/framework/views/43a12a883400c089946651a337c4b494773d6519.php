<?php $__env->startSection('title', 'fatd - Criar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">Fatd - Lista</a></li>
  <li class="active">FATD - Criar</li>
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

            <?php echo Form::open(['url' => route('fatd.store')]); ?>

            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('prioritario', 'Processo prioritário'); ?>

            <?php echo Form::checkbox('prioritario', '1'); ?>

            </div>

            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('id_andamento', 'Andamento'); ?> <br>
            <?php echo Form::select('id_andamento', config('sistema.andamentoFATD')); ?>

            <?php if($errors->has('id_andamento')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_andamento')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('andamentocoger', 'Andamento COGER'); ?> <br>
            <?php echo Form::select('id_andamentocoger', config('sistema.andamentocogerFATD')); ?>

            <?php if($errors->has('id_andamentocoger')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_andamentocoger')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_origem_txt', 'Documentos de origem: '); ?> <br>
            <?php echo Form::text('doc_origem_txt'); ?>

            <?php if($errors->has('doc_origem_txt')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('doc_origem_txt')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('fato_data', 'Data do fato: '); ?> <br>
            <?php echo Form::text('fato_data','' ,['class' => 'datepicker']); ?>

            <?php if($errors->has('fato_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('fato_data')); ?></strong>
                </span>
            <?php endif; ?>              
            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('cdopm', 'OPM'); ?> <br>
            <?php echo $__env->make('vendor.adminlte.form.opm_select_no', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if($errors->has('cdopm')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('cdopm')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-8 col-xs-12'>
            <?php echo Form::label('motivo_fatd', 'Motivo FATD'); ?> <br>
            <?php echo Form::select('motivo_fatd', config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']); ?>

            <?php if($errors->has('motivo_fatd')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('motivo_fatd')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12' class='descricao_outros'>
            <?php echo Form::label('motivo_outros', 'Motivo Outros' ); ?> <br>
            <?php echo Form::text('motivo_outros',''); ?>

            <?php if($errors->has('motivo_outros')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('motivo_outros')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('situacao_fatd', 'Situação'); ?> <br>
            <?php echo Form::select('situacao_fatd', config('sistema.situacaoOCOR')); ?>

            <?php if($errors->has('situacao_fatd')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('situacao_fatd')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_tipo', 'Tipo de boletim'); ?> <br>
            <?php echo Form::select('doc_tipo', config('sistema.tipoBoletim')); ?>

            <?php if($errors->has('doc_tipo')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('doc_tipo')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_numero', 'N° Boletim'); ?> <br>
            <?php echo Form::text('doc_numero', ''); ?>

            <?php if($errors->has('doc_numero')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('doc_numero')); ?></strong>
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

            
            <div class='col-md-4 col-xs-12'>
            <small><?php echo Form::label('despacho_numero', 'Nº do despacho que designa o Encarregado : '); ?></small> <br>
            <?php echo Form::text('despacho_numero','',['class' => 'despacho','placeholder' => '12345/2000'] ); ?>

            <?php if($errors->has('despacho_numero')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('despacho_numero')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('portaria_data', 'Data do despacho: '); ?> <br>
            <?php echo Form::text('portaria_data','' ,['class' => 'datepicker']); ?> 
            <?php if($errors->has('portaria_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('portaria_data')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('abertura_data', 'Data do despacho: '); ?> <br>
            <?php echo Form::text('abertura_data','' ,['class' => 'datepicker']); ?> 
            <?php if($errors->has('abertura_data')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('abertura_data')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Procedimento(s) de Origem (apenas se houver)',
                'btn' => 'Adicionar documento de origem',
                'arquivo' => 'ligacao',
                'proc' => 'fatd',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Acusado',
                'btn' => 'Adicionar acusado',
                'arquivo' => 'envolvido',
                'proc' => 'fatd',
                'unico' => true
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

            <div class='col-md-12 col-xs-12'>
            <br>
            <?php echo Form::submit('Inserir FATD',['class' => 'btn btn-primary btn-block']); ?>

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
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
//caregar envolvido
$(document).ready(function(){
    addObjectForm('envolvido','fatd',true);
});

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