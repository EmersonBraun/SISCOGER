<div class="row">{{-- dependentes --}}
    <div class="col-xs-12">
        <div class="box collapsed-box">
            <div class="box-header">
                <h2 class="box-title">Dependentes
                &emsp;<i class="fa fa-info-circle text-info" data-toggle="tooltip" data-placement="bottom" title="O campo poderá ser suprimido nos casos de certidão da Ficha Disciplinar Individual do militar estadual."></i>
                @if(count($dependentes) > 0) <span class="badge bg-red">{{count($dependentes)}}</span> @endif</h2>
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
                        @forelse($dependentes as $dep)
                        <tr>
                            <td>
                            {{special_ucwords($dep['nome'])}} ({{$dep['sexo']}}), {{$dep['parentesco']}} , 
                            Nascimento: {{data_br($dep['data_nasc'])}} ({{tempo_svc($dep['data_nasc'])}}) Convênio: {{$dep['irpf']}}
                            </td>
                        </tr>
                        @empty
                        <tr><td>Não há dependentes.</td></tr>   
                        @endforelse
                        </tbody>
                    </table>   
                </div> 
            </div>   
        </div>
    </div>     
</div>{{-- /dependentes --}}