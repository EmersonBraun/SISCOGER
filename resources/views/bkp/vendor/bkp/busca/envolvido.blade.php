@extends('adminlte::page')

@section('title_postfix', '| Busca Envolvido')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><i class='fa fa-user-plus'></i> Busca Envolvido</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            <li class="breadcrumb-item active">Busca envolvido</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<div class=''>
    <h4 style="padding-left: 3%"><b>Buscar por:</b></h4>
    {{ Form::open(array('route' => array('busca.pm'))) }}
    <div class="col-md-12 form-group">
        <div class="col-md-6">
            {!! Form::label('envolvido[rg]', 'RG') !!}
            {!! Form::text('envolvido[rg]', '', array('class' => 'form-control', 'id' => 'rg')) !!}
        </div>
        <div class="col-md-6">
            {!! Form::label('envolvido[nome]', 'Nome') !!}
            {!! Form::text('envolvido[nome]', '', array('class' => 'form-control','id' => 'nome'))!!}
        </div>
    </div>

    {!! Form::close() !!}
    <div id="tabela">

    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script type="text/javascript">
$('#rg').keydown(function()
{
var rg = $(this).val();
    
    if(rg.length >= 2)
    {
        $.ajax({
            type: "POST",
            url: '/siscoger/busca/getenrg/' + rg,
            data: {"_token": "{{ csrf_token() }}", "rg": rg},
             
            success:function(data){
                $('#tabela').empty();
                $('#tabela').html(data);
            }
        });
    }
    else
    {
        $('#tabela').html("");
    }
 
});

$('#nome').keydown(function()
{
var nome = $(this).val();
    
    if(nome.length >= 2)
    {
        $.ajax({
            type: "POST",
            url: '/siscoger/busca/getennome/' + nome,
            data: {"_token": "{{ csrf_token() }}", "nome": nome},
             
            success:function(data){
                $('#tabela').empty();
                $('#tabela').html(data);
             
            }
        });
    }
    else
    {
        $('#tabela').html("");
    }
});
</script>
@stop