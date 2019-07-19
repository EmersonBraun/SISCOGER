 @forelse ($properties->attributes as $key => $value)
    @if ($value && $value !== '' && $value !== '-' && $value !== '-0001-11-30' && $value !== '-0001-11-30 00:00:00')
        @if (substr($key, 0, 3) == 'id_')
            @php
                $dado = substr($key, 3, strlen($key));
                switch ($dado) {
                    case 'decorrenciaconselho': $array_sistem = 'decorrenciaConselho'; break;
                    case 'motivoconselho': $array_sistem = 'motivoConselho'; break;
                    case 'situacaoconselho': $array_sistem = 'situacaoConselho'; break;
                    default: $array_sistem = $dado; break;
                }
            @endphp
            {{ $dado }}: {{ sistema($array_sistem, $value)}}<br>
        @else
            {{$key}}: {{$value}}<br>
        @endif
    @endif
@empty
    Não há registros
@endforelse