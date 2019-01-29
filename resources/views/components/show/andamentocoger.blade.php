<div class="col-lg-{{$lg ?? '6'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>Andamento COGER:</strong></p><p> {{ sistema('andamentocoger'.strtoupper($module),$proc['id_andamentocoger']) }}</p>
</div>