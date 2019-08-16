@extends('adminlte::page')

@section('title_postfix', '| Dasboard')

@section('content_header')
<section class="content-header nopadding">
    <h1>Dashboard<small>- Pendências</small></h1>
    @if($nome_unidade != '')OPM/OBM: {{$nome_unidade}} @endif
    <ol class="breadcrumb">
        <li><i class="fa fa-dashboard"></i> Home</li>
    </ol>
</section>
@stop

@section('content')
<section class="content nopadding">
    
    <div class="row"><!-- Info box -->
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='FATD' icon='balance-scale' :value='{{$totais_proc['fatd'] ?? 0}}' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='IPM' icon='institution' bg='green' :value='{{$totais_proc['ipm'] ?? 0}}' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='Sindicância' icon='search' bg="yellow" :value='{{$totais_proc['sindicancia'] ?? 0}}' ></v-info-box>
        </div>
        <div class="col-lg-3 col-md-3 col-xs-6">
            <v-info-box title='CD' icon='gavel' bg='red' :value='{{$totais_proc['cd'] ?? 0}}' ></v-info-box>
        </div>
    </div><!-- /Info boxes -->
    <div class="row"><!-- Info box -->
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'Transferências', 'qtd' => count($pendencias['transferidos']) ])
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

                    @forelse($pendencias['transferidos'] as $transferido)
                    <tr>
                        <td><a href="{{route('fdi.show',$transferido['rg'])}}" target="_blanck">{{$transferido['rg']}}</a></td>
                        <td>{{special_ucwords($transferido['nome'])}}</td>
                        <td>{{opm($transferido['opmorigem'])}}</td>
                        <td>{{opm($transferido['opmdestino'])}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan='3'>Nenhuma Transferência</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            @endcomponent
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'Comportamento', 'qtd' => $totais['comportamento']])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>RG</th>
                        <th>Comportamento</th>
                        <th>Tempo</th>
                        <th>OPM</th>
                    </tr>
                </thead>
                @forelse($pendencias['comportamentos'] as $comportamento)
                    @if(
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo_em_anos'] >= 1 &&
                    $comportamento['comportamento'] == 'Mau' && $comportamento['tempo_em_anos'] <= 2 ||
                    $comportamento['comportamento']=='Insuficiente' && $comportamento['tempo_em_anos']>= 2 &&
                    $comportamento['comportamento'] == 'Insuficiente' && $comportamento['tempo_em_anos'] <= 3 ||
                    $comportamento['comportamento']=='Bom' && $comportamento['tempo_em_anos']>= 5 &&
                    $comportamento['comportamento'] == 'Bom' && $comportamento['tempo_em_anos'] <= 6 ||
                    $comportamento['comportamento']=='Ótimo' && $comportamento['tempo_em_anos']>= 4 &&
                    $comportamento['comportamento'] == 'Ótimo' && $comportamento['tempo_em_anos'] <= 5 ) 
                    <tr>
                        <td>
                            <a href="{{route('fdi.show',$comportamento['rg'])}}" target="_blanck">
                                {{$comportamento['rg']}}
                            </a>
                        </td>
                        <td>
                            <span @switch($comportamento['comportamento']) @case('Mau') class='label label-error'
                                @break @case('Insuficiente') class='label label-danger' @break @case('Bom')
                                class='label label-default' @break @case('Ótimo') class='label label-info' @break
                                @case('Excepcional') class='label label-success' @break @default
                                class='label label-default' @endswitch>{{$comportamento['comportamento']}}
                            </span>
                        </td>
                        <td>{{$comportamento['tempo_em_anos']}}</td>
                        <td>{{$comportamento['cdopm']}}</td>
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
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'FATD - DATA DE ABERTURA', 'qtd' => $totais['fatd_abertura']])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['fatd_aberturas'] as $fatd_abertura)
                    <tr>
                        <td><a>{{$fatd_abertura['sjd_ref']}}/{{$fatd_abertura['sjd_ref_ano']}}</a></td>
                        <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                        <td>
                            <span>
                                @if(hasPermissionTo('ver-fatd'))
                                <a class="btn btn-secondary" href="{{route('fatd.show',['ref' => $fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])}}" target="_black">
                                    <i class="fa fa-fw fa-eye "></i></a>
                                @endif
                                @if(hasPermissionTo('editar-fatd')) 
                                <a class="btn btn-info"
                                    href="{{route('fatd.edit',['ref' => $fatd_abertura['sjd_ref'], 'ano' => $fatd_abertura['sjd_ref_ano']])}}" target="_blanck"><i
                                        class="fa fa-fw fa-edit "></i></a>
                                @endif
                            </span>
                        </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'FATD - PRAZOS', 'qtd' => $totais['fatd_prazo'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['fatd_prazos'] as $fatd_prazo)

                <tr>
                    <td><a href="{{route('fatd.edit',['ref' =>$fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])}}"
                            target="_blank">{{$fatd_prazo['sjd_ref']}}/{{$fatd_prazo['sjd_ref_ano']}}</a> </td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-fatd'))
                            <a class="btn btn-secondary" href="{{route('fatd.show',['ref' => $fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-fatd')) 
                            <a class="btn btn-info"
                                href="{{route('fatd.edit',['ref' => $fatd_prazo['sjd_ref'], 'ano' => $fatd_prazo['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'FATD - PUNIÇÃO', 'qtd' => $totais['fatd_punicao'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Posto/grad.</th>
                        <th>Nome</th>
                        <th>Fatd ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['fatd_punidos'] as $fatd_punido)
                <tr>
                    <td>{{$fatd_punido['cargo']}}</td>
                    <td><a href="{{route('fdi.show',$fatd_punido['rg'])}}" target="_blanck">{{special_ucwords($fatd_punido['nome'])}}</a></td>
                    <td>{{$fatd_punido['sjd_ref']}}/{{$fatd_punido['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>punição não foi cadastrada.</span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-fatd'))
                            <a class="btn btn-secondary" href="{{route('fatd.show',['ref' => $fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-fatd')) 
                            <a class="btn btn-info"
                                href="{{route('fatd.edit',['ref' => $fatd_punido['sjd_ref'], 'ano' => $fatd_punido['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'IPM - DATA DE INSTAURAÇÃO', 'qtd' => $totais['ipm_abertura'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>IPM ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['ipm_aberturas'] as $ipm_abertura)

                <tr>
                    <td>{{$ipm_abertura['sjd_ref']}}/{{$ipm_abertura['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-ipm'))
                            <a class="btn btn-secondary" href="{{route('ipm.show',['ref' => $ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-ipm')) 
                            <a class="btn btn-info"
                                href="{{route('ipm.edit',['ref' => $ipm_abertura['sjd_ref'], 'ano' => $ipm_abertura['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'IPM - PRAZOS', 'qtd' => $totais['ipm_prazo'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>IPM ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['ipm_prazos'] as $ipm_prazo)

                <tr>
                    <td>{{$ipm_prazo['sjd_ref']}}/{{$ipm_prazo['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-ipm'))
                            <a class="btn btn-secondary" href="{{route('ipm.show',['ref' => $ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-ipm')) 
                            <a class="btn btn-info"
                                href="{{route('ipm.edit',['ref' => $ipm_prazo['sjd_ref'], 'ano' => $ipm_prazo['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - DATA DE ABERTURA', 'qtd' => $totais['sindicancia_abertura'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['sindicancia_aberturas'] as $sindicancia_abertura)
                <tr>
                    <td>{{$sindicancia_abertura['sjd_ref']}}/{{$sindicancia_abertura['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-sindicancia'))
                            <a class="btn btn-secondary" href="{{route('sindicancia.show',['ref' => $sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-sindicancia')) 
                            <a class="btn btn-info"
                                href="{{route('sindicancia.edit',['ref' => $sindicancia_abertura['sjd_ref'], 'ano' => $sindicancia_abertura['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'SINDICÂNCIA - PRAZOS', 'qtd' => $totais['sindicancia_prazo'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>Sindicância ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['sindicancia_prazos'] as $sindicancia_prazo)

                <tr>
                    <td>{{$sindicancia_prazo['sjd_ref']}}/{{$sindicancia_prazo['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-sindicancia'))
                            <a class="btn btn-secondary" href="{{route('sindicancia.show',['ref' => $sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-sindicancia')) 
                            <a class="btn btn-info"
                                href="{{route('sindicancia.edit',['ref' => $sindicancia_prazo['sjd_ref'], 'ano' => $sindicancia_prazo['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-6 col-md-6 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - DATA DE ABERTURA', 'qtd' => $totais['cd_abertura'] ])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['cd_aberturas'] as $cd_abertura)

                <tr>
                    <td>{{$cd_abertura['sjd_ref']}}/{{$cd_abertura['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>não tem data de abertura cadastrada. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-cd'))
                            <a class="btn btn-secondary" href="{{route('cd.show',['ref' => $cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-cd')) 
                            <a class="btn btn-info"
                                href="{{route('cd.edit',['ref' => $cd_abertura['sjd_ref'], 'ano' => $cd_abertura['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-lg-12 col-md-12 col-xs-12">
            @component('components.comp.boxcolapse',['titulo' => 'CONSELHOS DE DISCIPLINA - PRAZOS', 'qtd' => $totais['cd_prazo'], 'md' => '12', 'lg' => '12'])
            <table class="table no-margin">
                <thead>
                    <tr>
                        <th>CD ref/ano</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                @forelse($pendencias['cd_prazos'] as $cd_prazo)

                <tr>
                    <td>{{$cd_prazo['sjd_ref']}}/{{$cd_prazo['sjd_ref_ano']}}</td>
                    <td><span class='label label-danger'>está fora do prazo regulamentar. </span></td>
                    <td>
                        <span>
                            @if(hasPermissionTo('ver-cd'))
                            <a class="btn btn-secondary" href="{{route('cd.show',['ref' => $cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])}}" target="_black">
                                <i class="fa fa-fw fa-eye "></i></a>
                            @endif
                            @if(hasPermissionTo('editar-cd')) 
                            <a class="btn btn-info"
                                href="{{route('cd.edit',['ref' => $cd_prazo['sjd_ref'], 'ano' => $cd_prazo['sjd_ref_ano']])}}" target="_blanck"><i
                                    class="fa fa-fw fa-edit "></i></a>
                            @endif
                        </span>
                    </td>
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
        <div class="col-md-6 col-xs-12">
            <efetivo-chart :efetivo="{{json_encode($efetivo)}}"></efetivo-chart>
        </div>
        <div class="col-md-6 col-xs-12">
            <procedimentos-chart :procedimentos="{{json_encode($procedimentos)}}"></procedimentos-chart>
        </div>
    </div>
</section>

@stop

@section('js')
@include('vendor.adminlte.includes.vue')
@stop