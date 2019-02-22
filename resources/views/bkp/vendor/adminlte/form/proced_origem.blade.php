<div class="box">{{-- procedimentos de origem --}}
        <div class="box-header">
            <h4 class="box-title">Procedimento(s) de Origem (apenas se houver)</h4>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>  

        <div class="box-body">
            <div class="row">
                {!! Form::open(['url' => route('fatd.store')]) !!}
                <input name="ligacao[3][id_ligacao]" type="hidden">
                <div class='col-md-3 col-xs-12'>
                    {!! Form::label('origem_proc', 'Proc. Origem')!!} <br>
                    {!! Form::select('origem_proc', config('sistema.pocedimentosOpcoes')) !!}
                </div>
                <div class='col-md-3 col-xs-12'>
                    {!! Form::label('origem_sjd_ref', 'N°')!!} <br>
                    {!! Form::text('origem_sjd_ref','',['onkeypress' => 'return dntr(this,event)']) !!}
                </div>
                <div class='col-md-3 col-xs-12'>
                    {!! Form::label('origem_sjd_ref_ano', 'Ano')!!} <br>
                    {!! Form::text('origem_sjd_ref_ano','',['onkeypress' => 'return dntr(this,event)','placeholder' => 'Ano com 4 digitos']) !!}
                </div>
                <div class='col-md-3 col-xs-12'>
                    {!! Form::label('origem_opm', 'OPM')!!} <br>
                    {!! Form::text('origem_opm','',['placeholder' => 'Apenas para conferência']) !!}
                </div>
                <div class='col-md-12 col-xs-12'>
                    <input class="noprint" value="Adicionar" onclick="addObjectForm('ligacao','fatd');" type="button">	</td>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>{{-- /procedimentos de origem --}}