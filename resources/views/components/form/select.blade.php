<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset
    {!! Form::label($campo, $titulo) !!}

    @php
        $class = (!isset($class)) ?  '' : $class;
        $opt = (!isset($opt)) ?  [] : $opt;
        $adc = (!isset($adc)) ?  '' : $adc;
    @endphp

    @isset($btn)
    <div class="input-group">
        <div class="input-group-btn">
            <button type="button" class="btn btn-{{$btn['color'] ?? 'info'}}">{{$btn['title']}}</button>
        </div>   
    @endisset

    {!! Form::select($campo,$opt,null, ['class' => 'form-control typeahead '.$class, $adc]) !!}

    @isset($btn)
    </div>
    @endisset

    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>