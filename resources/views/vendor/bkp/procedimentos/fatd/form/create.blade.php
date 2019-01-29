@extends('adminlte::page')

@section('title', 'fatd - Criar')

@section('content_header')
<section class="content-header">   
  <h1>FATD - Criar</h1>
  <ol class="breadcrumb">
  <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
  <li><a href="{{route('fatd.lista',['ano' => date('Y')])}}">Fatd - Lista</a></li>
  <li class="active">FATD - Criar</li>
  </ol>
</section>
  
@stop

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
<section class="">
    <div class="row">

        <div class="col-xs-12">

        <div class="box">{{-- formulário principal --}}
            <div class="box-header">
                {{-- sjd_ref / sjd_ref_ano --}}
                <h4 class="box-title">N° * / {{date('Y')}} - Formulário principal</h4>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

            {!! Form::open(['url' => route('fatd.store')]) !!}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('prioritario', 'Processo prioritário') !!}
            {!! Form::checkbox('prioritario', '1') !!}
            </div>

            {{-- linha --}}
            <div class='col-md-6 col-xs-12'>
            {!! Form::label('id_andamento', 'Andamento')!!} <br>
            {!! Form::select('id_andamento', config('sistema.andamentoFATD')) !!}
            @if ($errors->has('id_andamento'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_andamento') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-6 col-xs-12'>
            {!! Form::label('andamentocoger', 'Andamento COGER')!!} <br>
            {!! Form::select('id_andamentocoger', config('sistema.andamentocogerFATD')) !!}
            @if ($errors->has('id_andamentocoger'))
                <span class="help-block">
                    <strong>{{ $errors->first('id_andamentocoger') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_origem_txt', 'Documentos de origem: ')!!} <br>
            {!! Form::text('doc_origem_txt') !!}
            @if ($errors->has('doc_origem_txt'))
                <span class="help-block">
                    <strong>{{ $errors->first('doc_origem_txt') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('fato_data', 'Data do fato: ')!!} <br>
            {!! Form::text('fato_data','' ,['class' => 'datepicker']) !!}
            @if ($errors->has('fato_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('fato_data') }}</strong>
                </span>
            @endif              
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('cdopm', 'OPM')!!} <br>
            @include('vendor.adminlte.form.opm_select_no')
            @if ($errors->has('cdopm'))
                <span class="help-block">
                    <strong>{{ $errors->first('cdopm') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-8 col-xs-12'>
            {!! Form::label('motivo_fatd', 'Motivo FATD')!!} <br>
            {!! Form::select('motivo_fatd', config('sistema.motivoFATD'),'', ['class' => 'select2', 'id' => 'descricao']) !!}
            @if ($errors->has('motivo_fatd'))
                <span class="help-block">
                    <strong>{{ $errors->first('motivo_fatd') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12' class='descricao_outros'>
            {!! Form::label('motivo_outros', 'Motivo Outros' )!!} <br>
            {!! Form::text('motivo_outros','') !!}
            @if ($errors->has('motivo_outros'))
                <span class="help-block">
                    <strong>{{ $errors->first('motivo_outros') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            {!! Form::label('situacao_fatd', 'Situação')!!} <br>
            {!! Form::select('situacao_fatd', config('sistema.situacaoOCOR')) !!}
            @if ($errors->has('situacao_fatd'))
                <span class="help-block">
                    <strong>{{ $errors->first('situacao_fatd') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_tipo', 'Tipo de boletim')!!} <br>
            {!! Form::select('doc_tipo', config('sistema.tipoBoletim')) !!}
            @if ($errors->has('doc_tipo'))
                <span class="help-block">
                    <strong>{{ $errors->first('doc_tipo') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12'>
            {!! Form::label('doc_numero', 'N° Boletim')!!} <br>
            {!! Form::text('doc_numero', '') !!}
            @if ($errors->has('doc_numero'))
                <span class="help-block">
                    <strong>{{ $errors->first('doc_numero') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-12 col-xs-12'>
            {!! Form::label('sintese_txt', 'Síntese do fato')!!} <br>
            {!! Form::textarea('sintese_txt','',['class' => 'form-control', 'rows' => '5']) !!}
            @if ($errors->has('sintese_txt'))
                <span class="help-block">
                    <strong>{{ $errors->first('sintese_txt') }}</strong>
                </span>
            @endif
            </div>

            {{-- linha --}}
            <div class='col-md-4 col-xs-12'>
            <small>{!! Form::label('despacho_numero', 'Nº do despacho que designa o Encarregado : ')!!}</small> <br>
            {!! Form::text('despacho_numero','',['class' => 'despacho','placeholder' => '12345/2000'] ) !!}
            @if ($errors->has('despacho_numero'))
                <span class="help-block">
                    <strong>{{ $errors->first('despacho_numero') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('portaria_data', 'Data do despacho: ')!!} <br>
            {!! Form::text('portaria_data','' ,['class' => 'datepicker']) !!} 
            @if ($errors->has('portaria_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('portaria_data') }}</strong>
                </span>
            @endif
            </div>

            <div class='col-md-4 col-xs-12'>
            <i class="fa fa-calendar"></i> {!! Form::label('abertura_data', 'Data do despacho: ')!!} <br>
            {!! Form::text('abertura_data','' ,['class' => 'datepicker']) !!} 
            @if ($errors->has('abertura_data'))
                <span class="help-block">
                    <strong>{{ $errors->first('abertura_data') }}</strong>
                </span>
            @endif
            </div>

            <div class="col-md-12" id="ligacaoForm">
                    <input class="noprint" value="Adicionar" type="button" onclick="addObjectForm('ligacao','fatd');">
            </div>
            <div class='col-md-12 col-xs-12'>
            <br>
            {!! Form::submit('Inserir FATD',['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}
            </div>
        </div>
    </div>
   
    {{-- <div class="box">
        <div class="box-header">
            
            <h4 class="box-title">Acusado</h4>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-plus"></i>
                </button> 
            </div>             
        </div>
    
        <div class="box-body">
    
        <div class='col-md-12 col-xs-12'>
    
            <table>
                <thead>
                    <tr>
                        <td class="col-md-3">RG</td>
                        <td class="col-md-3">Nome</td>
                        <td class="col-md-3">Posto/Graduação</td>
                        <td class="col-md-2">Situação</td>
                        <td class="col-md-1">Ações</td>
                    </tr>
                </thead>
                <tbody class="tr_colection">
                    <tr class="tr_clone">
                        <td class="0">{!! Form::text('rg','',['onblur' => "completaDados($(this).val(),'nome','posto','#',$(this).parent().attr('class'))"]) !!}</td>
                        <td class="0">{!! Form::text('nome','',['readonly','id' => 'nome']) !!}</td>
                        <td class="0">{!! Form::text('posto','',['readonly','id' => 'posto']) !!}</td>
                        <td class="0"> {!! Form::select('resultado',config('sistema.envolvidoFatd'),'') !!}</td>
                        <td class="0">
                            <div class="btn-group">
                                <a class="btn btn-primary" href="#">
                                    <i class="fa fa-fw fa-floppy-o"></i>
                                </a>  
                                <a class="btn btn-danger" 
                                href="#"
                                onclick="removeLinha(
                                    $(this).parents('td').attr('class'))">
                                    <i class="fa fa-fw fa-trash "></i>
                                </a>
                            </div>
                            <br>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <button id="addRow"><i class="fa fa-plus">Adicionar</i></button>
                </tfoot>
            </table> 
    
        </div>
        </div>
    </div>  --}}

    </div>{{-- procedimento principal --}}
  
</section>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
  @include('vendor.adminlte.includes.pickers')
  @include('vendor.adminlte.includes.select2')
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>

$("#descricao").on('load, change',function ()
{
    var campo = $("#descricao").val();
    console.log(campo);
    if (campo == 'Outro') 
    {
        $(".descricao_outros").show();
    }
    else
    {
        $(".descricao_outros").hide();
    }
});


 $(document).ready(function() {
    function addEnvolvido($titulo, $indice, $proc) {
        $titulo = 'Acusado';
        $indice = $('#view').children().last().attr('class');
        $.post(){
            success: function(response){
                $('#view').children().last().html(response);
            }
        }
    }  

//     $("#addRow").on('click', function() {
//         //base
//         var $tr = $('.tr_clone');
//         var cont = $tr.children().last().attr('class');
//         cont++;  

//         var $clone = $tr.clone().removeClass('tr_clone').addClass(cont);
//         $clone.find(':text').val('');
//         $('.tr_clone td').attr('class',cont);
//         $('.tr_colection').children().last().before($clone);
    
//     });

} );

// function removeLinha(classe){
//     if(classe > 0){
//         $('.'+classe).closest("tr").remove();
//     }
//     //return false;
// }

</script>
@stop

