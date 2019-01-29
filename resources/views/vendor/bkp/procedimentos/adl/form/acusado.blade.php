<div class="box">{{-- formulário principal --}}
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Acusado</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    <div class='col-md-3 col-xs-12'>
        {!! Form::label('acusado-rg', 'RG do acusado')!!} <br>
        {!! Form::text('acusado-rg',$envolvido['rg'],['onblur' => "completaDados($(this).val(),'acusado-nome','acusado-posto')"]) !!}
    </div>

    <div class='col-md-3 col-xs-12'>
        {!! Form::label('acusado-nome', 'Nome do acusado')!!} <br>
        {!! Form::text('acusado-nome',$envolvido['nome'],['readonly']) !!}
    </div>

    <div class='col-md-3 col-xs-12'>
        {!! Form::label('acusado-posto', 'Posto/Graduação')!!} <br>
        {!! Form::text('acusado-posto',$envolvido['cargo'],['readonly']) !!}
    </div>

    <div class='col-md-3 col-xs-12'>
        {!! Form::label('acusado-resultado', 'Situação')!!} <br>
        {!! Form::select('acusado-resultado',[
            'Selecione' => 'Selecione',
            'Punido' => 'Punido', 
            'Absolvido' => 'Absolvido', 
            'Outra Medida' => 'Outra Medida',
            'Anulado' => 'Anulado'
    ],$proc['acusado-resultado']) !!}
    </div>

    </div>
</div>



    
    