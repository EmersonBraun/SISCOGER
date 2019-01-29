<?php $__env->startSection('title', 'fatd - Editar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">Fatd - Lista</a></li>
  <li class="active">FATD - Editar</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-success col-md-3 col-xs-4 "  href="#">Editar</a>
    <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
      <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('fatd.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
    </div>
  <div>
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
                
                <h4 class="box-title">N° <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?> - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            <?php echo Form::model($proc,['url' => route('fatd.update',['id' => $proc['id_fatd']]),'method' => 'put', 'files' => true]); ?>

            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('prioritario', 'Processo prioritário'); ?>

            <?php echo Form::checkbox('prioritario', '1'); ?>

            </div>

            
            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('andamento', 'Andamento'); ?> <br>
            <?php echo Form::select('id_andamento', config('sistema.andamentoFATD')); ?>

            <?php if($errors->has('andamento')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('andamento')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            <div class='col-md-6 col-xs-12'>
            <?php echo Form::label('andamentocoger', 'Andamento COGER'); ?> <br>
            <?php echo Form::select('id_andamentocoger', config('sistema.andamentocogerFATD')); ?>

            <?php if($errors->has('andamentocoger')): ?>
                <span class="help-block">
                    <strong><?php echo e($errors->first('andamentocoger')); ?></strong>
                </span>
            <?php endif; ?>
            </div>

            
            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_origem_txt', 'Documentos de origem: '); ?> <br>
            <?php echo Form::text('doc_origem_txt',$proc['doc_origem_txt']); ?>

            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('fato_data', 'Data do fato: '); ?> <br>
            <?php echo Form::text('fato_data',data_br($proc['fato_data']) ,['class' => 'datepicker']); ?>              
            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('cdopm', 'OPM'); ?> <br>
            <?php echo Form::text('cdopm',opm($proc['cdopm'])); ?>

            </div>

            
            <?php if($proc['motivo_outros']): ?>
                <div class='col-md-8 col-xs-12'>
                <?php echo Form::label('motivo_fatd', 'Motivo FATD'); ?> <br>
                <?php echo Form::select('motivo_fatd',config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']); ?>

                </div>

                <div class='col-md-4 col-xs-12' class='descricao_outros'>
                <?php echo Form::label('motivo_outros', 'Motivo Outros' ); ?> <br>
                <?php echo Form::text('motivo_outros',$proc['motivo_outros']); ?>

                </div>
            <?php else: ?>
                    <div class='col-md-12 col-xs-12'>
                    <?php echo Form::label('motivo_fatd', 'Motivo FATD'); ?> <br>
                    <?php echo Form::select('motivo_fatd',config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']); ?>

                    </div>
            <?php endif; ?>

            
            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('situacao_fatd', 'Situação'); ?> <br>
            <?php echo Form::select('situacao_fatd', config('sistema.situacaoOCOR')); ?>

            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_tipo', 'Tipo de boletim'); ?> <br>
            <?php echo Form::select('doc_tipo', config('sistema.tipoBoletim')); ?>

            </div>

            <div class='col-md-4 col-xs-12'>
            <?php echo Form::label('doc_numero', 'N° Boletim'); ?> <br>
            <?php echo Form::text('doc_numero'); ?>

            </div>

            
            <div class='col-md-12 col-xs-12'>
            <?php echo Form::label('sintese_txt', 'Síntese do fato'); ?> <br>
            <?php echo Form::textarea('sintese_txt',$proc['sintese_txt'],['class' => 'form-control', 'rows' => '5']); ?>

            </div>

            
            <div class='col-md-4 col-xs-12'>
            <small><?php echo Form::label('despacho_numero', 'Nº do despacho que designa o Encarregado : '); ?></small> <br>
            <?php echo Form::text('despacho_numero',$proc['despacho_numero'],['class' => 'despacho','placeholder' => '12345/2000'] ); ?>

            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('portaria_data', 'Data do despacho: '); ?> <br>
            <?php echo Form::text('portaria_data',data_br($proc['portaria_data']) ,['class' => 'datepicker']); ?> 
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> <?php echo Form::label('abertura_data', 'Data do despacho: '); ?> <br>
            <?php echo Form::text('abertura_data',data_br($proc['abertura_data']) ,['class' => 'datepicker']); ?> 
            </div>

            </div>
        </div>
    </div>

</div>

<?php echo $__env->make('vendor.procedimentos.fatd.form.documentos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('vendor.procedimentos.fatd.form.recursos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('vendor.procedimentos.fatd.form.membros', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('vendor.procedimentos.fatd.form.acusado', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="content-footer">
    <br>
    <?php echo Form::submit('Alterar FATD',['class' => 'btn btn-primary btn-block']); ?>

    <?php echo Form::close(); ?>

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