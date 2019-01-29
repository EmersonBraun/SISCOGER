@php
    $class = (!isset($class)) ? 'btn btn-primary btn-block' : $class;
@endphp
<div class="col-lg-{{$lg ?? '12'}} col-md-{{$col ?? '12'}} col-xs-{{$xs ?? '12'}} form-group">
    @if(!isset($text))
    {{$slot}}   
    @else
    {{ Form::submit($text, ['class' => $class]) }}
    @endif
</div>