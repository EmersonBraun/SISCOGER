@php 
    $rows = (!isset($rows)) ?  '5' : $rows;
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
@endphp
<div class="col-lg-{{$lg ?? '12'}} col-md-{{$col ?? '12'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset

    {!! Form::label($campo, $titulo) !!}
    {!! Form::textarea($campo,NULL,['class' => 'form-control '.$class, $adc, 'rows' => $rows]) !!}

    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif

</div>