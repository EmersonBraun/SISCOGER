<div class="col-lg-{{$lg ?? '6'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <p><strong>{{$title}}:</strong></p>
    @if($proc['relato_file'])
    <p><a href="{{asset('storage/arquivo/'.$module.'/'.$proc)}}" target="_blank"><i class="fa fa-file-pdf-o"></i>{{$proc}}</a></p>
    @else
        <p>Não Há</p>
    @endif
</div>