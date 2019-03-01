@extends('adminlte::page')

@section('title_postfix', '| Dasboard')

@section('content_header')
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
        @if($nome_unidade != '')OPM/OBM:  {{$nome_unidade}} @endif
    <ol class="breadcrumb">
    <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
@stop

@section('content')
<section class="content nopadding">
    <div class="row"><!-- ***********Info box FATD*********** -->

        <div class="col-lg-3 col-md-3 col-xs-6">
            {{-- <br-infobox title="FATD" bg="aqua" icon="balance-scale" value="{{$fatd_total}}" route="#" text="Mais Informações">
            </br-infobox> --}}
            @component('components.infobox',
            [
                'title' => 'FATD',
                'bg' => 'aqua',
                'icon' => 'balance-scale',
                'value' => $fatd_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ])   
            @endcomponent
        </div>
        <!-- \Info box FATD -->
    
        <!-- .Info box IPM -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            @component('components.infobox',
            [
                'title' => 'IPM',
                'bg' => 'green',
                'icon' => 'institution',
                'value' => $ipm_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ])   
            @endcomponent
        </div>
        <!-- ./Info box IPM -->
    
        <!-- Info box IPM Sindicância -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            @component('components.infobox',
            [
                'title' => 'Sindicância',
                'bg' => 'yellow',
                'icon' => 'search',
                'value' => $sindicancia_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ])   
            @endcomponent
        </div>
        <!-- .Info box IPM Sindicância -->
    
        <!-- ./Info box IPM CD -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            @component('components.infobox',
            [
                'title' => 'CD',
                'bg' => 'red',
                'icon' => 'gavel',
                'value' => $cd_total,
                'route' => '#',
                'text' => 'Mais Informações'
            ])   
            @endcomponent
        </div><!-- *********./Info box IPM CD******** -->
    
    </div><!-- /Info boxes -->

    <div class="row">
        @component('components.comp.boxcolapse',['titulo' => 'Transferências', 'qtd' => $ttransferidos])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Nome</th>
                    <th>OPM Origem</th>
                    <th>OPM Destino</th>
                </tr>
            </thead>
            <tbody>

            @forelse($transferidos as $transferido) 
            {{-- @if($transferido['opmorigem'] == $unidade || $transferido['opmdestino'] == $unidade) --}}
            <tr>
                <td>{{$transferido['rg']}}</td>
                <td>{{special_ucwords($transferido['nome'])}}</td>
                <td>{{opm($transferido['opmorigem'])}}</td>
                <td>{{opm($transferido['opmdestino'])}}</td>
            </tr>
            {{-- @endif --}}
            @empty
            <tr>
                <td colspan='3'>Nenhuma Transferência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'Comportamento', 'qtd' => ''])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>RG</th>
                    <th>Comportamento</th>
                    <th>Tempo</th>
                </tr>
            </thead>
            @forelse($comportamentos as $comportamento)
            
                @if(
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] >= 1 &&
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo'] <= 2 || 
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] >= 2 &&
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo'] <= 3 || 
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] >= 5 &&
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo'] <= 6 || 
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] >= 4 &&
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo'] <= 5
                    )
                    <tr>
                        <td><a href="{{route('fdi.show',$comportamento['rg'])}}" target="_blanck">
                            {{$comportamento['rg']}}
                            </a></td>
                        <td><span 
                        @switch($comportamento['comportamento'])
                            @case('Mau')
                                class='label label-error'
                                @break
                            @case('Insuficiente')
                                class='label label-danger'
                                @break
                            @case('Bom')
                                class='label label-default'
                                @break
                            @case('Ótimo')
                                class='label label-info'
                                @break
                            @case('Excepcional')
                                class='label label-success'
                                @break
                            @default
                                class='label label-default'
                        @endswitch
                        
                        >{{$comportamento['comportamento']}}</span></td>
                        <td><span class='label label-success'>{{$comportamento['tempo']}}</span></td>
                    </tr>
                @endif
                @empty
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'FATD - DATA DE ABERTURA', 'qtd' => $tfatd_aberturas])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($fatd_aberturas as $fatd_abertura)
            
            <tr>
                <td><a href="{{route('fatd.edit',['ref' =>$fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])}}" target="_blank">{{$fatd_abertura['sjd_ref']}}/{{$fatd_abertura['sjd_ref_ano']}}</a></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'FATD - PRAZOS', 'qtd' => $tfatd_prazos])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($fatd_prazos as $fatd_prazo)
            
            <tr>
                <td><a href="{{route('fatd.edit',['ref' =>$fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])}}" target="_blank">{{$fatd_prazo['sjd_ref']}}/{{$fatd_prazo['sjd_ref_ano']}}</a> </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'FATD - PUNIÇÃO', 'qtd' => $tfatd_punidos])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Posto/grad.</th>
                    <th>Nome</th>
                    <th>Fatd ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($fatd_punidos as $fatd_punido)
            <tr>
                <td>{{$fatd_punido['cargo']}}</td>
                <td>{{special_ucwords($fatd_punido['nome'])}}</td>
                <td><a href="{{route('fatd.edit',['ref' =>$fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])}}" target="_blank">{{$fatd_punido['sjd_ref']}}/{{$fatd_punido['sjd_ref_ano']}}</a></td>
                <td><span class='label label-danger'>punição não foi cadastrada.</span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'IPM - DATA DE INSTAURAÇÃO', 'qtd' => $tipm_aberturas])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>IPM ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($ipm_aberturas as $ipm_abertura)
            
            <tr>
                <td><a href="{{route('ipm.edit',['ref' =>$ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])}}" target="_blank">{{$ipm_abertura['sjd_ref']}}/{{$ipm_abertura['sjd_ref_ano']}}</a></td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'IPM - PRAZOS', 'qtd' => $tipm_prazos])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>IPM ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($ipm_prazos as $ipm_prazo)
            
            <tr>
                <td><a href="{{route('ipm.edit',['ref' =>$ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])}}" target="_blank">
                    {{$ipm_prazo['sjd_ref']}}/{{$ipm_prazo['sjd_ref_ano']}}</a>
                </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - DATA DE ABERTURA', 'qtd' => $tsindicancia_aberturas])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($sindicancia_aberturas as $sindicancia_abertura)
            
            <tr>
                <td>
                    <a href="{{route('sindicancia.edit',['ref' =>$sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])}}" target="_blank">
                        {{$sindicancia_abertura['sjd_ref']}}/{{$sindicancia_abertura['sjd_ref_ano']}}
                    </a>
                </td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - PRAZOS', 'qtd' => $tsindicancia_prazos])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($sindicancia_prazos as $sindicancia_prazo)
            
            <tr>
                <td>
                    <a href="{{route('sindicancia.edit',['ref' =>$sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])}}" target="_blank">
                        {{$sindicancia_prazo['sjd_ref']}}/{{$sindicancia_prazo['sjd_ref_ano']}}
                    </a>
                </td>
                <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA ABERTURA', 'qtd' => $tsindicancia_aberturas])
        <table class="table no-margin">
            <thead>
                <tr>
                    <th>Sindicância ref/ano</th>
                    <th>Situação</th>
                </tr>
            </thead>
            @forelse($sindicancia_aberturas as $sindicancia_abertura)
            
            <tr>
                <td>
                    <a href="{{route('sindicancia.edit',['ref' =>$sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])}}" target="_blank">
                        {{$sindicancia_abertura['sjd_ref']}}/{{$sindicancia_abertura['sjd_ref_ano']}}
                    </a>
                </td>
                <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
            </tr>
            @empty
            <tr>
                <td colspan='3'>Nenhuma Pendência</td> 
            </tr>
            @endforelse
            </tbody>
        </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - DATA DE ABERTURA', 'qtd' => $tcd_aberturas])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                @forelse($cd_aberturas as $cd_abertura)
                
                <tr>
                    <td>
                        <a href="{{route('cd.edit',['ref' =>$cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])}}" target="_blank">
                            {{$cd_abertura['sjd_ref']}}/{{$cd_abertura['sjd_ref_ano']}}
                        </a>
                    </td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                </tr>
                @empty
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                @endforelse
                </tbody>
            </table>
        @endcomponent

        @component('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - PRAZOS', 'qtd' => $tcd_prazos])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                @forelse($cd_prazos as $cd_prazo)
                
                <tr>
                    <td>
                        <a href="{{route('cd.edit',['ref' =>$cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])}}" target="_blank">
                            {{$cd_prazo['sjd_ref']}}/{{$cd_prazo['sjd_ref_ano']}}
                        </a>
                    </td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                </tr>
                @empty
                <tr>
                    <td colspan='3'>Nenhuma Pendência</td> 
                </tr>
                @endforelse
                </tbody>
            </table>
        @endcomponent
            
    </div>
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Efetivo OPM/OBM</h3>
            </div>
            <div class="box-body" style="width:75%;">
                @include('vendor.adminlte.includes.graficos')
                {!! $efetivo_chartjs->render() !!}
                <div class="d-flex flex-row">
                    <div class="p-6"><strong>Total efetivo: {{$total_efetivo->qtd}}</strong></div>
                    <div class="p-6">Fonte: RHPARANA - data {{date('d/m/Y')}}</div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
    
    <div class="row"><!-- *************.Gráficos********************* -->
        <div class="col-md-12 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Quantitativo procedimetos por ano</h3>
            </div>
            <div class="box-body" style="width:75%;">
                @include('vendor.adminlte.includes.graficos')
                {!! $chartjs->render() !!}
                <div class="d-flex flex-row">
                    <div class="p-6">Fonte: Banco de dados SISCOGER - data {{date('d/m/Y')}}</div>       
                <div>         
            </div>
        </div>
    </div>
    </div>
</section>

@stop

@section('js')
   
@stop