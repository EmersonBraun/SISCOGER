<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset

    {!! Form::label($campo, $titulo) !!}

    {{$slot}}
    
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>