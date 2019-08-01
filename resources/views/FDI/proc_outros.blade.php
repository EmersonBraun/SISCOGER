<div class="tab-pane" id="proc_outros">
    <table class="table table-striped">
        <tbody> 
            <tr>
                <th>N° proc_outros</th>
                <th>Andamento</th>
                <th>Andamento COGER</th>
                <th>Motivo</th>
                <th>Doc. Origem</th>
                <th>Sintese do fato</th>
                <th>Situação</th>
                <th>Resultado</th>
                <th>Digitador</th>
                <th>Ações</th>
            </tr>
        @forelse($proc_outros as $o)
        <tr>
            <td>{{$o['sjd_ref']}}/{{$o['sjd_ref_ano']}}</td>
            <td>{{$o['andamento']}}</td>
            <td>{{$o['andamentocoger']}}</td>
            <td>{{$o['motivo_abertura']}}</td>
            <td>{{$o['doc_origem']}}</td>
            <td>{{$o['sintese_txt']}}</td>
            <td>{{$o['situacao']}}</td>
            <td>{{$o['origem_proc']}}-{{$o['origem_sjd_ref']}}/{{$o['origem_sjd_ref_ano']}}</td>
            <td>{{$o['digitador']}}</td>
            <td>Ações </td>
        </tr>
        @empty 
            <tr>
                <td> Não há registros.</td>
            </tr> 
        @endforelse
        </tbody>
    </table>
    @can('criar-proc-outros')
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar Procedimento Outros
    </button>
    @endcan
</div>