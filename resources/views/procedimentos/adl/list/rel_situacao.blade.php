@extends('adminlte::page')

@section('title', 'ADL - Rel. Sit')

@section('content_header')
<section class="content-header nopadding"> 
    @component('components.treeview',
    [
        'title' => 'ADL - Relatório de Situação',
        'opts' => []
    ])
    @endcomponent   
    
    @component('components.menu',
    [
        'title' => 'ADL',
        'prop' => ['8','4'],
        'menu' => [
            ['md'=> 2, 'xs'=> 4, 'route'=>'adl.lista','name'=>'lista'],
            ['md'=> 2, 'xs'=> 4, 'route'=>'adl.andamento','name'=>'Andamento'],
            ['md'=> 2, 'xs'=> 4, 'route'=>'adl.prazos','name'=>'Prazos'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'adl.rel_situacao','name'=>'Rel. Situação','type'=>'success'],
            ['md'=> 3, 'xs'=> 4, 'route'=>'adl.julgamento','name'=>'Julgamento']
        ]
    ])   
    @endcomponent  
</section>
@stop

@section('content')
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
                     @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro['id_adl']}}</td>
                    <td>{{ $registro->present()->refAno}}</td>
                    <td>{{ $registro->fato_data}}</td> 
                    <td>{{ $registro->portaria_data}}</td>
                    <td>{{ $registro->prescricao_data}}</td> 
                    <td>
                        <span>
                            {!! $registro->present()->libeloIcon !!}
                            Libelo<br>
                            {!! $registro->present()->parecerIcon !!}
                            Parecer<br>
                            {!! $registro->present()->decisaoIcon !!}
                            Decisão<br>
                            {!! $registro->present()->recAtoIcon !!}
                            Rec. Ato<br>
                    </td> 
                  </tr>
                  @endforeach
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
@stop

@section('js')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.css') }}">
<script src="{{ asset('public/vendor/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
@stop
