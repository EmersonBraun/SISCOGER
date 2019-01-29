<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>{{$title}}:</strong></p>
    @if($proc != '')
        <p> {{ $proc }}</p>
    @else
        <p>Não há</p>
    @endif
</div>