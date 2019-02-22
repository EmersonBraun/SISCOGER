<div class="tab-pane" id="membro">
    <h4 class="text-center text-bold">Marcado em procedimentos como Encarregado, Presidente ou Acusador</h4>
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>Proc.</th>
                <th>CDOPM</th>
                <th>Situação</th>
                <th>Andamento</th>
                <th>Ações</th>
            </tr>
        @forelse($membros as $m)
        <tr>
            <td>{{strtoupper($m['procedimento'])}} {{$m['sjd_ref']}} / {{$m['sjd_ref_ano']}}</td>
            <td>{{$m['cdopm']}}</td>
            <td>{{$m['situacao']}} @if(!is_null($m['rg_sustituto'])) Substituído @endif</td>
            <td>{{$m['id_andamento']}}</td>
            <td></td> 
        </tr>
        @empty 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        @endforelse
        </tbody>
    </table>
</div>