<div class="tab-pane" id="apresentacoes">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° Apres.</th>
                <th>OPM</th>
                <th>N° OF</th>
                <th>Pessoa</th>
                <th>Tipo</th>
                <th>Autos</th>
                <th>Condição</th>
                <th>Local</th>
                <th>Data/hora</th>
                <th>Situação</th>
            </tr>
        @forelse($apresentacoes as $a)
        <tr>
            <td>{{$a['sjd_ref']}} / {{$a['sjd_ref_ano']}}</td>
            <td>
            @if(!empty($a['opmsigla'])) {{$a['opmsigla']}} @else {{$a['pessoa_unidade_lotacao_sigla']}} @endif
            </td>
            <td>{{$a['documento_de_origem']}}</td>
            <td>{{$a['pessoa_posto']}} {{$a['pessoa_quadro']}} special_ucwords({{$a['pessoa_nome']}})</td>
            <td>{{sistema('apresentacaoTipoProcesso',$a['id_apresentacaotipoprocesso'])}}</td>
            <td>{{$a['autos_numero']}}</td>
            <td>{{sistema('apresentacaoCondicao',$a['id_apresentacaocondicao'])}}</td>
            <td>{{$a['comparecimento_local_txt']}}</td>
            <td>{{date( 'd/m/Y H:i' , strtotime($a['comparecimento_dh']))}}</td>
            <td>{{sistema('apresentacaoSituacao',$a['id_apresentacaosituacao'])}}</td>
        </tr>
        @empty 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        @endforelse
        </tbody>
    </table>
    @can('criar-apresentacao')
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Apresentação
    </button>
    @endcan
</div>