@extends('adminlte::page')

@section('title', 'Relatórios | Prioritários')

@section('content_header')
    @include('relatorios.prioritario.menu', ['page' => $proc])
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de - {{sistema('procedimentosTipos',strtoupper($proc))}}</h3>
            </div>
                <div class="box-body">
                    <table id="datable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                <th class='col-xs-2 col-md-1'>OPM Apuração</th>
                                <th class='col-xs-2 col-md-4'>Sintese do fato</th>
                                <th class='col-xs-2 col-md-1'>Data do fato</th>
                                <th class='col-xs-2 col-md-1'>Data de abertura</th>
                                <th class='col-xs-3 col-md-2'>Andamento</th>   
                                <th class='col-xs-3 col-md-2'>Andamento COGER</th>  
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($registros as $registro)
                        <tr>
                            <td style="display: none">{{$registro['id_'.$proc.'']}}</td>
                            <td><a href="{{route(strtolower($proc).'.index',['ref' => $registro['sjd_ref'], 'ano' => $registro['sjd_ref_ano']])}}">{{$registro['sjd_ref']}}/{{$registro['sjd_ref_ano']}}</a></td>
                            <td>{{opm($registro['cdopm'])}}</td>
                            <td>{{$registro['sintese_txt']}}</td>
                            <td>{{data_br($registro['fato_data'])}}</td>
                            <td>{{data_br($registro['abertura_data'])}}</td>
                            <td>{{sistema('andamento',$registro['id_andamento'])}}</td>
                            <td>{{sistema('andamentocoger',$registro['id_andamentocoger'])}}</td>  
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th style="display: none">#</th>
                                <th class='col-xs-1 col-md-1'>N°/Ano</th>
                                <th class='col-xs-2 col-md-1'>OPM Apuração</th>
                                <th class='col-xs-2 col-md-4'>Sintese do fato</th>
                                <th class='col-xs-2 col-md-1'>Data do fato</th>
                                <th class='col-xs-2 col-md-1'>Data de abertura</th>
                                <th class='col-xs-3 col-md-2'>Andamento</th>   
                                <th class='col-xs-3 col-md-2'>Andamento COGER</th>  
                            </tr>
                        </tfoot>
                    </table>
            </div>
        </div>
    </div>
</section>
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