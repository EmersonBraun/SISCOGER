<?php $__env->startSection('title', 'APFD - Editar'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>APFD - Editar</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="<?php echo e(route('apfd.lista',['ano' => date('Y')])); ?>">APFD - Lista</a></li>
  <li class="active">APFD - Editar</li>
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
            {idp: 'membros',name: 'Membros'},
            {idp: 'movimentos',name: 'Movimentos'},
            {idp: 'encaminhamentos',name: 'Encaminhamentos'},
            {idp: 'arquivo',name: 'Arquivo'},

        ]">

        </v-tab-menu>
       
        <div class="tab-content">
            <v-tab-item title="N° <?php echo e($proc['sjd_ref']); ?> / <?php echo e($proc['sjd_ref_ano']); ?> - Formulário principal" idp="principal" cls="active show">
                <?php echo Form::model($proc,['url' => route('apfd.update',$proc['id_apfd']),'method' => 'put']); ?>

                <v-label label="id_andamentocoger" title="Andamento COGER">
                    <?php echo Form::select('id_andamentocoger',config('sistema.andamentocogerAPFD'),null, ['class' => 'form-control ']); ?>

                </v-label>
                <v-label label="tipo" title="Tipo">
                    <?php echo Form::select('tipo', ['Crime comum','Crime militar'],null, ['class' => 'form-control select2']); ?>

                </v-label>
                <v-label label="cdopm" title="OPM">
                    <v-opm cdopm="<?php echo e($proc['cdopm']); ?>"></v-opm>
                </v-label>
                <v-label label="fato_data" title="Data do fato">
                    <v-datepicker name="fato_data" placeholder="dd/mm/aaaa" clear-button value="<?php echo e($proc['fato_data'] ?? ''); ?>"></v-datepicker>
                </v-label>
                <v-label label="sintese_txt" title="Síntese do fato (Quem, quando, onde, como e por quê): " lg="12" md="12" error="<?php echo e($errors->first('sintese_txt')); ?>">
                    <?php echo Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']); ?>

                </v-label>
                <v-label label="tipo_penal_novo" title="Tipos penais (Do mais grave ao menos grave): ">
                    <?php echo Form::select('tipo_penal_novo', config('sistema.tipo_penal_novo'),null, ['class' => 'form-control select2']); ?>

                </v-label>
                <v-label label="especificar" title="Especificar (Caso tipo penal OUTROS): ">
                    <?php echo e(Form::text('especificar', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="doc_tipo" title="Documento da publicação: ">
                    <?php echo Form::select('doc_tipo',['BI','BG','BR'],null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

                </v-label>
                <v-label label="doc_tipo" title="N° Documento da publicação: ">
                    <?php echo e(Form::text('doc_tipo', null, ['class' => 'form-control '])); ?>

                </v-label>
                <v-label label="referenciavajme" title="Referencia da VAJME (Nº do processo e vara)" >
                    <?php echo e(Form::text('referenciavajme', null, ['class' => 'form-control '])); ?>

                </v-label>
                <?php echo Form::submit('Alterar APFD',['class' => 'btn btn-primary btn-block']); ?>

                <?php echo Form::close(); ?>

            </v-tab-item>
            <v-tab-item title="Envolvidos" idp="envolvidos">      
                <v-acusado idp="<?php echo e($proc['id_apfd']); ?>" situacao="<?php echo e(sistema('procSituacao','apfd')); ?>" ></v-acusado><br>
                <v-vitima idp="<?php echo e($proc['id_apfd']); ?>" ></v-vitima><br>
            </v-tab-item>
            <v-tab-item title="Membros" idp="membros">
                <v-membro idp="<?php echo e($proc['id_apfd']); ?>"></v-membro>
            </v-tab-item>
            <v-tab-item title="Movimentos" idp="movimentos">
                <v-movimento idp="<?php echo e($proc['id_apfd']); ?>" opm="<?php echo e(session('opm_descricao')); ?>" rg="<?php echo e(session('rg')); ?>" :admin="<?php echo e(session('is_admin')); ?>"></v-movimento>
            </v-tab-item>
            <v-tab-item title="Encaminhamentos" idp="encaminhamentos">
                Encaminhamentos
            </v-tab-item>
            <v-tab-item title="Arquivo" idp="arquivo">
                <v-arquivo idp="<?php echo e($proc['id_apfd']); ?>" ></v-arquivo>
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