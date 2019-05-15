<?php $__env->startSection('title', 'FATD - Editar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>FATD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('fatd.lista',['ano' => date('Y')])); ?>">FATD - Lista</a></li>
  <li class="active">FATD - Editar</li>
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
            {idp: 'documentos',name: 'Documentos'},
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
                <?php echo Form::model($proc,['url' => route('fatd.update',$proc['id_fatd']),'method' => 'put']); ?>

                <v-label label="id_andamento" title="Andamento">
                    <?php echo Form::select('id_andamento',config('sistema.andamentoFATD'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <?php echo Form::select('id_andamentocoger',config('sistema.andamentocogerFATD'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="doc_origem_txt" title="Documentos de origem">
                    <?php echo e(Form::text('doc_origem_txt', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="fato_data" title="Data da fato" icon="fa fa-calendar">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['fato_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="<?php echo e($proc['cdopm']); ?>"></v-opm>
                </v-label>
                <v-label label="motivo_fatd" title="Motivo" >
                    <?php echo Form::select('motivo_fatd', config('sistema.motivoFATD'),null, ['class' => 'form-control select2', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                    <?php echo e(Form::text('outromotivo', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="situacao_fatd" title="Situação">
                    <?php echo Form::select('situacao_fatd',config('sistema.situacaoOCOR'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="despacho_numero" title="Nº do despacho que designa o Encarregado">
                    <?php echo e(Form::text('despacho_numero', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="portaria_data" title="Data do despacho" icon="fa fa-calendar">
                    <v-datepicker name="portaria_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['portaria_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="doc_tipo" title="Tipo de boletim">
                    <?php echo Form::select('doc_tipo',config('sistema.tipoBoletim'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="doc_numero" title="N° Boletim">
                    <?php echo e(Form::text('doc_numero', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="abertura_data" title="Data da abertura" icon="fa fa-calendar">
                    <v-datepicker name="abertura_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['abertura_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="<?php echo e($errors->first('sintese_txt')); ?>">
                    <?php echo Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']); ?>

                </v-label>
                <?php echo Form::submit('Alterar FATD',['class' => 'btn btn-primary btn-block']); ?>

                <?php echo Form::close(); ?>

            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">
                <v-proced-origem></v-proced-origem><br>           
                <v-acusado idp="<?php echo e($proc['id_fatd']); ?>" situacao="<?php echo e(sistema('procSituacao','fatd')); ?>" ></v-acusado><br>
                <v-vitima idp="<?php echo e($proc['id_fatd']); ?>" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Documentos" idp="documentos">
                <file-upload 
                title="Relato do fato imputado:"
                name="fato_file"
                proc="fatd"
                idp="<?php echo e($proc['id_fatd']); ?>"
                :ext="['pdf']" 
                :candelete="<?php echo e(session('is_admin')); ?>"
                ></file-upload>

                <file-upload 
                title="Relatório:"
                name="relatorio_file"
                proc="fatd"
                idp="<?php echo e($proc['id_fatd']); ?>"
                :ext="['pdf']" 
                :candelete="<?php echo e(session('is_admin')); ?>"
                ></file-upload>

                <file-upload 
                title="Solução do Comandante:"
                name="sol_cmt_file"
                proc="fatd"
                idp="<?php echo e($proc['id_fatd']); ?>"
                :ext="['pdf']" 
                :candelete="<?php echo e(session('is_admin')); ?>"
                ></file-upload>

                <file-upload 
                title="Solução do Cmt Geral:"
                name="sol_cg_file"
                proc="fatd"
                idp="<?php echo e($proc['id_fatd']); ?>"
                :ext="['pdf']" 
                :candelete="<?php echo e(session('is_admin')); ?>"
                ></file-upload>

                <file-upload 
                title="Nota de punição:"
                name="notapunicao_file"
                proc="fatd"
                idp="<?php echo e($proc['id_fatd']); ?>"
                :ext="['pdf']" 
                :candelete="<?php echo e(session('is_admin')); ?>"
                ></file-upload>

                <v-item-unique title="Publicação da nota de punição (Ex: BI nº 12/2011)" proc="fatd" idp="<?php echo e($proc['id_fatd']); ?>" name="publicacaonp"></v-item-unique>
            </v-tab-item>
            <v-tab-item title="Recursos" idp="recursos">
                <file-upload 
                    title="Reconsideração de ato (solução):"
                    name="rec_ato_file"
                    proc="fatd"
                    idp="<?php echo e($proc['id_fatd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT OPM:"
                    name="rec_cmt_file"
                    proc="fatd"
                    idp="<?php echo e($proc['id_fatd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT CRPM:"
                    name="rec_crpm_file"
                    proc="fatd"
                    idp="<?php echo e($proc['id_fatd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>

                <file-upload 
                    title="Recurso CMT Geral:"
                    name="rec_cg_file"
                    proc="fatd"
                    idp="<?php echo e($proc['id_fatd']); ?>"
                    :ext="['pdf']" 
                    :candelete="<?php echo e(session('is_admin')); ?>"
                    >
                </file-upload>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="<?php echo e($proc['id_fatd']); ?>"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="<?php echo e($proc['id_fatd']); ?>" opm="<?php echo e(session('opm_descricao')); ?>" rg="<?php echo e(session('rg')); ?>" :admin="<?php echo e(session('is_admin')); ?>"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Sobrestamentos" idp="sobrestamentos">
                <v-sobrestamento idp="<?php echo e($proc['id_fatd']); ?>" ></v-sobrestamento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="<?php echo e($proc['id_fatd']); ?>" ></v-arquivo>
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