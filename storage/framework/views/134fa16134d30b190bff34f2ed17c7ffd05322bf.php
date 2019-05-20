<?php $__env->startSection('title', 'ADL - Rel. Sit'); ?>

<?php $__env->startSection('content_header'); ?>
<section class="content-header nopadding"> 
    <?php $__env->startComponent('components.treeview',
    [
        'title' => 'ADL - Relatório de Situação',
        'opts' => []
    ]); ?>
    <?php echo $__env->renderComponent(); ?>   
    
    <?php $__env->startComponent('components.menu',
    [
        'title' => 'ADL',
        'prop' => ['10','2'],
        'menu' => [
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.lista','name'=>'lista'],
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.andamento','name'=>'Andamento'],
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.prazos','name'=>'Prazos'],
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação','type'=>'success'],
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.julgamento','name'=>'Julgamento'],
            ['md'=> 2, 'xs'=> 2, 'route'=>'adl.apagados','name'=>'Apagados']
        ]
    ]); ?>   
    <?php echo $__env->renderComponent(); ?>  
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="">
        <div class="row ">
          <div class="col-xs-12">
            <!-- /.box -->
  
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                    <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-2 col-md-2'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>Fato</th>
                      <th class='col-xs-2 col-md-2'>Portaria</th>
                      <th class='col-xs-2 col-md-2'>Parecer</th>  
                      <th class='col-xs-4 col-md-4'>Check</th>
                    </tr>
                  </thead>
  
                  <tbody>
                     <?php $__currentLoopData = $registros; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $registro): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td style="display: none"><?php echo e($registro['id_adl']); ?></td>
                    <td><?php echo e($registro->present()->refAno); ?></td>
                    <td><?php echo e($registro->fato_data); ?></td> 
                    <td><?php echo e($registro->portaria_data); ?></td>
                    <td><?php echo e($registro->prescricao_data); ?></td> 
                    <td>
                        <span>
                            <?php echo $registro->present()->libeloIcon; ?>

                            Libelo<br>
                            <?php echo $registro->present()->parecerIcon; ?>

                            Parecer<br>
                            <?php echo $registro->present()->decisaoIcon; ?>

                            Decisão<br>
                            <?php echo $registro->present()->recAtoIcon; ?>

                            Rec. Ato<br>
                    </td> 
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                        <th style="display: none">#</th>
                        <th>N°/Ano</th>
                        <th>Fato</th>
                        <th>Portaria</th>
                        <th>Parecer</th>  
                        <th>Check</th>
                    </tr>
                  </tfoot>
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

<?php $__env->startSection('js'); ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.css')); ?>">
<script src="<?php echo e(asset('public/vendor/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.js')); ?>"></script>

<script type="text/javascript">
// Setup - add a text input to each footer cell
$('#datable tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" style="max-width:100px" placeholder="'+title+'" />' );
} );

function format ( d ) {
    return 'Full name: '+d.first_name+' '+d.last_name+'<br>'+
        'Salary: '+d.salary+'<br>'+
        'The child row can contain any data you wish, including links, images, inner tables etc.';
}

// DataTable
var table =  $('#datable').DataTable({
    'ajax' : false,
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : true,
    'info'        : true,
    'autoWidth'   : false,
    "order": [[ 0, "desc" ]],

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

// Apply the search
table.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
        if ( that.search() !== this.value ) {
            that
                .search( this.value )
                .draw();
        }
    } );
} );  

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>