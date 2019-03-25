<?php $__env->startSection('title', 'adl - Editar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>ADL - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('adl.lista',['ano' => date('Y')])); ?>">ADL - Lista</a></li>
  <li class="active">ADL - Editar</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
    <div class='btn-group col-md-8 col-xs-12 ' style='padding-left: 0px'>
      <a class="btn btn-success col-md-3 col-xs-4 "  href="#">Editar</a>
    <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('adl.movimentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Movimentos</a>
      <a class="btn btn-default col-md-3 col-xs-4 "  href="<?php echo e(route('adl.sobrestamentos',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']])); ?>">Sobrestamentos</a>   
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

            <?php echo Form::model($proc,['url' => route('adl.update',['ref' => $proc['sjd_ref'],'ano' => $proc['sjd_ref_ano']]),'method' => 'put', 'files' => true]); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento','campo' => 'id_andamento', 'opt' => config('sistema.andamentoADL')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Andamento COGER','campo' => 'andamentocoger', 'opt' => config('sistema.andamentocogerADL'), 'class' => 'select2']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'Modelo','campo' => 'modelo']); ?>
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
            
            <?php $__env->startComponent('components.form.date',['titulo' => 'Data da portaria','campo' => 'portaria_data']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.select',
            ['titulo' => 'Tipo de boletim','campo' => 'doc_tipo', 'opt' => config('sistema.tipoBoletim')]); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.text',['titulo' => 'N° Boletim','campo' => 'doc_numero']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.date',['titulo' => 'Data da fato','campo' => 'fato_data']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.date',['titulo' => 'Data da abertura','campo' => 'abertura_data']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.date',['titulo' => 'Data da prescricao','campo' => 'prescricao_data']); ?>
            <?php echo $__env->renderComponent(); ?>

            <?php $__env->startComponent('components.form.sintese_txt'); ?>
            <?php echo $__env->renderComponent(); ?>

            
            <v-proced-origem dproc="adl" dref="<?php echo e($proc['sjd_ref']); ?>" dano="<?php echo e($proc['sjd_ref_ano']); ?>"></v-proced-origem>
            <br>
            
            
            

            </div>
        </div>
    </div>

</div>

<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Documentos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('libelo_file','Libelo:','adl',$proc['libelo_file'], ['class' => 'form-control']); ?>

        <?php if($errors->has('libelo_file')): ?>
            <span class="help-block">
                <strong><?php echo e($errors->first('libelo_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    <?php echo Form::label('parecer_comissao', 'Parecer comissão'); ?> <br>
    <?php echo Form::text('parecer_comissao', $proc['parecer_comissao'], ['class' => 'form-control']); ?>

    <?php if($errors->has('parecer_comissao')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('parecer_comissao')); ?></strong>
        </span>
    <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('parecer_file','Parecer:','adl',$proc['parecer_file'], ['class' => 'form-control']); ?>

        <?php if($errors->has('parecer_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('parecer_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
    

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
    <?php echo Form::label('parecer_cmtgeral', 'Parecer CMT Geral'); ?> <br>
    <?php echo Form::text('parecer_cmtgeral', $proc['parecer_cmtgeral'], ['class' => 'form-control']); ?>

    <?php if($errors->has('parecer_cmtgeral')): ?>
        <span class="help-block">
            <strong><?php echo e($errors->first('parecer_cmtgeral')); ?></strong>
        </span>
    <?php endif; ?>
    </div>

    <div class='col-lg-6 col-md-6 col-xs-12 form-group'>
        <?php echo Form::sfile('decisao_file','Parecer CMT Geral:','adl',$proc['decisao_file'], ['class' => 'form-control']); ?>

        <?php if($errors->has('decisao_file')): ?>
            <span class='help-block'>
                <strong><?php echo e($errors->first('decisao_file')); ?></strong>
            </span>
        <?php endif; ?>
    </div>

    

    </div>
</div>


<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Recursos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_ato_file','Reconsideração de ato (solução): ','fatd',$proc['rec_ato_file']); ?>

    </div>

    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_cmt_file','Recurso CMT OPM','fatd',$proc['rec_cmt_file']); ?>

    </div>

    
    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_crpm_file','Recurso CMT CRPM:','fatd',$proc['rec_crpm_file']); ?>

    </div>

    <div class='col-md-6 col-xs-12'>
        <?php echo Form::sfile('rec_cg_file','Recurso CMT Geral:','fatd',$proc['rec_cg_file']); ?>

    </div>

    </div>
</div>


<div class="box">
    <div class="box-header">
        
        <h4 class="box-title">Membros</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-rg', 'RG do presidente'); ?> <br>
        <?php echo Form::text('presidente-rg',$presidente['rg'],
        ['onblur' => "completaDados($(this).val(),'presidente-nome','presidente-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-nome', 'Nome do presidente'); ?> <br>
        <?php echo Form::text('presidente-nome',$presidente['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('presidente-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('presidente-posto',$presidente['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-rg', 'RG do escrivao'); ?> <br>
        <?php echo Form::text('escrivao-rg',$escrivao['rg'],
        ['onblur' => "completaDados($(this).val(),'escrivao-nome','escrivao-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-nome', 'Nome do escrivao'); ?> <br>
        <?php echo Form::text('escrivao-nome',$escrivao['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('escrivao-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('escrivao-posto',$escrivao['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    
    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-rg', 'RG do defensor'); ?> <br>
        <?php echo Form::text('defensor-rg',$defensor['rg'],
        ['onblur' => "completaDados($(this).val(),'defensor-nome','defensor-posto')",'class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-nome', 'Nome do defensor'); ?> <br>
        <?php echo Form::text('defensor-nome',$defensor['nome'],['readonly','class' => 'form-control']); ?>

    </div>

    <div class='col-lg-4 col-md-6 col-xs-12 form-group'>
        <?php echo Form::label('defensor-posto', 'Posto/Graduação'); ?> <br>
        <?php echo Form::text('defensor-posto',$defensor['cargo'],['readonly','class' => 'form-control']); ?>

    </div>

    </div>
</div>



<div class="content-footer">
    <br>
    <?php echo Form::submit('Alterar ADL',['class' => 'btn btn-primary btn-block']); ?>

    <?php echo Form::close(); ?>

</div>


</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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