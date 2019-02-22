@php
    $base = 'http://10.22.9.210/sjd/arquivo/';
    $arquivo = (!isset($arquivo)) ? NULL : $arquivo;
@endphp

@if ($arquivo == NULL)  

<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset
    {!! Form::label($campo, $titulo) !!}
    <input type='file' name='{{$campo}}'> 
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>
    
@else 

<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    @isset($icon)
        <i class="{{$icon}}"></i>
    @endisset
    {!! Form::label($campo, $titulo) !!}
    <!-- adicionar arquivo -->
    <div id='add-{{$campo}}' style='display: none;'>
        <input type='file' name='{{$campo}}'>
    </div>
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
    
    <!-- remover arquivo -->
    <div id='remove-{{$campo}}'>
        <button name='{{$proc-$name-$arquivo}}' type='button' onclick='removerArquivo(this);'>
            <i class='glyphicon glyphicon-trash'></i> <span>Apagar</span>
        </button>

        <a href="{{asset("storage/public/arquivo/$proc/$arquivo")}}" target='_blank'>
            <i class='fa fa-file-pdf-o'></i>{{$arquivo}}
        </a>
    </div>
</div>
@endif

    