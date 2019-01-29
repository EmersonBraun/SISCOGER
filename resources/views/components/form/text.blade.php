@php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
    $id = (!isset($id)) ?  $campo : $id;
    $value = (!isset($value)) ?  null : $value;
    //específico do numerador
    if($campo == 'responsavel') $value = session('cargo')." ".special_ucwords(session('nome'));
@endphp
<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset

    {!! Form::label($campo, $titulo) !!}

    @isset($btn)
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-{{$btn['color'] ?? 'info'}}">{{$btn['title']}}</button>
        </div>   
    @endisset

    {{ Form::text($campo, $value, 
    [
        'class' => 'form-control '.$class,
        'id' => $id, 
        $adc
        ]
    ) }}

    @isset($btn)
    </div>
    @endisset

    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>