@php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
@endphp
<div class="col-lg-{{$lg ?? '12'}} col-md-{{$col ?? '12'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has('sintese_txt')) has-error @endif">
    
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset

    {!! Form::label('sintese_txt', 'Síntese do fato')!!} <br>
    {!! Form::textarea('sintese_txt','',['class' => 'form-control '.$class, $adc, 'rows' => '5']) !!}

    @if ($errors->has('sintese_txt'))
        <span class="help-block">
            <strong>{{ $errors->first('sintese_txt') }}</strong>
        </span>
    @endif

</div>
