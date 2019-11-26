@extends('adminlte::page')

@section('title', 'História')

@section('content_header')
<section class="content-header">   
  <h1>História SISCOGER</h1>
  <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#myModal').modal('show')"><i class="fa fa-plus"></i> Adicionar história</button>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">História SISCOGER</li>
  </ol>
  <br>
</section>
  
@stop

@section('content')
<section class="">
    
    <ul class="timeline">
        <li class="time-label">
            <span class="bg-red">
                {{ $anoatual}}
            </span>
        </li>
    @forelse ($historias as $h)
    @if ($anoatual < $h['ano'])
    <li class="time-label">
        <span class="bg-red">
           {{ $anoatual = $h['ano']}}
        </span>
    </li>
    @endif

    <li>
        <i class="fa fa-calendar bg-blue"></i>
        <div class="timeline-item">   
            <h3 class="timeline-header">{{$h['titulo']}}</h3>        
            <div class="timeline-body">
                {{$h['conteudo']}}
            </div>
            <div class="timeline-footer">
                <small class="text-muted"><i class="fa fa-calendar"></i> {{data_br($h['data'])}}</small>
                @if ($h['rodape']) {{$h['rodape']}} @endif
                @if(session('is_admin'))
                <span>
                    <a class="btn btn-primary btn-xs" onclick="openModal('m-{{$h['id_historia']}}')">Editar</a>
                    <a class="btn btn-danger btn-xs" onclick="apagarHistoria({{$h['id_historia']}})">Apagar</a>
                </span> 
                @endif
            </div>
        </div>
    </li>
    {{-- modal editar --}}
    @if(session('is_admin'))
    @include('historia.edit')
    @endif
    @empty
    <li>Não há histórias</li> 
    @endforelse
    </ul>
</section> 

{{-- Formulário no modal --}}
@if(session('is_admin'))
@include('historia.create')
@endif
{{-- /Formulário no modal --}}
@stop

@section('js')
<script>
//$(document).ready(function($){
function openModal(id) 
{
    $('#'+id).modal('show');
}
function apagarHistoria(id)
{
    //endereço do servidor
    var url = window.location.origin;
    //token
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url+"/siscoger/historia/"+id+"/remover",
        data: {
        _token: _token,
        'id': id
        },
        success: function(){
            alert('Apagado');
            window.location.href = url+"/siscoger/historia/";
        }
    });      
}
//});
</script>
@stop

