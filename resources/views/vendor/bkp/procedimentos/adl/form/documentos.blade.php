<div class="box">{{-- formulário principal --}}
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Documentos</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    {{-- linha --}}
    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('libelo','Libelo:','adl',$proc['libelo']) !!}
        @if ($errors->has('libelo'))
            <span class='help-block'>
                <strong>{{$errors->first('libelo')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-4 col-xs-12'>
    {!! Form::label('parecer_comissao', 'Parecer comissão')!!} <br>
    {!! Form::text('parecer_comissao', $proc['parecer_comissao']) !!}
    @if ($errors->has('parecer_comissao'))
        <span class="help-block">
            <strong>{{ $errors->first('parecer_comissao') }}</strong>
        </span>
    @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('parecer_file','Parecer:','adl',$proc['parecer_file']) !!}
        @if ($errors->has('parecer_file'))
            <span class='help-block'>
                <strong>{{$errors->first('parecer_file')}}</strong>
            </span>
        @endif
    </div>
    {{-- linha --}}

    <div class='col-md-4 col-xs-12'>
    {!! Form::label('parecer_cmtgeral', 'Parecer CMT Geral')!!} <br>
    {!! Form::text('parecer_cmtgeral', $proc['parecer_cmtgeral']) !!}
    @if ($errors->has('parecer_cmtgeral'))
        <span class="help-block">
            <strong>{{ $errors->first('parecer_cmtgeral') }}</strong>
        </span>
    @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('decisao_file','Parecer CMT Geral:','adl',$proc['decisao_file']) !!}
        @if ($errors->has('decisao_file'))
            <span class='help-block'>
                <strong>{{$errors->first('decisao_file')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-12 col-xs-12'>
        <h5>Arquivos excluídos</h5>
        @forelse ($arquivos_apagados as $aa)
            <div class='col-md-12 col-xs-12'>
                <a href="{{asset('public/storage/arquivo/adl/'.$proc['id_adl'].'/'.$aa->objeto.'')}}" target='_blank'>
                    <i class='fa fa-file-pdf-o'></i>{{$aa->objeto}}
                </a>&emsp;Excluído por {{special_ucwords($aa->nome)}}, RG:{{$aa->rg}}, em: {{$aa->created_at}}
            </div>   
        @empty
        <h6>Nenhum arquivo</h6>
        @endforelse
    </div>

    </div>
</div>

