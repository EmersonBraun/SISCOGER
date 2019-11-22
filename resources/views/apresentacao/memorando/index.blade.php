@extends('adminlte::page')

@section('title', 'apresentacao')

@section('content_header')
@stop

@section('content')
<div class="a4 col-xs-6"> 
    <div class="header">
        <div class="text-bold-g">ESTADO DO PARANÁ</div>
        <div class="text-bold-g">POLÍCIA MILITAR</div>
        @if($registro->opm_intermediaria)
            <div class="text-bold-m">{{ $registro->opm_intermediaria }}</div>
        @endif
        <div class="text-bold-m">{{ $registro->pessoa_unidade_lotacao_descricao }}</div>
    </div>
    <div class="content-mem">
        <div class="col-xs-6 text-bold-m nopadding">Memorando nº {{ $registro->sjd_ref }}/{{$registro->sigla}}</div>
        <div class="col-xs-6 text-bold-m text-right nopadding">Em {{$registro->data_ico->dia}} de {{$registro->data_ico->mes_abr}} de {{$registro->data_ico->ano}}.</div>
        <div class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ $registro->pm->cargo_ico }} {{ $registro->pm->quadro_ico }} {{ $registro->pm->nome_ico }}</div>
        <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
        <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ $registro->documento_de_origem }}.</div>
        <p>
            Com fundamento no artigo 288,§ 3º do CPPM, 
            determino o comparecimento de {{ $registro->pm->tratamento_ico }} em data de 
            {{$registro->comparecimento_data_ico->dia}} 
            {{$registro->comparecimento_data_ico->mes}}. 
            {{$registro->comparecimento_data_ico->ano_abr}}, 
            às {{$registro->comparecimento_hora_ico}}, 
            no(a) {{$registro->comparecimento_local_txt}}, a fim de prestar depoimento em autos n°
            {{$registro->autos_numero}} na condição de {{$registro->condicao}}.
        </p>
        <div v-if="$registro->acusados">Acusado(s): {{$registro->acusados}}</div>
    </div>
    <div class="ass">
        <div>{{$registro->autoridade->nome}},</div>
        <div class="text-bold-m">{{$registro->autoridade->funcao}}</div>
    </div>
    <div class="row cert" >
        <div class="col-xs-6">
            <table class="table-mem border">
                <tr>
                    <td colspan="2" class="border text-bold-s center">USO DO SJD ({{$registro->cod_notificacao->base}}/{{$registro->data_ico->ano}})</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Notificado:</td>
                    <td class="border-l">{{$registro->cod_notificacao->notificado}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Não notificado:</td>
                    <td class="border-l">{{$registro->cod_notificacao->naonotificado}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Realizada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->realizada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Cancelada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->cancelada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Redesignada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->redesignada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Não compareceu:</td>
                    <td class="border-l">{{$registro->cod_notificacao->naocompareceu}}</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <table class="table-mem border">
                <tr>
                    <td colspan="2" class="border text-bold-s center" style="height: 12px;">CIENTE</td>
                </tr>
                <tr>
                    <td><span class="text-bold-s">Data:</span>  ______/______/__________</td>
                </tr>
                <tr>
                    <td><span class="text-bold-s">Horário:</span>  ______:______</td>
                </tr>
                <tr>
                    <td><span class="text-bold-s">Ass.:</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div style="page-break-before: always;"></div>
{{-- segunda via --}}
<div class="a4 col-xs-6" v-for="(via, index) in vias" :key="index"> 
    <div class="header">
        <div class="text-bold-g">ESTADO DO PARANÁ</div>
        <div class="text-bold-g">POLÍCIA MILITAR</div>
        @if($registro->opm_intermediaria)
            <div class="text-bold-m">{{ $registro->opm_intermediaria }}</div>
        @endif
        <div class="text-bold-m">{{ $registro->pessoa_unidade_lotacao_descricao }}</div>
    </div>
    <div class="content-mem">
        <div class="col-xs-6 text-bold-m nopadding">Memorando nº {{ $registro->sjd_ref }}/{{$registro->sigla}}</div>
        <div class="col-xs-6 text-bold-m text-right nopadding">Em {{$registro->data_ico->dia}} de {{$registro->data_ico->mes_abr}} de {{$registro->data_ico->ano}}.</div>
        <div class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ $registro->pm->cargo_ico }} {{ $registro->pm->quadro_ico }} {{ $registro->pm->nome_ico }}</div>
        <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
        <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ $registro->documento_de_origem }}.</div>
        <p>
            Com fundamento no artigo 288,§ 3º do CPPM, 
            determino o comparecimento de {{ $registro->pm->tratamento_ico }} em data de 
            {{$registro->comparecimento_data_ico->dia}} 
            {{$registro->comparecimento_data_ico->mes}}. 
            {{$registro->comparecimento_data_ico->ano_abr}}, 
            às {{$registro->comparecimento_hora_ico}}, 
            no(a) {{$registro->comparecimento_local_txt}}, a fim de prestar depoimento em autos n°
            {{$registro->autos_numero}} na condição de {{$registro->condicao}}.
        </p>
        <div v-if="$registro->acusados">Acusado(s): {{$registro->acusados}}</div>
    </div>
    <div class="ass">
        <div>{{$registro->autoridade->nome}},</div>
        <div class="text-bold-m">{{$registro->autoridade->funcao}}</div>
    </div>
    <div class="row cert" >
        <div class="col-xs-6">
            <table class="table-mem border">
                <tr>
                    <td colspan="2" class="border text-bold-s center">USO DO SJD ({{$registro->cod_notificacao->base}}/{{$registro->data_ico->ano}})</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Notificado:</td>
                    <td class="border-l">{{$registro->cod_notificacao->notificado}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Não notificado:</td>
                    <td class="border-l">{{$registro->cod_notificacao->naonotificado}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Realizada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->realizada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Cancelada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->cancelada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Compareceu/Redesignada:</td>
                    <td class="border-l">{{$registro->cod_notificacao->redesignada}}</td>
                </tr>
                <tr>
                    <td class="border text-bold-s">Não compareceu:</td>
                    <td class="border-l">{{$registro->cod_notificacao->naocompareceu}}</td>
                </tr>
            </table>
        </div>
        <div class="col-xs-6">
            <table class="table-mem border">
                <tr>
                    <td colspan="2" class="border text-bold-m" style="text-align: justify;">
                        ** Esta via deve ser carimbada no local da audiência e ser entregue no SJD após a apresentação do Militar Estadual
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
   @media print {
        #printpage {
            background-color: white;
            height: 100%;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            margin: 0;
        }
    }
    .body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 12px;
        line-height: 1 !important;
        background-color: #f1f1f1;
    }
    p {
        text-indent: 50px;
        text-align: justify;
    }
    .a4 {
        display: flex;
        flex-direction: column;
        width: 595px;
        height: 841px;
        padding: 20px;
    }
    .header {
        margin: 82.8px 57px 10px 85px;
        text-align: center;
        padding-bottom: 10px;
        border-bottom: 1px solid black;
    }
    .text-bold-g{
        font-size:14px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .text-bold-m{
        font-size:12px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .text-bold-s{
        font-size:8px;
        font-weight:bold;
        font-style:normal;
        text-decoration: none;
    }
    .content-mem {
        margin: 10px 57px 10px 85px !important;
        padding: 0 !important;
    }
    .ass {
        margin-top: 50px;
        text-align: center;  
    }
    .cert {
        display: flex;
        align-items: flex-end !important;
        margin: auto 57px 25px 85px; 
        font-size:8px;
    }
    .border-l {
        border-left: 1px solid black;
    }
    .border {
        border: 1px solid black;
    }
    .center {
        text-align: center;
    }
    .table-mem  {
        width: 100%;
        height: 90px;
        text-align: left;
        text-indent: 5px;
        padding: 0 10px 0 10px;
    }
</style>
@stop

@section('js')
@stop