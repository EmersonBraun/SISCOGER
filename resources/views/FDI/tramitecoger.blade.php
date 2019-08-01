<div class="row">{{-- tramitecoger --}}
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Trâmite COGER
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                @if(count($tramitacao) > 0) <span class="badge bg-red">{{count($tramitacao)}}</span> @endif</h2> 
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-plus"></i>
                    </button> 
                </div>             
            </div>

            <div class="box-body">

                <div class="col-md-12 col-xs-12">   
                    <table class="table table-striped">
                        <tbody> 
                            <tr>
                                <th>Data</th>
                                <th>Descrição</th>
                                <th>Digitador</th>
                            </tr>
                        @forelse ($tramitacao as $t)
                            <tr>
                                <td>{{data_br($t['data'])}}</td>
                                <td>{{$t['descricao_txt']}}</td>
                                <td>{{$t['digitador']}}</td>
                            </tr>
                        @empty
                        <tr><td>Não há trâmite.</td></tr>   
                        @endforelse
                        </tbody>
                    </table>  
                    @can('criar-tramite-coger')
                    <button type="button" class="btn btn-primary btn-block">
                        <i class="fa fa-plus"></i>Adicionar Trâmite COGER
                    </button>
                    @endcan 
                </div> 
            </div>   
        </div>
    </div>     
</div>{{-- /tramitecoger --}}