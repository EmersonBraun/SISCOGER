@extends('adminlte::page')

@section('title', 'ADL - Andamento')

@section('content_header')
    @include('procedimentos.adl.list.menu', ['title' => 'Andamento','page' => 'andamento'])
@stop

@section('content')
  <div class="">
    <section class="">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Listagem de Apuração Disciplinar de Licenciamento</h3>
              </div>
              <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th style="display: none">#</th>
                        <th class='col-xs-1 col-md-1'>N°/Ano</th>
                        <th class='col-xs-1 col-md-1'>Data</th>
                        <th class='col-xs-1 col-md-1'>Prescrição</th>
                        <th class='col-xs-2 col-md-2'>Encarregado</th>
                        <th class='col-xs-2 col-md-2'>Andamento</th>
                        <th class='col-xs-2 col-md-2'>Andamento COGER</th>
                        <th class='col-xs-3 col-md-3'>Ações</th>     
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_adl']}}</td>
                            <td>{{$registro->present()->refAno}}</td>
                            <td>{{ $registro->fato_data}}</td>
                            <td>{{ $registro->prescricao_data}}</td>
                            <td>{{ $registro->present()->cargoeENome}}</td>
                            <td>{{ $registro->present()->andamento }}</td>
                            <td>{{ $registro->present()->andamentocoger }}</td>
                            <td>
                                <span>
                                <a class="btn btn-default" href="{{route('adl.show',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-eye "></i></a>
                                <a class="btn btn-info" href="{{route('adl.edit',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}"><i class="fa fa-fw fa-edit "></i></a>
                                <a class="btn btn-danger"  href="{{route('adl.destroy',$registro['id_adl'])}}" onclick="confirmApagar('adl',$registro['sjd_ref'],$registro['sjd_ref_ano'])"><i class="fa fa-fw fa-trash-o "></i></a>
                                </span>
                            </td>   
                        </tr>
                    @endforeach
                  </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th>N°/Ano</th>
                            <th>Data</th>
                            <th>Prescrição</th>
                            <th>Encarregado</th>
                            <th>Andamento</th>
                            <th>Andamento COGER</th>
                            <th>Ações</th>  
                        </tr>
                    </tfoot>
                </table>
                </div>
                </div>
            </div>
        </div>
    </section>
  </div>
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