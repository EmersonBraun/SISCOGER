@extends('adminlte::page')

@section('title', 'notacoger')

@section('content_header')
    @include('procedimentos.notacoger.list.menu', ['title' => 'Consultas','page' => 'lista'])
@stop

@section('content')
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
                <h3 class="box-title">Listagem de Nota COGER</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
  
                  <thead>
                  <tr>
                      <th style="display: none">#</th>
                      <th class='col-xs-1 col-md-1'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>Data</th>
                      <th class='col-xs-2 col-md-2'>Situação</th>
                      <th class='col-xs-2 col-md-2'>Descrição</th>
                      <th class='col-xs-2 col-md-2'>Arquivo</th>
                      <th class='col-xs-3 col-md-3'>Ações</th>     
                  </tr>
                  </thead>
  
                  <tbody>
                  @foreach($registros as $registro)
                  <tr>
                    <td style="display: none">{{$registro->id_notacomparecimento}}</td>
                    @if ($registro->sjd_ref != '')
                    <td>{{$registro->sjd_ref}}/{{$registro->sjd_ref_ano}}</td>
                    @else
                    <td>{{$registro->id_notacomparecimento}}</td>
                    @endif
                    <td>{{$registro->expedicao_data}}</td>
                    <td>{{$registro->status}}</td>
                    <td>{{$registro->present()->tiponotacomparecimento}}</td>
                    <td>{{$registro->present()->nota_file}}</td>
                    <td>
                        <span>
                        <a class="btn btn-default" href="{{route('notacoger.show',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i class="fa fa-fw fa-eye "></i></a>
                        <a class="btn btn-info" href="{{route('notacoger.edit',['ref' => $registro->sjd_ref, 'ano' => $registro->sjd_ref_ano])}}"><i class="fa fa-fw fa-edit "></i></a>
                        <a class="btn btn-danger"  href="{{route('notacoger.destroy',$registro['id_notacoger'])}}" onclick="confirm('Tem certeza que quer apagar o notacoger?')"><i class="fa fa-fw fa-trash-o "></i></a>
                        </span>
                    </td>   
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                     <th style="display: none">#</th>
                      <th class='col-xs-1 col-md-1'>N°/Ano</th>
                      <th class='col-xs-2 col-md-2'>Data</th>
                      <th class='col-xs-2 col-md-2'>Situação</th>
                      <th class='col-xs-2 col-md-2'>Descrição</th>
                      <th class='col-xs-2 col-md-2'>Arquivo</th>
                      <th class='col-xs-3 col-md-3'>Ações</th>  
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

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
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