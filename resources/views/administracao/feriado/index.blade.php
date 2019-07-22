@extends('adminlte::page')

@section('title', 'Feriado')

@section('content_header')
<section class="content-header nopadding">  
    <h1>Feriado - Lista</h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Feriado - Lista</li>
    </ol>
    <br>   
    <div class="form-group col-md-12 col-xs-12 nopadding">
        <div class="btn-group col-md-6 col-xs-12 nopadding">
            <a class="btn btn-success col-md-2 col-xs-2" href="{{route('feriado.index')}}">Consulta</a>
        </div>
        <div class="col-md-6 col-xs-12 litlepadding">
            <a class="btn btn-block btn-primary" href="{{route('feriado.create')}}">
            <i class="fa fa-plus"></i> Adicionar Feriado</a>
        </div>
    <div>
</section>
@stop

@section('content')
<section class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Listagem de Feriados</h3>
            </div>
            <div class="box-body">
                <table id="datable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-3 col-md-3'>Data</th>
                            <th class='col-xs-3 col-md-3'>Dia da semana</th>
                            <th class='col-xs-3 col-md-3'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Ações</th>     
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $registro)
                            <tr>
                            <td style="display: none">{{$registro->id_feriado}}</td>
                            <td>{{$registro->data}}</td>
                            <td>{{$registro->data}}</td>
                            <td>{{$registro->feriado}}</td>
                            <td>
                                <span>
                                    <a class="btn btn-info" href="{{route('feriado.edit',$registro->id_feriado)}}"><i class="fa fa-fw fa-edit "></i></a>
                                    <a class="btn btn-danger"  href="{{route('feriado.destroy',$registro->id_feriado)}}" onclick="confirm('Tem certeza que quer apagar o Feriado?')"><i class="fa fa-fw fa-trash-o "></i></a>
                                </span>
                            </td>   
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="display: none">#</th>
                            <th class='col-xs-3 col-md-3'>Data</th>
                            <th class='col-xs-3 col-md-3'>Dia da semana</th>
                            <th class='col-xs-3 col-md-3'>Descrição</th>
                            <th class='col-xs-2 col-md-2'>Ações</th> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
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