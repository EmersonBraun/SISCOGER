<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    <div class="form-check">
        @isset($icon)
            <i class="{{$icon}}"></i>
        @endisset
        {{ Form::checkbox($campo, 1, false) }}
        {!! Form::label($campo, $titulo) !!}

        @if ($errors->has($campo))
            <span class="help-block">
                <strong>{{ $errors->first($campo) }}</strong>
            </span>
        @endif
    </div>
</div> 
