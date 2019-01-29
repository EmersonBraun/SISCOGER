<select class="select2" name="opm">
<option value=''>Todas as OPM</option>
@foreach($opms as $opm)

    @if (trim($opm->CODIGOBASE)=="") {{$opm->CODIGOBASE="0"}} @endif

    @if ($opm->TITULO=="COMANDO" || $opm->TITULO=="COMANDO GERAL") 

        @if ($firstGroup == "false")

            {{"</optgroup>"}}

       @endif

            {{$firstGroup = "true"}}
            <optgroup LABEL='{{$opm->ABREVIATURA}}'>
            <option value='{{$opm->CODIGOBASE}}'>{{$opm->ABREVIATURA}} (sede)</option>
    
    @endif

        @if ((isset($cdopm_selected)) && ($opm->CODIGOBASE==$cdopm_selected)) {{$selected="selected"}}

        @else {{$selected=""}}

            <option {{$selected}} value='{{corta_zeros($opm->CODIGO)}}'>{{$opm->ABREVIATURA}}</option>

        @endif

@endforeach  
</select>