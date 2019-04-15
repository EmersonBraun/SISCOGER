<?php $__env->startSection('title', 'BD'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header">   
  <h1>BD - Lista</h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">BD - Lista</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
  
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem do Banco de dados</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                    <th>META4</th>
                    <th>NOME_META4</th>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Abreviatura</th>
                    <th>Tipo</th>
                    <th>Municip.</th>
                    <th>Titulo</th>
                    <th>Cod. base</th>
                    <th>Cod. novo</th>
                    <th>Telefone</th>
                  </tr>
                  </thead>
  
                  <tbody>
                    <?php $__currentLoopData = $dados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($d['META4']); ?></td> 
                        <td><?php echo e($d['NOME_META4']); ?></td> 
                        <td><?php echo e($d['CODIGO']); ?></td> 
                        <td><?php echo e($d['DESCRICAO']); ?></td> 
                        <td><?php echo e($d['ABREVIATURA']); ?></td> 
                        <td><?php echo e($d['TIPO']); ?></td> 
                        <td><?php echo e($d['MUNICIPIO']); ?></td> 
                        <td><?php echo e($d['CDMUNICIPIO']); ?></td> 
                        <td><?php echo e($d['TITULO']); ?></td> 
                        <td><?php echo e($d['CODIGOBASE']); ?></td> 
                        <td><?php echo e($d['CODIGONOVO']); ?></td> 
                        <td><?php echo e($d['TELEFONE']); ?></td> 
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="/css/admin_custom.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.css')); ?>">
<script src="<?php echo e(asset('public/vendor/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">

// DataTable
var table =  $('#example1').DataTable({
    'ajax' : false,
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : false,
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