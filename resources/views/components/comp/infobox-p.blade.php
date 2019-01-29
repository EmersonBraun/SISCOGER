<div class="col-lg-{{$lg ?? '4'}} col-md-{{$col ?? '6'}} col-xs-{{$xs ?? '12'}}">
    <div class="info-box">
        <span class="info-box-icon bg-{{$bg ?? 'info'}}"><i class="{{$icon ?? 'fa fa-envelope-o'}}"></i></span>

        <div class="info-box-content">
        <span class="info-box-text">{{$title}}</span>
        @isset($text)
            <span class="info-box-number">{{$text}}</span>
        @endisset
        @isset($link)
            @foreach ($link as $l) 
                @php $route = $l['route']; @endphp   
                <span class="info-box-number"><a href="{{route($route)}}">{{$l['name']}}</a></span>
            @endforeach
        @endisset
        </div>
        <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
</div>