<div class="row">{{-- tramiteopm --}}
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Trâmite OPM/OBM
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                @if(count($tramitacaoopm) > 0) <span class="badge bg-red">{{count($tramitacaoopm)}}</span> @endif</h2> 
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
                                <th>OM</th>
                            </tr>
                        @forelse ($tramitacaoopm as $to)
                            <tr>
                                <td>{{data_br($to['data'])}}</td>
                                <td>{{$to['descricao_txt']}}</td>
                                <td>{{$to['digitador']}}</td>
                                <td>{{$to['opm_abreviatura']}}</td>
                            </tr>
                        @empty
                        <tr><td>Não há trâmite.</td></tr>   
                        @endforelse
                    </tbody>
                </table>
                @can('criar-tramite-op')
                <button type="button" class="btn btn-primary btn-block">
                    <i class="fa fa-plus"></i>Adicionar Trâmite OPM
                </button>
                @endcan
                </div> 
            </div>   
        </div>
    </div>     
</div>{{-- /tramiteopm --}}