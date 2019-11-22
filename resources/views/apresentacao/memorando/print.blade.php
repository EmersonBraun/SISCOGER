<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {
            margin: 0px;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            line-height: 1.4 !important;
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            background-color: white;
        }
        p {
            text-indent: 50px;
            text-align: justify;
        }
        .a4 {
        /* width: 100%;
        height: 100%; */
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
        .container {
            display: inline-block;
            padding: 0 !important;
            overflow: auto;
            width: 100%;
            /* border: 1px solid red; */
        }
        .container:after {
            content: "";
            display: table;
            clear: both;
        }
        .cert {
            margin: 480px 57px 25px 85px; 
            font-size:8px;
        }
        .left, .right {
            display: inline-block;
            width: 45%; 
            margin:5px; 
            padding: 0 !important;
            /* border: 1px solid red; */
        }
        .right {
            float:right;
        }
        .left {
            float:left;
        }
        .border-l {
            padding: 0 !important;
            margin: 0 !important;
            border-left: 1px solid black;
        }
        .border {
            padding: 0 !important;
            margin: 0 !important;
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
            padding: 0;
        }
        .row {
            display: block;
        }
        .col-xs-12 {
            width: 100%;
            padding: 10px 15px 0 15px;
        }
        .nopadding {
            padding: 0 !important;
        }
        </style>
    <title>Memorando</title>
</head>
<body> 
<section>
    <div class="a4"> 
        <div class="header">
            <div class="text-bold-g">ESTADO DO PARANÁ</div>
            <div class="text-bold-g">POLÍCIA MILITAR</div>
            @if($registro['opm_intermediaria'])
                <div class="text-bold-m">{{ $registro['opm_intermediaria'] }}</div>
            @endif
            <div class="text-bold-m">{{ $registro['pessoa_unidade_lotacao_descricao'] }}</div>
        </div>
        <div class="content-mem">
            <div class="container">
                <div class="left text-bold-m nopadding">Memorando nº {{ $registro['sjd_ref'] }}/{{$registro['sigla']}}</div>
                <div class="right text-bold-m text-right nopadding">Em {{$registro['data_ico']['dia']}} de {{$registro['data_ico']['mes_abr']}} de {{$registro['data_ico']['ano']}}.</div>
            </div>
            <div class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ $registro['pm']['cargo_ico'] }} {{ $registro['pm']['quadro_ico'] }} {{ $registro['pm']['nome_ico'] }}</div>
            <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
            <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ $registro['documento_de_origem'] }}.</div>
            <p>
                Com fundamento no artigo 288,§ 3º do CPPM, 
                determino o comparecimento de {{ $registro['pm']['tratamento_ico'] }} em data de 
                {{$registro['comparecimento_data_ico']['dia']}} 
                {{$registro['comparecimento_data_ico']['mes']}}. 
                {{$registro['comparecimento_data_ico']['ano_abr']}}, 
                às {{$registro['comparecimento_hora_ico']}}, 
                no(a) {{$registro['comparecimento_local_txt']}}, a fim de prestar depoimento em autos n°
                {{$registro['autos_numero']}} na condição de {{$registro['condicao']}}.
            </p>
            <div v-if="$registro['acusados">Acusado(s): {{$registro['acusados']}}</div>
        </div>
        <div class="ass">
            <div>{{$registro['autoridade_nome']}},</div>
            <div class="text-bold-m">{{$registro['autoridadefuncao']}}</div>
        </div>
        <div class="cert container" >
            <div class="left">
                <table class="table-mem border">
                    <tr>
                        <td colspan="2" class="text-bold-s center">USO DO SJD ({{$registro['cod_notificacao']['base']}}/{{$registro['data_ico']['ano']}})</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Notificado:</td>
                        <td>{{$registro['cod_notificacao']['notificado']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Não notificado:</td>
                        <td>{{$registro['cod_notificacao']['naonotificado']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Realizada:</td>
                        <td>{{$registro['cod_notificacao']['realizada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Cancelada:</td>
                        <td>{{$registro['cod_notificacao']['cancelada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Redesignada:</td>
                        <td>{{$registro['cod_notificacao']['redesignada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Não compareceu:</td>
                        <td>{{$registro['cod_notificacao']['naocompareceu']}}</td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <table class="table-mem border" style="height: 108px">
                    <tr>
                        <td colspan="2" class="text-bold-s center" style="height: 12px;">CIENTE</td>
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
    <div class="a4" v-for="(via, index) in vias" :key="index"> 
        <div class="header">
            <div class="text-bold-g">ESTADO DO PARANÁ</div>
            <div class="text-bold-g">POLÍCIA MILITAR</div>
            @if($registro['opm_intermediaria'])
                <div class="text-bold-m">{{ $registro['opm_intermediaria'] }}</div>
            @endif
            <div class="text-bold-m">{{ $registro['pessoa_unidade_lotacao_descricao'] }}</div>
        </div>
        <div class="content-mem">
            <div class="container">
                <div class="left text-bold-m nopadding">Memorando nº {{ $registro['sjd_ref'] }}/{{$registro['sigla']}}</div>
                <div class="right text-bold-m text-right nopadding">Em {{$registro['data_ico']['dia']}} de {{$registro['data_ico']['mes_abr']}} de {{$registro['data_ico']['ano']}}.</div>
            </div>
            <div class="col-xs-12 text-bold-m nopadding" style="padding-top: 10px !important;">Ao {{ $registro['pm']['cargo_ico'] }} {{ $registro['pm']['quadro_ico'] }} {{ $registro['pm']['nome_ico'] }}</div>
            <div class="col-xs-12 nopadding" style="padding-bottom: 10px !important;"><span class="text-bold-m">Assunto:</span>  Determinação para comparecimento.</div>
            <div class="col-xs-12 nopadding" style="padding-bottom: 25px !important;"><span class="text-bold-m">Referência:</span>  {{ $registro['documento_de_origem'] }}.</div>
            <p>
                Com fundamento no artigo 288,§ 3º do CPPM, 
                determino o comparecimento de {{ $registro['pm']['tratamento_ico'] }} em data de 
                {{$registro['comparecimento_data_ico']['dia']}} 
                {{$registro['comparecimento_data_ico']['mes']}}. 
                {{$registro['comparecimento_data_ico']['ano_abr']}}, 
                às {{$registro['comparecimento_hora_ico']}}, 
                no(a) {{$registro['comparecimento_local_txt']}}, a fim de prestar depoimento em autos n°
                {{$registro['autos_numero']}} na condição de {{$registro['condicao']}}.
            </p>
            <div v-if="$registro['acusados">Acusado(s): {{$registro['acusados']}}</div>
        </div>
        <div class="ass">
            <div>{{$registro['autoridade_nome']}},</div>
            <div class="text-bold-m">{{$registro['autoridadefuncao']}}</div>
        </div>
        <div class="cert container" >
            <div class="left">
                <table class="table-mem border">
                    <tr>
                        <td colspan="2" class="text-bold-s center">USO DO SJD ({{$registro['cod_notificacao']['base']}}/{{$registro['data_ico']['ano']}})</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Notificado:</td>
                        <td>{{$registro['cod_notificacao']['notificado']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Não notificado:</td>
                        <td>{{$registro['cod_notificacao']['naonotificado']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Realizada:</td>
                        <td>{{$registro['cod_notificacao']['realizada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Cancelada:</td>
                        <td>{{$registro['cod_notificacao']['cancelada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Compareceu/Redesignada:</td>
                        <td>{{$registro['cod_notificacao']['redesignada']}}</td>
                    </tr>
                    <tr>
                        <td class="text-bold-s">Não compareceu:</td>
                        <td>{{$registro['cod_notificacao']['naocompareceu']}}</td>
                    </tr>
                </table>
            </div>
            <div class="right">
                <table class="table-mem border"  style="height: 108px">
                    <tr>
                        <td colspan="2" class="border text-bold-m" style="text-align: justify;">
                            ** Esta via deve ser carimbada no local da audiência e ser entregue no SJD após a apresentação do Militar Estadual
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>


