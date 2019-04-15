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
<div class='btn-group col-md-4 col-xs-12 ' style='padding-left: 0px'>
    <select name="meta4">
        <?php $__currentLoopData = $meta4; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'meta4','nome' => $m, 'limite' => 10])); ?>'"> <?php echo e($m); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <select name="rhparana">
        <?php $__currentLoopData = $rhparana; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'rhparana','nome' => $r, 'limite' => 10])); ?>'"> <?php echo e($r); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

    <select name="pass">
        <?php $__currentLoopData = $pass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option onclick="javascript:location.href='<?php echo e(route('bd',['conn' => 'pass','nome' => $p, 'limite' => 10])); ?>'"> <?php echo e($p); ?> </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>
</section>
  
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
                    <?php $__currentLoopData = $colunas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coluna): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($coluna); ?></th>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>     
                  </tr>
                  </thead>
  
                  <tbody>
                    <?php $__currentLoopData = $res; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $linha): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <?php $__currentLoopData = $linha; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($valor); ?></td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>   
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