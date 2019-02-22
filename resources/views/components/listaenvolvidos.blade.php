<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12">
        <div class="box">
            <div class="box-header">
                <h2 class="box-title">Envolvidos</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button> 
                </div>             
            </div>
            <div class="box-body">
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Situação</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Posto/Graduação Nome RG</b>
                    </div>
                    <div class="col-lg-4 col-md-4 col-xs-4">   
                        <b>Resultado</b>
                    </div>
                @forelse ($envolvidos as $e)
                    @if ($e->nome != '')
                        <div class="col-lg-4 col-md-4 col-xs-4">   
                            {{ $e->situacao }}
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-4">   
                            {{ $e->cargo }} {{ special_ucwords($e->nome) }} - <a href="{{ route('fdi.show',$e->rg) }}" target="_blank">{{ $e->rg }}</a>
                        </div> 
                        <div class="col-lg-4 col-md-4 col-xs-4">
                        @if ( in_array($e->situacao, config('sistema.procTiposAcusados')) )
                            {{ $e->resultado }}
                        @else
                            Não se aplica
                        @endif
                        </div>   
                    @endif
                @empty
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <b>Não há</b>
                    </div> 
                @endforelse
            </div>
        </div>
    </div>
</div>