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
        {!! Form::sfile('fato_file','Relato do fato imputado:','fatd',$proc['fato_file']) !!}
        @if ($errors->has('fato_file'))
            <span class='help-block'>
                <strong>{{$errors->first('fato_file')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('relatorio_file','Relatório:','fatd',$proc['relatorio_file']) !!}
        @if ($errors->has('relatorio_file'))
            <span class='help-block'>
                <strong>{{$errors->first('relatorio_file')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('sol_cmt_file','Solução do Comandante:','fatd',$proc['sol_cmt_file']) !!}
        @if ($errors->has('sol_cmt_file'))
            <span class='help-block'>
                <strong>{{$errors->first('sol_cmt_file')}}</strong>
            </span>
        @endif
    </div>

    {{-- linha --}}
    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('sol_cg_file','Solução do Cmt. Geral:','fatd',$proc['sol_cg_file']) !!}
        @if ($errors->has('sol_cg_file'))
            <span class='help-block'>
                <strong>{{$errors->first('sol_cg_file')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::sfile('notapunicao_file','Nota de punição:','fatd',$proc['notapunicao_file']) !!}
        @if ($errors->has('notapunicao_file'))
            <span class='help-block'>
                <strong>{{$errors->first('notapunicao_file')}}</strong>
            </span>
        @endif
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('publicacaonp', 'Publicação da nota de punição: ')!!} <br>
        {!! Form::text('publicacaonp',$proc['publicacaonp'],['placeholder' => '(Ex: BI nº 12/2011)']) !!}
    </div>

    <div class='col-md-12 col-xs-12'>
        <h5>Arquivos excluídos</h5>
        @forelse ($arquivos_apagados as $aa)
            <div class='col-md-12 col-xs-12'>
                <a href="{{asset('public/storage/arquivo/fatd/'.$proc['id_fatd'].'/'.$aa->objeto.'')}}" target='_blank'>
                    <i class='fa fa-file-pdf-o'></i>{{$aa->objeto}}
                </a>&emsp;Excluído por {{special_ucwords($aa->nome)}}, RG:{{$aa->rg}}, em: {{$aa->created_at}}
            </div>   
        @empty
        <h6>Nenhum arquivo</h6>
        @endforelse
    </div>

    </div>
</div>

