@php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
    $id = (!isset($id)) ?  $campo : $id;
@endphp
<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    {!! Form::label($campo, $titulo) !!}
    {{ Form::select($campo, $opms, session('cdopm'), ['class'=>'form-control select2 '.$class, 'id' => $id, $adc]) }}
    
    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>

{{-- esse era o modelo antigo, deixei no código só para ver como melhorou a lógica! 
<select class="select2" name="{{$campo}}">
    <option value=''>Todas as OPM</option>
    @foreach($opms as $opm) 
        @if (trim($opm['CODIGOBASE'])=="") {{$opm['CODIGOBASE']="0"}} @endif
        @if ($opm['TITULO']=="COMANDO" || $opm['TITULO']=="COMANDO GERAL") 
            @if ($firstGroup == "false")
                {{"</optgroup>"}}
            @endif
                {{$firstGroup = "true"}}
                <optgroup LABEL='{{$opm['ABREVIATURA']}}'>
                <option value='{{$opm['CODIGOBASE']}}'>{{$opm['ABREVIATURA']}} (sede)</option>
        @endif
            @if ((isset($cdopm_selected)) && ($opm['CODIGOBASE']==$cdopm_selected)) {{$selected="selected"}}
            @else {{$selected=""}}
                <option {{$selected}} value='{{corta_zeros($opm['CODIGO'])}}'>{{$opm['ABREVIATURA']}}</option>
            @endif
    @endforeach  
</select> 
    --}}