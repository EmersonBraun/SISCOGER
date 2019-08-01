<div class="row">{{-- Afastamentos --}}
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Afastamentos
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                @if(count($afastamentos) > 0) <span class="badge bg-red">{{count($afastamentos)}}</span> @endif</h2>
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
                            @forelse($afastamentos as $af)
                            <tr>
                                <td>
                                    {{$af['DESC_INCIDENTE']}}, 
                                    <b>De {{data_br($af['DT_INIC'])}} a {{data_br($af['DT_FIM'])}}
                                    ({{$af['UNITS']}} Dias)</b>     
                                </td>
                            </tr>
                            @empty
                            <tr><td>Não há registros.</td></tr>
                            @endforelse
                            </tbody>
                    </table>   
                </div> 
            </div>   
        </div>
    </div>     
</div>{{-- /Afastamentos --}}