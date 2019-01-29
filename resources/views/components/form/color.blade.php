@php
    $class = (!isset($class)) ?  '' : $class;
@endphp
<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    {!! Form::label($campo, $titulo) !!}
    {{ Form::text($campo, null, ['class' => 'form-control jscolor'.$class]) }}
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>