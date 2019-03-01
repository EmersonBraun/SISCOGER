<?php $__env->startSection('title_postfix', '| Dasboard geral'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências Gerais</small></h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Pendências Gerais</li>
    </ol>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="content nopadding">

<div class="row"><!-- ************lista de pendências GERAL***************** -->

    <!-- Pendências Gerais -->
    <div class="col-md-12 col-xs-12">
        <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pendências Gerais
            </h3>

        </div>

        <div class="box-body">
            <table class="table table-striped" id="tabela1">
                <thead>
                    <tr>
                        <th>OPM</th>
                        <th>FATD punição</th>
                        <th>FATD prazo</th>
                        <th>FATD abertura</th>
                        <th>IPM praz</th>
                        <th>IPM abertura</th>
                        <th>Sindicância prazo</th>
                        <th>Sindicância abertura</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $pendencias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pendencia): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                <tr>
                    <td><?php echo e(opm($pendencia->cdopm)); ?></td>
                    <td><?php echo e($pendencia->fatd_punicao); ?></td>
                    <td><?php echo e($pendencia->fatd_prazo); ?></td>
                    <td><?php echo e($pendencia->fatd_abertura); ?></td>
                    <td><?php echo e($pendencia->ipm_prazo); ?></td>
                    <td><?php echo e($pendencia->ipm_abertura); ?></td>
                    <td><?php echo e($pendencia->sindicancia_prazo); ?></td>
                    <td><?php echo e($pendencia->sindicancia_abertura); ?></td>
                    <td><?php echo e($pendencia->total); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>           
        </div>

    </div>
    <!-- /Pendências Gerais -->


</div><!-- *************/.lista de pendências GERAL********************* -->

<div class="row"><!-- *************.Gráficos********************* -->
    <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Pendências Totais</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_total->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tp_total); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">FATD punição</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_fatd_punicao->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tpfatd_punicao); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
     <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">FATD abertura</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_fatd_abertura->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tpfatd_abertura); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
     <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">FATD prazo</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_fatd_prazo->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tpfatd_prazo); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
     <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">IPM abertura</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_ipm_abertura->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tpipm_abertura); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
     <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">IPM Prazo</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_ipm_prazo->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tpipm_prazo); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
     <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Sindicância abertura</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_s_abertura->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tps_abertura); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-12 col-xs-12">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Sindicância Prazo</h3>
        </div>
        <div class="box-body" style="width:75%;">
            <?php echo $__env->make('vendor.adminlte.includes.graficos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $chartjs_pendencia_s_prazo->render(); ?>

            <div class="d-flex flex-row">
                <div class="p-6">Fonte: SISCOGER - data <?php echo e(date('d/m/Y')); ?> <strong>TOTAL: <?php echo e($tps_prazo); ?></strong></div>       
            <div>         
        </div>
    </div>
</div>
</div>


</div><!-- *************.Gráficos********************* -->
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.css')); ?>">
<script src="<?php echo e(asset('public/vendor/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">

// DataTable
var table =  $('#tabela1').DataTable({
    'ajax' : false,
    'paging'      : true,
    'lengthChange': false,
    'searching'   : false,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,

      "language": {
        "sEmptyTable":   "Nenhum registro encontrado",
        "sProcessing":   "A processar...",
        "sLengthMenu":   "Mostrar _MENU_ registos",
        "sZeroRecords":  "Não foram encontrados resultados",
        "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registos",
        "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registos",
        "sInfoFiltered": "(filtrado de _MAX_ registos no total)",
        "sInfoPostFix":  "",
        "sSearch":       "Procurar:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Primeiro",
            "sPrevious": "Anterior",
            "sNext":     "Seguinte",
            "sLast":     "Último"
        },
        "oAria": {
            "sSortAscending":  ": Ordenar colunas de forma ascendente",
            "sSortDescending": ": Ordenar colunas de forma descendente"
        }
      }
    }); 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>