@php
    $class = (!isset($class)) ?  '' : $class;
    $adc = (!isset($adc)) ?  '' : $adc;
    $id = (!isset($id)) ?  $campo : $id;
    $value = (!isset($value)) ?  null : $value;
@endphp
<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}} form-group @if ($errors->has($campo)) has-error @endif">
    {!! Form::label($campo, $titulo) !!}

    <select name="{{$campo}}" class="form-control">
        <option value="">Selecione</option>
        <option rel="confronto" value="Homicidio">Homicidio</option>
        <option rel="confronto" value="Lesao Corporal">Lesao Corporal</option>
        <option rel="none" value="Extravio de arma">Extravio de arma</option>
        <option rel="none" value="Furto de arma">Furto de arma</option>
        <option rel="none" value="Roubo de arma">Roubo de arma</option>
        <option rel="none" value="Extravio de municao">Extravio de Munição</option>
        <option rel="none" value="Concussao">Concussão (Art. 305)</option>
        <option rel="none" value="Peculato">Peculato (Art. 303)</option>
        <option rel="none" value="Corrupcao passiva">Corrupção passiva (Art. 308)</option>
        <option rel="none" value="Contrabando ou descaminho">Contrabando ou descaminho</option>
        <option rel="none" value="Uso de documento falso">Uso de documento falso (Art. 315)</option>
        <option rel="none" value="Falsidade ideologica">Falsidade ideológica</option>
        <option rel="none" value="Fuga de Preso">Fuga de preso</option>
        <option rel="none" value="Prevaricacao">Prevaricação (Art. 319)</option>
        <option rel="none" value="Violacao do sigilo funcional">Violação do sigilo funcional</option>
        <option rel="none" value="Deserção">Deserção</option>
        <option rel="none" value="Violencia contra superior">Violencia contra superior (Art. 157)</option>
        <option rel="none" value="Violencia contra militar de sv">Violencia contra militar de serviço (Art. 158)</option>
        <option rel="none" value="Desrespeito a superior">Desrespeito a superior (Art. 160)</option>
        <option rel="none" value="Recusa de obediencia">Recusa de obediencia (Art. 163)</option>
        <option rel="none" value="Abandono de posto">Abandono de posto (Art. 195)</option>
        <option rel="none" value="Embriaguez em servico">Embriaguez em serviço (Art. 202)</option>
        <option rel="none" value="Desacato a superior">Desacato a superior (Art. 298)</option>
        <option rel="none" value="Desacato a militar">Desacato a militar (Art. 299)</option>
        <option rel="none" value="Furto">Furto</option>
        <option rel="none" value="Roubo">Roubo</option>
        <option rel="none" value="Dano">Dano</option>
        <option rel="none" value="Instigamento ao suicidio">Instigamento ao suicidio</option>
        <option rel="none" value="Abuso de autoridade">Abuso de autoridade</option>
        <option rel="none" value="Auferir vantagem indevida">Auferir vantagem indevida</option>
        <option rel="none" value="Outros">Outros (especificar)</option>
    </select>

    @if ($errors->has($campo))
        <span class="help-block">
            <strong>{{ $errors->first($campo) }}</strong>
        </span>
    @endif
</div>