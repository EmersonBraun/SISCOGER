<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <div class="small-box bg-{{$bg ?? 'info'}}">
        <div class="inner">
            <h3>{{$value}}</h3>
            <p>{{$title}}</p>
        </div>
        <div class="icon">
            @foreach ($icon as $i)
                <i class="{{$i}}"></i>
            @endforeach
        </div>
        <a href="{{route($route)}}" class="small-box-footer">{{$text}}<i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>