<div class="tab-pane" id="objeto">
    <h4 class="text-center text-bold">Marcado em procedimentos como Acusado, Indiciado, Sindicado ou Paciente</h4>
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>Proc.</th>
                <th>CDOPM</th>
                <th>Situação</th>
                <th>Andamento</th>
                <th>Ações</th>
            </tr>
        @forelse($objetos as $o)
        <tr>
            <td>{{strtoupper($o['procedimento'])}} {{$o['sjd_ref']}} / {{$o['sjd_ref_ano']}}</td>
            <td>{{$o['cdopm']}}</td>
            <td>{{$o['situacao']}} @if(!is_null($o['rg_sustituto'])) Substituído @endif</td>
            <td>{{$o['id_andamento']}}</td>
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