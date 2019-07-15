<?php $__env->startSection('title', 'ADL - Criar'); ?>

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
    <div class="tab-content">
        <v-tab-item title="Formulário principal" idp="principal" cls="active show">
            <?php echo Form::open(['url' => route('adl.store')]); ?>

            <v-prioritario admin="session('is_admin')"></v-prioritario>
            <v-label label="id_andamento" title="Andamento" error="<?php echo e($errors->first('id_andamento')); ?>">
                <?php echo Form::select('id_andamento',config('sistema.andamentoADL'),null, ['class' => 'form-control','required']); ?>

            </v-label>
            <v-label label="id_andamentocoger" title="Andamento COGER" error="<?php echo e($errors->first('id_andamentocoger')); ?>">
                <?php echo Form::select('id_andamentocoger',config('sistema.andamentocogerADL'),null, ['class' => 'form-control','required']); ?>

            </v-label>
            <v-label label="id_motivoconselho" title="Motivo ADL (Lei nº 16.544/2010)" link="https://goo.gl/L1m5Ps" icon="fa fa-link text-info">
                <?php echo Form::select('id_motivoconselho', config('sistema.motivoConselho'),null, ['class' => 'form-control select2', 'id' => 'descricao']); ?>

            </v-label>
            <v-label label="check" title="Selecione: " md="12" lg="12">
                <v-checkbox name="ac_desempenho_bl" true-value="S" false-value="0"
                text="Procedido incorretamente no desempenho do cargo ou função.">
                </v-checkbox>
                <v-checkbox name="ac_conduta_bl" true-value="S" false-value="0"
                text="Conduta irregular ou ato que venha a denegrir a imagem da Corporação.">
                </v-checkbox>
                <v-checkbox name="ac_honra_bl" true-value="S" false-value="0"
                text="Praticado ato que afete a honra pessoal, o pundonor militar ou o decoro da classe.">
                </v-checkbox>
            </v-label>
            <v-label label="outromotivo" title="Especificar (no caso de outros motivos)">
                <?php echo e(Form::text('outromotivo', null, ['class' => 'form-control '])); ?>

            </v-label>
            <v-label label="id_situacaoconselho" title="Situação">
                <?php echo Form::select('id_situacaoconselho',config('sistema.situacaoConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

            </v-label>
            <v-label label="id_decorrenciaconselho" title="Em decorrência de">
                <?php echo Form::select('id_decorrenciaconselho',config('sistema.decorrenciaConselho'),null, ['class' => 'form-control ', 'id' => 'descricao']); ?>

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
            <v-label label="sintese_txt" title="Sintese" lg="12" md="12" error="<?php echo e($errors->first('sintese_txt')); ?>">
                <?php echo Form::textarea('sintese_txt',null,['class' => 'form-control ', 'rows' => '5', 'cols' => '50']); ?>

            </v-label>
            <?php echo Form::submit('Inserir ADL',['class' => 'btn btn-primary btn-block']); ?>

            <?php echo Form::close(); ?>

        </v-tab-item>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<?php echo $__env->make('vendor.adminlte.includes.vue', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>