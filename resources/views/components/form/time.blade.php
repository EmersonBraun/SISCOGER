@php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
@endphp
<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    <i class="fa fa-clock-o"></i>
    {!! Form::label($campo, $titulo) !!}

    @isset($btn)
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-{{$btn['color'] ?? 'info'}}" id='{{$btn['id'] ?? ''}}'>{{$btn['title']}}</button>
        </div>   
    @endisset

    {{ Form::text($campo, null, ['class' => 'form-control timepicker date'.$class, $adc]) }}

    @isset($btn)
    </div>
    @endisset
    
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>
