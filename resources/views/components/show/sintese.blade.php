<div class="col-lg-{{$lg ?? '12'}} col-md-{{$col ?? '12'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>{{$title ?? 'Sintese do fato'}}:</strong></p>
    @if($proc != '')
        <p> {{ $proc }}</p>
    @else
        <p>Não há</p>
    @endif
</div>