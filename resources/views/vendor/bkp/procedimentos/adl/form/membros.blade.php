<div class="box">{{-- formulário principal --}}
    <div class="box-header">
        {{-- sjd_ref / sjd_ref_ano --}}
        <h4 class="box-title">Membros</h4>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-plus"></i>
            </button> 
        </div>             
    </div>

    <div class="box-body">

    {{--  presidente --}}
    <div class='col-md-4 col-xs-12'>
        {!! Form::label('presidente-rg', 'RG do presidente')!!} <br>
        {!! Form::text('presidente-rg',$presidente['rg'],
        ['onblur' => "completaDados($(this).val(),'presidente-nome','presidente-posto')"]) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('presidente-nome', 'Nome do presidente')!!} <br>
        {!! Form::text('presidente-nome',$presidente['nome'],['readonly']) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('presidente-posto', 'Posto/Graduação')!!} <br>
        {!! Form::text('presidente-posto',$presidente['cargo'],['readonly']) !!}
    </div>

    {{--  escrivao --}}
    <div class='col-md-4 col-xs-12'>
        {!! Form::label('escrivao-rg', 'RG do escrivao')!!} <br>
        {!! Form::text('escrivao-rg',$escrivao['rg'],
        ['onblur' => "completaDados($(this).val(),'escrivao-nome','escrivao-posto')"]) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('escrivao-nome', 'Nome do escrivao')!!} <br>
        {!! Form::text('escrivao-nome',$escrivao['nome'],['readonly']) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('escrivao-posto', 'Posto/Graduação')!!} <br>
        {!! Form::text('escrivao-posto',$escrivao['cargo'],['readonly']) !!}
    </div>

    {{--  defensor --}}
    <div class='col-md-4 col-xs-12'>
        {!! Form::label('defensor-rg', 'RG do defensor')!!} <br>
        {!! Form::text('defensor-rg',$defensor['rg'],
        ['onblur' => "completaDados($(this).val(),'defensor-nome','defensor-posto')"]) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('defensor-nome', 'Nome do defensor')!!} <br>
        {!! Form::text('defensor-nome',$defensor['nome'],['readonly']) !!}
    </div>

    <div class='col-md-4 col-xs-12'>
        {!! Form::label('defensor-posto', 'Posto/Graduação')!!} <br>
        {!! Form::text('defensor-posto',$defensor['cargo'],['readonly']) !!}
    </div>

    </div>
</div>
    
    