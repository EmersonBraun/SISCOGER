<div class="col-lg-{{$lg ?? '6'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>{{$title ?? 'OPM/OBM'}}:</strong></p><p> {{ opm($proc[$campo ?? 'cdopm']) }}</p>
</div>