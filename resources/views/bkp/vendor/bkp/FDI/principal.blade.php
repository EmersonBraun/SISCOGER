<div class="box">{{-- Dados Principais --}}
    <div class="box-header">
        <h2 class="box-title">Dados Principais</h2>       
        <div class="box-tools pull-right">

            @switch($pm->STATUS)
                @case('Ativo')
                    <i class="fa fa-circle text-success"></i>
                    @break
                @case('Inativo')
                    <i class="fa fa-circle text-warning"></i>
                    @break
                @case('Reserva')
                    <i class="fa fa-circle text-info"></i>
                    @break   
                @default
            @endswitch

            @if($pm->SITUACAO != 'Normal')
                <strong class="text-danger">{{$pm->SITUACAO}}</strong>
            @else
                <strong>{{$pm->STATUS}}</strong>
            @endif
            
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">
        <table class="table table-bordered">

            <tr>
                <td rowspan="4" class="col-md-2">
                    <a href="http://10.47.1.8/sispics/fotos/{{$pm->RG}}.JPG"><img class="img-responsive" src="http://10.47.1.8/sispics/fotos/{{$pm->RG}}.JPG" max-width="190"></a>
                </td>
                <td class="col-md-5">
                    <strong>Nome:</strong><br>
                    {{$pm->CARGO}} {{$pm->QUADRO}}@if($pm->SUBQUADRO !== 'NA')-{{$pm->SUBQUADRO}} @endif {{$pm->NOME}} 
                </td>
                <td class="col-md-5">
                    <strong>RG:</strong><br>
                    {{$pm->RG}}
                </td>
            </tr>

            <tr>
                <td>
                    <b>Comportamento atual:</b><br>
                    {{$pm->comportamento}} 
                </td>
                <td>
                    @switch($pm->STATUS)
                        @case('Ativo')<b>Data de inclusão:</b><br>@break
                        @case('Inativo')<b>Data Inatividade:</b><br>@break
                        @case('Reserva')<b>Data Reserva:</b><br>@break
                        @default<b>Data de inclusão:</b><br>    
                    @endswitch
                    {{data_br($pm->ADMISSAO_REAL)}} ({{tempo_svc($pm->ADMISSAO_REAL)}})<br>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Cidade:</b><br>
                    {{$pm->CIDADE}} 
                    @if($pm->STATUS == "Inativo")
                        - {{special_ucwords($pm->END_BAIRRO)}}
                    @endif
                    
                </td>
                <td>
                    <b>Data de nascimento: </b><br>
                    {{data_br($pm->NASCIMENTO)}} ({{$pm->IDADE}} Anos) 
                </td>
            </tr>

            <tr>
                <td>
                    <b>Classificacao Meta4:</b><br>
                    {{$pm->OPM_DESCRICAO}}
                </td>
                <td>
                    <b>Email funcional:</b><br>
                    {{$pm->EMAIL_META4}}
                </td>
            </tr>

            {{-- dados adicionais --}}
            @if($adc != "")
            <tr>
                <td colspan="2">
                    <b>CPF:</b><br>
                    {{$adc->CPF}}
                </td>
                <td>
                    <b>Título de eleitor:</b><br>
                    {{$adc->SBR_NUM_TIT}}  Zona: {{$adc->SBR_ZONA}} Seção: {{$adc->SBR_SECAO}}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <b>Nome do pai:</b><br>
                    {{special_ucwords($adc->CBR_NAME_FATHER)}}
                </td>
                <td>
                    <b>Nome da mãe:</b><br>
                    {{special_ucwords($adc->CBR_NAME_MATHER)}}
                </td>
            </tr>
            @endif
            {{-- /dados adicionais --}} 
            @if($pm->STATUS == "Inativo")
            <tr>
                <td colspan="2">
                    <b>Endereço:</b><br>
                    {{special_ucwords($pm->END_RUA)}}, n° {{$pm->END_NUM}} ({{$pm->END_COMPL}}) CEP: {{$pm->END_CEP}}   
                </td> 
                <td>
                    <b>Telefone:</b><br>
                    {{$pm->FONE}}  
                </td>
            </tr>
            @endif 
        </table>
    </div>
</div>{{-- /Dados Principais --}} 