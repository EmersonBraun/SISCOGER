<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><i class="fa fa-calendar"></i> <strong>{{$title ?? 'Data'}}:</strong></p><p> {{ date('d/m/Y',strtotime($proc)) ?? ''}}</p>
</div>