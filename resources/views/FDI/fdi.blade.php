<div class="tab-pane" id="fdi">
    @can('ver-mudanca-comportamento')
    <table class="table table-striped">
        <h4 class="text-center text-bold">Mudanças de Comportamento</h4>
        <tbody>
            <tr>
                <th><b>Data:</b></th>
                <th><b>Novo comportamento:</b></th>
                <th><b>Sintese:</b></th>
                <th><b>Publicacao:</b></th>
            </tr>
            @forelse($comportamentos as $c)
            <tr>
                <td>{{data_br($c['data'])}}</td>
                <td>{{$c['comportamento']}}</td>
                <td>{{$c['motivo_txt']}}</td>
                <td>{{$c['publicacao']}}</td>
            </tr>
            @empty
            <tr>
                <td> Não há mudanças de comportamento.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endcan
    @can('criar-mudanca-comportamento')
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar mudança de comportamento
    </button>
    @endcan
    @can('ver-elogios')
    <table class="table table-striped">
        <h4 class="text-center text-bold">Elogios</h4>
        <tbody>
            <tr>
                <th><b>Data:</b></th>
                <th><b>OPM:</b></th>
                <th><b>Sintese:</b></th>
            </tr>
            @forelse($elogios as $e)
            <tr>
                <td>{{data_br($e['elogio_data'])}}</td>
                <td>{{$e['opm_abreviatura']}}</td>
                <td>{{$e['descricao_txt']}}</td>
            </tr>
            @empty
            <tr>
                <td> Não há elogios.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @endcan
    @can('criar-elogio')
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar elogio
    </button>
    @endcan
</div>