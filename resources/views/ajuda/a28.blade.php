@extends('adminlte::page')

@section('title', 'BD')

@section('content_header')
<section class="content-header">   
  <h1>BD - Lista</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">BD - Lista</li>
  </ol>
  <br>
  <div class='form-group col-md-12 col-xs-12' style='padding-left: 0px'>
  
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
                    @foreach($dados as $d)
                    <tr>
                        <td>{{ $d['META4']}}</td> 
                        <td>{{ $d['NOME_META4']}}</td> 
                        <td>{{ $d['CODIGO']}}</td> 
                        <td>{{ $d['DESCRICAO']}}</td> 
                        <td>{{ $d['ABREVIATURA']}}</td> 
                        <td>{{ $d['TIPO']}}</td> 
                        <td>{{ $d['MUNICIPIO']}}</td> 
                        <td>{{ $d['CDMUNICIPIO']}}</td> 
                        <td>{{ $d['TITULO']}}</td> 
                        <td>{{ $d['CODIGOBASE']}}</td> 
                        <td>{{ $d['CODIGONOVO']}}</td> 
                        <td>{{ $d['TELEFONE']}}</td> 
                    </tr>
                    @endforeach
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
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.css') }}">
<script src="{{ asset('public/vendor/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('public/vendor/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
 
@stop