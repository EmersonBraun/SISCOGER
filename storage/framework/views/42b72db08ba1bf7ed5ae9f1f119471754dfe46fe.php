<?php $__env->startSection('title', 'CD - Editar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>CD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('cd.lista')); ?>">CD - Lista</a></li>
  <li class="active">CD - Editar</li>
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
        <v-tab-menu
        :itens="[
            {idp: 'principal',name: 'Principal', cls: 'active'},
            {idp: 'envolvidos',name: 'Envolvidos'},
            {idp: 'acordaos',name: 'Acórdãos'},
            {idp: 'recursos',name: 'Recursos'},
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'sobrestamentos',name: 'Sobrestamentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?> - Formulário principal" idp="principal" cls="active show">
                <?php echo Form::model($proc,['url' => route('cd.update',$proc['id_cd']),'method' => 'put']); ?>

                <v-label label="id_andamento" title="Andamento">
                    <?php echo Form::select('id_andamento',config('sistema.andamentoCD'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <?php echo Form::select('id_andamentocoger',config('sistema.andamentocogerCD'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                    <?php echo Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="id_situacaoconselho" title="Situação">
                    <?php echo Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="id_decorrenciaconselho" title="Situação">
                    <?php echo Form::select('id_decorrenciaconselho',config('sistema.decorrenciaConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                    <?php echo e(Form::text('outromotivo', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="portaria_numero" title="N° Portaria">
                    <?php echo e(Form::text('portaria_numero', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="portaria_data" title="Data da Portaria" icon="fa fa-calendar">
                    <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['portaria_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <?php echo Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    <?php echo e(Form::text('doc_numero', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['fato_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['abertura_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="prescricao_data" title="Data da prescricao" icon="fa fa-calendar">
                    <v-datepicker name="prescricao_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['prescricao_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="doc_prorrogacao" title="Documento da prorrogação de prazo">
                    <?php echo e(Form::text('doc_prorrogacao', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="<?php echo e($errors->first('sintese_txt')); ?>">
                    <?php echo Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']); ?>

                </v-label>
                <?php echo Form::submit('Alterar CD',['class' => 'btn btn-primary btn-block']); ?>

                <?php echo Form::close(); ?>

            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem></v-proced-origem><br>           
                <v-acusado idp="<?php echo e($proc['id_cd']); ?>" situacao="<?php echo e(sistema('procSituacao','cd')); ?>" ></v-acusado><br>
                <v-vitima idp="<?php echo e($proc['id_cd']); ?>" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Acórdãos" idp="acordaos">
                <file-upload 
                        title="TJ-PR:"
                        name="tjpr_file"
                        proc="cd"
                        idp="<?php echo e($proc['id_cd']); ?>"
                        :ext="['pdf']" 
                        :candelete="<?php echo e(session('is_admin')); ?>"
                        ></file-upload>

                <file-upload 
                    title="STJ/STF:"
                    name="stj_file"
                    proc="cd"
                    idp="<?php echo e($proc['id_cd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    ></file-upload>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    proc="cd"
                    idp="<?php echo e($proc['id_cd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso ao Governador (solução):"
                    name="rec_gov_file"
                    proc="cd"
                    idp="<?php echo e($proc['id_cd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="<?php echo e($proc['id_cd']); ?>"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="<?php echo e($proc['id_cd']); ?>" opm="<?php echo e(session('opm_descricao')); ?>" rg="<?php echo e(session('rg')); ?>" :admin="<?php echo e(session('is_admin')); ?>"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento idp="<?php echo e($proc['id_cd']); ?>" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="<?php echo e($proc['id_cd']); ?>" ></v-arquivo>
            </v-tab-item>
        </div>
    </div>

    <div class="content-footer">
        <br>
        
    </div>

</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>