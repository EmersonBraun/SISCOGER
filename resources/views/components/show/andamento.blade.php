<div class="col-lg-{{$lg ?? '6'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>Andamento:</strong></p><p> {{ sistema('andamento'.strtoupper($module),$proc['id_andamento']) }}</p>
</div>