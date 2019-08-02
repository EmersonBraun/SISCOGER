<div class="tab-pane" id="sai">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° SAI</th>
                <th>Motivo abertura</th>
                <th>Síntese do fato</th>
                <th>Situação</th>
                <th>Resultado</th>
                <th>Digitaror</th>
                <th>Ações</th>
            </tr>
        @forelse($sai as $s)
        <tr>
            @if ($s['sjd_ref'] !== 0 )
            <td>{{$s['sjd_ref']}} / {{$s['sjd_ref_ano']}} </td>
            @else
            <td>{{$s['id_sai']}}</td> 
            @endif
            <td>{{$s['motivo_principal']}} </td>
            <td>{{$s['sintese_txt']}} </td>
            <td>{{$s['situacao']}} </td>
            <td>{{$s['origem_proc']}}-{{$s['origem_sjd_ref']}}/{{$s['origem_sjd_ref_ano']}} </td>
            <td>{{$s['digitador']}} </td>
            <td>Ações </td>
        </tr>
        @empty 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        @endforelse
        </tbody>
    </table>
    @if(hasPermissionTo('criar-sai'))
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Sai
    </button>
    @endif
</div>