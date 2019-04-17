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
</section>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section>
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="a principal active"><a href="#principal" data-toggle="tab" aria-expanded="true" onclick="mudaTab('principal')">Principal </a></li>
            <li class="a envolvidos"><a href="#envolvidos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('envolvidos')">Envolvidos </a></li>
            <li class="a documentos"><a href="#documentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('documentos')">Documentos </a></li>
            <li class="a recursos"><a href="#recursos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('recursos')">Recursos</a></li>
            <li class="a membros "><a href="#membros" data-toggle="tab" aria-expanded="false" onclick="mudaTab('membros')">Membros</a></li>
            <li class="a movimentos "><a href="#movimentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('movimentos')">Movimentos</a></li>
            <li class="a sobrestamentos "><a href="#sobrestamentos" data-toggle="tab" aria-expanded="false" onclick="mudaTab('sobrestamentos')">Sobrestamentos</a></li>
        </ul>
        <div class="tab-content">
            <div class="row tab-pane active show" id="principal">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            
                            <h4 class="box-title">N° <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?> - Formulário principal</h4>
                            
                        </div>

                        <div class="box-body">
                            <?php echo Form::model($proc,['url' => route('adl.update',$proc['id_adl']),'method' => 'put']); ?>

                            <v-label label="id_andamento" title="Andamento">
                                <?php echo Form::select('id_andamento',config('sistema.andamentoADL'),null, ['class' => 'form-control ']); ?>

                            </v-label>
                            <v-label label="id_andamentocoger" title="Andamento COGER">
                                <?php echo Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control ']); ?>

                            </v-label>
                            <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                                <?php echo Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']); ?>

                            </v-label>
                            <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                                <?php echo e(Form::text('outromotivo', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="id_situacaoconselho" title="Situação">
                                <?php echo Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

                            </v-label>
                            <v-label label="portaria_numero" title="N° Portaria">
                                <?php echo e(Form::text('portaria_numero', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="portaria_data" title="Data da portaria" icon="fa fa-calendar">
                                <?php echo e(Form::text('portaria_data', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="doc_tipo" title="Tipo de boletim">
                                <?php echo Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']); ?>

                            </v-label>
                            <v-label label="doc_numero" title="N° Boletim">
                                <?php echo e(Form::text('doc_numero', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                                <?php echo e(Form::text('fato_data', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                                <?php echo e(Form::text('abertura_data', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                                <?php echo e(Form::text('prescricao_data', null, ['class' => 'form-control '])); ?>

                            </v-label>
                            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="<?php echo e($errors->first('sintese_txt')); ?>">
                                <?php echo Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']); ?>

                            </v-label>
                            <?php echo Form::submit('Alterar ADL',['class' => 'btn btn-primary btn-block']); ?>

                            <?php echo Form::close(); ?>

                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="box tab-pane" id="envolvidos">
                <div class="box-header">
                    
                    <h4 class="box-title">Envolvidos</h4> 
                    <div class="box-body">
                        <v-proced-origem></v-proced-origem><br>           
                        <v-acusado idp="<?php echo e($proc['id_adl']); ?>" situacao="<?php echo e(sistema('procSituacao','adl')); ?>" ></v-acusado><br>
                        <v-vitima idp="<?php echo e($proc['id_adl']); ?>" ></v-vitima><br>
                    </div>           
                </div>
            </div>
            
            <div class="box tab-pane" id="documentos">
                <div class="box-header">
                    
                    <h4 class="box-title">Documentos</h4>            
                </div>

                <div class="box-body">
                    <file-upload 
                        title="Libelo:"
                        name="libelo_file"
                        proc="adl"
                        idp="<?php echo e($proc['id_adl']); ?>"
                        :ext="['pdf']" 
                        :candelete="<?php echo e(session('is_admin')); ?>"
                        ></file-upload>

                    <file-upload 
                        title="Parecer:"
                        name="parecer_file"
                        proc="adl"
                        idp="<?php echo e($proc['id_adl']); ?>"
                        :ext="['pdf']" 
                        :candelete="<?php echo e(session('is_admin')); ?>"
                        ></file-upload>

                    <v-label label="parecer_comissao" title="Parecer comissão" lg="12" md="12">
                        <?php echo Form::text('parecer_comissao', null, ['class' => 'form-control']); ?>

                    </v-label>

                    <file-upload 
                        title="Parecer CMT Geral:"
                        name="decisao_file"
                        proc="adl"
                        idp="<?php echo e($proc['id_adl']); ?>"
                        :ext="['pdf']" 
                        :candelete="<?php echo e(session('is_admin')); ?>"
                        ></file-upload>
                    <v-label label="parecer_cmtgeral" title="Parecer CMT Geral" lg="12" md="12">
                        <?php echo Form::text('parecer_cmtgeral', null, ['class' => 'form-control']); ?>

                    </v-label>
                </div>
            </div>
            
            
            <div class="box tab-pane" id="recursos">
                <div class="box-header">
                    
                    <h4 class="box-title">Recursos</h4>            
                </div>

                <div class="box-body">

                
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    proc="adl"
                    idp="<?php echo e($proc['id_adl']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    proc="adl"
                    idp="<?php echo e($proc['id_adl']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    proc="adl"
                    idp="<?php echo e($proc['id_adl']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    proc="adl"
                    idp="<?php echo e($proc['id_adl']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                </div>
            </div>
            
            
            <div class="box tab-pane" id="membros">
                <div class="box-header">
                    
                    <h4 class="box-title">Membros</h4>            
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
            
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
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
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>