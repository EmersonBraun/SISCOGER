<?php $__env->startSection('title', 'apfd - Criar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>APFD - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('apfd.lista')); ?>">APFD - Lista</a></li>
  <li class="active">APFD - Criar</li>
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

            <?php echo Form::open(['url' => route('apfd.store')]); ?>

            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('prioridade', 'Processo prioritário'); ?>

            <?php echo Form::checkbox('prioridade', '1'); ?>

            </div>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoAPFD')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerAPFD'), 'class' => 'select2']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.opm',
            ['titulo' => 'OPM/OBM','campo' => 'cdopm', 'opms' => $opms]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Tipo','campo' => 'tipo', 'opt' => ['Crime comum','Crime militar']]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.date',['titulo' => 'Data do fato','campo' => 'fato_data']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.tipo_penal',
            ['titulo' => 'Tipos penais (Do mais grave ao menos grave)','campo' => 'tipo_penal_novo']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'Especificar (no caso de outros motivos)','campo' => 'especificar']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Tipo de boletim','campo' => 'doc_tipo', 'opt' => config('sistema.tipoBoletim')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'N° Boletim','campo' => 'doc_numero']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'Referencia da VAJME (Nº do processo e vara)','campo' => 'referenciavajme']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.textarea',['titulo' => 'Síntese do fato (Quem, quando, onde, como e por quê)','campo' => 'sintese_txt']); ?>
            <?php echo $__env->renderComponent(); ?>

            <br>
            
            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Procedimento(s) de Origem (apenas se houver)',
                'btn' => 'Adicionar documento de origem',
                'arquivo' => 'ligacao',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>
            

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Acusado',
                'btn' => 'Adicionar acusado',
                'arquivo' => 'envolvido',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.subform',
            [
                'title' => 'Vítima (apenas se houver)',
                'btn' => 'Adicionar vítima',
                'arquivo' => 'ofendido',
                'relacao' => NULL,
                'proc' => 'apfd',
                'unico' => false
            ]); ?>    
            <?php echo $__env->renderComponent(); ?>

            <div class='col-md-12 col-xs-12'>
            <br>
            <?php echo Form::submit('Inserir apfd',['class' => 'btn btn-primary btn-block']); ?>

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
    $(document).ready(function(){
        addObjectForm('envolvido','apfd');
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