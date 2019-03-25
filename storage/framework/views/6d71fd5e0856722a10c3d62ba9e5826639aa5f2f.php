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

</v-select>
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
            <?php echo Form::label('prioridade', 'Processo prioritário'); ?>

            <?php echo Form::checkbox('prioridade', '1'); ?>

            </div>

            

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoADL')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerADL'), 'class' => 'select2']); ?>
            <?php echo $__env->renderComponent(); ?>


            
            <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
            <?php echo Form::label('id_motivoconselho', 'Motivo ADL (Lei nº 16.544/2010)'); ?> <a href="https://goo.gl/L1m5Ps" target="_blank"><i class="fa fa-link text-info"></i></a><br>
            <?php echo Form::select('id_motivoconselho', config('sistema.motivoConselho'),'', ['class' => 'form-control select2', 'id' => 'descricao']); ?>

            <?php if($errors->has('id_motivoconselho')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('id_motivoconselho')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <?php $__env->startComponent('components.form.text',['titulo' => 'Especificar (no caso de outros motivos)','campo' => 'outromotivo']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Situação','campo' => 'id_situacaoconselho', 'opt' => config('sistema.situacaoConselho'), 'id' => 'descricao']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'N° Portaria','campo' => 'portaria_numero']); ?>
            <?php echo $__env->renderComponent(); ?>
            
            <v-datepicker title="Data da portaria" name="portaria_data"></v-datepicker>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Tipo de boletim','campo' => 'doc_tipo', 'opt' => config('sistema.tipoBoletim')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'N° Boletim','campo' => 'doc_numero']); ?>
            <?php echo $__env->renderComponent(); ?>

            <v-datepicker title="Dato do fato" name="fato_data"></v-datepicker>

            <v-datepicker title="Data da abertura" name="abertura_data"></v-datepicker>

            <v-datepicker title="Data da prescricao" name="prescricao_data"></v-datepicker>


            <?php $__env->startComponent('components.form.sintese_txt'); ?>
            <?php echo $__env->renderComponent(); ?>

            
            
            <v-proced-origem></v-proced-origem>
            <br>
            
            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Procedimento(s) de Origem (apenas se houver)',
                'btn' => 'Adicionar documento de origem',
                'arquivo' => 'ligacao',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>
            

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Acusado',
                'btn' => 'Adicionar acusado',
                'arquivo' => 'envolvido',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Vítima (apenas se houver)',
                'btn' => 'Adicionar vítima',
                'arquivo' => 'ofendido',
                'relacao' => NULL,
                'proc' => 'adl',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

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
  
  

<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>