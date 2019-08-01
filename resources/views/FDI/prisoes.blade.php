<div class="tab-pane" id="prisoes">
    <table class="table table-striped">
        <tbody> 
        @forelse($prisoes as $prisoes)
            <tr> 
                <td><b>Inicio</b>: {{data_br($prisoes['inicio_data'])}} <b>Fim</b>: {{data_br($prisoes['fim_data'])}} ({{$prisoes['comarca']}}-{{$prisoes['vara']}}) </td>
            </tr>
        @empty 
            <tr> 
                <td>Não há registros. </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    @can('criar-prisoes')
    <button type="button" class="btn btn-primary btn-block">
        <i class="fa fa-plus"></i>Adicionar prisão
    </button>
    @endcan
</div>